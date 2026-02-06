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

if (!$name || !$phone) {
    echo json_encode(["status" => "error", "message" => "Не заполнены обязательные поля"]);
    exit;
}

/* === КУПИТЬ В 1 КЛИК === */
if ($formType === "one_click" && $productId > 0) {
    try {
        $order = Sale\Order::create($siteId, $userId);
        $order->setPersonTypeId(1);
        $currency = \Bitrix\Currency\CurrencyManager::getBaseCurrency();
        $order->setField("CURRENCY", $currency);
        $order->setField("USER_DESCRIPTION", $comment ?: "Заказ через форму 1 клик");
        $order->setField("DATE_INSERT", new DateTime());

        $basket = Sale\Basket::create($siteId);
        $item = $basket->createItem("catalog", $productId);
        $item->setFields([
            "QUANTITY" => 1,
            "CURRENCY" => $currency,
            "LID" => $siteId,
            "PRODUCT_PROVIDER_CLASS" => "CCatalogProductProvider",
        ]);
        $order->setBasket($basket);

        $propertyCollection = $order->getPropertyCollection();
        if ($prop = $propertyCollection->getPhone()) $prop->setValue($phone);
        if ($prop = $propertyCollection->getUserEmail()) $prop->setValue($email);
        if ($prop = $propertyCollection->getPayerName()) $prop->setValue($name);

        $shipmentCollection = $order->getShipmentCollection();
        $shipment = $shipmentCollection->createItem();
        $service = Sale\Delivery\Services\Manager::getById(1);
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

        $paymentCollection = $order->getPaymentCollection();
        $payment = $paymentCollection->createItem();
        $paySystem = Sale\PaySystem\Manager::getById(1);
        if ($paySystem) {
            $payment->setFields([
                "PAY_SYSTEM_ID" => $paySystem["ID"],
                "PAY_SYSTEM_NAME" => $paySystem["NAME"],
            ]);
        }

        $order->doFinalAction(true);
        $result = $order->save();

        if (!$result->isSuccess()) {
            echo json_encode(["status" => "error", "message" => implode(", ", $result->getErrorMessages())]);
            exit;
        }

        $orderId = $order->getId();
        $order->setField("STATUS_ID", "N");
        $order->save();

        Event::send([
            "EVENT_NAME" => "ONE_CLICK_ORDER_MANAGER",
            "LID" => $siteId,
            "C_FIELDS" => [
                "ORDER_ID" => $orderId,
                "AUTHOR" => $name,
                "AUTHOR_PHONE" => $phone,
                "AUTHOR_EMAIL" => $email ?: "не указано",
                "COMMENT" => $comment ?: "—",
                "PRODUCT_ID" => $productId,
                "EMAIL_TO" => "manager@site.ru",
                "DATE" => date("d.m.Y H:i"),
            ],
        ]);

        echo json_encode(["status" => "success", "orderId" => $orderId]);
        exit;

    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        exit;
    }
}

/* === ОФОРМЛЕНИЕ ЗАКАЗА ИЗ КОРЗИНЫ (checkout) === */
elseif ($formType === "checkout") {
    try {
        $personTypeId = (int)($_POST["PERSON_TYPE_ID"] ?? 1);
        $deliveryId   = (int)($_POST["DELIVERY_ID"] ?? 1);
        $paySystemId  = (int)($_POST["PAY_SYSTEM_ID"] ?? 1);

        $order = Sale\Order::create($siteId, $userId);
        $order->setPersonTypeId($personTypeId);
        $order->setField("CURRENCY", \Bitrix\Currency\CurrencyManager::getBaseCurrency());
        $order->setField("USER_DESCRIPTION", $comment ?: "Заказ с сайта");
        $order->setField("DATE_INSERT", new DateTime());

        // Загружаем корзину пользователя
        $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), $siteId);
        if ($basket->isEmpty()) {
            echo json_encode(["status" => "error", "message" => "Корзина пуста"]);
            exit;
        }
        $order->setBasket($basket);

        // Свойства заказа
        $propertyCollection = $order->getPropertyCollection();
        if ($prop = $propertyCollection->getPhone()) $prop->setValue($phone);
        if ($prop = $propertyCollection->getUserEmail()) $prop->setValue($email);
        if ($prop = $propertyCollection->getPayerName()) $prop->setValue($name);

        // Доставка
        $shipmentCollection = $order->getShipmentCollection();
        $shipment = $shipmentCollection->createItem();
        $service = Sale\Delivery\Services\Manager::getById($deliveryId);
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

        // Оплата
        $paymentCollection = $order->getPaymentCollection();
        $payment = $paymentCollection->createItem();
        $paySystem = Sale\PaySystem\Manager::getById($paySystemId);
        if ($paySystem) {
            $payment->setFields([
                "PAY_SYSTEM_ID" => $paySystem["ID"],
                "PAY_SYSTEM_NAME" => $paySystem["NAME"],
            ]);
        }

        $order->doFinalAction(true);
        $result = $order->save();

        if (!$result->isSuccess()) {
            echo json_encode(["status" => "error", "message" => implode(", ", $result->getErrorMessages())]);
            exit;
        }

        $orderId = $order->getId();

        Event::send([
            "EVENT_NAME" => "NEW_ORDER_CREATED",
            "LID" => $siteId,
            "C_FIELDS" => [
                "ORDER_ID" => $orderId,
                "AUTHOR" => $name,
                "AUTHOR_PHONE" => $phone,
                "AUTHOR_EMAIL" => $email ?: "не указано",
                "COMMENT" => $comment ?: "—",
                "EMAIL_TO" => "manager@site.ru",
            ],
        ]);

        echo json_encode(["status" => "success", "orderId" => $orderId, "message" => "Заказ оформлен"]);
        exit;

    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        exit;
    }
}

/* === ЗАПРОС В ИНФОБЛОК === */
elseif ($formType === "request") {
    try {
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
        ];

        if ($ID = $el->Add($arLoad)) {
            Event::send([
                "EVENT_NAME" => "SEND_REQUEST",
                "LID" => $siteId,
                "C_FIELDS" => [
                    "AUTHOR" => $name,
                    "AUTHOR_PHONE" => $phone,
                    "AUTHOR_EMAIL" => $email ?: "не указано",
                    "COMMENT" => $comment ?: "—",
                    "REQUEST_NUMBER" => $nextNumber,
                    "EMAIL_TO" => "admin@site.ru",
                ],
            ]);

            echo json_encode([
                "status" => "success",
                "message" => "Заявка сохранена",
                "requestNumber" => $nextNumber,
            ]);
        } else {
            echo json_encode(["status" => "error", "message" => $el->LAST_ERROR]);
        }

    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}