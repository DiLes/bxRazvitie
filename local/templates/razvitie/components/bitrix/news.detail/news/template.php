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
if (empty($arParams["FILTER_NAME"])){
    $arParams["FILTER_NAME"] = 'SimilarNewsFilter';
}
if (empty($arParams["USE_FILTER"])){
    $arParams["USE_FILTER"] = 'Y';
}
$date = null;
$img = null;
if (!empty($arResult["PREVIEW_PICTURE"])){
    $img = $arResult["PREVIEW_PICTURE"];
}elseif (!empty($arResult["DETAIL_PICTURE"])){
    $img = $arResult["DETAIL_PICTURE"];
}
if($arResult['ACTIVE_FROM']) {
    $date = $arResult['ACTIVE_FROM'];
} else {
    $date = ConvertDateTime($arResult['DATE_CREATE'], "DD.MM.YYYY");
}
$rsFile = CFile::GetByID($arResult['PROPERTIES']['AUTHOR_IMG']['VALUE']);
$authorImg = $rsFile->Fetch();
//pre($arResult["PROPERTIES"]);
//pre($arResult["PROPERTIES"]["QUOTE"]["~VALUE"]);
//pre($arResult["PROPERTIES"]["PICS_NEWS"]["VALUE"]);
?>
<div class="news_page">
    <div class="container">
        <div class="news_page_top">
            <span class="date_sp desc"><?=$date?></span>
            <h2 class="news_page_title"><?=$arResult["NAME"]?>
                <div class="news_page_top_actions">
                    <span class="date_sp mob"><?=$date?></span>
                    <div class="share-container">
                        <button class="share_btn">
                            <span>Поделиться</span>
                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share.svg" alt="">
                        </button>

                        <div class="share-modal">
                            <ul>
                                <li class="copy-link">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_link.svg" alt="">
                                    <span>Скопировать ссылку</span>
                                </li>
                                <hr>
                                <li>
                                    <a href="https://wa.me/?text=file<?=$arResult["DETAIL_PAGE_URL"]?>" class="share-item whatsapp">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_wa.svg" alt="">
                                        <span>WhatsApp</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://t.me/share/url?url=file<?=$arResult["DETAIL_PAGE_URL"]?>" class="share-item telegram">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_tg.svg" alt="">
                                        <span>Telegram</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://vk.com/share.php?url=file<?=$arResult["DETAIL_PAGE_URL"]?>" class="share-item vk">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_vk.svg" alt="">
                                        <span>ВКонтакте</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://connect.ok.ru/offer?url=file<?=$arResult["DETAIL_PAGE_URL"]?>" class="share-item odnoklassniki">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_ok.svg" alt="">
                                        <span>Одноклассники</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </h2>
            <?if (!empty($img["SRC"])){?>
                <img src="<?=$img["SRC"]?>" alt="<?=$img["ALT"]?>" class="news_page_main_img">
            <?}?>
        </div>

        <div class="white_container">
            <div class="mini_container">
                <div class="news_p_item">
                    <?=$arResult["DETAIL_TEXT"]?>

                    <?if (!empty($arResult["PROPERTIES"]["QUOTE"]["VALUE"])){?>
                        <div class="author_box">
                            <div class="author_box_top">
                                <span class="author_ic">“</span>
                                <div class="author_box_content">
                                    <p>
                                        <?=$arResult["PROPERTIES"]["QUOTE"]["~VALUE"]["TEXT"]?>
                                    </p>
                                    <div class="author_box_bottom">
                                        <img src="<?=$authorImg["SRC"]?>" alt="<?=$authorImg["ALT"]?>">
                                        <h6>
                                            <?=$arResult['PROPERTIES']['AUTHOR_NAME']['VALUE']?>
                                            <span>Автор</span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?}?>
                </div>
                <?if (!empty($arResult["PROPERTIES"]["PICS_NEWS"]["VALUE"])){?>
                <div class="news_page_slider">
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <?foreach ($arResult["PROPERTIES"]["PICS_NEWS"]["VALUE"] as $val){
                                $rsImg = CFile::GetByID($val);
                                $arImg = $rsImg->Fetch();
                                ?>
                                <div class="swiper-slide">
                                    <img src="<?=$arImg["SRC"]?>" alt="<?=$arImg["ALT"]?>">
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
                <?if (!empty($arResult["PROPERTIES"]["DOP_TEXT"]["VALUE"])){?>
                <div class="news_p_item">
                    <?=$arResult["PROPERTIES"]["DOP_TEXT"]["~VALUE"]["TEXT"]?>
                    <div class="author_box_white">
                        <div class="author_box_bottom">
                            <img src="<?=$authorImg["SRC"]?>" alt="<?=$authorImg["ALT"]?>">
                            <h6>
                                <?=$arResult['PROPERTIES']['AUTHOR_NAME']['VALUE']?>
                                <span>Автор</span>
                            </h6>
                        </div>
                        <div class="share-container">
                            <button class="share_btn">
                                <span>Поделиться</span>
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share.svg" alt="">
                            </button>

                            <div class="share-modal">
                                <ul>
                                    <li class="copy-link">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_link.svg" alt="">
                                        <span>Скопировать ссылку</span>
                                    </li>
                                    <hr>
                                    <li>
                                        <a href="https://wa.me/?text=file<?=$arResult["DETAIL_PAGE_URL"]?>" class="share-item whatsapp">
                                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_wa.svg" alt="">
                                            <span>WhatsApp</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://t.me/share/url?url=file<?=$arResult["DETAIL_PAGE_URL"]?>" class="share-item telegram">
                                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_tg.svg" alt="">
                                            <span>Telegram</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://vk.com/share.php?url=file<?=$arResult["DETAIL_PAGE_URL"]?>" class="share-item vk">
                                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_vk.svg" alt="">
                                            <span>ВКонтакте</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://connect.ok.ru/offer?url=file<?=$arResult["DETAIL_PAGE_URL"]?>" class="share-item odnoklassniki">
                                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_ok.svg" alt="">
                                            <span>Одноклассники</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?}?>
            </div>
        </div>
    </div>
</div>
<?
global $SimilarNewsFilter;
if (!empty($arResult["PROPERTIES"]["SIMILAR_NEWS"]["VALUE"]) && is_array($arResult["PROPERTIES"]["SIMILAR_NEWS"]["VALUE"])) {
    $SimilarNewsFilter = [
        "ID" => $arResult["PROPERTIES"]["SIMILAR_NEWS"]["VALUE"],
    ];
} else {
    $SimilarNewsFilter = [
        "!ID" => $arResult['ID'],
    ];
}
//pre($SimilarNewsFilter);
if (!empty($SimilarNewsFilter)){
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "news_similar",
        [
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "NEWS_COUNT" => $arParams["NEWS_COUNT"],

            "SORT_BY1" => $arParams["SORT_BY1"],
            "SORT_ORDER1" => $arParams["SORT_ORDER1"],
            "SORT_BY2" => $arParams["SORT_BY2"],
            "SORT_ORDER2" => $arParams["SORT_ORDER2"],

            "FILTER_NAME" => $arParams["FILTER_NAME"],
            "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
            "PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
            "CHECK_DATES" => $arParams["CHECK_DATES"],
            "IBLOCK_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["news"],
            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
            "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["detail"],
            "SEARCH_PAGE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["search"],

            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],

            "PREVIEW_TRUNCATE_LEN" => $arParams["PREVIEW_TRUNCATE_LEN"],
            "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
            "SET_TITLE" => $arParams["SET_TITLE"],
            "SET_BROWSER_TITLE" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_META_DESCRIPTION" => "Y",
            "MESSAGE_404" => $arParams["MESSAGE_404"],
            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
            "SHOW_404" => $arParams["SHOW_404"],
            "FILE_404" => $arParams["FILE_404"],
            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
            "INCLUDE_IBLOCK_INTO_CHAIN" => $arParams["INCLUDE_IBLOCK_INTO_CHAIN"],
            "ADD_SECTIONS_CHAIN" => "N",
            "HIDE_LINK_WHEN_NO_DETAIL" => $arParams["HIDE_LINK_WHEN_NO_DETAIL"],

            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "INCLUDE_SUBSECTIONS" => "Y",

            "DISPLAY_DATE" => $arParams["DISPLAY_DATE"],
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => $arParams["DISPLAY_PICTURE"],
            "DISPLAY_PREVIEW_TEXT" => $arParams["DISPLAY_PREVIEW_TEXT"],
            "MEDIA_PROPERTY" => ($arParams["MEDIA_PROPERTY"] ?? ''),
            "SLIDER_PROPERTY" => ($arParams["SLIDER_PROPERTY"] ?? ''),

            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
            "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
            "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
            "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
            "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
            "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
            "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
            "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],

            "USE_RATING" => $arParams["USE_RATING"],
            "DISPLAY_AS_RATING" => $arParams["DISPLAY_AS_RATING"],
            "MAX_VOTE" => $arParams["MAX_VOTE"],
            "VOTE_NAMES" => $arParams["VOTE_NAMES"],

            "USE_SHARE" => $arParams["LIST_USE_SHARE"],
            "SHARE_HIDE" => $arParams["SHARE_HIDE"],
            "SHARE_TEMPLATE" => $arParams["SHARE_TEMPLATE"],
            "SHARE_HANDLERS" => $arParams["SHARE_HANDLERS"],
            "SHARE_SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
            "SHARE_SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],

            "TEMPLATE_THEME" => ($arParams["TEMPLATE_THEME"] ?? ''),
        ],
        $component
    );
}

?>