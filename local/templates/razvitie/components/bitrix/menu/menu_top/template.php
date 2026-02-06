<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)){?>
    <nav class="nav-links">
        <?foreach($arResult as $arItem) {?>
            <a href="<?=$arItem["LINK"]?>" class="nav-links__item"><?=$arItem["TEXT"]?></a>
        <?}?>
    </nav>
<?}?>