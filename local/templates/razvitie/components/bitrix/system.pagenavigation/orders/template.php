<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

$colorSchemes = array(
	"green" => "bx-green",
	"yellow" => "bx-yellow",
	"red" => "bx-red",
	"blue" => "bx-blue",
);
$colorScheme = $colorSchemes[$arParams["TEMPLATE_THEME"] ?? ''] ?? '';
$prevBtn = '
<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M7 13L1 7L7 1" stroke="#1A1A1A" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>';
$nextBtn = '
<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M1 13L7 7L1 1" stroke="#1A1A1A" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
</svg>';

//pre($arResult);
?>
<div class="main-category__products-pagination">
    <?if($arResult["bDescPageNumbering"] === true){?>

        <?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]){?>
            <?if($arResult["bSavePage"]){?>
                <a class="bx-pag-prev 1" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><span><?echo GetMessage("round_nav_back")?></span></a>
                <a class="1111" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">1</a>
            <?}else{?>
                <?if (($arResult["NavPageNomer"]+1) == $arResult["NavPageCount"]){?>
                    <a class="bx-pag-prev 2" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><span><?echo GetMessage("round_nav_back")?></span></a>
                <?}else{?>
                    <a class="bx-pag-prev 3" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><span><?echo GetMessage("round_nav_back")?></span></a>
                <?}?>
                <li class="2222"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><span>1</span></a></li>
            <?}?>
        <?}else{?>
            <li class="bx-pag-prev 4"><span><?echo GetMessage("round_nav_back")?></span></li>
            <li class="bx-active 111"><span>1</span></li>
        <?}?>

        <?
        $arResult["nStartPage"]--;
        while($arResult["nStartPage"] >= $arResult["nEndPage"]+1){
            ?>
            <?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

            <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]){?>
            <li class="bx-active 222"><span><?=$NavRecordGroupPrint?></span></li>
            <?}else{?>
                <li class="3333"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><span><?=$NavRecordGroupPrint?></span></a></li>
            <?}?>

            <?$arResult["nStartPage"]--?>
        <?}?>

        <?if ($arResult["NavPageNomer"] > 1){?>
            <?if($arResult["NavPageCount"] > 1){?>
                <li class="4444"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><span><?=$arResult["NavPageCount"]?></span></a></li>
            <?}?>
            <li class="bx-pag-next 11"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><span><?echo GetMessage("round_nav_forward")?></span></a></li>
        <?}else{?>
            <?if($arResult["NavPageCount"] > 1){?>
                <li class="bx-active 333"><span><?=$arResult["NavPageCount"]?></span></li>
            <?}?>
            <li class="bx-pag-next 22"><span><?echo GetMessage("round_nav_forward")?></span></li>
        <?}?>

    <?}else{?>

        <?if ($arResult["NavPageNomer"] > 1){?>
            <?if($arResult["bSavePage"]){?>
                <a class="bx-pag-prev 5" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><span><?echo GetMessage("round_nav_back")?></span></a>
                <a class="5555" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><span>1</span></a>
            <?}else{?>
                <?if ($arResult["NavPageNomer"] > 2){?>
                    <a class="bx-pag-prev 6" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=$prevBtn?></a>
                <?}else{?>
                    <a class="bx-pag-prev 7" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$prevBtn?></a>
                <?}?>
                <a class="6666" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">1</a>
                <span>...</span>
            <?}?>
        <?}else{?>
            <a class="bx-pag-prev 8"><?=$prevBtn?></a>
            <a class="active 444">1</a>
        <?}?>

        <?
        $arResult["nStartPage"]++;
        while($arResult["nStartPage"] <= $arResult["nEndPage"]-1){
            ?>
            <?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]){?>
            <a class="active 555"><?=$arResult["nStartPage"]?></a>
        <?}else{?>
            <a class="7777" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>
        <?}?>
            <?$arResult["nStartPage"]++?>
        <?}?>

        <?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]){?>
            <?if($arResult["NavPageCount"] > 1){
                //pre($arResult["NavPageCount"]);
                ?>
                    <?if ($arResult["NavPageCount"] > 3){?>
                        <span>...</span>
                    <?}?>
                <a class="8888" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=$arResult["NavPageCount"]?></a>
            <?}?>
            <a class="bx-pag-next 33" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"><?=$nextBtn?></a>
        <?}else{?>
            <?if($arResult["NavPageCount"] > 1){?>
                <a class="active 666"><span><?=$arResult["NavPageCount"]?></span></a>
            <?}?>
            <a class="bx-pag-next 44"><?=$nextBtn?></a>
        <?}?>
    <?}?>

    <?if ($arResult["bShowAll"]){?>
        <?if ($arResult["NavShowAll"]){?>
            <li class="bx-pag-all"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><span><?echo GetMessage("round_nav_pages")?></span></a></li>
        <?}else{?>
            <li class="bx-pag-all"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><span><?echo GetMessage("round_nav_all")?></span></a></li>
        <?}?>
    <?}?>
</div>