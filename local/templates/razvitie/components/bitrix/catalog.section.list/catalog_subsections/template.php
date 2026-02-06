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

//$this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
//$this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

?>
<div class="categories category-page">
    <div class="categories__bottom">
        <div class="swiper categories-swiper__wrapper">

            <div class="swiper-wrapper">
                <?
                foreach ($arResult['SECTIONS'] as $k => $arSection){
                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
                    $img = $arSection["PICTURE"];
                    //echo '<pre>'; print_r($k); echo '</pre>';
                    $extraClass = ($k % 2 === 1) ? ' second-slide' : '';
                ?>
                    <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="swiper-slide<?=$extraClass?>" id="<?=$this->GetEditAreaId($arSection['ID']); ?>">
                        <div class="row">
                            <p><?=$arSection["NAME"]?></p>
                            <svg
                                    width="46"
                                    height="46"
                                    viewBox="0 0 46 46"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                            >
                                <circle cx="23" cy="23" r="23" fill="white" />
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
                        </div>
                        <span><?=$arSection["ELEMENT_CNT"]?></span>
                        <?if (!empty($img)){?>
                        <img src="<?=$img["SRC"]?>" alt="<?=$img["ALT"]?>" />
                        <?}?>
                        <div class="shadow"></div>
                    </a>
                <?}?>
            </div>
        </div>
        <div class="categories__swiper-prev swiper-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <g opacity="0.5">
                    <path
                            d="M11.25 13.5L6.75 9L11.25 4.5"
                            stroke="#1A1A1A"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                    />
                </g>
            </svg>
        </div>
        <div class="categories__swiper-next swiper-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                <g opacity="0.5">
                    <path
                            d="M6.75 13.5L11.25 9L6.75 4.5"
                            stroke="#1A1A1A"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                    />
                </g>
            </svg>
        </div>
    </div>
</div>