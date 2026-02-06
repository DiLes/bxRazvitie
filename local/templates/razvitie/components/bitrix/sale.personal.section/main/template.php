<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

if ($arParams["MAIN_CHAIN_NAME"] !== '')
{
	$APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}
$availablePages = array();

if ($arParams['SHOW_ORDER_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_ORDERS'],
		"name" => Loc::getMessage("SPS_ORDER_PAGE_NAME"),
		"icon" => '<i class="fa fa-calculator"></i>'
	);
}

if ($arParams['SHOW_ACCOUNT_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_ACCOUNT'],
		"name" => Loc::getMessage("SPS_ACCOUNT_PAGE_NAME"),
		"icon" => '<i class="fa fa-credit-card"></i>'
	);
}

if ($arParams['SHOW_PRIVATE_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_PRIVATE'],
		"name" => Loc::getMessage("SPS_PERSONAL_PAGE_NAME"),
		"icon" => '<i class="fa fa-user-secret"></i>'
	);
}

if ($arParams['SHOW_ORDER_PAGE'] === 'Y')
{

	$delimeter = ($arParams['SEF_MODE'] === 'Y') ? "?" : "&";
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_ORDERS'].$delimeter."filter_history=Y",
		"name" => Loc::getMessage("SPS_ORDER_PAGE_HISTORY"),
		"icon" => '<i class="fa fa-list-alt"></i>'
	);
}

if ($arParams['SHOW_PROFILE_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_PROFILE'],
		"name" => Loc::getMessage("SPS_PROFILE_PAGE_NAME"),
		"icon" => '<i class="fa fa-list-ol"></i>'
	);
}

if ($arParams['SHOW_BASKET_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arParams['PATH_TO_BASKET'],
		"name" => Loc::getMessage("SPS_BASKET_PAGE_NAME"),
		"icon" => '<i class="fa fa-shopping-cart"></i>'
	);
}

if ($arParams['SHOW_SUBSCRIBE_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_SUBSCRIBE'],
		"name" => Loc::getMessage("SPS_SUBSCRIBE_PAGE_NAME"),
		"icon" => '<i class="fa fa-envelope"></i>'
	);
}

if ($arParams['SHOW_CONTACT_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arParams['PATH_TO_CONTACT'],
		"name" => Loc::getMessage("SPS_CONTACT_PAGE_NAME"),
		"icon" => '<i class="fa fa-info-circle"></i>'
	);
}

if (!empty($arParams['~CUSTOM_PAGES']))
{
	$customPagesList = CUtil::JsObjectToPhp($arParams['~CUSTOM_PAGES']);
	if (!empty($customPagesList) && is_array($customPagesList))
	{
		foreach ($customPagesList as $page)
		{
			$icon = (string)($page[2] ?? '');
			$availablePages[] = [
				'path' => $page[0],
				'name' => $page[1],
				'icon' => $icon !== '' ? '<i class="fa ' . htmlspecialcharsbx($icon) . '"></i>' : ''
			];
			unset($icon);
		}
	}
	unset($customPagesList);
}

//pre($arResult);
//pre($arParams);

if (empty($availablePages))
{
	ShowError(Loc::getMessage("SPS_ERROR_NOT_CHOSEN_ELEMENT"));
}
else
{
//    pre($arResult);

	?>

<div class="container white lk_block">
    <div class="tabs-container">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "menu_personal",
            [
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => [
                ],
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "personal",
                "USE_EXT" => "N",
                "COMPONENT_TEMPLATE" => "menu_personal"
            ],
            false
        );?>
        <div class="content-container">
            <div class="content" id="current_orders">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:sale.personal.order.list",
                    "main",
                    array(
                        "PATH_TO_DETAIL" => $arResult["PATH_TO_ORDER_DETAIL"],
                        "PATH_TO_CANCEL" => $arResult["PATH_TO_ORDER_CANCEL"],
                        "PATH_TO_CATALOG" => $arParams["PATH_TO_CATALOG"],
                        "PATH_TO_COPY" => $arResult["PATH_TO_ORDER_COPY"],
                        "PATH_TO_BASKET" => $arParams["PATH_TO_BASKET"],
                        "PATH_TO_PAYMENT" => $arParams["PATH_TO_PAYMENT"],
                        "SAVE_IN_SESSION" => $arParams["SAVE_IN_SESSION"],
                        "ORDERS_PER_PAGE" => $arParams["ORDERS_PER_PAGE"],
                        "SET_TITLE" =>$arParams["SET_TITLE"],
                        "ID" => $arResult["VARIABLES"]["ID"],
                        "NAV_TEMPLATE" => $arParams["NAV_TEMPLATE"],
                        "ACTIVE_DATE_FORMAT" => $arParams["ACTIVE_DATE_FORMAT"],
                        "HISTORIC_STATUSES" => $arParams["ORDER_HISTORIC_STATUSES"],
                        "ALLOW_INNER" => $arParams["ALLOW_INNER"],
                        "ONLY_INNER_FULL" => $arParams["ONLY_INNER_FULL"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "DEFAULT_SORT" => $arParams["ORDER_DEFAULT_SORT"],
                        "DISALLOW_CANCEL" => $arParams["ORDER_DISALLOW_CANCEL"],
                        "RESTRICT_CHANGE_PAYSYSTEM" => $arParams["ORDER_RESTRICT_CHANGE_PAYSYSTEM"],
                        "REFRESH_PRICES" => $arParams["ORDER_REFRESH_PRICES"],
                        "CONTEXT_SITE_ID" => $arParams["CONTEXT_SITE_ID"],
                        "AUTH_FORM_IN_TEMPLATE" => 'Y',
                    ),
                    //$component
                );
                ?>
            </div>

            <div class="content" id="order_history">
                <div class="lk_order_item">
                    <div class="lk_order_header">
                        <div class="lk_order_header_left">
                            <div class="status delivered">Доставлен</div>
                            <p class="order_number">Заказ #312093 <span class="order_date">от 25.11.2023</span></p>
                        </div>
                        <span class="order_total">56 761 ₽</span>
                    </div>
                    <div class="lk_order_body">
                        <div class="order_payment">
                            <h4>ОПЛАТА</h4>
                            <p>Закупка через тендер</p>
                            <span class="tender_info">Тендер №124912015  от 25.11.2023</span>
                        </div>
                        <div class="order_delivery order_payment">
                            <h4>ДОСТАВКА</h4>
                            <p>СДЭК <span class="delivery_date">15.11.2024</span> <span class="delivery_cost">660₽</span></p>
                            <span class="track_code">Трек код 011-15015-</span>
                        </div>
                        <div class="order_items">
                            <div class="order_items_top">
                                <h4>2 товара</h4>
                                <span class="total_price_mini_sp">56 101 ₽</span>
                            </div>
                            <div class="order_images">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-4.png" alt="">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-8.png" alt="">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-7.png" alt="">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-6.png" alt="">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-5.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="lk_order_footer">
                        <div class="lk_order_footer_left">
                            <a href="#" class="order_details order_details_btn">Подробнее о заказе
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 6L15 12L9 18" stroke="#056BE9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <a href="#" class="order_details_btn repeat_order">Повторить заказ
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                    <path d="M2.00005 5L2.00005 5.75H2.00005V5ZM3.00005 14.25C2.58584 14.25 2.25005 14.5858 2.25005 15C2.25005 15.4142 2.58584 15.75 3.00005 15.75V14.25ZM3.67204 9.53269C3.96624 9.82427 4.44111 9.82215 4.73269 9.52796C5.02427 9.23376 5.02216 8.75889 4.72796 8.46731L3.67204 9.53269ZM2.78962 7.60215L2.26167 8.13484H2.26167L2.78962 7.60215ZM2.78962 2.39785L2.26167 1.86516L2.26167 1.86516L2.78962 2.39785ZM4.72796 1.53269C5.02216 1.24111 5.02427 0.766238 4.73269 0.472041C4.44111 0.177844 3.96624 0.175726 3.67204 0.467309L4.72796 1.53269ZM1.01591 5.25067L0.271931 5.34549L0.271931 5.3455L1.01591 5.25067ZM1.01591 4.74933L0.271931 4.6545L0.271931 4.6545L1.01591 4.74933ZM2.00005 5.75H11V4.25H2.00005V5.75ZM11 14.25H3.00005V15.75H11V14.25ZM15.25 10C15.25 12.3472 13.3473 14.25 11 14.25V15.75C14.1757 15.75 16.75 13.1756 16.75 10H15.25ZM11 5.75C13.3473 5.75 15.25 7.65279 15.25 10H16.75C16.75 6.82436 14.1757 4.25 11 4.25V5.75ZM4.72796 8.46731L3.31758 7.06946L2.26167 8.13484L3.67204 9.53269L4.72796 8.46731ZM3.31758 2.93054L4.72796 1.53269L3.67204 0.467309L2.26167 1.86516L3.31758 2.93054ZM3.31758 7.06946C2.74268 6.49967 2.35733 6.11614 2.09823 5.79351C1.84863 5.48272 1.77852 5.302 1.75989 5.15584L0.271931 5.3455C0.339893 5.87869 0.594265 6.31633 0.928691 6.73276C1.25361 7.13735 1.71182 7.58988 2.26167 8.13484L3.31758 7.06946ZM2.26167 1.86516C1.71182 2.41012 1.25362 2.86265 0.928692 3.26724C0.594266 3.68366 0.339893 4.12131 0.271931 4.6545L1.75989 4.84416C1.77852 4.698 1.84863 4.51728 2.09823 4.20649C2.35733 3.88386 2.74268 3.50033 3.31758 2.93054L2.26167 1.86516ZM1.75989 5.15584C1.7533 5.10409 1.75 5.05204 1.75 5H0.25C0.25 5.1154 0.257311 5.23079 0.271931 5.34549L1.75989 5.15584ZM1.75 5C1.75 4.94796 1.7533 4.89591 1.75989 4.84416L0.271931 4.6545C0.257311 4.76921 0.25 4.8846 0.25 5H1.75ZM2.00005 4.25L1 4.25L0.999999 5.75L2.00005 5.75L2.00005 4.25Z" fill="#056BE9"/>
                                </svg>
                            </a>
                        </div>

                        <button class="order_cancel">Отменить заказ</button>
                    </div>
                </div>
                <div class="lk_order_item">
                    <div class="lk_order_header">
                        <div class="lk_order_header_left">
                            <div class="status cancelled">Отменён</div>
                            <p class="order_number">Заказ #312093 <span class="order_date">от 25.11.2023</span></p>
                        </div>
                        <span class="order_total">56 761 ₽</span>
                    </div>
                    <div class="lk_order_body">
                        <div class="order_payment">
                            <h4>ОПЛАТА</h4>
                            <p>Закупка через тендер</p>
                            <span class="tender_info">Тендер №124912015  от 25.11.2023</span>
                        </div>
                        <div class="order_delivery order_payment">
                            <h4>ДОСТАВКА</h4>
                            <p>СДЭК <span class="delivery_date">15.11.2024</span> <span class="delivery_cost">660₽</span></p>
                            <span class="track_code">Трек код 011-15015-</span>
                        </div>
                        <div class="order_items">
                            <div class="order_items_top">
                                <h4>2 товара</h4>
                                <span class="total_price_mini_sp">56 101 ₽</span>
                            </div>
                            <div class="order_images">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-4.png" alt="">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-8.png" alt="">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-7.png" alt="">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-6.png" alt="">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-5.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="lk_order_footer">
                        <div class="lk_order_footer_left">
                            <a href="#" class="order_details order_details_btn">Подробнее о заказе
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 6L15 12L9 18" stroke="#056BE9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <a href="#" class="order_details_btn repeat_order">Повторить заказ
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                    <path d="M2.00005 5L2.00005 5.75H2.00005V5ZM3.00005 14.25C2.58584 14.25 2.25005 14.5858 2.25005 15C2.25005 15.4142 2.58584 15.75 3.00005 15.75V14.25ZM3.67204 9.53269C3.96624 9.82427 4.44111 9.82215 4.73269 9.52796C5.02427 9.23376 5.02216 8.75889 4.72796 8.46731L3.67204 9.53269ZM2.78962 7.60215L2.26167 8.13484H2.26167L2.78962 7.60215ZM2.78962 2.39785L2.26167 1.86516L2.26167 1.86516L2.78962 2.39785ZM4.72796 1.53269C5.02216 1.24111 5.02427 0.766238 4.73269 0.472041C4.44111 0.177844 3.96624 0.175726 3.67204 0.467309L4.72796 1.53269ZM1.01591 5.25067L0.271931 5.34549L0.271931 5.3455L1.01591 5.25067ZM1.01591 4.74933L0.271931 4.6545L0.271931 4.6545L1.01591 4.74933ZM2.00005 5.75H11V4.25H2.00005V5.75ZM11 14.25H3.00005V15.75H11V14.25ZM15.25 10C15.25 12.3472 13.3473 14.25 11 14.25V15.75C14.1757 15.75 16.75 13.1756 16.75 10H15.25ZM11 5.75C13.3473 5.75 15.25 7.65279 15.25 10H16.75C16.75 6.82436 14.1757 4.25 11 4.25V5.75ZM4.72796 8.46731L3.31758 7.06946L2.26167 8.13484L3.67204 9.53269L4.72796 8.46731ZM3.31758 2.93054L4.72796 1.53269L3.67204 0.467309L2.26167 1.86516L3.31758 2.93054ZM3.31758 7.06946C2.74268 6.49967 2.35733 6.11614 2.09823 5.79351C1.84863 5.48272 1.77852 5.302 1.75989 5.15584L0.271931 5.3455C0.339893 5.87869 0.594265 6.31633 0.928691 6.73276C1.25361 7.13735 1.71182 7.58988 2.26167 8.13484L3.31758 7.06946ZM2.26167 1.86516C1.71182 2.41012 1.25362 2.86265 0.928692 3.26724C0.594266 3.68366 0.339893 4.12131 0.271931 4.6545L1.75989 4.84416C1.77852 4.698 1.84863 4.51728 2.09823 4.20649C2.35733 3.88386 2.74268 3.50033 3.31758 2.93054L2.26167 1.86516ZM1.75989 5.15584C1.7533 5.10409 1.75 5.05204 1.75 5H0.25C0.25 5.1154 0.257311 5.23079 0.271931 5.34549L1.75989 5.15584ZM1.75 5C1.75 4.94796 1.7533 4.89591 1.75989 4.84416L0.271931 4.6545C0.257311 4.76921 0.25 4.8846 0.25 5H1.75ZM2.00005 4.25L1 4.25L0.999999 5.75L2.00005 5.75L2.00005 4.25Z" fill="#056BE9"/>
                                </svg>
                            </a>
                        </div>

                        <button class="order_cancel">Отменить заказ</button>
                    </div>
                </div>
                <div class="lk_order_item">
                    <div class="lk_order_header">
                        <div class="lk_order_header_left">
                            <div class="status delivered">Доставлен</div>
                            <p class="order_number">Заказ #312093 <span class="order_date">от 25.11.2023</span></p>
                        </div>
                        <span class="order_total">56 761 ₽</span>
                    </div>
                    <div class="lk_order_body">
                        <div class="order_payment">
                            <h4>ОПЛАТА</h4>
                            <p>Закупка через тендер</p>
                            <span class="tender_info">Тендер №124912015  от 25.11.2023</span>
                        </div>
                        <div class="order_delivery order_payment">
                            <h4>ДОСТАВКА</h4>
                            <p>СДЭК <span class="delivery_date">15.11.2024</span> <span class="delivery_cost">660₽</span></p>
                            <span class="track_code">Трек код 011-15015-</span>
                        </div>
                        <div class="order_items">
                            <div class="order_items_top">
                                <h4>2 товара</h4>
                                <span class="total_price_mini_sp">56 101 ₽</span>
                            </div>
                            <div class="order_images">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-4.png" alt="">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-8.png" alt="">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-7.png" alt="">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-6.png" alt="">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-5.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="lk_order_footer">
                        <div class="lk_order_footer_left">
                            <a href="#" class="order_details order_details_btn">Подробнее о заказе
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M9 6L15 12L9 18" stroke="#056BE9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            <a href="#" class="order_details_btn repeat_order">Повторить заказ
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
                                    <path d="M2.00005 5L2.00005 5.75H2.00005V5ZM3.00005 14.25C2.58584 14.25 2.25005 14.5858 2.25005 15C2.25005 15.4142 2.58584 15.75 3.00005 15.75V14.25ZM3.67204 9.53269C3.96624 9.82427 4.44111 9.82215 4.73269 9.52796C5.02427 9.23376 5.02216 8.75889 4.72796 8.46731L3.67204 9.53269ZM2.78962 7.60215L2.26167 8.13484H2.26167L2.78962 7.60215ZM2.78962 2.39785L2.26167 1.86516L2.26167 1.86516L2.78962 2.39785ZM4.72796 1.53269C5.02216 1.24111 5.02427 0.766238 4.73269 0.472041C4.44111 0.177844 3.96624 0.175726 3.67204 0.467309L4.72796 1.53269ZM1.01591 5.25067L0.271931 5.34549L0.271931 5.3455L1.01591 5.25067ZM1.01591 4.74933L0.271931 4.6545L0.271931 4.6545L1.01591 4.74933ZM2.00005 5.75H11V4.25H2.00005V5.75ZM11 14.25H3.00005V15.75H11V14.25ZM15.25 10C15.25 12.3472 13.3473 14.25 11 14.25V15.75C14.1757 15.75 16.75 13.1756 16.75 10H15.25ZM11 5.75C13.3473 5.75 15.25 7.65279 15.25 10H16.75C16.75 6.82436 14.1757 4.25 11 4.25V5.75ZM4.72796 8.46731L3.31758 7.06946L2.26167 8.13484L3.67204 9.53269L4.72796 8.46731ZM3.31758 2.93054L4.72796 1.53269L3.67204 0.467309L2.26167 1.86516L3.31758 2.93054ZM3.31758 7.06946C2.74268 6.49967 2.35733 6.11614 2.09823 5.79351C1.84863 5.48272 1.77852 5.302 1.75989 5.15584L0.271931 5.3455C0.339893 5.87869 0.594265 6.31633 0.928691 6.73276C1.25361 7.13735 1.71182 7.58988 2.26167 8.13484L3.31758 7.06946ZM2.26167 1.86516C1.71182 2.41012 1.25362 2.86265 0.928692 3.26724C0.594266 3.68366 0.339893 4.12131 0.271931 4.6545L1.75989 4.84416C1.77852 4.698 1.84863 4.51728 2.09823 4.20649C2.35733 3.88386 2.74268 3.50033 3.31758 2.93054L2.26167 1.86516ZM1.75989 5.15584C1.7533 5.10409 1.75 5.05204 1.75 5H0.25C0.25 5.1154 0.257311 5.23079 0.271931 5.34549L1.75989 5.15584ZM1.75 5C1.75 4.94796 1.7533 4.89591 1.75989 4.84416L0.271931 4.6545C0.257311 4.76921 0.25 4.8846 0.25 5H1.75ZM2.00005 4.25L1 4.25L0.999999 5.75L2.00005 5.75L2.00005 4.25Z" fill="#056BE9"/>
                                </svg>
                            </a>
                        </div>

                        <button class="order_cancel">Отменить заказ</button>
                    </div>
                </div>
            </div>

            <div class="content active" id="acc_details">
                <div class="company-profile">
                    <div class="profile-container">
                        <div class="profile-image">
                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/reviews-avatar.png" alt="Фото" id="profilePreview">
                            <input type="file" id="profileUpload" accept="image/*">
                            <label for="profileUpload" class="upload-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M1 9H17M9 17V9L9 1" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </label>
                        </div>
                        <p class="profile-text">ФОТО ПРОФИЛЯ</p>
                        <button id="removePhoto" class="remove-btn hidden">УДАЛИТЬ</button>
                    </div>

                    <!-- Company Data -->
                    <div class="company-data">
                        <h2>Данные компании</h2>
                        <div class="input-group-z">
                            <input type="text" class="input" placeholder="Введите название компании" value="МОУ СОШ № 48 Г. БОРЗИ" >
                            <label class="user_label">Юридическое наименование организации</label>
                        </div>

                        <div class="input-groups-z">
                            <div class="input-group-z">
                                <input type="text" placeholder="ИНН" value="2301055864" >
                                <label class="user_label">ИНН</label>
                            </div>
                            <div class="input-group-z">
                                <input type="text" placeholder="КПП" value="230101001" >
                                <label class="user_label">КПП</label>
                            </div>
                            <div class="input-group-z">
                                <input type="text" placeholder="ОГРН" value="1444546555463" >
                                <label class="user_label">ЕГРЮЛ (ОГРН)</label>
                            </div>
                        </div>
                    </div>

                    <!-- Address Section -->
                    <div class="address-section company-data">
                        <h2>Юридический адрес</h2>
                        <div class="input-groups-z">
                            <div class="input-group-z w_50">
                                <input type="text" placeholder="Борзя, Забайкальский край, 674600" value="Борзя, Забайкальский край, 674600" >
                                <label>Область, район, город</label>
                            </div>
                            <div class="input-group-z w_50">
                                <input type="text" placeholder="Ул. Ленина" value="Ул. Ленина" >
                                <label>Улица</label>
                            </div>
                            <div class="input-group-z">
                                <input type="text" placeholder="26" value="26" >
                                <label>Дом</label>
                            </div>
                            <div class="input-group-z w_mob_50">
                                <input type="text" placeholder="-" value="-" >
                                <label>Офис/квартира</label>
                            </div>
                            <div class="input-group-z w_mob_50">
                                <input type="text" placeholder="674600" value="674600" >
                                <label>Индекс</label>
                            </div>
                        </div>
                    </div>

                    <div class="address-section company-data actual_data">
                        <h2>Фактический адрес
                            <label class="checkbox">
                                <input type="checkbox" id="sameAddress">
                                Совпадает с юридическим адресом
                            </label>
                        </h2>
                        <div class="input-groups-z actual-address">
                            <div class="input-group-z w_50">
                                <input type="text" placeholder="Борзя, Забайкальский край, 674600" value="Борзя, Забайкальский край, 674600" >
                                <label>Область, район, город</label>
                            </div>
                            <div class="input-group-z w_50">
                                <input type="text" placeholder="Ул. Ленина" value="Ул. Ленина" >
                                <label>Улица</label>
                            </div>
                            <div class="input-group-z">
                                <input type="text" placeholder="26" value="26" >
                                <label>Дом</label>
                            </div>
                            <div class="input-group-z w_mob_50">
                                <input type="text" placeholder="-" value="-" >
                                <label>Офис/квартира</label>
                            </div>
                            <div class="input-group-z w_mob_50">
                                <input type="text" placeholder="674600" value="674600" >
                                <label>Индекс</label>
                            </div>
                        </div>
                    </div>

                    <!-- Banking Information -->
                    <div class="bank-data company-data">
                        <h2>Банковские данные</h2>
                        <div class="input-groups-z">
                            <div class="input-group-z">
                                <input type="text" placeholder="ООО 'Банк Точка'" value="ООО “Банк Точка”" >
                                <label>Название банка</label>
                            </div>
                            <div class="input-group-z w_mob_50">
                                <input type="text" placeholder="256 377 909" value="256 377 909" >
                                <label>БИК Банка</label>
                            </div>
                            <div class="input-group-z w_mob_50">
                                <input type="text" placeholder="9721 944 61" value="9721 1944 61" >
                                <label>ИНН Банка</label>
                            </div>
                            <div class="input-group-z">
                                <input type="text" placeholder="997 950 001" value="997 950 001" >
                                <label>КПП Банка</label>
                            </div>
                            <div class="input-group-z">
                                <input type="text" placeholder="2080 4810 6055 0033 6093" value="2080 4810 6055 0033 6093" >
                                <label>Расч. счёт</label>
                            </div>
                            <div class="input-group-z">
                                <input type="text" placeholder="30101 4509 9090 9090" value="30101 4509 9090 9090" >
                                <label>Корр. счёт</label>
                            </div>
                        </div>

                    </div>

                    <!-- Contact Information -->
                    <div class="contact-data company-data">
                        <h2>Контактные данные</h2>
                        <div class="input-groups-z">
                            <div class="input-group-z w_50">
                                <input type="email" placeholder="example@gmail.com" value="example@gmail.com" >
                                <label>Email организации</label>
                            </div>
                            <div class="input-group-z w_50">
                                <input type="tel" placeholder="+7 (923) 446-35-55" value="+7 (923) 446-35-55" >
                                <label>Телефон организации</label>
                            </div>
                        </div>
                    </div>

                    <div class="contact-persons company-data con_per">
                        <h2>Контактные лица</h2>
                        <h5>Контактное лицо №1</h5>
                        <div class="input-groups-z">
                            <div class="input-group-z select_group_z">
                                <select class="_select" style="background-image: url(./src/assets/svgicons/arr_select.svg);">
                                    <option>Директор</option>
                                    <option>Менеджер</option>
                                    <option>Бухгалтер</option>
                                </select>
                                <label>Должность</label>
                            </div>
                            <div class="input-group-z">
                                <input type="text" placeholder="Петров Иван Иванович" value="Петров Иван Иванович" >
                                <label>ФИО</label>
                            </div>
                            <div class="input-group-z">
                                <input type="tel" placeholder="+7 (923) 446-35-55" value="+7 (923) 446-35-55" >
                                <label>Контактный телефон</label>
                            </div>
                        </div>
                        <div id="contacts-list"></div>
                        <button class="add-person" id="add-person">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                                        <path d="M8.71094 1.66211L8.71094 17.3363M0.873852 9.49922L8.71095 9.49922H16.5481" stroke="#056BE9" stroke-width="1.6" stroke-linecap="round"/>
                                    </svg>
                                </span>
                            Добавить контактное лицо
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?}?>
