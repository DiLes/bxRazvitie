<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Спасибо за заказ!");

$orderId = intval($_GET["ORDER_ID"]);
?>

<div class="container white">
    <div class="call_back_info_block">
        <div class="call_back_info_ic">
            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/like.svg" alt="">
        </div>
        <h4 class="call_back_info_title">Мы приняли <br> вашу заявку</h4>
        <?if ($orderId > 0):?>
            <div class="call_back_info_subtitle">Номер заказа №<?=$orderId?></div>
        <?endif;?>

        <p class="call_back_info_text">
            Мы приняли ваш заказ в работу, в ближайшее <br> время с вами свяжется менеджер
        </p>
        <a href="/catalog/" class="call_back_info_btn">В каталог</a>
        <a href="/personal/" class="call_back_info_btn">Личный кабинет</a>
    </div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
