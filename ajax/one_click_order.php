<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Sale;
use Bitrix\Main\Mail\Event;

Loader::includeModule("sale");
Loader::includeModule("catalog");
Loader::includeModule("iblock");

header('Content-Type: application/json; charset=utf-8');

$productId = (int)$_POST["PRODUCT_ID"];
$name = trim($_POST["NAME"]);
$inn = trim($_POST["INN"]);
$company = trim($_POST["COMPANY"]);
$email = trim($_POST["EMAIL"]);
$position = trim($_POST["POSITION"]);
$phone = trim($_POST["PHONE"]);
$comment = trim($_POST["COMMENT"]);

if (!$name || !$phone || !$productId) {
    echo json_encode(["status" => "error", "message" => "Не заполнены обязательные поля"]);
    exit;
}

global $USER;

try {
    $basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), SITE_ID);
    $item = $basket->getExistsItem('catalog', $productId);

    if (!$item) {
        $item = $basket->createItem('catalog', $productId);
        $item->setFields([
            'QUANTITY' => 1,
            'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
            'LID' => SITE_ID,
            'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
        ]);
        $basket->save();
    }

    pre($basket);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Ошибка добавления в корзину: " . $e->getMessage()]);
    exit;
}

$fields = [
    "AUTHOR" => htmlspecialcharsbx($name),
    "AUTHOR_PHONE" => htmlspecialcharsbx($phone),
    "AUTHOR_EMAIL" => htmlspecialcharsbx($email ?: "не указано"),
    "PRODUCT_ID" => $productId,
    "COMMENT" => htmlspecialcharsbx($comment),
    "EMAIL_TO" => "admin@site.ru",
    "USER_ID" => $USER->IsAuthorized() ? $USER->GetID() : "Гость",
];
//pre($fields);
if (Event::send(["EVENT_NAME" => "ONE_CLICK_ORDER", "LID" => SITE_ID, "C_FIELDS" => $fields])) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Не удалось отправить письмо"]);
}
