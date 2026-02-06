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

foreach ($arResult["ORDERS"] as &$order){
    foreach ($order["BASKET_ITEMS"] as &$item){
        $arSelect = ['ID', 'NAME', 'IBLOCK_ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'PROPERTY_MORE_PHOTO'];
        $arFilter = ["ID" => $item["PRODUCT_ID"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y"];
        $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
        while($ob = $res->GetNextElement())
        {
            $fields = $ob->GetFields();
//            pre($fields['IBLOCK_ID']);
//            pre($fields['IBLOCK_ID']);
            if ($fields['IBLOCK_ID'] == 2){
                if (!empty($fields['PREVIEW_PICTURE'])){
                    $item['PICTURE'] = CFile::GetPath($fields['PREVIEW_PICTURE']);
                } elseif (!empty($fields['DETAIL_PICTURE'])) {
                    $item['PICTURE'] = CFile::GetPath($fields['DETAIL_PICTURE']);
                } else {
                    $item['PICTURE'] = NO_IMAGE;
                }
            } elseif ($fields['IBLOCK_ID'] == 3){
                $ssSelect = ['ID', 'NAME', 'IBLOCK_ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'PROPERTY_CML2_LINK'];
                $ssFilter = ["IBLOCK_ID" => 3, "ACTIVE_DATE" => "Y", "ACTIVE" => "Y"];
                $ses = CIBlockElement::GetList([], $ssFilter, false, false, $ssSelect);
                while($sob = $ses->GetNextElement())
                {
                    $sfields = $sob->GetFields();
//                    pre($sfields["PROPERTY_CML2_LINK_VALUE"]);
                    $rrSelect = ['ID', 'NAME', 'IBLOCK_ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE'];
                    $rrFilter = ["ID" => $sfields["PROPERTY_CML2_LINK_VALUE"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y"];
                    $rres = CIBlockElement::GetList([], $rrFilter, false, false, $rrSelect);
                    $rob = $rres->GetNext();
                    if (!empty($rob['PREVIEW_PICTURE'])){
                        $item['PICTURE'] = CFile::GetPath($rob['PREVIEW_PICTURE']);
                    } elseif (!empty($rob['DETAIL_PICTURE'])) {
                        $item['PICTURE'] = CFile::GetPath($rob['DETAIL_PICTURE']);
                    } else {
                        $item['PICTURE'] = NO_IMAGE;
                    }
                }
            }
        }
    }
}
//pre($arResult["ORDERS"]);