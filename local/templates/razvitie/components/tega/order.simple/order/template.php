<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Security\Sign\Signer;

if ($arResult["ORDER_SUCCESSFULLY_CREATED"] == "Y") {
    echo GetMessage("ORDER_SUCCESSFULLY_CREATED");
    return;
}
$signer = new Signer;
$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.order.ajax');
$context = Main\Application::getInstance()->getContext();
$basketCount = count($arResult["BASKET"]);

$lastDeliveryId = isset($_COOKIE['last_delivery_id']) ? (int)$_COOKIE['last_delivery_id'] : 0;

// Если нашли сохранённый — отмечаем его как CHECKED
if ($lastDeliveryId > 0) {
    foreach ($arResult["DELIVERY"] as &$delivery) {
        $delivery["CHECKED"] = ($delivery["ID"] == $lastDeliveryId) ? "Y" : "N";
    }
    unset($delivery);
}
//pre($arResult);
//pre($arResult["PRICES"]);
//pre($arResult["BASKET"]);
//pre($arResult["DELIVERY"]);
//pre($arResult["PAY_SYSTEM"]);
//pre($arResult["ORDER_PROPS"]);
//pre($arResult["USER"]);
//pre($arResult["USER_CONSENT_FIELDS"]);
//pre($arResult["CURRENT_VALUES"]);
//pre($arParams["FORM_NAME"]);

?>

<script type="text/javascript">
    function submitForm(val) {
        BX('<? echo $arParams["ENABLE_VALIDATION_INPUT_ID"]; ?>').value = (val !== 'Y') ? "N" : "Y";
        var orderForm = BX('<? echo $arParams["FORM_ID"]; ?>');
        BX.submit(orderForm);
        return true;
    }
</script>

<div class="cart_z placing_order_section">
    <!--<div class="container">
        <div class="page-head">
            <div class="cart_z_top_actions">
                <h1 class="section_title">Оформление заказа</h1>
                <div class="cart_z_btns">
                    <button class="clear_list">Очистить список</button>
                </div>
            </div>
        </div>
    </div>-->
    <div class="container white">
        <form class="checkout-container"
              id="checkout-form"
              name="<? echo $arParams["FORM_NAME"]; ?>"
              action="<? echo $arParams["FORM_ACTION"]; ?>">

            <?= bitrix_sessid_post() ?>
            <input type="hidden" name="<? echo $arParams["ENABLE_VALIDATION_INPUT_NAME"]; ?>" id="<? echo $arParams["ENABLE_VALIDATION_INPUT_ID"]; ?>" value="Y">
            <input type="hidden" name="signedParamsString" value="<?= htmlspecialcharsbx($signedParams) ?>">
            <input type="hidden" name="sessid" value="<?= bitrix_sessid() ?>">
            <input type="hidden" name="SITE_ID" value="<?= SITE_ID ?>">
            <div class="checkout_form_left">
                <!-- Yetkazib berish usuli -->
                <div class="delivery-methods">
                    <h3>Способ получения</h3>
                    <div class="delivery_options_box">
                        <div class="delivery-options">
                            <?foreach ($arResult["DELIVERY"] as $delivery){
//                                pre($delivery);
                                ?>
                            <label class="delivery-option">
                                <input type="radio"
                                       <?= ($delivery["CHECKED"]) ? ('checked') : (''); ?>
                                       id="pay_system_<?= $delivery["ID"] ?>"
                                       name="delivery"
                                       value="<?= $delivery["ID"] ?>"
                                       autocomplete="off"
                                       type="radio"
                                       data-delivery-id="<?= $delivery["ID"] ?>"
                                />
                                <img class="information_circle_ic" src="<?= SITE_TEMPLATE_PATH ?>/src/assets/svgicons/information_circle.svg" alt="<?=$delivery["NAME"]?>">
                                <div class="option-content">
                                    <span><?=$delivery["NAME"]?></span>
                                    <small>От <?=$delivery["CONFIG"]["MAIN"]["PRICE"]?> ₽</small>
                                </div>
                                <div class="tooltip">
                                    <?=$delivery["DESCRIPTION"]?>
                                </div>
                            </label>
                            <?}?>
                        </div>
                    </div>
                </div>

                <!-- Xaridor ma’lumotlari -->
                <div class="customer-details">
                    <h2>Данные покупателя</h2>
                    <div class="form_inputs">

                        <? foreach ($arResult["ORDER_PROPS"] as $props){?>
                            <? if ($props["CODE"] == "COMPANY"){ ?>
                                <div class="input-group">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?> autocomplete="">
                                </div>
                            <? } ?>

                            <? if ($props["CODE"] == "INN"){ ?>
                                <div class="input-group">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>

                            <? if ($props["CODE"] == "CONTACT_PERSON_NAME"){ ?>
                                <div class="input-group">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>

                            <? if ($props["CODE"] == "CONTACT_PERSON_LASTNAME"){ ?>
                                <div class="input-group">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>

                            <? if ($props["CODE"] == "PHONE"){ ?>
                                <div class="input-group">
                                    <input type="tel" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>

                            <? if ($props["CODE"] == "EMAIL"){ ?>
                                <div class="input-group">
                                    <input type="email" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>
                        <?}?>

                        <h4>Юридический адрес</h4>
                        <? foreach ($arResult["ORDER_PROPS"] as $props){ ?>
                            <? if ($props["CODE"] == "LEGAL_ADR_REGION"){ ?>
                                <div class="input-group">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>

                            <? if ($props["CODE"] == "LEGAL_ADR_STREET"){ ?>
                                <div class="input-group">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>

                            <? if ($props["CODE"] == "LEGAL_ADR_DOM"){ ?>
                                <div class="input-group w_3">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>

                            <? if ($props["CODE"] == "LEGAL_ADR_KV"){ ?>
                                <div class="input-group w_3">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>

                            <? if ($props["CODE"] == "LEGAL_ADR_ZIP"){ ?>
                                <div class="input-group w_3 w_mob_100">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>
                        <?}?>

                        <h4>Фактический адрес</h4>
                        <? foreach ($arResult["ORDER_PROPS"] as $props){ ?>
                            <? if ($props["CODE"] == "ACTUAL_ADR_REGION"){ ?>
                                <div class="input-group">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>

                            <? if ($props["CODE"] == "ACTUAL_ADR_STREET"){ ?>
                                <div class="input-group">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>

                            <? if ($props["CODE"] == "ACTUAL_ADR_DOM"){ ?>
                                <div class="input-group w_3">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>

                            <? if ($props["CODE"] == "ACTUAL_ADR_KV"){ ?>
                                <div class="input-group w_3">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>

                            <? if ($props["CODE"] == "ACTUAL_ADR_ZIP"){ ?>
                                <div class="input-group w_3 w_mob_100">
                                    <input type="text" id="soa-property-<?=$props["ID"]?>" name="<?=$props["CODE"]?>" placeholder="<?=$props["NAME"]?>" <?=($props["REQUIRED"] ? 'required' : '')?>>
                                </div>
                            <? } ?>
                        <?}?>

                    </div>
                </div>


                <!-- Xarid qilish ro‘yxati -->
                <div class="order-summary">
                    <h2>Товары в заказе</h2>
                    <ul class="order-list">
                        <?foreach ($arResult["BASKET"] as $item){
                            if (!empty($item['PREVIEW_PICTURE'])) {
                                $img = $item['PREVIEW_PICTURE'];
                            } elseif (!empty($item['DETAIL_PICTURE'])) {
                                $img = $item['DETAIL_PICTURE'];
                            } else {
                                $img = NO_IMAGE;
                            }
//                            pre($item);
                            ?>
                        <li data-item="<?=$item["PRODUCT_ID"]?>">
                            <img src="<?=$img?>" alt="<?=$item["NAME"]?>">
                            <div class="order_list_right">
                                <p><?=$item["NAME"]?></p>
                                <div class="order_price_sp">
                                    <?=$item["PRICE"]?> ₽
                                    <span><?=intval($item["QUANTITY"])?> <?=$item["MEASURE_NAME"]?></span>
                                </div>
                            </div>
                        </li>
                        <?}?>
                    </ul>
                    <div class="order_summary_bottom">
                        <label class="toggle-differences">
                            <input type="checkbox" id="toggleDifferences" name="checkbox" checked>
                            <p>
                                Я согласен на <br> <a href="#">обработку персональных данных</a>
                            </p>
                        </label>
                        <button class="btn_z checkout-btn" onclick="submitForm('Y'); return false;">Получить КП</button>
                    </div>
                </div>
            </div>

            <div class="checkout_form_right">
                <!-- Narx va tugma -->
                <div class="checkout-summary">
                    <div class="total_sp">Итого</div>
                    <p><?= cartProductsText($basketCount) ?> <span class="items_summ" data-products-price="<?=$arResult["PRICES"]["PRODUCTS_PRICE"]?>"><?=$arResult["PRICES"]["PRODUCTS_PRICE_FORMATTED"]?></span></p>
                    <p>Доставка <span class="deivery_summ" data-delivery-price="<?=$arResult["PRICES"]["DELIVERY_PRICE"]?>"><?=$arResult["PRICES"]["DELIVERY_PRICE_FORMATTED"]?></span></p>
                    <div class="total_sum">Всего: <span data-total-price="<?=$arResult["PRICES"]["TOTAL_PRICE"]?>"><?=$arResult["PRICES"]["TOTAL_PRICE_FORMATTED"]?>                        </span>
                    </div>
                    <button class="checkout-btn btn_z" onclick="submitForm('Y'); return false;">Получить КП</button>
                </div>
            </div>
        </form>
    </div>
</div>