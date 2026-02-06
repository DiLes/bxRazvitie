<?
foreach ($arResult["BASKET"] as $k => &$item){
    $element = \Bitrix\Iblock\Elements\ElementCatalogTable::getByPrimary($item["PRODUCT_ID"], [
        'select' => ['ID', 'PREVIEW_PICTURE', 'DETAIL_PICTURE'],
        "cache" => ["ttl" => 3600],
    ])->fetch();
    $arResult["BASKET"][$k]["PREVIEW_PICTURE"] = CFile::GetPath($element["PREVIEW_PICTURE"]);
    $arResult["BASKET"][$k]["DETAIL_PICTURE"] = CFile::GetPath($element["DETAIL_PICTURE"]);
}
