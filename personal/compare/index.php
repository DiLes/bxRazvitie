<?
define("HIDE_SIDEBAR", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сравнение товаров");
?>
    <div class="cart_z">
        <div class="container">
            <div class="page-head">
                <div class="cart_z_top_actions">
                    <h1 class="section_title">Сравнение товаров</h1>
                    <div class="cart_z_btns">
                        <button class="clear_list">Очистить список</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container white compare_products_con">
            <div class="filter-tags">
                <div class="filter-tag active" data-tab="tab1">
                    <span>Детские спортивные комплексы</span>
                    <span class="count">6</span>
                    <button class="close-btn">&times;</button>
                </div>
                <div class="filter-tag" data-tab="tab2">
                    <span>Спортивное оборудование</span>
                    <span class="count">10</span>
                    <button class="close-btn">&times;</button>
                </div>
            </div>
            <div class="filter-content">
                <div class="tab-content active" id="tab1">
                    <div class="compare_products_block">
                        <div class="recomended-products smilar-products cart_recom">
                            <div class="swiper recomended-products__wrapperrr">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide" data-num="101">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>

                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                                    <div class="swiper-slide" data-num="102">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                                    <div class="swiper-slide" data-num="103">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                                    <div class="swiper-slide" data-num="104">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>

                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                                    <div class="swiper-slide" data-num="105">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                                    <div class="swiper-slide" data-num="106">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                    <div class="compare_products_specifications_z">
                        <h2>
                            Характеристики
                            <label class="toggle-differences">
                                Только различающиеся
                                <input type="checkbox" id="toggleDifferences" name="checkbox">
                            </label>
                        </h2>
                        <div class="specifications_z_compare_box">
                            <div class="specifications_z_compare_sliders">
                                <div class="swiper specifications_z_compare_swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide" data-num="101">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">
                                                    <span>Размеры, мм</span>
                                                    810x130x350</div>
                                                <div class="material_z spec_item_z">
                                                    <span>Материалы</span>
                                                    Металл, резина</div>
                                                <div class="weight_z spec_item_z">
                                                    <span>Вес, кг</span>
                                                    16</div>
                                                <div class="max_load_z spec_item_z">
                                                    <span>Максимальная нагрузка, кг</span>
                                                    80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="102">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">810x130x350</div>
                                                <div class="material_z spec_item_z">Металл, резина</div>
                                                <div class="weight_z spec_item_z">16</div>
                                                <div class="max_load_z spec_item_z">80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="103">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">380x18</div>
                                                <div class="material_z spec_item_z">Металл, капрон</div>
                                                <div class="weight_z spec_item_z">16</div>
                                                <div class="max_load_z spec_item_z">80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="104">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">
                                                    810x130x350</div>
                                                <div class="material_z spec_item_z">
                                                    Металл, резина</div>
                                                <div class="weight_z spec_item_z">
                                                    16</div>
                                                <div class="max_load_z spec_item_z">
                                                    80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="105">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">810x130x350</div>
                                                <div class="material_z spec_item_z">Металл, резина</div>
                                                <div class="weight_z spec_item_z">16</div>
                                                <div class="max_load_z spec_item_z">80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="106">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">380x18</div>
                                                <div class="material_z spec_item_z">Металл, капрон</div>
                                                <div class="weight_z spec_item_z">16</div>
                                                <div class="max_load_z spec_item_z">80</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="tab2">
                    <div class="compare_products_block">
                        <div class="recomended-products smilar-products cart_recom">
                            <div class="swiper recomended-products__wrapperrr">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide" data-num="1">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>

                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                                    <div class="swiper-slide" data-num="2">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                                    <div class="swiper-slide" data-num="3">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                                    <div class="swiper-slide" data-num="4">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
                                                                <rect y="0.5" width="4" height="4" rx="1" fill="#17B744" />
                                                            </svg>
                                                            <span>В наличии</span>
                                                        </div>
                                                        <div class="art">арт. 156060</div>
                                                    </div>
                                                    <a href="#">
                                                        <h3 class="title">
                                                            Шкаф-локер с электронным замком, 1250х500х1230 мм (4 секции) Артикул:
                                                            ТРО-010
                                                        </h3>
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
                                    <div class="swiper-slide" data-num="5">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                                    <div class="swiper-slide" data-num="6">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>

                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                                    <div class="swiper-slide" data-num="7">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                                    <div class="swiper-slide" data-num="8">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                                    <div class="swiper-slide" data-num="9">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
                                                                <rect y="0.5" width="4" height="4" rx="1" fill="#17B744" />
                                                            </svg>
                                                            <span>В наличии</span>
                                                        </div>
                                                        <div class="art">арт. 156060</div>
                                                    </div>
                                                    <a href="#">
                                                        <h3 class="title">
                                                            Шкаф-локер с электронным замком, 1250х500х1230 мм (4 секции) Артикул:
                                                            ТРО-010
                                                        </h3>
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
                                    <div class="swiper-slide" data-num="10">
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
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="14"
                                                            height="14"
                                                            viewBox="0 0 14 14"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.16667"
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                            />
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
                                                    <button class="clear_compare_pr">
                                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/x_clear.svg" alt="">
                                                    </button>
                                                    <button class="heart-btn-featured">
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            width="17"
                                                            height="16"
                                                            viewBox="0 0 17 16"
                                                            fill="none"
                                                        >
                                                            <path
                                                                d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                                                stroke="#033B80"
                                                                stroke-width="1.48707"
                                                                stroke-linecap="round"
                                                            />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-card__bottom">
                                                <div class="product-card__bottom_swiper_item">
                                                    <div class="top-section">
                                                        <div class="badge-green">
                                                            <svg
                                                                width="4"
                                                                height="5"
                                                                viewBox="0 0 4 5"
                                                                fill="none"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                            >
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
                    <div class="compare_products_specifications_z">
                        <h2>
                            Характеристики
                            <label class="toggle-differences">
                                Только различающиеся
                                <input type="checkbox" id="toggleDifferences" name="checkbox">
                            </label>
                        </h2>
                        <div class="specifications_z_compare_box">
                            <div class="specifications_z_compare_sliders">
                                <div class="swiper specifications_z_compare_swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide" data-num="1">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">
                                                    <span>Размеры, мм</span>
                                                    810x130x350</div>
                                                <div class="material_z spec_item_z">
                                                    <span>Материалы</span>
                                                    Металл, резина</div>
                                                <div class="weight_z spec_item_z">
                                                    <span>Вес, кг</span>
                                                    16</div>
                                                <div class="max_load_z spec_item_z">
                                                    <span>Максимальная нагрузка, кг</span>
                                                    80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="2">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">480x380</div>
                                                <div class="material_z spec_item_z">Дерево</div>
                                                <div class="weight_z spec_item_z">16</div>
                                                <div class="max_load_z spec_item_z">80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="3">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">380x18</div>
                                                <div class="material_z spec_item_z">Металл, капрон</div>
                                                <div class="weight_z spec_item_z">16</div>
                                                <div class="max_load_z spec_item_z">80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="4">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">380x20</div>
                                                <div class="material_z spec_item_z">Дерево</div>
                                                <div class="weight_z spec_item_z">16</div>
                                                <div class="max_load_z spec_item_z">80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="5">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">350x15</div>
                                                <div class="material_z spec_item_z">Металл, резина</div>
                                                <div class="weight_z spec_item_z">16</div>
                                                <div class="max_load_z spec_item_z">80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="6">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">
                                                    810x130x350</div>
                                                <div class="material_z spec_item_z">
                                                    Металл, резина</div>
                                                <div class="weight_z spec_item_z">
                                                    16</div>
                                                <div class="max_load_z spec_item_z">
                                                    80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="7">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">480x380</div>
                                                <div class="material_z spec_item_z">Дерево</div>
                                                <div class="weight_z spec_item_z">16</div>
                                                <div class="max_load_z spec_item_z">80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="8">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">380x18</div>
                                                <div class="material_z spec_item_z">Металл, капрон</div>
                                                <div class="weight_z spec_item_z">16</div>
                                                <div class="max_load_z spec_item_z">80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="9">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">380x20</div>
                                                <div class="material_z spec_item_z">Дерево</div>
                                                <div class="weight_z spec_item_z">16</div>
                                                <div class="max_load_z spec_item_z">80</div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide" data-num="10">
                                            <div class="specifications_z_compare_items">
                                                <div class="size_z spec_item_z">350x15</div>
                                                <div class="material_z spec_item_z">Металл, резина</div>
                                                <div class="weight_z spec_item_z">16</div>
                                                <div class="max_load_z spec_item_z">80</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>