<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (!empty($arResult)){?>
    <nav>
        <?foreach($arResult as $arItem) {
            $name = $arItem["PARAMS"]["UF_SHORT_NAME"] ?: $arItem["TEXT"];?>
            <a href="<?=$arItem["LINK"]?>"><?=$name?></a>
        <?}?>
    </nav>
<?}?>