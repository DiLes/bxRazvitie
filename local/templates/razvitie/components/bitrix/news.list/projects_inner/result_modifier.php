<?
foreach($arResult["ITEMS"] as &$arItem){
    $arItem['CATEGORY'] = [];
    foreach ($arItem['PROPERTIES']['CATEGORY']['VALUE'] as $category) {
        $rsSections = CIBlockSection::GetList(["SORT"=>"ASC"], ["ID" => $category],false, ["ID", "NAME"]);
        while ($arSction = $rsSections->Fetch())
        {
            $arItem['CATEGORY'][] = $arSction['NAME'];
        }
    }

}