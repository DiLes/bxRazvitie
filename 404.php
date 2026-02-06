<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
const HIDE_SIDEBAR = true;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/** @global CMain $APPLICATION */

$APPLICATION->SetTitle("Страница не найдена");?>
<style>
    .page-head h1 {
        display: none;
    }
</style>
<main>
    <div class="container">
        <div class="not_found_title">
            Страница <br> не найдена
        </div>
        <div class="not_found_subtitle">Неправильно набран адрес или <br> такой страницы не существует</div>
        <a href="<?=SITE_DIR?>" class="btn_z">На главную</a>
        <div class="big_404">404</div>
    </div>
</main>
<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
