<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;

$request = Application::getInstance()->getContext()->getRequest();
$data = json_decode(file_get_contents("php://input"), true);

$ids = isset($data["ids"]) && is_array($data["ids"]) ? array_map("intval", $data["ids"]) : [];

if (empty($ids)) {
    echo "<p>Список избранного пуст.</p>";
    exit;
}

$GLOBALS["arrFavoritesFilter"] = ["ID" => $ids];

$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "catalog",
    [
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => 1, // замените на ваш ID инфоблока
        "FILTER_NAME" => "arrFavoritesFilter",
        "PAGE_ELEMENT_COUNT" => 20,
        "PRICE_CODE" => ["BASE"],
        "SET_TITLE" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
    ],
    false
);