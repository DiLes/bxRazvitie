<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;
use Bitrix\Sale;

/**
* @global CMain $APPLICATION
* @var array $arParams
* @var array $arResult
* @var CatalogSectionComponent $component
* @var CBitrixComponentTemplate $this
* @var string $templateName
* @var string $componentPath
* @var string $templateFolder
*/

$this->setFrameMode(true);

$templateLibrary = array('popup', 'fx', 'ui.fonts.opensans');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$haveOffers = !empty($arResult['OFFERS']);

$templateData = [
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => [
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
	],
];
if ($haveOffers)
{
	$templateData['ITEM']['OFFERS_SELECTED'] = $arResult['OFFERS_SELECTED'];
	$templateData['ITEM']['JS_OFFERS'] = $arResult['JS_OFFERS'];
}
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
	'STICKER_ID' => $mainId.'_sticker',
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'OLD_PRICE_ID' => $mainId.'_old_price',
	'PRICE_ID' => $mainId.'_price',
	'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
	'PRICE_TOTAL' => $mainId.'_price_total',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
	'QUANTITY_ID' => $mainId.'_quantity',
	'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
	'QUANTITY_UP_ID' => $mainId.'_quant_up',
	'QUANTITY_MEASURE' => $mainId.'_quant_measure',
	'QUANTITY_LIMIT' => $mainId.'_quant_limit',
	'BUY_LINK' => $mainId.'_buy_link',
	'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
	'COMPARE_LINK' => $mainId.'_compare_link',
	'TREE_ID' => $haveOffers && !empty($arResult['OFFERS_PROP']) ? $mainId.'_skudiv' : null,
	'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
	'DESCRIPTION_ID' => $mainId.'_description',
	'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
	'OFFER_GROUP' => $mainId.'_set_group_',
	'BASKET_PROP_DIV' => $mainId.'_basket_prop',
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
	'TABS_ID' => $mainId.'_tabs',
	'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
	'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

if ($haveOffers)
{
	$actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['MORE_PHOTO_COUNT'] > 1)
		{
			$showSliderControls = true;
			break;
		}
	}
}
else
{
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y')
{
	$skuDescription = false;
	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '')
		{
			$skuDescription = true;
			break;
		}
	}
	$showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}
else
{
	$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');

if ($arResult['MODULES']['catalog'] && $arResult['PRODUCT']['TYPE'] === ProductTable::TYPE_SERVICE)
{
	$arParams['~MESS_NOT_AVAILABLE_SERVICE'] ??= '';
	$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE_SERVICE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE')
	;

	$arParams['MESS_NOT_AVAILABLE_SERVICE'] ??= '';
	$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE_SERVICE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE')
	;
}
else
{
	$arParams['~MESS_NOT_AVAILABLE'] ??= '';
	$arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE')
	;

	$arParams['MESS_NOT_AVAILABLE'] ??= '';
	$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE']
		?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE')
	;
}

$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-'.$arParams['TEMPLATE_THEME'] : '';


// DILSHOD MOD START
if (!empty($arResult["DETAIL_PICTURE"])){
    $picture = $arResult["DETAIL_PICTURE"];
} else {
    $picture = $arResult["PREVIEW_PICTURE"];
}

$inBasket = false;
$productId = $arResult["ID"];
$basketQuantity = 1; // по умолчанию 1

if (\Bitrix\Main\Loader::includeModule("sale")) {
    $basket = Sale\Basket::loadItemsForFUser(
        Sale\Fuser::getId(),
        Bitrix\Main\Context::getCurrent()->getSite()
    );

    foreach ($basket as $basketItem) {
        if ((int)$basketItem->getProductId() === (int)$productId && $basketItem->canBuy()) {
            $inBasket = true;
            $basketQuantity = (int)$basketItem->getQuantity();
            break;
        }
    }
}
$isAvailable = false;
if ($actualItem["CATALOG_QUANTITY"] > 0) {
    $isAvailable = true;
}
$isHit = $arResult["PROPERTIES"]["HIT"]["VALUE_XML_ID"] === "Y";
$isComapre = false;
if (isset($_SESSION["CATALOG_COMPARE_LIST"][$arParams["IBLOCK_ID"]]["ITEMS"][$arResult["ID"]])){
    $isComapre = true;
}
$props = [
    "MAX_NAG", "MODEL", "MATERIAL", "RAZMER", "KOLVO_POL", "TIP_PRIK", "FUNC", "KALIBR", "VID", "ROST_GRUP", "COLOR", "MATERIAL_SID_SPIN", "MATERIAL_KARK", "RAZMER_STOLE", "MATERIAL_STOLE", "NAZNACH", "KOMPLEKT", "OSOBENN", "GRUZOPOD", "DIAPAZON_POK", "PREDUPREZH_POV", "VREMYA_NEP", "POGRESHNOST_IZM", "VID_KALIBROVKI", "TYPE", "ZASH_SVOYSTVA", "KLASS_ZASH", "TIP_RESPIR"
];

//pre($arResult["OFFERS"]);

//pre($actualItem["ID"]);
//pre($actualItem["NAME"]);

//pre($basketQuantity);
//pre($showAddBtn);
//pre($showBuyBtn);
//pre($picture["SRC"]);

//pre($arResult["PROPERTIES"]["vote_count"]);
//pre($arResult["PROPERTIES"]["vote_sum"]);
//pre($arResult["PROPERTIES"]["rating"]);
//pre($arResult["PROPERTIES"]["ARTNUMBER"]["VALUE"]);


//pre($props);
//pre($arParams["PROPERTY_CODE"]);



/*
 * OFFER_ID_SELECTED
 * OFFERS_SELECTED
 *
 *
 */

foreach ($arResult['SKU_PROPS'] as $skuProperty)
{
    $propertyId = $skuProperty['ID'];
    $skuProps[] = array(
        'ID' => $propertyId,
        'SHOW_MODE' => $skuProperty['SHOW_MODE'],
        'VALUES' => $skuProperty['VALUES'],
        'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
    );
    foreach ($skuProperty['VALUES'] as &$value) {
        $value['NAME'] = htmlspecialcharsbx($value['NAME']);
        //pre($value['NAME']);
    }
    //pre($skuProperty['SHOW_MODE']);
}
// DILSHOD MOD END
?>

<?/*$APPLICATION->IncludeComponent(
    "webdebug:propsorter",
    "",
    Array(
        "EXCLUDE_PROPERTIES" => array("",""),
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "MULTIPLE_SEPARATOR" => ", ",
        "NOGROUP_NAME" => "без группы",
        "NOGROUP_SHOW" => "Y",
        "PROPERTIES" => "MAX_NAG",
        "WARNING_IF_EMPTY" => "Y",
        "WARNING_IF_EMPTY_TEXT" => "Нет свойств"
    )
);*/?>
    <div class="breadcrumb mob">
        <a href="#">Главная</a>
        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/arrow-right.svg" alt="" />
        <a href="#">Школьные кабинеты</a>
        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/arrow-right.svg" alt="" />
        <a href="#">Кабинет Физкультуры</a>
        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/arrow-right.svg" alt="" />
        <a href="#">Спорт. оборудование</a>
    </div>
    <div class="product-screen pr_sc_z">
        <div class="product-screen__top">
            <div class="product-screen__left-side">
                <div class="product-screen__left-side-top">
                    <div class="breadcrumb desc">
                        <a href="#">Главная</a>
                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/arrow-right.svg" alt="" />
                        <a href="#">Школьные кабинеты</a>
                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/arrow-right.svg" alt="" />
                        <a href="#">Кабинет Физкультуры</a>
                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/arrow-right.svg" alt="" />
                        <a href="#">Спорт. оборудование</a>
                    </div>
                    <div class="product-screen__swiper-wrap">
                        <div class="swiper product-screen__swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="<?=$picture["SRC"]?>" alt="">
                                </div>
                                <?
                                if (!empty($actualItem['MORE_PHOTO'])) {
                                    foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {?>
                                        <div class="swiper-slide">
                                            <img src="<?=$photo["SRC"]?>" alt="">
                                        </div>
                                    <?
                                    }
                                }
                                ?>

                            </div>
                        </div>
                        <div class="product-info">
                            <?if ($price["PERCENT"]){?>
                                <span>-<?=$price["PERCENT"]?>%</span>
                            <?}?>
                            <?if ($isHit){?>
                                <span>Хит</span>
                            <?}?>
                        </div>
                        <div class="action-buttons">
                            <button class="black_heart" data-action="favorite"  data-iblock="<?=$arResult["IBLOCK_ID"]?>" data-item="<?=$arResult["ID"]?>">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="17"
                                        height="16"
                                        viewBox="0 0 17 16"
                                        fill="none"
                                >
                                    <path
                                            d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                                            stroke="#1A1A1A"
                                            stroke-width="1.48707"
                                            stroke-linecap="round"
                                    />
                                </svg>
                            </button>
                            <button class="compare__btn__icon<?=($isComapre)?(' active'):('');?>" data-action="compare" data-iblock="<?=$arResult["IBLOCK_ID"]?>" data-item="<?=$arResult["ID"]?>" data-entity="compare-checkbox">
                                <span>
                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/compare_little_ic_black.svg" alt="">
                                </span>
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="19"
                                        height="19"
                                        viewBox="0 0 19 19"
                                        fill="none"
                                >
                                    <path
                                            d="M13.7383 15.1758V7.98828"
                                            stroke="#1A1A1A"
                                            stroke-width="1.4375"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                    />
                                    <path
                                            d="M9.42578 15.1758V3.67578"
                                            stroke="#1A1A1A"
                                            stroke-width="1.4375"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                    />
                                    <path
                                            d="M5.11328 15.1758V10.8633"
                                            stroke="#1A1A1A"
                                            stroke-width="1.4375"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                    />
                                </svg>
                            </button>
                        </div>
                        <div class="swiper-nav">
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="product-screen__swiper-prev swiper-btn">
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
                        <div class="product-screen__swiper-next swiper-btn">
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
                <div class="swiper product-screen__left-side-bottom">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide active">
                            <div class="image-item">
                                <img src="<?=$picture["SRC"]?>" alt="">
                            </div>
                        </div>
                        <?
                        if (!empty($actualItem['MORE_PHOTO'])) {
                            foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {?>
                                <div class="swiper-slide">
                                    <div class="image-item">
                                        <img src="<?=$photo["SRC"]?>" alt="">
                                    </div>
                                </div>
                                <?
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="product-screen__right-side">
                <div class="product-screen__right-side-top">
                    <div class="product-top">
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
                            <?if (!empty($actualItem["PROPERTIES"]["ARTNUMBER"]["VALUE"])){?>
                                <div class="art">арт. <?=$actualItem["PROPERTIES"]["ARTNUMBER"]["VALUE"]?></div>
                            <?}?>
                        </div>
                        <?$currentUrl = (CMain::IsHTTPS() ? "https://" : "http://") . $_SERVER["HTTP_HOST"] . $APPLICATION->GetCurPage();?>
                        <div class="share-container">
                            <button class="share_btn">
                                <span>Поделиться</span>
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share.svg" alt="">
                            </button>

                            <div class="share-modal">
                                <ul>
                                    <li class="copy-link" onclick="copyToClipboard('<?=htmlspecialchars($currentUrl)?>')">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_link.svg" alt="">
                                        <span>Скопировать ссылку</span>
                                    </li>
                                    <hr>
                                    <li>
                                        <a href="https://wa.me/?text=<?=urlencode($currentUrl)?>" target="_blank" rel="noopener" class="share-item whatsapp">
                                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_wa.svg" alt="">
                                            <span>WhatsApp</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://t.me/share/url?url=<?=urlencode($currentUrl)?>" target="_blank" rel="noopener" class="share-item telegram">
                                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_tg.svg" alt="">
                                            <span>Telegram</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://vk.com/share.php?url=<?=urlencode($currentUrl)?>" target="_blank" rel="noopener" class="share-item vk">
                                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_vk.svg" alt="">
                                            <span>ВКонтакте</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://connect.ok.ru/offer?url=<?=urlencode($currentUrl)?>" target="_blank" rel="noopener" class="share-item odnoklassniki">
                                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/share_ok.svg" alt="">
                                            <span>Одноклассники</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="title"><?=$arResult["NAME"]?></div>
                    <a href="#product_characteristics" class="product-reviews">
                        <div class="stars">
                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star.svg" alt="">
                        </div>
                        <span>4</span>
                        <p>15 отзывов</p>
                    </a>
                    <?if ($haveOffers) {?>
                    <div class="color_selection_container">
                        <div class="product-options">
                            <?
                            foreach ($arResult['SKU_PROPS'] as $skuProperty) {

                                //pre($skuProperty);

                                if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
                                    continue;

                                $propertyId = $skuProperty['ID'];
                                $skuProps[] = array(
                                    'ID' => $propertyId,
                                    'SHOW_MODE' => $skuProperty['SHOW_MODE'],
                                    'VALUES' => $skuProperty['VALUES'],
                                    'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
                                );
                                ?>
                                    <div class="option-group" data-offer-id="<?= $skuProperty["ID"]?>" data-entity="sku-line-block">
                                        <div class="color_type"><span>Цвет:</span> Бук светлый ЛДСП</div>
                                        <div class="color-picker">
                                            <?
                                            $c = 0;
                                            foreach ($skuProperty['VALUES'] as &$value) {
                                                $value['NAME'] = htmlspecialcharsbx($value['NAME']);
                                                if ($skuProperty['SHOW_MODE'] === 'PICT') {
                                                    //pre($value["PICT"]["SRC"]);
                                                    ?>
                                                    <button class="color-option<?=($c == 0)?(' active'):('');?>" data-color="<?=$value['NAME']?>" data-value="<?=$value["NAME"]?>" data-treevalue="<?=$propertyId?>_<?=$value['ID']?>" data-onevalue="<?=$value['ID']?>" title="<?=$value['NAME']?>">
                                                        <img src="<?= $value["PICT"]["SRC"]?>"
                                                             alt="<?=$value['NAME']?>">
                                                    </button>
                                                    <?
                                                }
                                                $c++;
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?

                                    ?>
                                    <div class="option-group" data-offer-id="<?= $skuProperty["ID"]?>" data-entity="sku-line-block">
                                        <p class="option-title"><?= $skuProperty["NAME"] ?></p>
                                        <div class="option-buttons" data-group="<?= $skuProperty["CODE"] ?>">
                                            <?
                                            $v = 0;
                                            foreach ($skuProperty['VALUES'] as &$value) {
                                                $value['NAME'] = htmlspecialcharsbx($value['NAME']);

                                                if ($skuProperty['SHOW_MODE'] !== 'PICT') {

                                                    //pre($value["NAME"]);
                                                    ?>
                                                    <button class="option-btn <?=($v == 0)?('active'):('');?>" data-value="<?=$value["NAME"]?>" data-treevalue="<?=$propertyId?>_<?=$value['ID']?>" data-onevalue="<?=$value['ID']?>" title="<?=$value['NAME']?>"><?=$value["NAME"]?></button>
                                                    <?
                                                }
                                                $v++;
                                            }

                                            ?>
                                        </div>
                                    </div>
                                    <?
                            }
                            ?>

                        </div>


                        <div class="specs_z">
                            <div class="specs-item">
                                <span>Ростовая группа</span>
                                <span class="value">4-6</span>
                            </div>

                            <div class="specs-item">
                                <span>Высота, м</span>
                                <span class="value">150</span>
                            </div>

                            <div class="specs-item">
                                <span>Ширина, м</span>
                                <span class="value">1</span>
                            </div>

                            <div class="specs-item">
                                <span>Глубина, м</span>
                                <span class="value">1 шт</span>
                            </div>

                        </div>
                        <div class="specs_z full">
                            <div class="specs-item">
                                <span>Ростовая группа</span>
                                <span class="value">4-6</span>
                            </div>

                            <div class="specs-item">
                                <span>Высота, м</span>
                                <span class="value">150</span>
                            </div>

                            <div class="specs-item">
                                <span>Ширина, м</span>
                                <span class="value">1</span>
                            </div>

                            <div class="specs-item">
                                <span>Глубина, м</span>
                                <span class="value">1 шт</span>
                            </div>
                        </div>
                        <a href="#" class="all_charac">Все характеристики</a>

                    </div>
                    <?}?>
                    <div class="description short">
                        <?=$arResult["PREVIEW_TEXT"]?>
                    </div>
                    <?if (!empty($arResult["DETAIL_TEXT"])){?>
                    <div class="description full">
                        <?=$arResult["DETAIL_TEXT"]?>
                    </div>
                    <a href="javascript:void(0);" class="full-desc">Полное описание</a>
                    <?}?>
                    <div class="product-bottom">
                        <div class="pb-top">
                            <div class="price">
                                <span class="new-price"><?=$price["PRINT_PRICE"]?></span>
                                <span class="old-price"><?=$price["PRINT_BASE_PRICE"]?></span>
                            </div>
                            <div class="col desc">
                                <a href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M1.25 4.02778V11.3611C1.25 11.6302 1.41183 11.873 1.66026 11.9765L7.91667 14.5833M1.25 4.02778L7.40385 1.46368C7.73205 1.32692 8.10128 1.32692 8.42949 1.46368L11.25 2.63889M1.25 4.02778L4.58333 5.41667M7.91667 6.80556V14.5833M7.91667 6.80556L14.5833 4.02778M7.91667 6.80556L4.58333 5.41667M7.91667 14.5833L14.1731 11.9765C14.4215 11.873 14.5833 11.6302 14.5833 11.3611V4.02778M14.5833 4.02778L11.25 2.63889M4.58333 5.41667L11.25 2.63889" stroke="#033B80" stroke-width="1.06" stroke-linejoin="round"></path>
                                    </svg>
                                    <span class="delivery_btn">Доставка</span>
                                </a>
                                <a href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M2.56004 12.4029L2.83761 11.9499L2.56004 12.4029ZM1.59712 11.44L2.05009 11.1624L1.59712 11.44ZM12.4042 11.44L11.9512 11.1624L12.4042 11.44ZM11.4413 12.4029L11.1637 11.9499L11.4413 12.4029ZM11.4413 3.34582L11.1637 3.79878L11.4413 3.34582ZM12.4042 4.30873L11.9512 4.58631L12.4042 4.30873ZM2.56004 3.34582L2.83761 3.79878L2.56004 3.34582ZM1.59712 4.30873L2.05009 4.58631L1.59712 4.30873ZM10.7788 1.48478L11.1622 1.11703V1.11703L10.7788 1.48478ZM2.24312 1.68564L2.56388 2.10912H2.56388L2.24312 1.68564ZM1.66575 2.28757L2.1016 2.59132L1.66575 2.28757ZM11.084 2.99204H11.6152L11.6152 2.98941L11.084 2.99204ZM10.7128 8.0344C11.0062 8.0344 11.244 7.79655 11.244 7.50315C11.244 7.20974 11.0062 6.9719 10.7128 6.9719V8.0344ZM9.12187 6.9719C8.82847 6.9719 8.59062 7.20974 8.59062 7.50315C8.59062 7.79655 8.82847 8.0344 9.12187 8.0344V6.9719ZM6.12566 3.44727H7.87566V2.38477H6.12566V3.44727ZM7.87566 12.3014H6.12566V13.3639H7.87566V12.3014ZM6.12566 12.3014C5.16062 12.3014 4.47415 12.3009 3.94008 12.2501C3.41392 12.2001 3.0908 12.1051 2.83761 11.9499L2.28246 12.8558C2.73064 13.1305 3.23558 13.2504 3.83951 13.3078C4.43554 13.3645 5.18119 13.3639 6.12566 13.3639V12.3014ZM0.636074 7.87435C0.636074 8.81881 0.635514 9.56447 0.692184 10.1605C0.749607 10.7644 0.86951 11.2694 1.14416 11.7175L2.05009 11.1624C1.89494 10.9092 1.79994 10.5861 1.74991 10.0599C1.69913 9.52586 1.69857 8.83939 1.69857 7.87435H0.636074ZM2.83761 11.9499C2.51664 11.7532 2.24678 11.4834 2.05009 11.1624L1.14416 11.7175C1.42846 12.1815 1.81852 12.5715 2.28246 12.8558L2.83761 11.9499ZM7.87566 13.3639C8.82012 13.3639 9.56577 13.3645 10.1618 13.3078C10.7657 13.2504 11.2707 13.1305 11.7189 12.8558L11.1637 11.9499C10.9105 12.1051 10.5874 12.2001 10.0612 12.2501C9.52717 12.3009 8.84069 12.3014 7.87566 12.3014V13.3639ZM11.9512 11.1624C11.7545 11.4834 11.4847 11.7532 11.1637 11.9499L11.7189 12.8558C12.1828 12.5715 12.5729 12.1815 12.8572 11.7175L11.9512 11.1624ZM11.1637 3.79878C11.4847 3.99547 11.7545 4.26533 11.9512 4.58631L12.8572 4.03115C12.5729 3.56721 12.1828 3.17715 11.7189 2.89285L11.1637 3.79878ZM6.12566 2.38477C5.18119 2.38477 4.43554 2.38421 3.83951 2.44088C3.23558 2.4983 2.73064 2.6182 2.28246 2.89285L2.83761 3.79878C3.0908 3.64363 3.41392 3.54863 3.94008 3.49861C4.47415 3.44783 5.16062 3.44727 6.12566 3.44727V2.38477ZM1.69857 7.87435C1.69857 6.90931 1.69913 6.22284 1.74991 5.68877C1.79994 5.16261 1.89494 4.83949 2.05009 4.58631L1.14416 4.03115C0.86951 4.47934 0.749607 4.98427 0.692184 5.5882C0.635514 6.18423 0.636074 6.92989 0.636074 7.87435H1.69857ZM2.28246 2.89285C1.81852 3.17715 1.42846 3.56721 1.14416 4.03115L2.05009 4.58631C2.24678 4.26533 2.51664 3.99547 2.83761 3.79878L2.28246 2.89285ZM5.86495 1.69727H8.9967V0.634766H5.86495V1.69727ZM8.9967 1.69727C9.50445 1.69727 9.82957 1.69849 10.0684 1.73197C10.2896 1.76297 10.3566 1.81214 10.3954 1.85253L11.1622 1.11703C10.8952 0.838657 10.5632 0.728438 10.2159 0.679754C9.8862 0.633541 9.47317 0.634766 8.9967 0.634766V1.69727ZM5.86495 0.634766C4.89867 0.634766 4.1295 0.633974 3.51771 0.703076C2.89463 0.773455 2.37182 0.921713 1.92235 1.26216L2.56388 2.10912C2.80044 1.92995 3.10995 1.81839 3.63697 1.75886C4.17529 1.69806 4.87402 1.69727 5.86495 1.69727V0.634766ZM1.69857 6.06347C1.69857 5.03188 1.69925 4.29913 1.75803 3.73346C1.81591 3.17649 1.92531 2.84428 2.1016 2.59132L1.2299 1.98383C0.90776 2.44607 0.767947 2.98158 0.701223 3.62364C0.635403 4.257 0.636074 5.0546 0.636074 6.06347H1.69857ZM1.92235 1.26216C1.65581 1.46405 1.4223 1.70775 1.2299 1.98383L2.1016 2.59132C2.23114 2.40543 2.38731 2.24287 2.56388 2.10912L1.92235 1.26216ZM11.6152 2.98941C11.6133 2.59548 11.605 2.24587 11.554 1.95344C11.5007 1.64749 11.3936 1.35829 11.1622 1.11703L10.3954 1.85253C10.4327 1.89145 10.4762 1.95746 10.5073 2.1359C10.5408 2.32785 10.5508 2.59178 10.5527 2.99466L11.6152 2.98941ZM0.636074 6.06347C0.636074 6.62931 0.624307 7.15446 0.636258 7.59702L1.69837 7.56834C1.68689 7.14312 1.69857 6.66667 1.69857 6.06347H0.636074ZM12.5423 8.5628H9.12187V9.62531H12.5423V8.5628ZM6.99971 7.50315C6.99971 8.67518 7.94983 9.62531 9.12187 9.62531V8.5628C8.53664 8.5628 8.06221 8.08838 8.06221 7.50315H6.99971ZM8.06221 7.50315C8.06221 6.91791 8.53664 6.44349 9.12187 6.44349V5.38099C7.94983 5.38099 6.99971 6.33111 6.99971 7.50315H8.06221ZM10.7128 6.9719H9.12187V8.0344H10.7128V6.9719ZM7.87566 3.44727C8.68443 3.44727 9.29962 3.44749 9.79693 3.47818C10.2937 3.50883 10.6326 3.56824 10.8954 3.66805L11.2726 2.67476C10.8629 2.51918 10.4003 2.45089 9.86237 2.4177C9.32496 2.38454 8.67222 2.38477 7.87566 2.38477V3.44727ZM10.8954 3.66805C10.9935 3.70531 11.0817 3.74851 11.1637 3.79878L11.7189 2.89285C11.5774 2.80619 11.4293 2.73428 11.2726 2.67476L10.8954 3.66805ZM10.5527 2.99204V3.17141H11.6152V2.99204H10.5527ZM9.12187 6.44349H12.8016V5.38099H9.12187V6.44349ZM13.3652 7.87435C13.3652 7.07368 13.3655 6.41825 13.3318 5.8791L12.2713 5.94538C12.3025 6.44391 12.3027 7.06128 12.3027 7.87435H13.3652ZM13.3318 5.8791C13.2857 5.14219 13.1737 4.54776 12.8572 4.03115L11.9512 4.58631C12.131 4.87969 12.2288 5.26424 12.2713 5.94538L13.3318 5.8791ZM12.3027 7.87435C12.3027 8.33396 12.3027 8.73252 12.2969 9.08524L13.3592 9.10287C13.3653 8.73954 13.3652 8.33143 13.3652 7.87435H12.3027ZM12.2969 9.08524C12.2779 10.2296 12.1927 10.7684 11.9512 11.1624L12.8572 11.7175C13.269 11.0455 13.3406 10.2256 13.3592 9.10287L12.2969 9.08524ZM12.5423 9.62531H12.828V8.5628H12.5423V9.62531Z" fill="#033B80"></path>
                                    </svg>
                                    <span class="pay_option_btn">Варианты оплаты</span>
                                </a>
                            </div>
                        </div>
                        <div class="pb-bottom">
                            <?//if ($inBasket){?>
                            <div class="in-basket" style="<?=($inBasket)?('display:ruby'):('display:none');?>" >
                                <div class="quantity-selector" data-base-price="<?=$price["RATIO_PRICE"]?>" data-item="<?=$arResult["ID"]?>">
                                    <button class="btn-decrease">−</button>
                                    <div class="quantity-info">
                                        <span class="quantity-value"><?=$basketQuantity?></span> шт.
                                        <div class="price_z"><?=CCurrencyLang::CurrencyFormat($price["RATIO_PRICE"] * $basketQuantity, $price["CURRENCY"], true)?></div>
                                    </div>
                                    <button class="btn-increase">+</button>
                                </div>

                                <a href="javascript:void(0);" class="korzina-btn success">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/tick.svg" alt="" />
                                    <span>В корзине</span>
                                </a>
                            </div>
                            <?//} else {?>
                            <div class="no-basket" style="<?=(!$inBasket)?('display:ruby'):('display:none');?>">
                                <a href="javascript:void(0);" class="korzina-btn" data-item="<?=$arResult["ID"]?>">
                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/buy.svg" alt="" />
                                    <span>Добавить в корзину</span>
                                </a>
                                <a href="javascript:void(0);" class="buy-btn one_buy_click-trigger" data-id="<?=$arResult["ID"]?>">Купить в 1 клик</a>
                            </div>
                            <?//}?>
                        </div>
                        <div class="pb-top mob">
                            <div class="col mob">
                                <a href="/about/delivery/">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M1.25 4.02778V11.3611C1.25 11.6302 1.41183 11.873 1.66026 11.9765L7.91667 14.5833M1.25 4.02778L7.40385 1.46368C7.73205 1.32692 8.10128 1.32692 8.42949 1.46368L11.25 2.63889M1.25 4.02778L4.58333 5.41667M7.91667 6.80556V14.5833M7.91667 6.80556L14.5833 4.02778M7.91667 6.80556L4.58333 5.41667M7.91667 14.5833L14.1731 11.9765C14.4215 11.873 14.5833 11.6302 14.5833 11.3611V4.02778M14.5833 4.02778L11.25 2.63889M4.58333 5.41667L11.25 2.63889" stroke="#033B80" stroke-width="1.06" stroke-linejoin="round"></path>
                                    </svg>
                                    <span class="delivery_btn">Доставка</span>
                                </a>
                                <a href="/about/delivery/">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                                        <path d="M2.56004 12.4029L2.83761 11.9499L2.56004 12.4029ZM1.59712 11.44L2.05009 11.1624L1.59712 11.44ZM12.4042 11.44L11.9512 11.1624L12.4042 11.44ZM11.4413 12.4029L11.1637 11.9499L11.4413 12.4029ZM11.4413 3.34582L11.1637 3.79878L11.4413 3.34582ZM12.4042 4.30873L11.9512 4.58631L12.4042 4.30873ZM2.56004 3.34582L2.83761 3.79878L2.56004 3.34582ZM1.59712 4.30873L2.05009 4.58631L1.59712 4.30873ZM10.7788 1.48478L11.1622 1.11703V1.11703L10.7788 1.48478ZM2.24312 1.68564L2.56388 2.10912H2.56388L2.24312 1.68564ZM1.66575 2.28757L2.1016 2.59132L1.66575 2.28757ZM11.084 2.99204H11.6152L11.6152 2.98941L11.084 2.99204ZM10.7128 8.0344C11.0062 8.0344 11.244 7.79655 11.244 7.50315C11.244 7.20974 11.0062 6.9719 10.7128 6.9719V8.0344ZM9.12187 6.9719C8.82847 6.9719 8.59062 7.20974 8.59062 7.50315C8.59062 7.79655 8.82847 8.0344 9.12187 8.0344V6.9719ZM6.12566 3.44727H7.87566V2.38477H6.12566V3.44727ZM7.87566 12.3014H6.12566V13.3639H7.87566V12.3014ZM6.12566 12.3014C5.16062 12.3014 4.47415 12.3009 3.94008 12.2501C3.41392 12.2001 3.0908 12.1051 2.83761 11.9499L2.28246 12.8558C2.73064 13.1305 3.23558 13.2504 3.83951 13.3078C4.43554 13.3645 5.18119 13.3639 6.12566 13.3639V12.3014ZM0.636074 7.87435C0.636074 8.81881 0.635514 9.56447 0.692184 10.1605C0.749607 10.7644 0.86951 11.2694 1.14416 11.7175L2.05009 11.1624C1.89494 10.9092 1.79994 10.5861 1.74991 10.0599C1.69913 9.52586 1.69857 8.83939 1.69857 7.87435H0.636074ZM2.83761 11.9499C2.51664 11.7532 2.24678 11.4834 2.05009 11.1624L1.14416 11.7175C1.42846 12.1815 1.81852 12.5715 2.28246 12.8558L2.83761 11.9499ZM7.87566 13.3639C8.82012 13.3639 9.56577 13.3645 10.1618 13.3078C10.7657 13.2504 11.2707 13.1305 11.7189 12.8558L11.1637 11.9499C10.9105 12.1051 10.5874 12.2001 10.0612 12.2501C9.52717 12.3009 8.84069 12.3014 7.87566 12.3014V13.3639ZM11.9512 11.1624C11.7545 11.4834 11.4847 11.7532 11.1637 11.9499L11.7189 12.8558C12.1828 12.5715 12.5729 12.1815 12.8572 11.7175L11.9512 11.1624ZM11.1637 3.79878C11.4847 3.99547 11.7545 4.26533 11.9512 4.58631L12.8572 4.03115C12.5729 3.56721 12.1828 3.17715 11.7189 2.89285L11.1637 3.79878ZM6.12566 2.38477C5.18119 2.38477 4.43554 2.38421 3.83951 2.44088C3.23558 2.4983 2.73064 2.6182 2.28246 2.89285L2.83761 3.79878C3.0908 3.64363 3.41392 3.54863 3.94008 3.49861C4.47415 3.44783 5.16062 3.44727 6.12566 3.44727V2.38477ZM1.69857 7.87435C1.69857 6.90931 1.69913 6.22284 1.74991 5.68877C1.79994 5.16261 1.89494 4.83949 2.05009 4.58631L1.14416 4.03115C0.86951 4.47934 0.749607 4.98427 0.692184 5.5882C0.635514 6.18423 0.636074 6.92989 0.636074 7.87435H1.69857ZM2.28246 2.89285C1.81852 3.17715 1.42846 3.56721 1.14416 4.03115L2.05009 4.58631C2.24678 4.26533 2.51664 3.99547 2.83761 3.79878L2.28246 2.89285ZM5.86495 1.69727H8.9967V0.634766H5.86495V1.69727ZM8.9967 1.69727C9.50445 1.69727 9.82957 1.69849 10.0684 1.73197C10.2896 1.76297 10.3566 1.81214 10.3954 1.85253L11.1622 1.11703C10.8952 0.838657 10.5632 0.728438 10.2159 0.679754C9.8862 0.633541 9.47317 0.634766 8.9967 0.634766V1.69727ZM5.86495 0.634766C4.89867 0.634766 4.1295 0.633974 3.51771 0.703076C2.89463 0.773455 2.37182 0.921713 1.92235 1.26216L2.56388 2.10912C2.80044 1.92995 3.10995 1.81839 3.63697 1.75886C4.17529 1.69806 4.87402 1.69727 5.86495 1.69727V0.634766ZM1.69857 6.06347C1.69857 5.03188 1.69925 4.29913 1.75803 3.73346C1.81591 3.17649 1.92531 2.84428 2.1016 2.59132L1.2299 1.98383C0.90776 2.44607 0.767947 2.98158 0.701223 3.62364C0.635403 4.257 0.636074 5.0546 0.636074 6.06347H1.69857ZM1.92235 1.26216C1.65581 1.46405 1.4223 1.70775 1.2299 1.98383L2.1016 2.59132C2.23114 2.40543 2.38731 2.24287 2.56388 2.10912L1.92235 1.26216ZM11.6152 2.98941C11.6133 2.59548 11.605 2.24587 11.554 1.95344C11.5007 1.64749 11.3936 1.35829 11.1622 1.11703L10.3954 1.85253C10.4327 1.89145 10.4762 1.95746 10.5073 2.1359C10.5408 2.32785 10.5508 2.59178 10.5527 2.99466L11.6152 2.98941ZM0.636074 6.06347C0.636074 6.62931 0.624307 7.15446 0.636258 7.59702L1.69837 7.56834C1.68689 7.14312 1.69857 6.66667 1.69857 6.06347H0.636074ZM12.5423 8.5628H9.12187V9.62531H12.5423V8.5628ZM6.99971 7.50315C6.99971 8.67518 7.94983 9.62531 9.12187 9.62531V8.5628C8.53664 8.5628 8.06221 8.08838 8.06221 7.50315H6.99971ZM8.06221 7.50315C8.06221 6.91791 8.53664 6.44349 9.12187 6.44349V5.38099C7.94983 5.38099 6.99971 6.33111 6.99971 7.50315H8.06221ZM10.7128 6.9719H9.12187V8.0344H10.7128V6.9719ZM7.87566 3.44727C8.68443 3.44727 9.29962 3.44749 9.79693 3.47818C10.2937 3.50883 10.6326 3.56824 10.8954 3.66805L11.2726 2.67476C10.8629 2.51918 10.4003 2.45089 9.86237 2.4177C9.32496 2.38454 8.67222 2.38477 7.87566 2.38477V3.44727ZM10.8954 3.66805C10.9935 3.70531 11.0817 3.74851 11.1637 3.79878L11.7189 2.89285C11.5774 2.80619 11.4293 2.73428 11.2726 2.67476L10.8954 3.66805ZM10.5527 2.99204V3.17141H11.6152V2.99204H10.5527ZM9.12187 6.44349H12.8016V5.38099H9.12187V6.44349ZM13.3652 7.87435C13.3652 7.07368 13.3655 6.41825 13.3318 5.8791L12.2713 5.94538C12.3025 6.44391 12.3027 7.06128 12.3027 7.87435H13.3652ZM13.3318 5.8791C13.2857 5.14219 13.1737 4.54776 12.8572 4.03115L11.9512 4.58631C12.131 4.87969 12.2288 5.26424 12.2713 5.94538L13.3318 5.8791ZM12.3027 7.87435C12.3027 8.33396 12.3027 8.73252 12.2969 9.08524L13.3592 9.10287C13.3653 8.73954 13.3652 8.33143 13.3652 7.87435H12.3027ZM12.2969 9.08524C12.2779 10.2296 12.1927 10.7684 11.9512 11.1624L12.8572 11.7175C13.269 11.0455 13.3406 10.2256 13.3592 9.10287L12.2969 9.08524ZM12.5423 9.62531H12.828V8.5628H12.5423V9.62531Z" fill="#033B80"></path>
                                    </svg>
                                    <span class="pay_option_btn">Варианты оплаты</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-screen__right-side-bottom">
                    <div class="bottom-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="30" viewBox="0 0 27 30" fill="none">
                            <path d="M17.1515 12.3346L14.4561 15.6797C13.3881 17.0052 12.854 17.668 12.1515 17.668C11.4489 17.668 10.9149 17.0052 9.84682 15.6797L9.15148 14.8167M22.3369 20.3346C24.4726 16.4425 25.0208 12.001 25.1288 9.18383C25.1906 7.57003 23.8575 6.33464 22.2425 6.33464H21.4567C20.168 6.33464 19.1233 5.28997 19.1233 4.0013C19.1233 2.71264 18.0787 1.66797 16.79 1.66797H9.90199C8.39855 1.66797 7.17977 2.88675 7.17977 4.39019C7.17977 5.89363 5.96099 7.11241 4.45755 7.11241H4.04573C2.43493 7.11241 1.10396 8.33745 1.18517 9.94619C1.31649 12.5474 1.89447 16.559 3.96624 20.3346C4.52972 21.3615 5.29503 22.392 6.14493 23.3739C8.78481 26.4239 10.1048 27.9489 13.1516 27.9489C16.1984 27.9489 17.5183 26.4239 20.1582 23.3739C21.0081 22.392 21.7734 21.3615 22.3369 20.3346Z" stroke="#056BE9" stroke-width="2.28571" stroke-linecap="round"/>
                        </svg>
                        <span>Сертификаты, ГОСТ, ФГОС РФ, СанПин</span>
                    </div>
                    <div class="bottom-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="31" viewBox="0 0 24 31" fill="none">
                            <path d="M15.8607 26.268L14.9597 25.5614L15.8607 26.268ZM8.44527 26.268L7.54427 26.9745L8.44527 26.268ZM12.153 29.3413V28.1963V29.3413ZM21.6747 12.8122C21.6747 14.4075 20.8388 16.5676 19.4984 18.9373C18.1834 21.2621 16.4823 23.6198 14.9597 25.5614L16.7617 26.9745C18.3188 24.989 20.0971 22.5302 21.4917 20.0647C22.8609 17.6441 23.9647 15.0399 23.9647 12.8122H21.6747ZM9.34627 25.5614C7.82365 23.6198 6.12254 21.2621 4.80754 18.9373C3.46719 16.5676 2.63133 14.4075 2.63133 12.8122H0.341328C0.341328 15.0399 1.4451 17.6441 2.8143 20.0647C4.20885 22.5302 5.98722 24.989 7.54427 26.9745L9.34627 25.5614ZM2.63133 12.8122C2.63133 7.02482 6.97195 2.47898 12.153 2.47898V0.188984C5.55197 0.188984 0.341328 5.92113 0.341328 12.8122H2.63133ZM12.153 2.47898C17.334 2.47898 21.6747 7.02482 21.6747 12.8122H23.9647C23.9647 5.92113 18.754 0.188984 12.153 0.188984V2.47898ZM14.9597 25.5614C14.1313 26.6179 13.5965 27.2936 13.1211 27.7254C12.6947 28.1127 12.4317 28.1963 12.153 28.1963V30.4863C13.1719 30.4863 13.9594 30.0576 14.6608 29.4205C15.3132 28.8279 15.9835 27.967 16.7617 26.9745L14.9597 25.5614ZM7.54427 26.9745C8.32253 27.967 8.99277 28.8279 9.64516 29.4205C10.3466 30.0576 11.134 30.4863 12.153 30.4863V28.1963C11.8743 28.1963 11.6113 28.1127 11.1849 27.7254C10.7095 27.2936 10.1747 26.6179 9.34627 25.5614L7.54427 26.9745ZM7.008 13.334C7.008 16.1755 9.31149 18.479 12.153 18.479V16.189C10.5762 16.189 9.298 14.9108 9.298 13.334H7.008ZM12.153 18.479C14.9945 18.479 17.298 16.1755 17.298 13.334H15.008C15.008 14.9108 13.7298 16.189 12.153 16.189V18.479ZM17.298 13.334C17.298 10.4925 14.9945 8.18898 12.153 8.18898V10.479C13.7298 10.479 15.008 11.7572 15.008 13.334H17.298ZM12.153 8.18898C9.31149 8.18898 7.008 10.4925 7.008 13.334H9.298C9.298 11.7572 10.5762 10.479 12.153 10.479V8.18898Z" fill="#EC9605"/>
                        </svg>
                        <span>Доставка по всей России</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-screen__bottom"></div>
    </div>

    <div class="product_characteristics" id="product_characteristics">
        <div class="container white">
            <div class="product_tabs_container">
                <div class="product_tabs_header">
                    <div class="product_tabs_header_in">
                        <a href="#" class="product_tab" data-target="descriptions">Описание</a>
                        <a href="#" class="product_tab" data-target="characteristics">Характеристики</a>
                        <a href="#" class="product_tab active" data-target="reviews">Отзывы <span>12</span></a>
                    </div>
                </div>
                <div class="product_tabs_content">
                    <div class="pr_content" id="descriptions">
                        <p><?=$arResult["DETAIL_TEXT"]?></p>
                    </div>
                    <div class="pr_content" id="characteristics">
                        <div class="characteristics_in">
                            <div class="specs">
                                <h5>Основные</h5>

                                <div class="specs-item">
                                    <span>Ростовая группа</span>
                                    <span class="value">4-6</span>
                                </div>

                                <div class="specs-item">
                                    <span>Высота, м</span>
                                    <span class="value">150</span>
                                </div>

                                <div class="specs-item">
                                    <span>Ширина, м</span>
                                    <span class="value">1</span>
                                </div>

                                <div class="specs-item">
                                    <span>Глубина, м</span>
                                    <span class="value">1 шт</span>
                                </div>

                            </div>
                            <div class="specs">
                                <h5 class="opac_0">Основные</h5>
                                <div class="specs-item">
                                    <span>Материалы (Стулья)</span>
                                    <span class="value">Пластик и сталь</span>
                                </div>

                                <div class="specs-item">
                                    <span>Материалы (Парта)</span>
                                    <span class="value">МДФ/ЛДСП</span>
                                </div>

                                <div class="specs-item">
                                    <span>Материалы (Колеса)</span>
                                    <span class="value">Прорезиненные</span>
                                </div>

                            </div>
                            <div class="specs">
                                <h5>Дополнительные</h5>

                                <div class="specs-item">
                                    <span>Ростовая группа</span>
                                    <span class="value">4-6</span>
                                </div>

                                <div class="specs-item">
                                    <span>Материалы (Стулья, парта, колеса)</span>
                                    <span class="value">Пластик, сталь</span>
                                </div>

                                <div class="specs-item">
                                    <span>Цвета</span>
                                    <span class="value">Серый, белый бук</span>
                                </div>

                            </div>
                            <div class="specs mob_none"></div>
                            <div class="specs">
                                <h5>Комплектация</h5>

                                <div class="specs-item">
                                    <span>Стул ученический регулируемый</span>
                                    <span class="value">1 шт</span>
                                </div>

                                <div class="specs-item">
                                    <span>Стол-трансформер “Трапеция” регулируемый </span>
                                    <span class="value">1 шт</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="pr_content active" id="reviews">
                        <div class="reviews_in">
                            <div class="reviews_header desc">
                                <span class="num_reviews">12 отзывов</span>
                                <div class="dropdown">
                                    <button class="dropdown-btn">
                                        <span class="selected">Сначала новые</span>
                                        <span class="arrow">&#9662;</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li data-value="new">Сначала новые</li>
                                        <li data-value="old">Сначала старые</li>
                                        <li data-value="popular">Популярные</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="reviews-container">
                                <div class="reviews_header mob">
                                    <span class="num_reviews">12 отзывов</span>
                                    <div class="dropdown">
                                        <button class="dropdown-btn">
                                            <span class="selected">Сначала новые</span>
                                            <span class="arrow">&#9662;</span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li data-value="new">Сначала новые</li>
                                            <li data-value="old">Сначала старые</li>
                                            <li data-value="popular">Популярные</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="reviews_left">
                                    <div class="review_item load_item">
                                        <div class="review_item_left">
                                            <div class="avatar">A</div>
                                            <div class="review_item_name">
                                                <h4>Александра</h4>
                                                <div class="location">МБОУ "Школа №32", г. Киров</div>
                                                <div class="stars">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <span>5</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <div class="desc">
                                                Хороший экран для своей цены, не шумный оклад, общая производительность отличная. <br> Приличный корпус, ничего не хрустит. Сразу из коробки диск на 512 и 8 гигов ОЗУ
                                            </div>
                                            <span class="date">26 февраля</span>
                                        </div>
                                    </div>

                                    <div class="review_item load_item">
                                        <div class="review_item_left">
                                            <div class="avatar img-avatar">
                                                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User">
                                            </div>
                                            <div class="review_item_name">
                                                <h4>Александра</h4>
                                                <div class="location">МБОУ "Школа №32", г. Киров</div>
                                                <div class="stars">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star.svg" alt="">
                                                    <span>4</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <div class="desc">
                                                Хороший экран для своей цены, не шумный оклад, общая производительность отличная. <br> Приличный корпус, ничего не хрустит. Сразу из коробки диск на 512 и 8 гигов ОЗУ
                                            </div>
                                            <span class="date">26 февраля</span>
                                        </div>
                                    </div>

                                    <div class="review_item load_item">
                                        <div class="review_item_left">
                                            <div class="avatar">A</div>
                                            <div class="review_item_name">
                                                <h4>Александра</h4>
                                                <div class="location">МБОУ "Школа №32", г. Киров</div>
                                                <div class="stars">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <span>5</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <div class="desc">
                                                Хороший экран для своей цены, не шумный оклад, общая производительность отличная. <br> Приличный корпус, ничего не хрустит. Сразу из коробки диск на 512 и 8 гигов ОЗУ
                                            </div>
                                            <span class="date">26 февраля</span>
                                        </div>
                                    </div>

                                    <div class="review_item load_item">
                                        <div class="review_item_left">
                                            <div class="avatar img-avatar">
                                                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User">
                                            </div>
                                            <div class="review_item_name">
                                                <h4>Александра</h4>
                                                <div class="location">МБОУ "Школа №32", г. Киров</div>
                                                <div class="stars">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star.svg" alt="">
                                                    <span>4</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <div class="desc">
                                                Хороший экран для своей цены, не шумный оклад, общая производительность отличная. <br> Приличный корпус, ничего не хрустит. Сразу из коробки диск на 512 и 8 гигов ОЗУ
                                            </div>
                                            <span class="date">26 февраля</span>
                                        </div>
                                    </div>

                                    <div class="review_item load_item hidd_z">
                                        <div class="review_item_left">
                                            <div class="avatar img-avatar">
                                                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User">
                                            </div>
                                            <div class="review_item_name">
                                                <h4>Александра</h4>
                                                <div class="location">МБОУ "Школа №32", г. Киров</div>
                                                <div class="stars">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star.svg" alt="">
                                                    <span>4</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <div class="desc">
                                                Хороший экран для своей цены, не шумный оклад, общая производительность отличная. <br> Приличный корпус, ничего не хрустит. Сразу из коробки диск на 512 и 8 гигов ОЗУ
                                            </div>
                                            <span class="date">26 февраля</span>
                                        </div>
                                    </div>

                                    <div class="review_item load_item hidd_z">
                                        <div class="review_item_left">
                                            <div class="avatar img-avatar">
                                                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User">
                                            </div>
                                            <div class="review_item_name">
                                                <h4>Александра</h4>
                                                <div class="location">МБОУ "Школа №32", г. Киров</div>
                                                <div class="stars">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star.svg" alt="">
                                                    <span>4</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <div class="desc">
                                                Хороший экран для своей цены, не шумный оклад, общая производительность отличная. <br> Приличный корпус, ничего не хрустит. Сразу из коробки диск на 512 и 8 гигов ОЗУ
                                            </div>
                                            <span class="date">26 февраля</span>
                                        </div>
                                    </div>

                                    <a href="#" class="btn_z mini load-more">Загрузить ещё</a>
                                </div>

                                <div class="review-summary">
                                    <div class="rating_top">
                                        <div class="rating">
                                            <h1>4.5</h1>
                                            <p>На основании <br> 22 отзывов</p>
                                            <div class="stars">
                                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt="">
                                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star_half.svg" alt="">
                                            </div>
                                        </div>
                                        <div class="rating-breakdown">
                                            <div class="bar">
                                                <span>5 <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt=""></span>
                                                <div class="progress"><div style="width: 83%;"></div></div>
                                                <span>83%</span>
                                            </div>
                                            <div class="bar">
                                                <span>4 <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt=""></span>
                                                <div class="progress"><div style="width: 70%;"></div></div>
                                                <span>70%</span>
                                            </div>
                                            <div class="bar">
                                                <span>3 <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt=""></span>
                                                <div class="progress"><div style="width: 83%;"></div></div>
                                                <span>83%</span>
                                            </div>
                                            <div class="bar">
                                                <span>2 <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt=""></span>
                                                <div class="progress"><div style="width: 70%;"></div></div>
                                                <span>70%</span>
                                            </div>
                                            <div class="bar">
                                                <span>1 <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/star-filled.svg" alt=""></span>
                                                <div class="progress"><div style="width: 83%;"></div></div>
                                                <span>83%</span>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="#" class="add-review">Оставить отзыв</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?
//pre($_SESSION);
?>




<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/blocks/advantages.php"), false);?>

<?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/blocks/sevices.php"), false);?>


<?/*?>
    <div class="popup-gallery">
        <div class="popup-content">
            <span class="close-popup"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/modal_x.svg" alt=""></span>

            <div class="popup_left swiper">
                <div class="popup_vertical swiper-wrapper">
                    <div class="image-item-popup active swiper-slide">
                        <img src="<?=$picture["SRC"]?>" alt="">
                    </div>

                    <?
                    if (!empty($actualItem['MORE_PHOTO'])) {
                        foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
                        ?>
                            <div class="image-item-popup active swiper-slide">
                                <img src="<?=$photo["SRC"]?>" alt="">
                            </div>
                        <?
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="popup_right">
                <div class="product-screen__swiper-popup">
                    <div class="swiper product-screen__popup">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="<?=$picture["SRC"]?>" alt="">
                            </div>
                            <?
                            if (!empty($actualItem['MORE_PHOTO'])) {
                                foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
                                ?>
                                    <div class="swiper-slide">
                                        <img src="<?=$photo["SRC"]?>" alt="">
                                    </div>
                                <?
                                }
                            }
                            ?>

                        </div>
                        <div class="product-popup-prev swiper-btn">
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
                        <div class="product-popup-next swiper-btn">
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
            </div>

        </div>
    </div>
    <?if ($arParams['USE_VOTE_RATING'] === 'Y') {?>
    <div class="review-modal modal_z">
        <?
        $APPLICATION->IncludeComponent(
            'bitrix:iblock.vote',
            'bootstrap_v5',
            array(
                'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
                'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                'ELEMENT_ID' => $arResult['ID'],
                'ELEMENT_CODE' => '',
                'MAX_VOTE' => '5',
                'VOTE_NAMES' => array('1', '2', '3', '4', '5'),
                'SET_STATUS_404' => 'N',
                'DISPLAY_AS_RATING' => $arParams['VOTE_DISPLAY_AS_RATING'],
                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                'CACHE_TIME' => $arParams['CACHE_TIME']
            ),
            $component,
            array('HIDE_ICONS' => 'Y')
        );
        ?>
    </div>
    <?}?>


<?*/?>

<script>
	BX.message({
		ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
		TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
		BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
		BTN_MESSAGE_DETAIL_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_DETAIL_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
		COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>',
		COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		COMPARE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
		PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
		SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
	});

	var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
    window.OffersData = <?=CUtil::PhpToJSObject($arResult['JS_OFFERS'])?>;

    const currentOffer = <?=$obName?>.offers[<?=$obName?>.offerNum];
    console.log('Активный оффер:', currentOffer);
    <?=$obName?>.offers.forEach(o => {
        console.log('ID:', o.ID, 'Цена:', o.PRICE.PRINT_PRICE, 'Артикул:', o.PROPERTIES.ARTNUMBER.VALUE);
    });

</script>
<?/*?>
<script>
    const obProductInfo = <?=CUtil::PhpToJSObject($arResult['JS_OFFERS'])?>;
    const obParams = {
        PRODUCT_TYPE: <?=($arResult['CATALOG_TYPE'] ?? 0)?>,
        SHOW_QUANTITY: true,
        SHOW_DISCOUNT_PERCENT: true,
        SHOW_OLD_PRICE: true,
        SHOW_MAX_QUANTITY: "Y",
        DISPLAY_COMPARE: false,
        BASKET: {
            QUANTITY: 'quantity',
            BASKET_URL: '/personal/cart/',
            SKU_PROPS: <?=CUtil::PhpToJSObject($arResult['SKU_PROPS'])?>
        },
        VISUAL: {
            ID: 'product_<?=$arResult["ID"]?>',
            PRICE_ID: 'product-price-<?=$arResult["ID"]?>',
            ART_ID: 'product-art-<?=$arResult["ID"]?>'
        },
        PRODUCT: {
            ID: "<?=$arResult['ID']?>",
            NAME: "<?=CUtil::JSEscape($arResult['NAME'])?>"
        },
        OFFERS: obProductInfo,
        OFFER_SELECTED: <?=($arResult['OFFERS_SELECTED'] ?? 0)?>,
    };

    const obJCCatalogElement = new JCCatalogElement(obParams);
</script>
<?*/?>



<?php
unset($actualItem, $itemIds, $jsParams);
