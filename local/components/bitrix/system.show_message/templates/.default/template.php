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
//$APPLICATION->ShowTitle("Сравнение товаров");
?>
<ul class="breadcrumb_z container">
    <li><a href="<?=SITE_DIR?>">Главная</a></li>
    <li><img src="<?SITE_TEMPLATE_PATH?>/src/assets/svgicons/arrow-right.svg" alt=""></li>
    <li>Сравнение товаров</li>
</ul>

<div class="cart_z">
    <div class="container">
        <div class="page-head">
            <div class="cart_z_top_actions">
                <h1>Сравнение товаров</h1>
            </div>
        </div>
    </div>
    <div class="container white">
        <div class="call_back_info_block empty_cart">
            <div class="call_back_info_ic">
                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/empty_compare.svg" alt="">
            </div>
            <h4 class="call_back_info_title">Список <br> сравнения пуст</h4>
            <p class="call_back_info_text">
                Добавьте товары из каталога, чтобы <br> начать сравнение
            </p>
            <a href="/catalog/" class="call_back_info_btn">В каталог</a>
        </div>
    </div>
    <div class="container white">
        <div class="recomended-products smilar-products cart_recom">
            <h2>Вы недавно смотрели</h2>
            <div class="swiper recomended-products__wrapper">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.products.viewed",
                    "catalog",
                    Array(
                        "ACTION_VARIABLE" => "action_cpv",
                        "ADDITIONAL_PICT_PROP_2" => "-",
                        "ADDITIONAL_PICT_PROP_3" => "-",
                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                        "ADD_TO_BASKET_ACTION" => "ADD",
                        "BASKET_URL" => "/personal/basket.php",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "3600",
                        "CACHE_TYPE" => "A",
                        "CONVERT_CURRENCY" => "N",
                        "DEPTH" => "2",
                        "DISPLAY_COMPARE" => "N",
                        "ENLARGE_PRODUCT" => "STRICT",
                        "HIDE_NOT_AVAILABLE" => "Y",
                        "HIDE_NOT_AVAILABLE_OFFERS" => "Y",
                        "IBLOCK_ID" => "2",
                        "IBLOCK_MODE" => "single",
                        "IBLOCK_TYPE" => "catalog",
                        "LABEL_PROP_2" => array(),
                        "LABEL_PROP_POSITION" => "top-left",
                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                        "MESS_BTN_BUY" => "Купить",
                        "MESS_BTN_DETAIL" => "Подробнее",
                        "MESS_BTN_SUBSCRIBE" => "Подписаться",
                        "MESS_NOT_AVAILABLE" => "Нет в наличии",
                        "PAGE_ELEMENT_COUNT" => "9",
                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                        "PRICE_CODE" => array("BASE"),
                        "PRICE_VAT_INCLUDE" => "Y",
                        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                        "PRODUCT_ID_VARIABLE" => "id",
                        "PRODUCT_PROPS_VARIABLE" => "prop",
                        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false},{'VARIANT':'3','BIG_DATA':false}]",
                        "PRODUCT_SUBSCRIPTION" => "Y",
                        "SECTION_CODE" => "",
                        "SECTION_ELEMENT_CODE" => "",
                        "SECTION_ELEMENT_ID" => $GLOBALS["CATALOG_CURRENT_ELEMENT_ID"],
                        "SECTION_ID" => $GLOBALS["CATALOG_CURRENT_SECTION_ID"],
                        "SHOW_CLOSE_POPUP" => "N",
                        "SHOW_DISCOUNT_PERCENT" => "N",
                        "SHOW_FROM_SECTION" => "N",
                        "SHOW_MAX_QUANTITY" => "N",
                        "SHOW_OLD_PRICE" => "N",
                        "SHOW_PRICE_COUNT" => "1",
                        "SHOW_SLIDER" => "Y",
                        "SLIDER_INTERVAL" => "3000",
                        "SLIDER_PROGRESS" => "N",
                        "TEMPLATE_THEME" => "",
                        "USE_ENHANCED_ECOMMERCE" => "N",
                        "USE_PRICE_COUNT" => "N",
                        "USE_PRODUCT_QUANTITY" => "N"
                    )
                );
                ?>
            </div>
            <div class="smilar-products__swiper-button-wraper">
                <div class="recomended-products__swiper-prev swiper-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <g opacity="0.5">
                            <path d="M11.25 13.5L6.75 9L11.25 4.5" stroke="#1A1A1A" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                    </svg>
                </div>
                <div class="recomended-products__swiper-next swiper-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <g opacity="0.5">
                            <path d="M6.75 13.5L11.25 9L6.75 4.5" stroke="#1A1A1A" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>