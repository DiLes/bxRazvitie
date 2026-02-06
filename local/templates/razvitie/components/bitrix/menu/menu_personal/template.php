<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!empty($arResult)){
?>
    <div class="tabs">
        <?foreach($arResult as $arItem) {
        ?>
            <div class="tab<?=($arItem["SELECTED"])?(' active'):('')?>" data-target="<?=$arItem["PARAMS"]["DATA_TARGET"]?>" onclick="location.href='<?=$arItem["LINK"]?>'"><?=$arItem["TEXT"]?></div>
        <?}?>
    </div>

<?}?>
