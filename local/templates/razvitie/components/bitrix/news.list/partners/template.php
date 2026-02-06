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
?>

<div class="partners">
    <div class="partners__top">
        <svg width="77" height="77" viewBox="0 0 77 77" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="77" height="77" rx="38.5" fill="white"/>
            <path
                    d="M43.3313 34.9983L38.7133 40.54C37.7639 41.6793 37.2892 42.2489 36.6647 42.2489C36.0402 42.2489 35.5655 41.6793 34.6161 40.54L32.6647 38.1983M29.4578 29.6903C31.5214 30.2076 33.6233 28.9941 34.2071 26.9482C35.2956 23.1344 40.7005 23.1344 41.7889 26.9482C42.3727 28.9941 44.4746 30.2076 46.5382 29.6903C50.3853 28.726 53.0878 33.4068 50.3291 36.2563C48.8493 37.7848 48.8493 40.2118 50.3291 41.7404C53.0878 44.5899 50.3853 49.2707 46.5382 48.3063C44.4746 47.7891 42.3727 49.0026 41.7889 51.0484C40.7005 54.8622 35.2956 54.8622 34.2071 51.0484C33.6233 49.0026 31.5214 47.7891 29.4578 48.3063C25.6107 49.2707 22.9082 44.5899 25.6669 41.7404C27.1467 40.2118 27.1467 37.7848 25.6669 36.2563C22.9083 33.4068 25.6107 28.726 29.4578 29.6903Z"
                    stroke="#056BE9"
                    stroke-width="1.77778"
                    stroke-linecap="round"
            />
        </svg>
        <div>
            <span>РАБОТАЕМ ЧЕСТНО</span>
            <h2>
                Мы работаем на
                <span>основных тендерных площадках</span>
            </h2>
        </div>
    </div>
    <div class="swiper partners__swiper">
        <div class="swiper-wrapper">
            <?
            foreach($arResult["ITEMS"] as $arItem){
                $this->AddEditAction($arItem['ID'],$arItem['EDIT_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_DELETE"),array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                $file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>250, 'height'=>250), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                ?>
                <div class="swiper-slide<?=($arItem['CODE'] == 'okrug')?(' osobenniy'):('')?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" data-id="<?=$arItem['ID']?>" data-name="<?=$arItem['NAME']?>">
                    <img src="<?= $file['src'] ?>" alt="<?=$arItem['NAME']?>"/>
                </div>
            <?}?>
        </div>
        <div class="partners__swiper-prev swiper-btn">
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
        <div class="partners__swiper-next swiper-btn">
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