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
<div class="projects">
    <div class="projects__header">
        <h2>Наши проекты</h2>
        <p>Посмотрите проекты, которые мы реализовали</p>
    </div>
    <div class="swiper projects__swiper">
        <div class="swiper-wrapper">
            <?
            foreach($arResult["ITEMS"] as $arItem){
                $this->AddEditAction($arItem['ID'],$arItem['EDIT_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_DELETE"),array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

//            pre($arItem['PREVIEW_PICTURE']['SRC']);
            ?>
                <div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="left" style="--img-url: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>')">
                        <div class="item">
                            <svg
                                    width="46"
                                    height="46"
                                    viewBox="0 0 46 46"
                                    fill="none"
                                    xmlns="http://www.w3.org/2000/svg"
                            >
                                <rect width="46" height="46" rx="15" fill="#F4F6F8"/>
                                <path
                                        d="M23 33C28.5228 33 33 28.5228 33 23C33 17.4772 28.5228 13 23 13C17.4772 13 13 17.4772 13 23C13 28.5228 17.4772 33 23 33Z"
                                        stroke="#056BE9"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                />
                                <path
                                        d="M23 17V23L27 25"
                                        stroke="#056BE9"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                />
                            </svg>
                            <span>СРОКИ</span>
                            <p><?=$arItem['PROPERTIES']['DEADLINES']['VALUE']?></p>
                        </div>
                        <div class="item">
                            <b>₽</b>
                            <span>БЮДЖЕТ</span>
                            <p><?=$arItem['PROPERTIES']['BUDGET']['VALUE']?></p>
                        </div>
                    </div>
                    <div class="right">
                        <span>
                            <?=$arItem['PROPERTIES']['CITY']['~VALUE']['TEXT']?>
                        </span>
                        <h3><?=$arItem['NAME']?></h3>
                        <p><?=$arItem['PREVIEW_TEXT']?></p>
                        <div class="category-list">
                            <?foreach ($arItem['CATEGORY'] as $category) {?>
                                <span><?=$category?></span>
                            <? } ?>
                        </div>
                    </div>
                </div>
            <?}?>
        </div>
    </div>
    <div class="projects__swiper-button-wraper">
        <div class="projects__swiper-prev swiper-btn">
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
        <div class="projects__swiper-next swiper-btn">
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