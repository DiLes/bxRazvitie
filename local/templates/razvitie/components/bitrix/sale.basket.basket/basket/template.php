<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load(["ui.fonts.ruble", "ui.fonts.opensans"]);

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

$documentRoot = Main\Application::getDocumentRoot();

if (empty($arParams['TEMPLATE_THEME']))
{
	$arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site')
{
	$templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
	$templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
	$arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', $component->getSiteId());
}

if (!empty($arParams['TEMPLATE_THEME']))
{
	if (!is_file($documentRoot.'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
	{
		$arParams['TEMPLATE_THEME'] = 'blue';
	}
}

if (!isset($arParams['DISPLAY_MODE']) || !in_array($arParams['DISPLAY_MODE'], array('extended', 'compact')))
{
	$arParams['DISPLAY_MODE'] = 'extended';
}

$arParams['USE_DYNAMIC_SCROLL'] = isset($arParams['USE_DYNAMIC_SCROLL']) && $arParams['USE_DYNAMIC_SCROLL'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_FILTER'] = isset($arParams['SHOW_FILTER']) && $arParams['SHOW_FILTER'] === 'N' ? 'N' : 'Y';

$arParams['PRICE_DISPLAY_MODE'] = isset($arParams['PRICE_DISPLAY_MODE']) && $arParams['PRICE_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['TOTAL_BLOCK_DISPLAY']) || !is_array($arParams['TOTAL_BLOCK_DISPLAY']))
{
	$arParams['TOTAL_BLOCK_DISPLAY'] = array('top');
}

if (empty($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = 'props,sku,columns';
}

if (is_string($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = explode(',', $arParams['PRODUCT_BLOCKS_ORDER']);
}

$arParams['USE_PRICE_ANIMATION'] = isset($arParams['USE_PRICE_ANIMATION']) && $arParams['USE_PRICE_ANIMATION'] === 'N' ? 'N' : 'Y';
$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

if ($arParams['USE_GIFTS'] === 'Y')
{
	$arParams['GIFTS_BLOCK_TITLE'] = isset($arParams['GIFTS_BLOCK_TITLE']) ? trim((string)$arParams['GIFTS_BLOCK_TITLE']) : Loc::getMessage('SBB_GIFTS_BLOCK_TITLE');

	CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.basket');

	$giftParameters = array(
		'SHOW_PRICE_COUNT' => 1,
		'PRODUCT_SUBSCRIPTION' => 'N',
		'PRODUCT_ID_VARIABLE' => 'id',
		'USE_PRODUCT_QUANTITY' => 'N',
		'ACTION_VARIABLE' => 'actionGift',
		'ADD_PROPERTIES_TO_BASKET' => 'Y',
		'PARTIAL_PRODUCT_PROPERTIES' => 'Y',

		'BASKET_URL' => $APPLICATION->GetCurPage(),
		'APPLIED_DISCOUNT_LIST' => $arResult['APPLIED_DISCOUNT_LIST'],
		'FULL_DISCOUNT_LIST' => $arResult['FULL_DISCOUNT_LIST'],

		'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_SHOW_VALUE'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

		'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'] ?? '',
		'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'] ?? '',
		'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'] ?? '',

		'DETAIL_URL' => $arParams['GIFTS_DETAIL_URL'] ?? null,
		'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'] ?? '',
		'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'] ?? '',
		'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'] ?? '',
		'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'] ?? '',
		'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'] ?? '',
		'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'] ?? '',
		'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'] ?? '',
		'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'] ?? '',
		'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'] ?? '',

		'PRODUCT_ROW_VARIANTS' => '',
		'PAGE_ELEMENT_COUNT' => 0,
		'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
			SaleProductsGiftBasketComponent::predictRowVariants(
				$arParams['GIFTS_PAGE_ELEMENT_COUNT'],
				$arParams['GIFTS_PAGE_ELEMENT_COUNT']
			)
		),
		'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],

		'ADD_TO_BASKET_ACTION' => 'BUY',
		'PRODUCT_DISPLAY_MODE' => 'Y',
		'PRODUCT_BLOCKS_ORDER' => isset($arParams['GIFTS_PRODUCT_BLOCKS_ORDER']) ? $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'] : '',
		'SHOW_SLIDER' => isset($arParams['GIFTS_SHOW_SLIDER']) ? $arParams['GIFTS_SHOW_SLIDER'] : '',
		'SLIDER_INTERVAL' => isset($arParams['GIFTS_SLIDER_INTERVAL']) ? $arParams['GIFTS_SLIDER_INTERVAL'] : '',
		'SLIDER_PROGRESS' => isset($arParams['GIFTS_SLIDER_PROGRESS']) ? $arParams['GIFTS_SLIDER_PROGRESS'] : '',
		'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

		'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
		'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
		'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
	);
}

\CJSCore::Init(array('fx', 'popup', 'ajax'));
Main\UI\Extension::load(['ui.mustache']);

//$this->addExternalJs($templateFolder.'/js/action-pool.js');
//$this->addExternalJs($templateFolder.'/js/filter.js');
//$this->addExternalJs($templateFolder.'/js/component.js');

$mobileColumns = isset($arParams['COLUMNS_LIST_MOBILE'])
	? $arParams['COLUMNS_LIST_MOBILE']
	: $arParams['COLUMNS_LIST'];
$mobileColumns = array_fill_keys($mobileColumns, true);

$jsTemplates = new Main\IO\Directory($documentRoot.$templateFolder.'/js-templates');
/** @var Main\IO\File $jsTemplate */
foreach ($jsTemplates->getChildren() as $jsTemplate)
{
	include($jsTemplate->getPath());
}

$items = $arResult['ITEMS']['AnDelCanBuy'];
$total = $arResult['TOTAL_RENDER_DATA'];
$minBasketSumm = \COption::GetOptionString( "askaron.settings", "UF_MIN_BASKET_SUMM");
$missingSumm = $minBasketSumm - $arResult['allSum'];
$pathToOrder = htmlspecialcharsbx($arParams['PATH_TO_ORDER']);
//pre($arResult['BASKET_ITEMS_COUNT']);
if (empty($arResult['ERROR_MESSAGE']))
{
    ?>
    <div class="container white">
        <span class="order_qty_main desc"><?=cartProductsText($arResult['BASKET_ITEMS_COUNT'])?> <?=$arResult['BASKET_ITEMS_COUNT']?></span>
        <div class="cart_block">
            <div class="order-info mob">
                <div class="order-icon">
                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/cart_ic.svg" alt="">
                </div>
                <div class="order-details">
                    <p class="order-title">Заказ от <?=$minBasketSumm?> ₽</p>
                    <p class="order-text"> Для оформления заказа <br> добавьте товаров ещё на <span class="order-missing"><?=$missingSumm?> ₽</span>
                    </p>
                </div>
                <div class="order-progress">
                    <div class="order-bar"></div>
                </div>
            </div>
            <div class="cart-items">
                <span class="order_qty_main mob"><?=cartProductsText($arResult['BASKET_ITEMS_COUNT'])?></span>
                <?foreach ($items as $item){
                    //$img = '';
                    if (!empty($item['PREVIEW_PICTURE_SRC'])){
                        $img = $item['PREVIEW_PICTURE_SRC'];
                    } elseif (!empty($item['DETAIL_PICTURE_SRC'])){
                        $img = $item['DETAIL_PICTURE_SRC'];
                    } else {
                        $img = NO_IMAGE;
                    }
                    ?>
                <div class="cart-item" data-old-price="<?=$item['FULL_PRICE']?>" data-price="<?=$item['PRICE']?>" data-item-id="<?=$item['PRODUCT_ID']?>" data-id="<?=$item['ID']?>">
                    <div class="cart_item_img">
                        <img src="<?=$img?>" alt="">
                        <?if (!empty($item['PROPERTY_ARTNUMBER_VALUE'])){?>
                            <span class="artikul_z mob">арт. <?=$item['PROPERTY_ARTNUMBER_VALUE']?></span>
                        <?}?>
                    </div>
                    <div class="cart_item_content">
                        <div class="item-info">
                            <div class="item_info_left">
                                <?if (!empty($item['PROPERTY_ARTNUMBER_VALUE'])){?>
                                    <span class="artikul_z desc">арт. <?=$item['PROPERTY_ARTNUMBER_VALUE']?></span>
                                <?}?>
                                <p><?=$item['NAME']?></p>
                            </div>
                            <p class="price"><?=$item['PRICE_FORMATED']?> <span class="old-price"><?=$item['FULL_PRICE_FORMATED']?></span>
                            </p>
                        </div>
                        <div class="cart_item_bottom">
                            <div class="quantity">
                                <button class="decrease">-</button>
                                <span class="count"><?=$item['QUANTITY']?></span>
                                <button class="increase">+</button>
                            </div>
                            <button class="remove">Удалить</button>
                        </div>
                    </div>
                </div>
                <?}?>
            </div>
            <div class="cart_right">
                <div class="order-info desc">
                    <div class="order-icon">
                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/cart_ic.svg" alt="">
                    </div>
                    <div class="order-details">
                        <p class="order-title">Заказ от 5 000 ₽</p>
                        <p class="order-text"> Для оформления заказа <br> добавьте товаров ещё на <span class="order-missing">1 650 ₽</span>
                        </p>
                    </div>
                    <div class="order-progress">
                        <div class="order-bar"></div>
                    </div>
                </div>
                <div class="cart-summary">
                    <div class="cart_summary_left">
                        <p class="summary-title">ИТОГО</p>
                        <p class="summary-items">
                            <span class="items-count"><?=$arResult['BASKET_ITEMS_COUNT']?> товара</span>
                            <?if ($arResult['allVATSum'] > 0){?>
                            <span class="tax">НДС: <?=$arResult['allVATSum_FORMATED']?></span>
                            <?}?>
                        </p>
                    </div>
                    <p class="summary-price">
                        <span class="old-price"><?=$arResult['PRICE_WITHOUT_DISCOUNT']?></span>
                        <span class="total-price"><?=$arResult['allSum_FORMATED']?></span>
                    </p>
                    <button onclick="window.location.href='<?=$pathToOrder?>'" class="checkout disabled">Получить КП</button>
                    
                </div>
            </div>
        </div>
        <div class="recomended-products smilar-products cart_recom">
            <h2>Вы недавно смотрели</h2>
            <div class="swiper recomended-products__wrapper">
                <div class="swiper-wrapper">
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
	<?
	if (!empty($arResult['CURRENCIES']) && Main\Loader::includeModule('currency'))
	{
		CJSCore::Init('currency');

		?>
		<script>
			BX.Currency.setCurrencies(<?=CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true)?>);
		</script>
		<?
	}

	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedTemplate = $signer->sign($templateName, 'sale.basket.basket');
	$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.basket.basket');
	$messages = Loc::loadLanguageFile(__FILE__);
	?>
	<script>
		BX.message(<?=CUtil::PhpToJSObject($messages)?>);
		BX.Sale.BasketComponent.init({
			result: <?=CUtil::PhpToJSObject($arResult, false, false, true)?>,
			params: <?=CUtil::PhpToJSObject($arParams)?>,
			template: '<?=CUtil::JSEscape($signedTemplate)?>',
			signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
			siteId: '<?=CUtil::JSEscape($component->getSiteId())?>',
			siteTemplateId: '<?=CUtil::JSEscape($component->getSiteTemplateId())?>',
			templateFolder: '<?=CUtil::JSEscape($templateFolder)?>'
		});
	</script>
<?
}
elseif ($arResult['EMPTY_BASKET'])
{
	include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}
else
{
	ShowError($arResult['ERROR_MESSAGE']);
}