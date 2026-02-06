<?
foreach($arResult["ITEMS"] as $k => &$arItem){
    $svgId = $arItem["PROPERTIES"]["SVG_ICONS"]["VALUE"];
    $res = CIBlockElement::GetByID($svgId);
    while($ar_res = $res->GetNext()){
        $arItem["ICON"] = $ar_res["PREVIEW_TEXT"];
        $arItem["~ICON"] = $ar_res["~PREVIEW_TEXT"];
    }
}
?>