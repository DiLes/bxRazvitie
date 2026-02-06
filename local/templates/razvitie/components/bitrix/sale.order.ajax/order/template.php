<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Security\Sign\Signer;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var SaleOrderAjax $component
 * @var string $templateFolder
 */

$signer = new Signer;
$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.order.ajax');
$context = Main\Application::getInstance()->getContext();
$request = $context->getRequest();
$scheme = $request->isHttps() ? 'https' : 'http';

switch (LANGUAGE_ID)
{
	case 'ru':
		$locale = 'ru-RU'; break;
	case 'ua':
		$locale = 'ru-UA'; break;
	case 'tk':
		$locale = 'tr-TR'; break;
	default:
		$locale = 'en-US'; break;
}

if ((string)$request->get('ORDER_ID') !== '')
{
    include(Main\Application::getDocumentRoot() . $templateFolder . '/confirm.php');
}
elseif ($arParams['DISABLE_BASKET_REDIRECT'] === 'Y' && $arResult['SHOW_EMPTY_BASKET'])
{
    include(Main\Application::getDocumentRoot() . $templateFolder . '/empty.php');
}
else {

//\Bitrix\Main\UI\Extension::load('ui.fonts.opensans');
//$this->addExternalJs($templateFolder.'/order_ajax.js');
//\Bitrix\Sale\PropertyValueCollection::initJs();
//$this->addExternalJs($templateFolder.'/script.js');

//pre($arResult["JS_DATA"]["TOTAL"]);
//pre($arResult["GRID"]);
//pre($arResult["DELIVERY"]);
//pre($arResult);

    ?>
    <div class="cart_z placing_order_section">
        <div class="container">
            <div class="page-head">
                <div class="cart_z_top_actions">
                    <h1 class="section_title">Оформление заказа</h1>
                    <div class="cart_z_btns">
                        <button class="clear_list">Очистить список</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container white">
            <form class="checkout-container" id="checkout-form" data-form-type="checkout"
                  data-action="/ajax/form_handler.php">
                <div class="checkout_form_left">
                    <!-- Yetkazib berish usuli -->
                    <div class="delivery-methods">
                        <h3>Способ получения</h3>
                        <div class="delivery_options_box">
                            <div class="delivery-options">
                                <?
                                foreach ($arResult["DELIVERY"] as $i => $delivery) {
                                    //pre($delivery);
                                    ?>
                                    <label class="delivery-option <?= ($delivery["CHECKED"]) ? ('selected') : (''); ?>"
                                           data-delivery-price="<?= $delivery["PRICE"] ?>">
                                        <input type="radio"
                                               name="delivery" <?= ($delivery["CHECKED"]) ? ('checked') : (''); ?>
                                               data-delivery-id="<?= $delivery["ID"] ?>">
                                        <img class="information_circle_ic"
                                             src="<?= SITE_TEMPLATE_PATH ?>/src/assets/svgicons/information_circle.svg"
                                             alt="">
                                        <div class="option-content">
                                            <span><?= $delivery["NAME"] ?></span>
                                            <small>От <?= $delivery["PRICE_FORMATED"] ?></small>
                                        </div>
                                        <div class="tooltip">
                                            <?= $delivery["DESCRIPTION"] ?>
                                        </div>
                                    </label>
                                <?
                                } ?>
                            </div>
                        </div>
                    </div>

                    <!-- Xaridor ma’lumotlari -->
                    <div class="customer-details">
                        <h2>Данные покупателя</h2>
                        <div class="form_inputs">
                            <div class="input-group">
                                <input type="text" name="COMPANY" placeholder="Юридическое наименование организации">
                            </div>
                            <div class="input-group">
                                <input type="text" name="INN" placeholder="ИНН организации">
                            </div>
                            <div class="input-group">
                                <input type="text" name="NAME" placeholder="Имя">
                            </div>
                            <div class="input-group">
                                <input type="text" placeholder="Фамилия">
                            </div>
                            <div class="input-group">
                                <input type="tel" name="PHONE" placeholder="Телефон">
                            </div>
                            <div class="input-group">
                                <input type="email" name="EMAIL" placeholder="E-mail">
                            </div>

                            <h4>Юридический адрес</h4>
                            <div class="input-group">
                                <input type="text" placeholder="Область, район, город">
                            </div>
                            <div class="input-group">
                                <input type="text" placeholder="Улица">
                            </div>
                            <div class="input-group w_3">
                                <input type="text" placeholder="Дом">
                            </div>
                            <div class="input-group w_3">
                                <input type="text" placeholder="Офис / квартира">
                            </div>
                            <div class="input-group w_3 w_mob_100">
                                <input type="text" placeholder="Индекс">
                            </div>

                            <h4>Фактический адрес</h4>
                            <div class="input-group">
                                <input type="text" placeholder="Область, район, город">
                            </div>
                            <div class="input-group">
                                <input type="text" placeholder="Улица">
                            </div>
                            <div class="input-group w_3">
                                <input type="text" placeholder="Дом">
                            </div>
                            <div class="input-group w_3">
                                <input type="text" placeholder="Офис / квартира">
                            </div>
                            <div class="input-group w_3 w_mob_100">
                                <input type="text" placeholder="Индекс">
                            </div>
                        </div>
                    </div>

                    <!-- Xarid qilish ro‘yxati -->
                    <div class="order-summary">
                        <h2>Товары в заказе</h2>
                        <ul class="order-list">
                            <?
                            foreach ($arResult["BASKET_ITEMS"] as $item) {
                                if (!empty($item['PREVIEW_PICTURE_SRC'])) {
                                    $img = $item['PREVIEW_PICTURE_SRC'];
                                } elseif (!empty($item['DETAIL_PICTURE_SRC'])) {
                                    $img = $item['DETAIL_PICTURE_SRC'];
                                } else {
                                    $img = NO_IMAGE;
                                }
                                //pre($item);
                                ?>
                                <li>
                                    <img src="<?= $img ?>" alt="<?= $item["NAME"] ?>">
                                    <div class="order_list_right">
                                        <p><?= $item["NAME"] ?></p>
                                        <div class="order_price_sp"><?= $item["PRICE_FORMATED"] ?>
                                            <span><?= $item["QUANTITY"] ?> <?= $item["MEASURE_NAME"] ?></span>
                                        </div>
                                    </div>
                                </li>
                            <?
                            } ?>
                        </ul>
                        <div class="order_summary_bottom">
                            <label class="toggle-differences">
                                <input type="checkbox" id="toggleDifferences" name="checkbox">
                                <p>
                                    Я согласен на <br> <a href="#">обработку персональных данных</a>
                                </p>
                            </label>
                            <button class="btn_z checkout-btn">Получить КП</button>
                        </div>
                    </div>
                </div>

                <div class="checkout_form_right">
                    <!-- Narx va tugma -->
                    <div class="checkout-summary">
                        <div class="total_sp">Итого</div>
                        <p><?= cartProductsText($arResult["BASKET_POSITIONS"]) ?><span class="items_summ"
                                                                                       data-items-summ="<?= $arResult["ORDER_PRICE"] ?>"><?= $arResult["ORDER_PRICE_FORMATED"] ?></span>
                        </p>
                        <p>Доставка <span class="deivery_summ"
                                          data-delivery-summ="<?= $arResult["DELIVERY_PRICE"] ?>"><?= $arResult["DELIVERY_PRICE_FORMATED"] ?></span>
                        </p>
                        <div class="total_sum">Всего: <span data-total-summ="<?= $arResult["ORDER_TOTAL_PRICE"]?>"><?= $arResult["ORDER_TOTAL_PRICE_FORMATED"] ?></span></div>
                        <button class="checkout-btn btn_z">Получить КП</button>
                    </div>
                </div>
                <input type="hidden" name="signedParamsString" value="<?= htmlspecialcharsbx($signedParams) ?>">
                <input type="hidden" name="sessid" value="<?= bitrix_sessid() ?>">
                <input type="hidden" name="SITE_ID" value="<?= SITE_ID ?>">
            </form>
        </div>
    </div>
<?}

?>

