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
<div class="reviews">
    <div class="reviews__header">
        <h2>Отзывы</h2>
        <p>Посмотрите, что о нас пишут руководители организаций, с которыми мы работали</p>
    </div>
    <div class="swiper reviews__swiper">
        <div class="swiper-wrapper">
            <?
            foreach($arResult["ITEMS"] as $k => $arItem){
            $this->AddEditAction($arItem['ID'],$arItem['EDIT_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_DELETE"),array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $pic = $arItem['DETAIL_PICTURE'] ?: $arItem['PREVIEW_PICTURE'];
            $img = CFile::GetPath($arItem['PROPERTIES']['IMG']['VALUE']);
            $videoBG = CFile::GetPath($arItem['PROPERTIES']['VIDEO_BG']['VALUE']);
            $jobTitle = $arItem['PROPERTIES']['JOB_TITLE']['VALUE'];
            $fio = $arItem['PROPERTIES']['FIO']['VALUE'];
            $institution = $arItem['PROPERTIES']['INSTITUTION']['VALUE'];
            $play = ($arItem['PROPERTIES']['VIDEO']['VALUE']) ? $arItem['PROPERTIES']['VIDEO']['VALUE']['path'] : $arItem['PROPERTIES']['VIDEO_YOUTUBE']['VALUE'];
            ?>
                <?
                    switch ($arItem['PROPERTIES']['TYPE']['VALUE_XML_ID']) {
                        case 'video':
                ?>
                        <div class="swiper-slide reviews__item reviews__item--video" style="--img: url(<?= !empty($videoBG) ? $videoBG : $pic['SRC'] ?>)">
                            <div class="row">
                                <a href="<?=$play?>"
                                   class="play-btn video-play glightbox" target="_blank">
                                    <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="15"
                                            height="16"
                                            viewBox="0 0 15 16"
                                            fill="none"
                                    >
                                        <path
                                                d="M9.05263 3.40857C11.6952 4.91531 13.0165 5.66868 13.4599 6.65225C13.8467 7.51015 13.8467 8.48985 13.4599 9.34775C13.0165 10.3313 11.6952 11.0847 9.05263 12.5914C6.41005 14.0982 5.08876 14.8515 4.00454 14.739C3.05884 14.6408 2.19973 14.151 1.6408 13.3912C1 12.5202 1 11.0135 1 8C1 4.98652 1 3.47978 1.6408 2.60875C2.19973 1.84901 3.05884 1.35916 4.00454 1.261C5.08876 1.14846 6.41005 1.90183 9.05263 3.40857Z"
                                                fill="#1A1A1A"
                                                stroke="#1A1A1A"
                                                stroke-width="1.5"
                                        />
                                    </svg>
                                </a>
                                <span>Смотреть отзыв</span>
                            </div>
                            <div class="col">
                                <?if(!empty($fio)) {?>
                                <h4><?=$fio?></h4>
                                <? } ?>
                                <?if (!empty($jobTitle)) {?>
                                <p><?=$jobTitle?></p>
                                <?}?>
                            </div>
                            <div class="shadow-1"></div>
                            <div class="shadow-2"></div>
                        </div>

                    <?
                        break;
                        case 'text':
                    ?>
                            <div class="swiper-slide reviews__item reviews__item--text">
                                <span class="apos">“</span>
                                <h3><?=$arItem['NAME']?></h3>
                                <p><?=$arItem['PREVIEW_TEXT']?></p>
                                <div class="reviews__author">
                                    <? if (!empty($img)) {?>
                                        <div><img src="<?= $img ?>" alt=""/></div>
                                    <?} else {?>
                                        <div><?= mb_substr($institution, 0, 1, 'UTF-8') ?></div>
                                    <? } ?>
                                    <?if (!empty($institution)) {?>
                                    <span><?=$institution?></span>
                                    <? } ?>
                                </div>
                            </div>

                        <?break;?>
            <?
                    }
            }
            ?>
        </div>
    </div>
    <div class="reviews__swiper-button-wraper">
        <div class="reviews__swiper-prev swiper-btn">
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
        <div class="reviews__swiper-next swiper-btn">
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