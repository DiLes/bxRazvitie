<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>
<div class="container white">
    <div class="call_back_info_block empty_cart">
        <div class="call_back_info_ic">
            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/empty_cart_ic.svg" alt="">
        </div>
        <h4 class="call_back_info_title">Ваша <br> корзина пуста</h4>
        <p class="call_back_info_text">
            Добавьте товары в корзину, <br> чтобы оформить заказ
        </p>
        <a href="/catalog/" class="call_back_info_btn">В каталог</a>
    </div>
</div>

<div class="container white">
    <div class="recomended-products smilar-products cart_recom">
        <h2>Вы недавно смотрели</h2>
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.products.viewed",
            "catalog", //catalog
            Array(
                "ACTION_VARIABLE" => "action_cvp",
                "ADDITIONAL_PICT_PROP_2" => "MORE_PHOTO",
                "ADDITIONAL_PICT_PROP_3" => "MORE_PHOTO",
                "ADD_PROPERTIES_TO_BASKET" => "Y",
                "ADD_TO_BASKET_ACTION" => "ADD",
                "BASKET_URL" => "/personal/basket.php",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CONVERT_CURRENCY" => "Y",
                "CURRENCY_ID" => "RUB",
                "DEPTH" => "2",
                "DETAIL_URL" => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#/",
                "DISCOUNT_PERCENT_POSITION" => "bottom-right",
                "DISPLAY_COMPARE" => "N",
                "ENLARGE_PRODUCT" => "STRICT",
                "HIDE_NOT_AVAILABLE" => "N",
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                "IBLOCK_ID" => "2",
                "IBLOCK_MODE" => "single",
                "IBLOCK_TYPE" => "catalog",
                "LABEL_PROP_2" => array(),
                "LABEL_PROP_MOBILE_2" => array(),
                "LABEL_PROP_POSITION" => "top-left",
                "LINE_ELEMENT_COUNT" => "4",
                "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                "MESS_BTN_BUY" => "Купить",
                "MESS_BTN_DETAIL" => "Подробнее",
                "MESS_BTN_SUBSCRIBE" => "Подписаться",
                "MESS_NOT_AVAILABLE" => "Нет в наличии",
                "PAGE_ELEMENT_COUNT" => "15",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array(),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                "PRODUCT_SUBSCRIPTION" => "Y",
                "SECTION_CODE" => "",
                "SECTION_ELEMENT_CODE" => "",
                "SECTION_ELEMENT_ID" => $GLOBALS["CATALOG_CURRENT_ELEMENT_ID"],
                "SECTION_ID" => $GLOBALS["CATALOG_CURRENT_SECTION_ID"],
                "SHOW_CLOSE_POPUP" => "N",
                "SHOW_DISCOUNT_PERCENT" => "Y",
                "SHOW_FROM_SECTION" => "N",
                "SHOW_IMAGE" => "Y",
                "SHOW_MAX_QUANTITY" => "N",
                "SHOW_NAME" => "Y",
                "SHOW_OLD_PRICE" => "Y",
                "SHOW_PRICE_COUNT" => "1",
                "SHOW_PRODUCTS_2" => "Y",
                "SHOW_SLIDER" => "Y",
                "SLIDER_INTERVAL" => "3000",
                "SLIDER_PROGRESS" => "N",
                "TEMPLATE_THEME" => "",
                "USE_ENHANCED_ECOMMERCE" => "N",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "N"
            )
        );?>
        <div class="swiper recomended-products__wrapper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-card__top">
                            <div class="swiper product-card__image-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-1.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-2.png" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="more-actions">
                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z" stroke="#033B80" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>4,6</span>
                                </div>
                                <div class="product-card__pagination"></div>
                            </div>
                            <div class="product-info">
                                <span>-50%</span>
                                <span>Хит</span>
                            </div>
                            <div class="action-buttons">
                                <button class="heart-btn-featured">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                        <path d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z" stroke="#033B80" stroke-width="1.48707" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <button class="compare__btn__icon">
                                        <span>
                                          <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/compare_little_ic.svg" alt="">
                                        </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path d="M13.7383 15.1758V7.98828" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.42578 15.1758V3.67578" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.11328 15.1758V10.8633" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="product-card__bottom">
                            <div class="product-card__bottom_swiper_item">
                                <div class="top-section">
                                    <div class="badge-green">
                                        <svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect y="0.5" width="4" height="4" rx="1" fill="#17B744" />
                                        </svg>
                                        <span>В наличии</span>
                                    </div>
                                    <div class="art">арт. ГИМ-021</div>
                                </div>
                                <a href="#">
                                    <h3 class="title">Ролл-мат с липучкой (гимнастический ворс)</h3>
                                </a>
                                <div class="price">
                                    <span class="new-price">3 680 ₽</span>
                                    <span class="old-price">3 920 ₽</span>
                                </div>
                                <div class="bottom-section">
                                    <a href="#" class="buy-btn">Купить в 1 клик</a>
                                    <a href="#" class="korzina-btn">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/buy.svg" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-card__top">
                            <div class="swiper product-card__image-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-1.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-2.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="more-actions">
                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z" stroke="#033B80" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>4,6</span>
                                </div>
                                <div class="product-card__pagination"></div>
                            </div>
                            <div class="product-info">
                                <span>-50%</span>
                                <span>Хит</span>
                            </div>
                            <div class="action-buttons">
                                <button class="heart-btn-featured">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                        <path d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z" stroke="#033B80" stroke-width="1.48707" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <button class="compare__btn__icon">
                                        <span>
                                          <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/compare_little_ic.svg" alt="">
                                        </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path d="M13.7383 15.1758V7.98828" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.42578 15.1758V3.67578" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.11328 15.1758V10.8633" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="product-card__bottom">
                            <div class="product-card__bottom_swiper_item">
                                <div class="top-section">
                                    <div class="badge-green">
                                        <svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect y="0.5" width="4" height="4" rx="1" fill="#17B744" />
                                        </svg>
                                        <span>В наличии</span>
                                    </div>
                                    <div class="art">арт. 156060</div>
                                </div>
                                <a href="#">
                                    <h3 class="title">Мат спортивный</h3>
                                </a>
                                <div class="price">
                                    <span class="new-price">3 615 ₽</span>
                                    <span class="old-price">3 900 ₽</span>
                                </div>
                                <div class="bottom-section">
                                    <a href="#" class="buy-btn">Купить в 1 клик</a>
                                    <a href="#" class="korzina-btn">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/buy.svg" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-card__top">
                            <div class="swiper product-card__image-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-2.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-1.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="more-actions">
                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z" stroke="#033B80" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>4,6</span>
                                </div>
                                <div class="product-card__pagination"></div>
                            </div>
                            <div class="product-info">
                                <span>-50%</span>
                                <span>Хит</span>
                            </div>
                            <div class="action-buttons">
                                <button class="heart-btn-featured">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                        <path d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z" stroke="#033B80" stroke-width="1.48707" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <button class="compare__btn__icon">
                                        <span>
                                          <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/compare_little_ic.svg" alt="">
                                        </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path d="M13.7383 15.1758V7.98828" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.42578 15.1758V3.67578" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.11328 15.1758V10.8633" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="product-card__bottom">
                            <div class="product-card__bottom_swiper_item">
                                <div class="top-section">
                                    <div class="badge-green">
                                        <svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect y="0.5" width="4" height="4" rx="1" fill="#17B744" />
                                        </svg>
                                        <span>В наличии</span>
                                    </div>
                                    <div class="art">арт. 156060</div>
                                </div>
                                <a href="#">
                                    <h3 class="title">Щит баскетбольный, фанера</h3>
                                </a>
                                <div class="price">
                                    <span class="new-price">23 210 ₽</span>
                                    <span class="old-price">24 300 ₽</span>
                                </div>
                                <div class="bottom-section">
                                    <a href="#" class="buy-btn">Купить в 1 клик</a>
                                    <a href="#" class="korzina-btn">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/buy.svg" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-card__top">
                            <div class="swiper product-card__image-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-3.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-4.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-5.png" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="more-actions">
                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z" stroke="#033B80" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>4,6</span>
                                </div>
                                <div class="product-card__pagination"></div>
                            </div>
                            <div class="product-info">
                                <span>-50%</span>
                                <span>Хит</span>
                            </div>
                            <div class="action-buttons">
                                <button class="heart-btn-featured">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                        <path d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z" stroke="#033B80" stroke-width="1.48707" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <button class="compare__btn__icon">
                                        <span>
                                          <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/compare_little_ic.svg" alt="">
                                        </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path d="M13.7383 15.1758V7.98828" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.42578 15.1758V3.67578" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.11328 15.1758V10.8633" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="product-card__bottom">
                            <div class="product-card__bottom_swiper_item">
                                <div class="top-section">
                                    <div class="badge-green">
                                        <svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect y="0.5" width="4" height="4" rx="1" fill="#17B744" />
                                        </svg>
                                        <span>В наличии</span>
                                    </div>
                                    <div class="art">арт. 156060</div>
                                </div>
                                <a href="#">
                                    <h3 class="title"> Шкаф-локер с электронным замком, 1250х500х1230 мм (4 секции) Артикул: ТРО-010 </h3>
                                </a>
                                <div class="price">
                                    <span class="new-price">54 985 ₽</span>
                                    <span class="old-price">56 000 ₽</span>
                                </div>
                                <div class="bottom-section">
                                    <a href="#" class="buy-btn">Купить в 1 клик</a>
                                    <a href="#" class="korzina-btn">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/buy.svg" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-card__top">
                            <div class="swiper product-card__image-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-4.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-5.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-3.png" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="more-actions">
                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z" stroke="#033B80" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>4,6</span>
                                </div>
                                <div class="product-card__pagination"></div>
                            </div>
                            <div class="product-info">
                                <span>-50%</span>
                                <span>Хит</span>
                            </div>
                            <div class="action-buttons">
                                <button class="heart-btn-featured">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                        <path d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z" stroke="#033B80" stroke-width="1.48707" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <button class="compare__btn__icon">
                                        <span>
                                          <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/compare_little_ic.svg" alt="">
                                        </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path d="M13.7383 15.1758V7.98828" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.42578 15.1758V3.67578" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.11328 15.1758V10.8633" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="product-card__bottom">
                            <div class="product-card__bottom_swiper_item">
                                <div class="top-section">
                                    <div class="badge-green">
                                        <svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect y="0.5" width="4" height="4" rx="1" fill="#17B744" />
                                        </svg>
                                        <span>В наличии</span>
                                    </div>
                                    <div class="art">арт. 156060</div>
                                </div>
                                <a href="#">
                                    <h3 class="title">Шкаф-локер для инвентаря, 600х500х1850 мм</h3>
                                </a>
                                <div class="price">
                                    <span class="new-price">12 665 ₽</span>
                                    <!-- <span class="old-price">56 000 ₽</span> -->
                                </div>
                                <div class="bottom-section">
                                    <a href="#" class="buy-btn">Купить в 1 клик</a>
                                    <a href="#" class="korzina-btn">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/buy.svg" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-card__top">
                            <div class="swiper product-card__image-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-5.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-3.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-4.png" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="more-actions">
                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z" stroke="#033B80" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>4,6</span>
                                </div>
                                <div class="product-card__pagination"></div>
                            </div>
                            <div class="product-info">
                                <span>-50%</span>
                                <span>Хит</span>
                            </div>
                            <div class="action-buttons">
                                <button class="heart-btn-featured">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                        <path d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z" stroke="#033B80" stroke-width="1.48707" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <button class="compare__btn__icon">
                                        <span>
                                          <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/compare_little_ic.svg" alt="">
                                        </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path d="M13.7383 15.1758V7.98828" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.42578 15.1758V3.67578" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.11328 15.1758V10.8633" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="product-card__bottom">
                            <div class="product-card__bottom_swiper_item">
                                <div class="top-section">
                                    <div class="badge-red">
                                        <svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect y="0.5" width="4" height="4" rx="1" fill="#E73939" />
                                        </svg>
                                        <span>Нет в наличии</span>
                                    </div>
                                    <div class="art">арт. 156060</div>
                                </div>
                                <a href="#">
                                    <h3 class="title"> Манишка тренировочная детская для футбола Артикул: АТМ-005 </h3>
                                </a>
                                <div class="price">
                                    <span class="new-price">560 ₽</span>
                                    <!-- <span class="old-price">56 000 ₽</span> -->
                                </div>
                                <div class="bottom-section">
                                    <a href="#" class="buy-btn">Купить в 1 клик</a>
                                    <a href="#" class="korzina-btn">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/buy.svg" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-card__top">
                            <div class="swiper product-card__image-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-6.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-7.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-8.png" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="more-actions">
                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z" stroke="#033B80" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>4,6</span>
                                </div>
                                <div class="product-card__pagination"></div>
                            </div>
                            <div class="product-info">
                                <span>-50%</span>
                                <span>Хит</span>
                            </div>
                            <div class="action-buttons">
                                <button class="heart-btn-featured">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                        <path d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z" stroke="#033B80" stroke-width="1.48707" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <button class="compare__btn__icon">
                                        <span>
                                          <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/compare_little_ic.svg" alt="">
                                        </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path d="M13.7383 15.1758V7.98828" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.42578 15.1758V3.67578" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.11328 15.1758V10.8633" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="product-card__bottom">
                            <div class="product-card__bottom_swiper_item">
                                <div class="top-section">
                                    <div class="badge-green">
                                        <svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect y="0.5" width="4" height="4" rx="1" fill="#17B744" />
                                        </svg>
                                        <span>В наличии</span>
                                    </div>
                                    <div class="art">арт. 156060</div>
                                </div>
                                <a href="#">
                                    <h3 class="title">Палочка эстафетная, 300 мм</h3>
                                </a>
                                <div class="price">
                                    <span class="new-price">235 ₽</span>
                                    <!-- <span class="old-price">3 920 ₽</span> -->
                                </div>
                                <div class="bottom-section">
                                    <a href="#" class="buy-btn">Купить в 1 клик</a>
                                    <a href="#" class="korzina-btn">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/buy.svg" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="product-card">
                        <div class="product-card__top">
                            <div class="swiper product-card__image-swiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-7.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-6.png" alt="" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-8.png" alt="" />
                                    </div>
                                </div>
                            </div>
                            <div class="more-actions">
                                <div class="stars">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z" stroke="#033B80" stroke-width="1.16667" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <span>4,6</span>
                                </div>
                                <div class="product-card__pagination"></div>
                            </div>
                            <div class="product-info">
                                <span>-50%</span>
                                <span>Хит</span>
                            </div>
                            <div class="action-buttons">
                                <button class="heart-btn-featured">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                        <path d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z" stroke="#033B80" stroke-width="1.48707" stroke-linecap="round" />
                                    </svg>
                                </button>
                                <button class="compare__btn__icon">
                                        <span>
                                          <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/compare_little_ic.svg" alt="">
                                        </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 19 19" fill="none">
                                        <path d="M13.7383 15.1758V7.98828" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.42578 15.1758V3.67578" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.11328 15.1758V10.8633" stroke="#033B80" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="product-card__bottom">
                            <div class="product-card__bottom_swiper_item">
                                <div class="top-section">
                                    <div class="badge-green">
                                        <svg width="4" height="5" viewBox="0 0 4 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect y="0.5" width="4" height="4" rx="1" fill="#17B744" />
                                        </svg>
                                        <span>В наличии</span>
                                    </div>
                                    <div class="art">арт. 156060</div>
                                </div>
                                <a href="#">
                                    <h3 class="title"> Табло электронное игровое (для волейбола, баскетбола, футбола, гандбола) с защитным экраном </h3>
                                </a>
                                <div class="price">
                                    <span class="new-price">143 000 ₽</span>
                                    <span class="old-price">160 000 ₽</span>
                                </div>
                                <div class="bottom-section">
                                    <a href="#" class="buy-btn">Купить в 1 клик</a>
                                    <a href="#" class="korzina-btn">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/buy.svg" alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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