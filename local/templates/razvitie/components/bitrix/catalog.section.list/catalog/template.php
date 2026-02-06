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
//pre($arResult);

?>

<div class="page-head">
    <a href="javascript:void(0);" onclick="history.back()">
        <svg width="65" height="65" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="32.5" cy="32.5" r="32.5" fill="white" />
            <g opacity="0.5">
                <path
                        d="M36 38L30 32L36 26"
                        stroke="#1A1A1A"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                />
            </g>
        </svg>
    </a>
    <h1>Каталог <span class="all-element-cnt"><?=$arResult['ALL_ELEMENTS_CNT']?> товаров</span></h1>
</div>
<div class="catalog-content">
    <?
    //pre($sectionsTree);
    foreach ($arResult["SECTIONS_TREE"] as $s => $arSection) {
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
        //pre($arSection);
    ?>
        <?//if (empty($arSection["IBLOCK_SECTION_ID"]) && $arSection["DEPTH_LEVEL"] == 1){?>
    <div class="catalog-content__item">

            <?//if ($arSection["DEPTH_LEVEL"] == 1){?>
                <div class="catalog-content__left" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                    <div class="item-top">
                        <span><?=$arSection["NAME"]?></span>
                        <a href="<?=$arSection["SECTION_PAGE_URL"]?>">
                            <svg
                                    width="46"
                                    height="46"
                                    viewBox="0 0 46 46"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                            >
                                <circle
                                        cx="23"
                                        cy="23"
                                        r="22.6406"
                                        stroke="#1A1A1A"
                                        stroke-opacity="0.1"
                                        stroke-width="0.71875"
                                />
                                <path
                                        d="M17.9688 23H28.0312"
                                        stroke="#056BE9"
                                        stroke-width="1.4375"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                />
                                <path
                                        d="M23 17.9688L28.0312 23L23 28.0312"
                                        stroke="#056BE9"
                                        stroke-width="1.4375"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                />
                            </svg>
                        </a>
                    </div>
                    <div class="item-bottom">
                        <h4><?=$arSection['ELEMENT_CNT']?>+</h4>
                        <span>товаров</span>
                    </div>
                    <img src="<?=$arSection["PICTURE"]["SRC"]?>" alt="<?=$arSection["PICTURE"]["ALT"]?>" />
                </div>
            <?//}?>

        <?
        //pre($arSection["CHILD"]);
        if (count($arSection["CHILD"]) > 0){?>
            <div class="catalog-content__right">
                <?foreach ($arSection["CHILD"] as $a => $arChild){?>
                <div class="item">
                    <?if (count($arChild["CHILD"]) > 0){?>
                    <div>
                        <a href="<?=$arChild["SECTION_PAGE_URL"]?>" class="item-child" data-section-id="<?=$arChild["ID"]?>"><?=$arChild["NAME"]?></a>
                            <?
                            if (count($arChild["CHILD"]) > 0){
                                foreach ($arChild["CHILD"] as $s =>  $subChild){

                                    ?>
                                    <a href="<?=$subChild["SECTION_PAGE_URL"]?>" class="<?=(count($subChild["CHILD"]) > 0)?("black"):("");?> item-subchild" data-section-id="<?=$subChild["ID"]?>"><?=$subChild["NAME"]?></a>
                                    <?
                                    if ($subChild["CHILD"]){
                                        foreach ($subChild["CHILD"] as $subSubChild) {
                                            ?>
                                            <a href="<?= $subSubChild["SECTION_PAGE_URL"] ?>" class="item-subsubchild" data-section-id="<?= $subSubChild["ID"] ?>"><?= $subSubChild["NAME"] ?></a>

                                        <?}?>

                                    <?}?>
                                    <?/*if (is_array($subChild["CHILD"]) && count($subChild["CHILD"]) > 4){?>
                                        <button>
                                            Ещё
                                            <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="12"
                                                    height="13"
                                                    viewBox="0 0 12 13"
                                                    fill="none"
                                            >
                                                <g>
                                                    <path
                                                            d="M9.75 5.75L6 9.5L2.25 5.75"
                                                            stroke="#1A1A1A"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                    />
                                                </g>
                                            </svg>
                                        </button>
                                    <?}*/?>


                                    <?
                                }
                            }
                            ?>

                    </div>
                    <?}else{?>
                    <a href="<?=$arChild["SECTION_PAGE_URL"]?>" class="single-link" data-section-id="<?=$arChild["ID"]?>"><?=$arChild["NAME"]?></a>
                    <?}?>
                </div>
                <?}?>
            </div>
        <?}?>
        <a href="#" class="show-all-btn">Показать все</a>
        <div class="shadow"></div>
    </div>
        <?//}?>
<?}?>
    <div class="shadow" style="background: #EC9605;"></div>
</div>