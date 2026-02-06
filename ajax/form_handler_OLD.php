<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Main\Mail\Event;
use Bitrix\Sale;
use Bitrix\Main\Context;
use Bitrix\Main\Type\DateTime;
use Bitrix\Main\Config\Option;

Loader::includeModule("sale");
Loader::includeModule("catalog");
Loader::includeModule("iblock");

header('Content-Type: application/json; charset=utf-8');

global $USER;
$userId = $USER->IsAuthorized() ? $USER->GetID() : null;
$siteId = Context::getCurrent()->getSite();

$formType   = $_POST["FORM_TYPE"] ?? "request";
$name       = trim($_POST["NAME"] ?? "");
$inn        = trim($_POST["INN"] ?? "");
$company    = trim($_POST["COMPANY"] ?? "");
$email      = trim($_POST["EMAIL"] ?? "");
$position   = trim($_POST["POSITION"] ?? "");
$phone      = trim($_POST["PHONE"] ?? "");
$comment    = trim($_POST["COMMENT"] ?? "");
$productId  = (int)($_POST["PRODUCT_ID"] ?? 0);
$iblockIdRequest = 13;

// --- Проверка обязательных полей ---
if (!$name || !$phone) {
    echo json_encode(["status" => "error", "message" => "Не заполнены обязательные поля"]);
    exit;
}

// === Заказ "Купить в 1 клик" ===
if ($formType === "one_click" && $productId > 0) {
    try {
        $order = Sale\Order::create($siteId, $userId);
        $order->setPersonTypeId(1); // ID типа плательщика (проверь в админке)

        $currency = \Bitrix\Currency\CurrencyManager::getBaseCurrency();
        $order->setField("CURRENCY", $currency);
        $order->setField("USER_DESCRIPTION", $comment ?: "Заказ через форму 1 клик");
        $order->setField("DATE_INSERT", new DateTime());

        // --- Корзина ---
        $basket = Sale\Basket::create($siteId);
        $item = $basket->createItem("catalog", $productId);
        $item->setFields([
            "QUANTITY" => 1,
            "CURRENCY" => $currency,
            "LID" => $siteId,
            "PRODUCT_PROVIDER_CLASS" => "CCatalogProductProvider",
        ]);
        $order->setBasket($basket);

        // --- Свойства заказа ---
        $propertyCollection = $order->getPropertyCollection();
        if ($prop = $propertyCollection->getPhone()) {
            $prop->setValue($phone);
        }
        if ($prop = $propertyCollection->getUserEmail()) {
            $prop->setValue($email);
        }
        if ($prop = $propertyCollection->getPayerName()) {
            $prop->setValue($name);
        }

        // --- Доставка ---
        $shipmentCollection = $order->getShipmentCollection();
        $shipment = $shipmentCollection->createItem();
        $service = Sale\Delivery\Services\Manager::getById(1); // ID службы доставки (настрой в админке)
        if ($service) {
            $shipment->setFields([
                "DELIVERY_ID" => $service["ID"],
                "DELIVERY_NAME" => $service["NAME"],
            ]);
        }

        $shipmentItemCollection = $shipment->getShipmentItemCollection();
        foreach ($basket as $basketItem) {
            $shipmentItem = $shipmentItemCollection->createItem($basketItem);
            $shipmentItem->setQuantity($basketItem->getQuantity());
        }

        // --- Оплата ---
        $paymentCollection = $order->getPaymentCollection();
        $payment = $paymentCollection->createItem();
        $paySystem = Sale\PaySystem\Manager::getById(1); // ID платёжной системы (проверь в админке)
        if ($paySystem) {
            $payment->setFields([
                "PAY_SYSTEM_ID" => $paySystem["ID"],
                "PAY_SYSTEM_NAME" => $paySystem["NAME"],
            ]);
        }

        // --- Сохраняем заказ ---
        $order->doFinalAction(true);
        $result = $order->save();

        if (!$result->isSuccess()) {
            echo json_encode(["status" => "error", "message" => implode(", ", $result->getErrorMessages())]);
            exit;
        }

        $orderId = $order->getId();
        $order->setField("STATUS_ID", "N"); // статус "Новый"
        $order->save();

        // --- Уведомление менеджеру ---
        $fields = [
            "ORDER_ID" => $orderId,
            "AUTHOR" => $name,
            "AUTHOR_PHONE" => $phone,
            "AUTHOR_EMAIL" => $email ?: "не указано",
            "COMMENT" => $comment ?: "—",
            "PRODUCT_ID" => $productId,
            "EMAIL_TO" => "manager@site.ru",
            "DATE" => date("d.m.Y H:i"),
        ];

        Event::send([
            "EVENT_NAME" => "ONE_CLICK_ORDER_MANAGER",
            "LID" => $siteId,
            "C_FIELDS" => $fields,
        ]);

        echo json_encode([
            "status" => "success",
            "orderId" => $orderId,
            "message" => "Заказ успешно создан и отправлен менеджеру",
        ]);
        exit;

    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        exit;
    }
}

// === Форма "Запрос" — сохраняем в инфоблок ===
elseif ($formType === "request") {
    try {
        // --- Автоматический номер заявки ---
        $nextNumber = (int)Option::get("custom.forms", "request_counter", 0) + 1;
        Option::set("custom.forms", "request_counter", $nextNumber);

        $el = new CIBlockElement;
        $PROP = [
            "NAME"     => $name,
            "INN"      => $inn,
            "COMPANY"  => $company,
            "EMAIL"    => $email,
            "POSITION" => $position,
            "PHONE"    => $phone,
            "COMMENT"  => $comment,
            "PRODUCT_ID" => $productId,
            "USER_ID" => $userId ?: "Гость",
        ];

        $arLoad = [
            "IBLOCK_ID"       => $iblockIdRequest,
            "NAME"            => "Заявка #{$nextNumber}",
            "ACTIVE"          => "Y",
            "DATE_ACTIVE_FROM"=> ConvertTimeStamp(time(), "FULL"),
            "PROPERTY_VALUES" => $PROP,
            "PREVIEW_TEXT"    => "Новая заявка от {$name}",
            "DETAIL_TEXT"     => "Комментарий: {$comment}\nТелефон: {$phone}\nEmail: {$email}",
        ];

        if ($ID = $el->Add($arLoad)) {
            // --- Уведомление менеджеру ---
            $fields = [
                "AUTHOR" => $name,
                "AUTHOR_PHONE" => $phone,
                "AUTHOR_EMAIL" => $email ?: "не указано",
                "COMMENT" => $comment ?: "—",
                "EMAIL_TO" => "admin@site.ru",
                "USER_ID" => $userId ?: "Гость",
                "REQUEST_ID" => $ID,
                "REQUEST_NUMBER" => $nextNumber,
            ];

            Event::send([
                "EVENT_NAME" => "SEND_REQUEST",
                "LID" => $siteId,
                "C_FIELDS" => $fields,
            ]);

            echo json_encode([
                "status"  => "success",
                "message" => "Заявка успешно сохранена",
                "requestNumber" => $nextNumber,
            ]);
        } else {
            echo json_encode(["status" => "error", "message" => "Ошибка сохранения: " . $el->LAST_ERROR]);
        }

    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}