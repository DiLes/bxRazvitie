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

//pre($arResult["PROPERTIES"]["CITY"]);
//pre($arResult["PROPERTIES"]["BUDGET"]);
//pre($arResult["PROPERTIES"]["DEADLINES"]);
//pre($arResult["PROPERTIES"]["MORE_PHOTOS"]);
//pre($arResult["PROPERTIES"]["PROCC_TEXT"]);
//pre($arResult["PROPERTIES"]["PROCC1_TITLE"]);
//pre($arResult["PROPERTIES"]["PROCC1_DESC"]);
//pre($arResult["PROPERTIES"]["PROCC1_DESC"]);
//pre($arResult["PROPERTIES"]["PROCC2_TITLE"]);
//pre($arResult["PROPERTIES"]["PROCC2_DESC"]);

?>
<div class="projects_z_page">
    <div class="container white">
        <div class="projects_z_page_block">
            <div class="projects_z_item_top">

                <div class="left_top">
                    <div class="left_top_content">
                        <span><?=$arResult["PROPERTIES"]["CITY"]["~VALUE"]["TEXT"]?></span>
                        <h3><?=$arResult["NAME"]?></h3>
                        <?=$arResult["~DETAIL_TEXT"]?>
                        <a href="#" class="read_more">Подробнее</a>
                    </div>
                    <a href="#" class="btn_z mini request-trigger">Получить индивидуальный расчет</a>
                </div>
                <?if (!empty($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"])){?>
                    <div class="right_top_slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?foreach ($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as $arPhoto){
                                $photo = CFile::GetPath($arPhoto);
                            ?>
                                <div class="swiper-slide">
                                    <img src="<?=$photo?>" alt="">
                                </div>
                            <?}?>
                        </div>

                        <!-- Navigation buttons -->
                        <div class="projects__swiper-button-wraper">
                            <div class="projects__swiper-prev swiper-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <g opacity="0.5">
                                        <path d="M11.25 13.5L6.75 9L11.25 4.5" stroke="#1A1A1A" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                </svg>
                            </div>
                            <div class="projects__swiper-next swiper-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <g opacity="0.5">
                                        <path d="M6.75 13.5L11.25 9L6.75 4.5" stroke="#1A1A1A" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                </svg>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <?}?>
            </div>
            <div class="projects_z_bottom">
                <div class="items">
                    <div class="item">
                        <div class="item_ic">
                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/clock_ic.svg" alt="">
                        </div>
                        <div class="deadlines_sp">
                            <span>СРОКИ</span>
                            <p><?=$arResult["PROPERTIES"]["DEADLINES"]["VALUE"]?></p>
                        </div>
                    </div>
                    <div class="item">
                        <b>₽</b>
                        <div class="deadlines_sp">
                            <span>БЮДЖЕТ</span>
                            <p><?=$arResult["PROPERTIES"]["BUDGET"]["VALUE"]?></p>
                        </div>
                    </div>
                </div>
                <div class="projects_z_content">
                    <?if (!empty($arResult["PROPERTIES"]["PROCC_TEXT"]["VALUE"])){?>
                    <h3>
                        <?=$arResult["PROPERTIES"]["PROCC_TEXT"]["~VALUE"]["TEXT"]?>
                    </h3>
                    <?}?>
                    <div class="projects_z_content_in">
                        <?if ($arResult["PROPERTIES"]["PROCC1_TITLE"]["VALUE"] && $arResult["PROPERTIES"]["PROCC1_DESC"]["~VALUE"]["TEXT"]){?>
                            <div class="projects_z_content_item">
                                <h5>1. <?=$arResult["PROPERTIES"]["PROCC1_TITLE"]["VALUE"]?></h5>
                                <p><?=$arResult["PROPERTIES"]["PROCC1_DESC"]["~VALUE"]["TEXT"]?></p>
                            </div>
                        <?}?>
                        <?
                        if ($arResult["PROPERTIES"]["PROCC2_TITLE"]["VALUE"] && $arResult["PROPERTIES"]["PROCC2_DESC"]["~VALUE"]["TEXT"]){?>
                            <div class="projects_z_content_item">
                                <h5>2. <?=$arResult["PROPERTIES"]["PROCC2_TITLE"]["VALUE"]?></h5>
                                <p><?=$arResult["PROPERTIES"]["PROCC2_DESC"]["~VALUE"]["TEXT"]?></p>
                            </div>
                        <?}?>
                    </div>
                    <a href="javascript:void(0);" class="btn_z mini request-trigger">Получить индивидуальный расчет</a>
                </div>
            </div>
        </div>
    </div>
</div>
