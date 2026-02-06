<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)){?>
    <div class="header__list">
        <?foreach($arResult as $arItem) {
//            pre($arItem["PARAMS"]["UF_SHORT_NAME"]);
//            $name = $arItem["PARAMS"]["UF_SHORT_NAME"] ?: $arItem["TEXT"];
            ?>
            <?=($arItem["PARAMS"]["SEPARATOR"])?("<span>|</span>"):("")?>
            <a href="<?=$arItem["LINK"]?>" class="<?=($arItem["PARAMS"]["CLASS"])?:("")?>"><?=$arItem["TEXT"]?></a>
        <?}?>
    </div>
<?}?>