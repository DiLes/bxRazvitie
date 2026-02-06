<?
/**
 * @global $APPLICATION
 * @global $arUser
 */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Избранное");
$favs = $arUser["UF_FAVORITES"] ?? [];
if (is_string($favs)) {
    $decoded = json_decode($favs, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        $favs = $decoded;
    }
}
$GLOBALS["arrFavsFilter"] = [
    '=ID' => $favs
];
?>
<?if (!empty($favs)){?>
<div class="main-category sub-category-page">
    <div class="main-category__content">
        <div class="featured_block">
            <?
            $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "favorites",
                [
                    "ACTION_VARIABLE" => "action",
                    "ADD_PICT_PROP" => "-",
                    "ADD_PROPERTIES_TO_BASKET" => "Y",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "ADD_TO_BASKET_ACTION" => "ADD",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "BACKGROUND_IMAGE" => "-",
                    "BASKET_URL" => "/personal/basket.php",
                    "BROWSER_TITLE" => "-",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "CACHE_TIME" => "36000000",
                    "CACHE_TYPE" => "A",
                    "COMPATIBLE_MODE" => "N",
                    "CONVERT_CURRENCY" => "N",
                    "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
                    "DETAIL_URL" => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#/",
                    "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "Y",
                    "DISPLAY_COMPARE" => "N",
                    "DISPLAY_TOP_PAGER" => "N",
                    "ELEMENT_SORT_FIELD" => "sort",
                    "ELEMENT_SORT_FIELD2" => "id",
                    "ELEMENT_SORT_ORDER" => "asc",
                    "ELEMENT_SORT_ORDER2" => "desc",
                    "ENLARGE_PRODUCT" => "STRICT",
                    "FILTER_NAME" => "arrFavsFilter",
                    "HIDE_NOT_AVAILABLE" => "N",
                    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                    "IBLOCK_ID" => "2",
                    "IBLOCK_TYPE" => "catalog",
                    "INCLUDE_SUBSECTIONS" => "Y",
                    "LABEL_PROP" => [
                    ],
                    "LAZY_LOAD" => "N",
                    "LINE_ELEMENT_COUNT" => "3",
                    "LOAD_ON_SCROLL" => "N",
                    "MESSAGE_404" => "",
                    "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                    "MESS_BTN_BUY" => "Купить",
                    "MESS_BTN_DETAIL" => "Подробнее",
                    "MESS_BTN_LAZY_LOAD" => "Показать ещё",
                    "MESS_BTN_SUBSCRIBE" => "Подписаться",
                    "MESS_NOT_AVAILABLE" => "Нет в наличии",
                    "MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
                    "META_DESCRIPTION" => "-",
                    "META_KEYWORDS" => "-",
                    "OFFERS_FIELD_CODE" => [
                        0 => "",
                        1 => "",
                    ],
                    "OFFERS_SORT_FIELD" => "sort",
                    "OFFERS_SORT_FIELD2" => "id",
                    "OFFERS_SORT_ORDER" => "asc",
                    "OFFERS_SORT_ORDER2" => "desc",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_TEMPLATE" => "orders",
                    "PAGER_TITLE" => "Товары",
                    "PAGE_ELEMENT_COUNT" => "12",
                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                    "PRICE_CODE" => [
                    ],
                    "PRICE_VAT_INCLUDE" => "Y",
                    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                    "PRODUCT_DISPLAY_MODE" => "N",
                    "PRODUCT_ID_VARIABLE" => "id",
                    "PRODUCT_PROPS_VARIABLE" => "prop",
                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",
                    "PRODUCT_SUBSCRIPTION" => "Y",
                    "PROPERTY_CODE_MOBILE" => [
                    ],
                    "SECTION_CODE" => "",
                    "SECTION_ID" => $_REQUEST["SECTION_ID"],
                    "SECTION_ID_VARIABLE" => "SECTION_ID",
                    "SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/",
                    "SECTION_USER_FIELDS" => [
                        0 => "",
                        1 => "",
                    ],
                    "SEF_MODE" => "Y",
                    "SET_BROWSER_TITLE" => "Y",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "Y",
                    "SET_META_KEYWORDS" => "Y",
                    "SET_STATUS_404" => "N",
                    "SET_TITLE" => "Y",
                    "SHOW_404" => "N",
                    "SHOW_ALL_WO_SECTION" => "N",
                    "SHOW_CLOSE_POPUP" => "N",
                    "SHOW_DISCOUNT_PERCENT" => "N",
                    "SHOW_MAX_QUANTITY" => "N",
                    "SHOW_OLD_PRICE" => "N",
                    "SHOW_PRICE_COUNT" => "1",
                    "SHOW_SLIDER" => "Y",
                    "SLIDER_INTERVAL" => "3000",
                    "SLIDER_PROGRESS" => "N",
                    "TEMPLATE_THEME" => "blue",
                    "USE_ENHANCED_ECOMMERCE" => "N",
                    "USE_MAIN_ELEMENT_SECTION" => "N",
                    "USE_PRICE_COUNT" => "N",
                    "USE_PRODUCT_QUANTITY" => "N",
                    "COMPONENT_TEMPLATE" => "favorites",
                    "SEF_RULE" => "",
                    "SECTION_CODE_PATH" => ""
                ],
                false
            );
            ?>
        </div>
    </div>
    <div class="filter-popup">
        <div class="filter-popup__content">
            <div class="filter-popup__header">
                <button class="filter-back-btn">
                    <svg width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.3327 5.74935C12.7469 5.74935 13.0827 5.41356 13.0827 4.99935C13.0827 4.58514 12.7469 4.24935 12.3327 4.24935V5.74935ZM1.66602 4.24935C1.2518 4.24935 0.916016 4.58514 0.916016 4.99935C0.916016 5.41356 1.2518 5.74935 1.66602 5.74935V4.24935ZM3.80472 8.86537C4.09892 9.15696 4.57379 9.15484 4.86537 8.86064C5.15696 8.56644 5.15484 8.09158 4.86064 7.79999L3.80472 8.86537ZM3.15737 7.16781L3.68533 6.63512L3.15737 7.16781ZM3.15737 2.83089L2.62941 2.2982V2.2982L3.15737 2.83089ZM4.86064 2.19871C5.15484 1.90712 5.15696 1.43225 4.86537 1.13806C4.57379 0.84386 4.09892 0.841741 3.80472 1.13332L4.86064 2.19871ZM1.67928 5.20824L0.935295 5.30307L0.935295 5.30307L1.67928 5.20824ZM1.67928 4.79046L0.935295 4.69563L0.935295 4.69563L1.67928 4.79046ZM12.3327 4.24935H1.66602V5.74935H12.3327V4.24935ZM4.86064 7.79999L3.68533 6.63512L2.62941 7.7005L3.80472 8.86537L4.86064 7.79999ZM3.68533 3.36358L4.86064 2.19871L3.80472 1.13332L2.62941 2.2982L3.68533 3.36358ZM3.68533 6.63512C3.20416 6.15822 2.8891 5.84436 2.67867 5.58234C2.47774 5.33215 2.43467 5.20296 2.42326 5.11341L0.935295 5.30307C0.996041 5.77965 1.22337 6.16576 1.50913 6.52158C1.78539 6.86557 2.17329 7.24844 2.62941 7.7005L3.68533 6.63512ZM2.62941 2.2982C2.17329 2.75026 1.78539 3.13313 1.50913 3.47711C1.22337 3.83294 0.996041 4.21905 0.935295 4.69563L2.42326 4.88529C2.43467 4.79574 2.47774 4.66655 2.67867 4.41636C2.8891 4.15434 3.20416 3.84048 3.68533 3.36358L2.62941 2.2982ZM2.42326 5.11341C2.4136 5.03767 2.4136 4.96103 2.42326 4.88529L0.935295 4.69563C0.909589 4.8973 0.909589 5.10139 0.935295 5.30307L2.42326 5.11341Z" fill="#1A1A1A"/>
                    </svg>
                    <span>Фильтры</span></button>
            </div>
            <div class="filter-popup__welcome">
                <div class="input-section">
                    <span>Цена</span>
                    <div class="inputs">
                        <input type="text" placeholder="От 64 000 ₽" />
                        <input type="text" placeholder="До 898 632 ₽" />
                    </div>
                </div>
                <div class="welcome-item">
                    <span>Категория</span>
                    <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.749998 10L5.25 5.5L0.75 1" stroke="#1A1A1A" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="welcome-item">
                    <span>Назначение</span>
                    <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.749998 10L5.25 5.5L0.75 1" stroke="#1A1A1A" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="welcome-item">
                    <span>Бренд</span>
                    <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.749998 10L5.25 5.5L0.75 1" stroke="#1A1A1A" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
            <div class="filter-popup__slide-content">
                <div class="slide-item">
                    <h3>Категория</h3>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Спортивное оборудование</span>
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Мебель</span>
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Баскетбол</span>
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Бадминтон</span>
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Волейбол</span>
                    </label>
                </div>
                <div class="slide-item">
                    <h3>Назначение</h3>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Социально-коммуникативное развитие</span>
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Познавательное развитие</span>
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Речевое развитие</span>
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Физическое развитие</span>
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Групповая комната</span>
                    </label>
                </div>
                <div class="slide-item">
                    <h3>Бренд</h3>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Бренд номер один</span>
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Бренд номер два</span>
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Бренд номер три</span>
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Бренд номер четыре</span>
                    </label>
                    <label class="custom-checkbox">
                        <input type="checkbox" />
                        <span class="checkmark">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="10"
                                        height="6"
                                        viewBox="0 0 10 6"
                                        fill="none"
                                >
                                    <path
                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                            stroke="#FAFAFA"
                                            stroke-width="1.5"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </span>
                        <span class="checkbox-text">Бренд номер пять</span>
                    </label>
                </div>
            </div>
            <button class="save-filter">Применить</button>
        </div>
    </div>
</div>
    <?}else{?>
    <div class="container white">
        <div class="call_back_info_block empty_cart">
            <div class="call_back_info_ic">
                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/empty_compare.svg" alt="">
            </div>
            <h4 class="call_back_info_title">Список <br> избранных пуст</h4>
            <a href="/catalog/" class="call_back_info_btn">В каталог</a>
        </div>
    </div>
    <?}?>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>