<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/**
 * @var CBitrixPersonalOrderListComponent $component
 * @var array $arParams
 * @var array $arResult
 */

//pre($arParams);
use Bitrix\Iblock\ElementTable;
use Bitrix\Catalog\PriceTable;
use Bitrix\Main\Loader;

Loader::includeModule('iblock');
Loader::includeModule('catalog');

foreach ($arResult["BASKET"] as &$basketItem){
    $arSelect = ['ID', 'NAME', 'IBLOCK_ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'PROPERTY_ARTNUMBER'];
    $arFilter = ["ID" => $basketItem["PRODUCT_ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y"];
    $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    $ob = $res->GetNextElement();
    $fields = $ob->GetFields();
    $basketItem["PROPERTIES"] = [
        "ARTNUMBER" => $fields["PROPERTY_ARTNUMBER_VALUE"],
    ];
}