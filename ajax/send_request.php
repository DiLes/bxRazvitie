<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Main\Event;

Loader::includeModule("iblock");

// Проверка обязательных полей
$name = trim($_POST["NAME"]);
$phone = trim($_POST["PHONE"]);

if (empty($name) || empty($phone)) {
    echo "ERROR: Не заполнены обязательные поля.";
    return;
}

$IBLOCK_ID = 13;

$el = new CIBlockElement;

$PROP = [
    "NAME"     => $name,
    "INN"      => trim($_POST["INN"]),
    "COMPANY"  => trim($_POST["COMPANY"]),
    "EMAIL"    => $email,
    "POSITION" => trim($_POST["POSITION"]),
    "PHONE"    => $phone,
    "COMMENT"  => trim($_POST["COMMENT"]),
    "PRODUCT_ID" => trim($_POST["PRODUCT_ID"]),
];

$arLoadProductArray = [
    "IBLOCK_ID"       => $IBLOCK_ID,
    "PROPERTY_VALUES" => $PROP,
    "NAME"            => "Заявка #".date("YmdHis"),
    "ACTIVE"          => "Y"
];

if ($ELEMENT_ID = $el->Add($arLoadProductArray)) {
    // Триггерим событие
    $event = new Event("main", "OnAfterFormRequest", [
        "ELEMENT_ID" => $ELEMENT_ID,
        "FIELDS"     => $PROP
    ]);
    $event->send();

    echo "OK";
} else {
    echo "ERROR: " . $el->LAST_ERROR;
}
