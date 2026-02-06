<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$incService = $arResult["PROPERTIES"]["INCLUDED_SERVICE"]["~VALUE"]["TEXT"];
$text1Bold = $arResult["PROPERTIES"]["TEXT1_BOLD"]["~VALUE"]["TEXT"];
$text2 = $arResult["PROPERTIES"]["TEXT2"]["~VALUE"]["TEXT"];
$text3 = $arResult["PROPERTIES"]["TEXT3"]["~VALUE"]["TEXT"];
$img = null;
if (!empty($arResult["PREVIEW_PICTURE"])){
    $img = $arResult["PREVIEW_PICTURE"];
}elseif (!empty($arResult["DETAIL_PICTURE"])){
    $img = $arResult["DETAIL_PICTURE"];
}
?>
<div class="comprehensive_equipping">
    <div class="container white">
        <span class="what_is_mini_sp">ЧТО ВХОДИТ В УСЛУГУ</span>
        <?if (!empty($incService)){?>
        <h3 class="section_mini_title"><?=$incService?></h3>
        <?}?>
        <div class="texts">
            <?if (!empty($text1Bold)){?>
            <p class="black_p">
                <?=$text1Bold?>
            </p>
            <?}?>
            <?if (!empty($text2)){?>
            <p>
                <?=$text2?>
            </p>
            <?}?>
            <?if (!empty($text3)){?>
            <p>
                <?=$text3?>
            </p>
            <?}?>
        </div>
        <?if (!empty($img)){?>
        <img src="<?=$img["SRC"]?>" alt="<?=$img["ALT"]?>" class="guarantees_main_img">
        <?}?>
    </div>
</div>
