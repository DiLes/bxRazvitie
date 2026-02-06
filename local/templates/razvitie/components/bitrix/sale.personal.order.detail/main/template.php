<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

/** @global CMain $APPLICATION */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $templateFolder */

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
//$APPLICATION->SetTitle("");

if (!empty($arResult['ERRORS']['FATAL']))
{
	$component = $this->__component;
	foreach($arResult['ERRORS']['FATAL'] as $code => $error)
	{
		if ($code !== $component::E_NOT_AUTHORIZED)
			ShowError($error);
	}

	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		?>
		<div class="row">
			<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
				<div class="alert alert-danger"><?=$arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]?></div>
			</div>
			<?php
			$authListGetParams = array();
			?>
			<div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
				<?php
				$APPLICATION->AuthForm('', false, false, 'N', false);
				?>
			</div>
		</div>
		<?php
	}
}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach ($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
    $basketCnt = count($arResult["BASKET"]);
    $status = null;
    $statusClass = null;
    if ($arResult["STATUS"]["ID"] == "N") {
        $status = "В процессе";
        $statusClass = " in_progress";
    }elseif ($arResult["STATUS"]["ID"] == "CN") {
        $status = "Отменен";
        $statusClass = " canceled";
    }elseif ($arResult["STATUS"]["ID"] == "F") {
        $status = "Доставлен";
        $statusClass = " delivered";
    }

    $paymentData = [];
    foreach ($arResult['PAYMENT'] as $payment) {
        $paymentData[$payment['ACCOUNT_NUMBER']] = array(
            "payment" => $payment['ACCOUNT_NUMBER'],
            "order" => $arResult['ACCOUNT_NUMBER'],
            "allow_inner" => $arParams['ALLOW_INNER'],
            "only_inner_full" => $arParams['ONLY_INNER_FULL'],
            "refresh_prices" => $arParams['REFRESH_PRICES'],
            "path_to_payment" => $arParams['PATH_TO_PAYMENT']
        );
    }
    $title = "Заказ #" . $arResult["ID"] . " <span>от " . $arResult["DATE_INSERT_FORMATED"] . "</span>";
    $APPLICATION->SetTitle($title);
	?>
        <div class="container order_cont">
            <div class="cart_z_top_actions">
                <h1 class="order_title_main">Заказ #<?=$arResult["ID"]?> <span>от <?=$arResult["DATE_INSERT_FORMATED"]?></span></h1>
                <div class="cart_z_btns">
                    <a href="<?=$arResult["URL_TO_COPY"]?>" class="repeat_order_btn">Повторить заказ
                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/repeator_ic.svg" alt="">
                    </a>
                    <button class="status_btn<?=$statusClass?>"><?=$status?></button>
                </div>
            </div>
        </div>
        <div class="container white">
            <span class="order_qty_main_detail"><?=$basketCnt.numWord($basketCnt, [" товар", " товара", " товаров"]);?></span>
            <div class="order_block">
                <div class="order_items">
                    <?foreach ($arResult["BASKET"] as $basketItem){
                        if (!empty($basketItem["PICTURE"]["SRC"])){
                            $img = $basketItem["PICTURE"]["SRC"];
                        }else{
                            $img = NO_IMAGE;
                        }
                        ?>
                        <div class="order_item_box">
                            <img src="<?=$img?>" alt="<?=$basketItem["NAME"]?>" data-id="<?=$basketItem["PRODUCT_ID"]?>">
                            <div class="order_item_box_details">
                                <div class="order_item_box_details_left">
                                    <?if (!empty($basketItem["PROPERTIES"]["ARTNUMBER"])){?>
                                        <span class="order_art">арт. <?=$basketItem["PROPERTIES"]["ARTNUMBER"]?></span>
                                    <?}?>
                                    <h3 class="order_title"><?=$basketItem["NAME"]?></h3>
                                </div>
                                <div class="order_item_box_details_right">
                                    <p class="order_price"><?=$basketItem["FORMATED_SUM"]?>
                                        <span class="order_old_price"><?=$basketItem["FORMATED_BASE_SUM"]?></span>
                                    </p>
                                    <span class="order_quantity"><?=$basketItem["QUANTITY"]?> <?=$basketItem["MEASURE_TEXT"]?></span>
                                </div>
                            </div>
                        </div>
                    <?}?>
                </div>
                <div class="order_summary">
                    <div class="summary_total">
                        <div class="summary_total_top">
                            <span class="total_sp">ИТОГО</span>
                            <p>
                                <span><?=$basketCnt.numWord($basketCnt, [" товар", " товара", " товаров"]);?></span>
                                <b><?=$arResult["PRODUCT_SUM_FORMATED"]?></b>
                            </p>
                            <p>
                                <span>Доставка</span>
                                <b><?=$arResult["PRICE_DELIVERY_FORMATED"]?></b>
                            </p>
                        </div>
                        <div class="summary_total_bottom">
                            <span>Всего</span>
                            <div class="total_price"><?=$arResult["SUM_REST_FORMATED"]?></div>
                        </div>
                    </div>
                    <div class="payment_details">
                        <div class="payment_details_item">
                            <span class="title_sp">ОПЛАТА</span>
                            <h4><?=$arResult["PAY_SYSTEM"]["NAME"]?></h4>
                            <p>Счет №19-10-4J71 от 25.11.2023</p>
                        </div>
                        <div class="payment_details_item">
                            <span class="title_sp">ДОСТАВКА</span>

                            <h4>
                                <?=$arResult["DELIVERY"]["NAME"]?>

                                <span class="delivery_date sp_btn"><?=$arResult["DATE_INSERT_FORMATED"]?></span>
                                <span class="delivery_price sp_btn"><?=$arResult["PRICE_DELIVERY_FORMATED"]?></span></h4>
                            <p>Отгрузка №19-10-4J7/2</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>




	<?php
	$javascriptParams = array(
		"url" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
		"templateFolder" => CUtil::JSEscape($templateFolder),
		"templateName" => $this->__component->GetTemplateName(),
		"paymentList" => $paymentData,
		"returnUrl" => $arResult['RETURN_URL'],
	);
	$javascriptParams = CUtil::PhpToJSObject($javascriptParams);
	?>
	<script>
		BX.Sale.PersonalOrderComponent.PersonalOrderDetail.init(<?=$javascriptParams?>);
	</script>
<?php
}
