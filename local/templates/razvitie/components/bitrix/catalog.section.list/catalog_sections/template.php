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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));


//pre($arResult["SECTIONS_TREE"]);
?>

<div class="catalog-main">
    <?
    //pre($arResult["SECTIONS_TREE"]);
    $bgColor = ['#056be9', '#F60504', '#EC9605'];
    $s = 1;
    foreach ($arResult["SECTIONS_TREE"] as $arSection) {
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
        $currentBg = $bgColor[$s % count($bgColor)];
        if ($arSection["PICTURE"]["SRC"])
        {
            $sectionBG = $arSection["PICTURE"]["SRC"];
        } else {
            $sectionBG = NO_IMAGE;
        }
//    pre($arSection);
//    pre($arSection["CHILD"]);
//    pre($arSection["ID"]);
//    pre($arSection["NAME"]);

        /*foreach ($arSection["CHILD"] as $arChild) {
            pre($arChild["ID"]);
        }*/
//pre(count($arSection["CHILD"]));
    ?>
        <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="catalog-main__item catalog-main__item--item-<?=$s?>" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
        <div class="top">
            <h3><?=$arSection["NAME"]?></h3>
            <span><?=$arSection["ELEMENT_CNT_TITLE"]?></span>
            <span class="count">500</span>
        </div>
        <?if ($arSection["CHILD"]){?>
            <div class="bottom">
                <?foreach ($arSection["CHILD"] as $arChild){

                    $words = explode(" ", $arChild["NAME"]); // Разбиваем строку на массив слов

                    if (count($words) > 3) {
                        $chunks = array_chunk($words, 3); // Разделяем массив по 3 слова
                        $formattedName = implode("<br>", array_map(function($chunk) {
                            return implode(" ", $chunk);
                        }, $chunks));

                        $arChild["NAME_FORMATTED"] = $formattedName;
                    } else {
                        $arChild["NAME_FORMATTED"] = $name;
                    }
                    ?>
                    <span><?=$arChild["NAME_FORMATTED"]?></span>
                <?}?>
            </div>
        <?}?>
        <div class="shadow" style="background: <?=$currentBg?>;"></div>
        <img src="<?=$sectionBG?>" alt="<?=$arSection["NAME"]?>">
    </a>
    <?
        $s++;
    }
    ?>
</div>