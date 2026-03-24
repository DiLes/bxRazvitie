<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;

Loader::includeModule('iblock');
Loader::includeModule('catalog');

$arResult['SEARCH'] = [];

foreach ($arResult['CATEGORIES'] as $category_id => $arCategory) {
    foreach ($arCategory['ITEMS'] as $i => $arItem) {
        if (isset($arItem['ITEM_ID'])) {
            $arResult['SEARCH'][] = &$arResult['CATEGORIES'][$category_id]['ITEMS'][$i];
        }
    }
}

// Получаем дополнительные данные для товаров (картинки, цены, разделы)
foreach ($arResult['SEARCH'] as $i => $arItem) {
    if ($arItem['MODULE_ID'] === 'iblock' && mb_substr($arItem['ITEM_ID'], 0, 1) !== 'S') {
        $elementId = intval($arItem['ITEM_ID']);

        // Получаем элемент с картинкой
        $rsElement = CIBlockElement::GetList(
            [],
            [
                '=ID' => $elementId,
                'IBLOCK_ID' => $arItem['PARAM2'],
            ],
            false,
            false,
            [
                'ID',
                'NAME',
                'IBLOCK_ID',
                'PREVIEW_PICTURE',
                'DETAIL_PICTURE',
                'IBLOCK_SECTION_ID',
            ]
        );

        if ($arElement = $rsElement->Fetch()) {
            // Картинка
            $pictureId = $arElement['PREVIEW_PICTURE'] ?: $arElement['DETAIL_PICTURE'];
            if ($pictureId) {
                $arResult['SEARCH'][$i]['IMAGE'] = CFile::GetPath($pictureId);
            } else {
                $arResult['SEARCH'][$i]['IMAGE'] = NO_IMAGE;
            }

            // Цена
            $arPrice = CCatalogProduct::GetOptimalPrice($elementId);
            if ($arPrice && $arPrice['PRICE']) {
                $arResult['SEARCH'][$i]['PRICE'] = $arPrice['PRICE']['PRICE'];
                $arResult['SEARCH'][$i]['PRICE_FORMATTED'] = CurrencyFormat($arPrice['PRICE']['PRICE'], $arPrice['PRICE']['CURRENCY']);
            }

            // Раздел (breadcrumb)
            if ($arElement['IBLOCK_SECTION_ID']) {
                $rsSection = CIBlockSection::GetByID($arElement['IBLOCK_SECTION_ID']);
                if ($arSection = $rsSection->Fetch()) {
                    $arResult['SEARCH'][$i]['SECTION_NAME'] = $arSection['NAME'];

                    // Получаем родительский раздел
                    if ($arSection['IBLOCK_SECTION_ID']) {
                        $rsParent = CIBlockSection::GetByID($arSection['IBLOCK_SECTION_ID']);
                        if ($arParent = $rsParent->Fetch()) {
                            $arResult['SEARCH'][$i]['PARENT_SECTION_NAME'] = $arParent['NAME'];
                        }
                    }
                }
            }
        }
    }
    // Для разделов
    elseif ($arItem['MODULE_ID'] === 'iblock' && mb_substr($arItem['ITEM_ID'], 0, 1) === 'S') {
        $sectionId = intval(mb_substr($arItem['ITEM_ID'], 1));

        $rsSection = CIBlockSection::GetByID($sectionId);
        if ($arSection = $rsSection->Fetch()) {
            $arResult['SEARCH'][$i]['IS_SECTION'] = true;

            // Родительский раздел
            if ($arSection['IBLOCK_SECTION_ID']) {
                $rsParent = CIBlockSection::GetByID($arSection['IBLOCK_SECTION_ID']);
                if ($arParent = $rsParent->Fetch()) {
                    $arResult['SEARCH'][$i]['PARENT_SECTION_NAME'] = $arParent['NAME'];
                }
            }
        }
    }
}
