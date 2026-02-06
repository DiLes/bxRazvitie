<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

/** @var CBitrixPersonalOrderListComponent $component */
/** @var array $arParams */
/** @var array $arResult */

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/script.js");
Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/style.css");
CJSCore::Init(array('clipboard', 'fx'));

Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $code => $error)
	{
		if ($code !== $component::E_NOT_AUTHORIZED)
			ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		?>
		<div class="row">
			<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
				<div class="alert alert-danger"><?=$arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]?></div>
			</div>
			<? $authListGetParams = array(); ?>
			<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
				<?$APPLICATION->AuthForm('', false, false, 'N', false);?>
			</div>
		</div>
		<?
	}

}
else
{
	$filterHistory = ($_REQUEST['filter_history'] ?? '');
	$filterShowCanceled = ($_REQUEST["show_canceled"] ?? '');

	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	if (empty($arResult['ORDERS']))
	{
		if ($filterHistory === 'Y')
		{
			if ($filterShowCanceled === 'Y')
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?></h3>
				<?
			}
			else
			{
				?>
				<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?></h3>
				<?
			}
		}
		else
		{
			?>
			<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></h3>
			<?
		}
	}
//pre($arResult["NAV_STRING"]);
    /**
     * round
     * visual
     */
	?>

    <?foreach ($arResult["ORDERS"] as $key => $order){
        $deliveryPrice = number_format($order["ORDER"]["PRICE_DELIVERY"], 0, '', ' ');
        $status = null;
        $statusClass = null;
        if ($order["ORDER"]["STATUS_ID"] == "N") {
            $status = "В процессе";
            $statusClass = " in_progress";
        }elseif ($order["ORDER"]["STATUS_ID"] == "CN") {
            $status = "Отменен";
            $statusClass = " canceled";
        }elseif ($order["ORDER"]["STATUS_ID"] == "F") {
            $status = "Доставлен";
            $statusClass = " delivered";
        }
        $payment = $arResult["INFO"]["PAY_SYSTEM"][$order["ORDER"]["PAY_SYSTEM_ID"]];
        $delivery = $arResult["INFO"]["DELIVERY"][$order["ORDER"]["DELIVERY_ID"]];
        $basketCnt = count($order["BASKET_ITEMS"]);
        $basketTotalSumm = null;
        foreach ($order["BASKET_ITEMS"] as $item){
            $basketTotalSumm += $item["PRICE"] * $item["QUANTITY"];
        }
        $basketTotalSumm = number_format($basketTotalSumm, 2, '.', ' ');
        ?>
        <div class="lk_order_item">
            <div class="lk_order_header">
                <div class="lk_order_header_left">
                    <div class="status<?=$statusClass?>"><?=$status?></div>
                    <p class="order_number">Заказ #<?=$order["ORDER"]["ID"]?> <span class="order_date">от <?=$order["ORDER"]["DATE_INSERT_FORMATED"]?></span></p>
                </div>
                <span class="order_total"><?=$order["ORDER"]["FORMATED_PRICE"]?></span>
            </div>
            <div class="lk_order_body">
                <div class="order_payment">
                    <h4>ОПЛАТА</h4>
                    <p><?=$payment["NAME"]?></p>
                    <span class="tender_info">Тендер №124912015  от 25.11.2023</span>
                </div>
                <div class="order_delivery order_payment">
                    <h4>ДОСТАВКА</h4>
                    <p><span class="delivey_name"><?=$delivery["NAME"]?></span> <!--<span class="delivery_date">15.11.2024</span>--> <span class="delivery_cost"><?=$deliveryPrice?> ₽</span></p>
                    <span class="track_code">Трек код 011-15015-</span>
                </div>
                <div class="order_items">
                    <div class="order_items_top">
                        <h4><?echo $basketCnt . numWord($basketCnt, [" товар", " товара", " товаров"]);?></h4>
                        <span class="total_price_mini_sp"><?=$basketTotalSumm?> ₽</span>
                    </div>
                    <div class="order_images">
                        <?foreach ($order["BASKET_ITEMS"] as $item){
                            ?>
                            <img src="<?=$item["PICTURE"]?>" alt="<?=$item["NAME"]?>" data-id="<?=$item["PRODUCT_ID"]?>">
                        <?}?>
                    </div>
                </div>
            </div>
            <div class="lk_order_footer">
                <a href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_DETAIL"])?>" class="order_details_btn">Подробнее о заказе
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M9 6L15 12L9 18" stroke="#056BE9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <a href="<?=htmlspecialcharsbx($order["ORDER"]["URL_TO_CANCEL"])?>" class="order_cancel">Отменить заказ</a>
            </div>
        </div>
    <?}?>
    <?=$arResult["NAV_STRING"];?>
	<?
	if ($filterHistory !== 'Y')
	{
		$javascriptParams = array(
			"url" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
			"templateFolder" => CUtil::JSEscape($templateFolder),
			"templateName" => $this->__component->GetTemplateName(),
			"paymentList" => $paymentChangeData,
			"returnUrl" => CUtil::JSEscape($arResult["RETURN_URL"]),
		);
		$javascriptParams = CUtil::PhpToJSObject($javascriptParams);
		?>
		<script>
			BX.Sale.PersonalOrderComponent.PersonalOrderList.init(<?=$javascriptParams?>);
		</script>
		<?
	}
}
