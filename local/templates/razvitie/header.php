<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;
use Bitrix\Sale;
use Bitrix\Sale\Location;
Loc::loadMessages(__FILE__);
global $APPLICATION, $USER;

$curPage = $APPLICATION->GetCurPage(false);

$basketCount = 0;
if (Loader::includeModule("sale")) {
    $basket = Sale\Basket::loadItemsForFUser(
        Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite()
    );
    $basketCount = count($basket);
}


$res = Location\LocationTable::getList([
    'filter' => [
        '=NAME.LANGUAGE_ID' => LANGUAGE_ID,
        '=TYPE.CODE' => 'CITY'
    ],
    'select' => ['ID', 'CODE', 'NAME_RU' => 'NAME.NAME']
]);

$cities = [];
while ($item = $res->fetch()) {
    $letter = mb_strtoupper(mb_substr($item['NAME_RU'], 0, 1));
    $cities[$letter][] = $item['NAME_RU'];
}
ksort($cities);
$currentCity = "Москва"; // значение по умолчанию
$arUser = null;
if ($USER->IsAuthorized()) {
    $rsUser = CUser::GetByID($USER->GetID());
    if ($arUser = $rsUser->Fetch()) {
        if (!empty($arUser["WORK_CITY"])) {
            $currentCity = $arUser["WORK_CITY"];
        }
    }
} elseif (!empty($_COOKIE["USER_CITY"])) {
    $currentCity = htmlspecialchars($_COOKIE["USER_CITY"]);
}

$favCount = 0;
$favs = $arUser["UF_FAVORITES"] ?? [];
if (is_string($favs)) {
    $decoded = json_decode($favs, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        $favs = $decoded;
    }
}
if (is_array($favs)) {
    $favCount = count($favs);
}

$compareCount = 0;
$IBLOCK_ID = 2;
if (isset($_SESSION["CATALOG_COMPARE_LIST"][$IBLOCK_ID]["ITEMS"])){
    $compareCount = count($_SESSION["CATALOG_COMPARE_LIST"][$IBLOCK_ID]["ITEMS"]);
}
$minBasketSumm = \COption::GetOptionString( "askaron.settings", "UF_MIN_BASKET_SUMM");
?>

<!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
    <meta charset="UTF-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="<?=SITE_TEMPLATE_PATH?>/src/assets/favicon.svg" type="image/x-icon" />
    <?
    //Asset::getInstance()->addString('<link rel="shortcut icon" href="'.SITE_TEMPLATE_PATH.'/src/assets/favicon.svg" type="image/x-icon" />');

    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/main.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/custom.css");
    Asset::getInstance()->addCss("https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css");
    Asset::getInstance()->addCss("https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css");
    Asset::getInstance()->addCss("https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css");

    Asset::getInstance()->addJs("https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js");
    Asset::getInstance()->addJs("https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js");
    //    Asset::getInstance()->addJs("https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js");
    Asset::getInstance()->addJs("https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js");

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/custom.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/form.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/modals.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/order.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/compare.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/favorites.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/auth.js");

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/main.js");


    ?>
    <title><?$APPLICATION->ShowTitle()?></title>
    <? $APPLICATION->ShowHead(); ?>
</head>

<body data-user-auth="<?= $USER->IsAuthorized() ? 'Y' : 'N' ?>">
<script>
    var minOrder = <?= (int)$minBasketSumm ?>;
    window.serverFavorites = <?= json_encode(array_map('intval', $favs)) ?>;
</script>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>

<?$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "menu_mobile",
    Array(
        "ALLOW_MULTI_SELECT" => "N",
        "CHILD_MENU_TYPE" => "left",
        "COMPONENT_TEMPLATE" => "menu_main",
        "DELAY" => "N",
        "MAX_LEVEL" => "1",
        "MENU_CACHE_GET_VARS" => array(),
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "ROOT_MENU_TYPE" => "mobile",
        "USE_EXT" => "Y"
    )
);?>

<div class="modal" id="cityModal">
    <div class="modal__content city-modal">
        <svg
            class="modal__close-btn"
            width="51"
            height="50"
            viewBox="0 0 51 50"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <rect x="0.792969" width="50" height="50" rx="25" fill="#F4F6F8" />
            <path
                d="M19.957 18.959L31.0404 30.0423M19.9571 30.0423L25.4987 24.5007L31.0404 18.959"
                stroke="#1A1A1A"
                stroke-width="1.6"
                stroke-linecap="round"
            />
        </svg>
        <span class="up-title">
                    Выберите свой город, чтобы увидеть
                    <br />
                    актуальные цены на товары
                </span>
        <h3>Выберите город</h3>
        <div class="city-modal__input">
            <label>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <g opacity="0.5">
                        <path
                            d="M14.1712 13.1942C13.8346 12.8576 13.2887 12.8576 12.9521 13.1942C12.6154 13.5309 12.6154 14.0767 12.9521 14.4134L14.1712 13.1942ZM15.9077 17.369C16.2443 17.7057 16.7902 17.7057 17.1268 17.369C17.4635 17.0323 17.4635 16.4865 17.1268 16.1499L15.9077 17.369ZM12.9521 14.4134L15.9077 17.369L17.1268 16.1499L14.1712 13.1942L12.9521 14.4134ZM7.65026 13.6806C4.45353 13.6806 1.86207 11.0891 1.86207 7.89242H0.137931C0.137931 12.0414 3.50132 15.4047 7.65026 15.4047V13.6806ZM13.4384 7.89242C13.4384 11.0891 10.847 13.6806 7.65026 13.6806V15.4047C11.7992 15.4047 15.1626 12.0414 15.1626 7.89242H13.4384ZM7.65026 2.10426C10.847 2.10426 13.4384 4.69571 13.4384 7.89242H15.1626C15.1626 3.74349 11.7992 0.380118 7.65026 0.380118V2.10426ZM7.65026 0.380118C3.50132 0.380118 0.137931 3.74349 0.137931 7.89242H1.86207C1.86207 4.69571 4.45353 2.10426 7.65026 2.10426V0.380118Z"
                            fill="#1A1A1A"
                        />
                    </g>
                </svg>
                <input type="text" placeholder="Введите название города" />
            </label>
            <svg
                class="go-btn"
                width="50"
                height="50"
                viewBox="0 0 50 50"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <rect opacity="0.1" x="0.5" y="0.5" width="49" height="49" rx="24.5" stroke="#1A1A1A" />
                <g opacity="0.5">
                    <path
                        d="M34.1518 15.8603C33.7697 15.4708 33.2852 15.1975 32.7543 15.0718C32.2234 14.9462 31.6678 14.9734 31.1518 15.1503L17.0018 19.8803C16.4311 20.0671 15.9324 20.4264 15.5747 20.9087C15.217 21.391 15.0178 21.9724 15.0046 22.5728C14.9914 23.1731 15.1649 23.7627 15.5012 24.2602C15.8374 24.7577 16.3198 25.1386 16.8818 25.3503L22.1218 27.3503C22.2411 27.3959 22.3497 27.4656 22.4409 27.5551C22.5321 27.6445 22.6039 27.7518 22.6518 27.8703L24.6518 33.1203C24.8553 33.6742 25.2248 34.152 25.7097 34.4884C26.1947 34.8248 26.7716 35.0036 27.3618 35.0003H27.4318C28.0328 34.9893 28.6153 34.7906 29.0977 34.4319C29.5801 34.0733 29.9382 33.5727 30.1218 33.0003L34.8518 18.8303C35.0238 18.3192 35.0494 17.7702 34.9257 17.2453C34.802 16.7205 34.5339 16.2407 34.1518 15.8603ZM33.0018 18.2003L28.2218 32.3803C28.1663 32.5597 28.0548 32.7167 27.9036 32.8283C27.7525 32.9398 27.5696 33.0001 27.3818 33.0003C27.195 33.0033 27.0118 32.9495 26.8564 32.8459C26.7009 32.7423 26.5808 32.5938 26.5118 32.4203L24.5118 27.1703C24.3668 26.7888 24.1431 26.4421 23.8554 26.1526C23.5677 25.8632 23.2224 25.6375 22.8418 25.4903L17.5918 23.4903C17.4147 23.4254 17.2624 23.3065 17.1565 23.1503C17.0507 22.9942 16.9965 22.8088 17.0018 22.6203C17.0019 22.4324 17.0622 22.2495 17.1737 22.0984C17.2853 21.9472 17.4423 21.8358 17.6218 21.7803L31.8018 17.0503C31.9646 16.9839 32.1431 16.9661 32.3158 16.9991C32.4885 17.032 32.6479 17.1143 32.7749 17.2359C32.9018 17.3576 32.9908 17.5134 33.031 17.6845C33.0713 17.8556 33.0611 18.0348 33.0018 18.2003Z"
                        fill="#1A1A1A"
                    />
                </g>
            </svg>
        </div>
        <div class="city-modal__cities">
            <? foreach ($cities as $letter => $cityList){ ?>
                <div class="city-modal__item">
                    <div class="city-title"><?= $letter ?></div>
                    <ul class="city-grid">
                        <? foreach ($cityList as $city){ ?>
                            <li class="<?= $city === $currentCity ? 'active' : '' ?>" data-city="<?= htmlspecialchars($city);?>"><?= htmlspecialchars($city);?></li>
                        <? } ?>
                    </ul>
                </div>
            <? } ?>
        </div>
    </div>
</div>

<div class="modal" id="letterModal">
    <div class="modal__content letter-modal">
        <svg
            class="modal__close-btn"
            width="51"
            height="50"
            viewBox="0 0 51 50"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <rect x="0.792969" width="50" height="50" rx="25" fill="#F4F6F8" />
            <path
                d="M19.957 18.959L31.0404 30.0423M19.9571 30.0423L25.4987 24.5007L31.0404 18.959"
                stroke="#1A1A1A"
                stroke-width="1.6"
                stroke-linecap="round"
            />
        </svg>
        <div class="swiper letter-modal__swiper">
            <div class="swiper-wrapper"></div>
        </div>
        <div class="letter-modal__swiper-prev swiper-btn">
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
        <div class="letter-modal__swiper-next swiper-btn">
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

<!-- <div class="modal" id="videoModal">
    <div class="modal__content video-modal">
        <svg
            class="modal__close-btn"
            width="51"
            height="50"
            viewBox="0 0 51 50"search-form
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <rect x="0.792969" width="50" height="50" rx="25" fill="#F4F6F8" />
            <path
                d="M19.957 18.959L31.0404 30.0423M19.9571 30.0423L25.4987 24.5007L31.0404 18.959"
                stroke="#1A1A1A"
                stroke-width="1.6"
                stroke-linecap="round"
            />
        </svg>
        <div class="video-container">
            <iframe
                id="videoFrame"
                src="https://rutube.ru/"
                frameborder="0"
                allowfullscreen
            ></iframe>
        </div>
    </div>
</div> -->

<div class="announcement active">
    <img class="bg" src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/announcement.png" alt="" />
    <div class="shadow"></div>
    <div class="content">
        <div class="col">
            <span class="day-num">05</span>
            <span class="day-text">ДНЕЙ</span>
        </div>
        <div class="col time">
            <span>16ч.</span>
            <span>55м. 30с.</span>
        </div>
        <div class="marketing-text">
            Помогите пёсику
            <br />
            добежать в школу
        </div>
        <div class="discount">
            Пройдите игру и получите
            <br />
            скидку до 15% на заказ
        </div>
        <a href="/TestWeb/">Начать игру</a>
        <img class="dog" src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/dog.svg" alt="" />
    </div>
</div>
<div class="catalog-popup">
    <div class="catalog-popup__content">
    <?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "mega_menu",
        Array(
            "ALLOW_MULTI_SELECT" => "N",
            "CHILD_MENU_TYPE" => "left",
            "DELAY" => "N",
            "MAX_LEVEL" => "4",
            "MENU_CACHE_GET_VARS" => array(""),
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "ROOT_MENU_TYPE" => "mega",
            "USE_EXT" => "Y"
        )
    );?>
    </div>
</div>

<header class="header<?=($curPage == '/about/')?(' about_h announcement-active'):('')?>">
    <div class="header__top">
        <div class="header__left">
            <div class="map-pick" id="mapPick">
                <svg
                    class="map-pick__geo"
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="13"
                    viewBox="0 0 10 13"
                    fill="none"
                >
                    <path
                        d="M6.3904 10.8502L5.87891 10.4491L6.3904 10.8502ZM3.6096 10.8502L3.09812 11.2513L3.6096 10.8502ZM5 12.0027V11.3527V12.0027ZM8.35 5.80435C8.35 6.34165 8.06236 7.10892 7.56251 7.99262C7.07705 8.85089 6.44658 9.72526 5.87891 10.4491L6.90188 11.2513C7.48909 10.5025 8.16342 9.57076 8.69404 8.63265C9.21027 7.71999 9.65 6.70065 9.65 5.80435H8.35ZM4.12109 10.4491C3.55342 9.72526 2.92295 8.85089 2.43749 7.99262C1.93764 7.10892 1.65 6.34165 1.65 5.80435H0.35C0.35 6.70065 0.789725 7.71999 1.30596 8.63265C1.83658 9.57076 2.51091 10.5025 3.09812 11.2513L4.12109 10.4491ZM1.65 5.80435C1.65 3.7404 3.19391 2.15 5 2.15V0.85C2.38781 0.85 0.35 3.11385 0.35 5.80435H1.65ZM5 2.15C6.80609 2.15 8.35 3.7404 8.35 5.80435H9.65C9.65 3.11385 7.61219 0.85 5 0.85V2.15ZM5.87891 10.4491C5.5634 10.8515 5.3759 11.087 5.21469 11.2335C5.0813 11.3546 5.03319 11.3527 5 11.3527V12.6527C5.45342 12.6527 5.79926 12.4587 6.08878 12.1957C6.35048 11.958 6.61487 11.6173 6.90188 11.2513L5.87891 10.4491ZM3.09812 11.2513C3.38513 11.6173 3.64952 11.958 3.91122 12.1957C4.20074 12.4587 4.54658 12.6527 5 12.6527V11.3527C4.96681 11.3527 4.9187 11.3546 4.78531 11.2335C4.6241 11.087 4.4366 10.8515 4.12109 10.4491L3.09812 11.2513ZM2.85 6C2.85 7.18741 3.81259 8.15 5 8.15V6.85C4.53056 6.85 4.15 6.46944 4.15 6H2.85ZM5 8.15C6.18741 8.15 7.15 7.18741 7.15 6H5.85C5.85 6.46944 5.46944 6.85 5 6.85V8.15ZM7.15 6C7.15 4.81259 6.18741 3.85 5 3.85V5.15C5.46944 5.15 5.85 5.53056 5.85 6H7.15ZM5 3.85C3.81259 3.85 2.85 4.81259 2.85 6H4.15C4.15 5.53056 4.53056 5.15 5 5.15V3.85Z"
                        fill="#1A1A1A"
                    />
                </svg>
                <span class="map-pick__text"><?= $currentCity ?></span>
                <svg
                    class="map-pick__arrow"
                    xmlns="http://www.w3.org/2000/svg"
                    width="10"
                    height="10"
                    viewBox="0 0 10 10"
                    fill="none"
                >
                    <g opacity="0.5">
                        <path
                            d="M7.5 3.75L5 6.25L2.5 3.75"
                            stroke=""
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </g>
                </svg>
            </div>
            <?$APPLICATION->IncludeComponent("bitrix:menu", "menu_top", Array(
                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                "CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
                "DELAY" => "N",	// Откладывать выполнение шаблона меню
                "MAX_LEVEL" => "1",	// Уровень вложенности меню
                "MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
                    0 => "",
                ),
                "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
            ),
                false
            );?>
        </div>
        <div class="header__right">
            <span class="header__work-time"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/work_time.php"), false);?></span>

            <div class="phone-wrapper">
                <a href="tel:+7(499)647-95-36" class="header__phone">
                    <span>+7(499) 647-95-36</span>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="10"
                        height="10"
                        viewBox="0 0 10 10"
                        fill="none"
                    >
                        <g opacity="0.5">
                            <path
                                d="M7.5 3.75L5 6.25L2.5 3.75"
                                stroke="#1A1A1A"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </g>
                    </svg>
                </a>
                <div class="phone-popup">
                    <a href="tel:+7(800)123-45-67">+7(800) 123-45-67</a>
                </div>
            </div>

            <div class="socials">
                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/socials.php"), false);?>
            </div>
            <!-- <a href="#" class="header__login">Вход</a> -->
            <?if ($USER->IsAuthorized()) {
                if (!empty($arUser["NAME"])) {
                    $userName = $arUser["NAME"];
                } else {
                    $userName = $arUser["LOGIN"];
                }
                ?>
                <div class="header__user-dropdown">
                    <button class="header__dropdown-trigger">
                        <span><?=$userName?></span>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="10"
                            height="10"
                            viewBox="0 0 10 10"
                            fill="none"
                        >
                            <g opacity="0.5">
                                <path
                                    d="M7.5 3.75L5 6.25L2.5 3.75"
                                    stroke="#033B80"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </g>
                        </svg>
                        <div class="user-image"><?=substr($userName, 0, 1);?></div>
                    </button>
                    <div class="header__dropdown-content-w">
                        <div class="header__dropdown-content">
                            <a href="/personal/orders/">Текущие заказы</a>
                            <a href="/personal/orders/?filter_history=Y">История заказов</a>
                            <a href="/personal/private/">Данные аккаунта</a>
                            <hr />
                            <a href="?logout=yes&<?=bitrix_sessid_get()?>">Выйти из аккаунта</a>
                        </div>
                    </div>
                </div>
            <?}else{?>
                <div class="header__user-dropdown">
                    <button class="header__login authorization_btn">
                        <span>Вход</span>
                    </button>
                </div>
            <?}?>
        </div>
    </div>
    <div class="header__bottom">
        <div class="header__logo-side">
            <a href="<?=SITE_DIR?>">
                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/logo.php"), false);?>
            </a>
            <button class="header__catalog-btn">
                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/catalog.svg" alt="" />
                <span>Каталог</span>
            </button>
            <?$APPLICATION->IncludeComponent(
                "bitrix:search.title",
                "",
                [
                    "CATEGORY_0" => "",
                    "CATEGORY_0_TITLE" => "",
                    "CHECK_DATES" => "N",
                    "CONTAINER_ID" => "title-search",
                    "INPUT_ID" => "title-search-input",
                    "NUM_CATEGORIES" => "1",
                    "ORDER" => "date",
                    "PAGE" => "#SITE_DIR#search/index.php",
                    "SHOW_INPUT" => "Y",
                    "SHOW_OTHERS" => "N",
                    "TOP_COUNT" => "5",
                    "USE_LANGUAGE_GUESS" => "Y"
                ],
                false
            );?>
        </div>
        <div class="header__actions">
            <?/*$APPLICATION->IncludeComponent(
                "bitrix:sale.basket.basket.line",
                "basket",
                Array(
                    "HIDE_ON_BASKET_PAGES" => "Y",
                    "PATH_TO_AUTHORIZE" => "",
                    "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
                    "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                    "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                    "PATH_TO_PROFILE" => SITE_DIR."personal/private/",
                    "PATH_TO_REGISTER" => SITE_DIR."login/",
                    "POSITION_FIXED" => "N",
                    "SHOW_AUTHOR" => "N",
                    "SHOW_EMPTY_VALUES" => "Y",
                    "SHOW_NUM_PRODUCTS" => "Y",
                    "SHOW_PERSONAL_LINK" => "Y",
                    "SHOW_PRODUCTS" => "N",
                    "SHOW_REGISTRATION" => "Y",
                    "SHOW_TOTAL_PRICE" => "Y"
                )
            );*/?>
            <a href="/personal/cart/" class="mini-basket">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                    <path
                            d="M1.51396 1.37833C1.42735 1.03191 1.07631 0.8213 0.729892 0.907913C0.383475 0.994525 0.172862 1.34557 0.259475 1.69198L1.51396 1.37833ZM3.96795 11.0947L4.35659 10.578L3.96795 11.0947ZM2.19359 6.87034L2.82233 6.71965L2.19359 6.87034ZM3.85163 11.0029L4.26354 10.5046L3.85163 11.0029ZM14.4767 7.18766L15.1055 7.33835L14.4767 7.18766ZM13.0999 10.818L12.647 10.3566L13.0999 10.818ZM12.5508 11.2511L12.8939 11.7991L12.5508 11.2511ZM14.4269 4.61014L14.8706 4.13992L14.4269 4.61014ZM14.6607 4.9067L15.2214 4.58475L14.6607 4.9067ZM9.29196 6.70757C8.93488 6.70757 8.64541 6.99704 8.64541 7.35412C8.64541 7.7112 8.93488 8.00067 9.29196 8.00067V6.70757ZM11.2316 8.64723C10.8745 8.64723 10.5851 8.9367 10.5851 9.29378C10.5851 9.65086 10.8745 9.94033 11.2316 9.94033V8.64723ZM1.56737 4.90403H12.1658V3.61093H1.56737V4.90403ZM8.69949 11.0973H8.37318V12.3904H8.69949V11.0973ZM2.82233 6.71965L2.19611 4.10679L0.93862 4.40817L1.56484 7.02103L2.82233 6.71965ZM2.19461 4.10065L1.51396 1.37833L0.259475 1.69198L0.940122 4.41431L2.19461 4.10065ZM8.37318 11.0973C7.17721 11.0973 6.33568 11.0963 5.68337 11.0205C5.04741 10.9466 4.66234 10.8079 4.35659 10.578L3.57932 11.6114C4.13671 12.0306 4.77356 12.2166 5.53408 12.3049C6.27825 12.3914 7.20775 12.3904 8.37318 12.3904V11.0973ZM1.56484 7.02103C1.83647 8.15435 2.05212 9.05849 2.30967 9.76201C2.57288 10.481 2.90213 11.057 3.43973 11.5013L4.26354 10.5046C3.96864 10.2608 3.74405 9.91868 3.52396 9.31747C3.2982 8.70079 3.10108 7.88267 2.82233 6.71965L1.56484 7.02103ZM4.35659 10.578C4.32501 10.5542 4.29399 10.5297 4.26354 10.5046L3.43973 11.5013C3.48541 11.539 3.53195 11.5758 3.57932 11.6114L4.35659 10.578ZM8.69949 12.3904C9.70777 12.3904 10.512 12.3912 11.1611 12.3255C11.8232 12.2586 12.3844 12.1181 12.8939 11.7991L12.2076 10.7031C11.9301 10.8769 11.587 10.9828 11.031 11.039C10.4619 11.0965 9.73405 11.0973 8.69949 11.0973V12.3904ZM12.647 10.3566C12.5135 10.4877 12.3662 10.6038 12.2076 10.7031L12.8939 11.7991C13.1317 11.6502 13.3526 11.476 13.5528 11.2794L12.647 10.3566ZM12.1658 4.90403C12.8117 4.90403 13.2368 4.90517 13.5497 4.94335C13.852 4.98023 13.9417 5.0413 13.9831 5.08036L14.8706 4.13992C14.5383 3.82632 14.1266 3.71105 13.7064 3.65977C13.2967 3.60979 12.7781 3.61093 12.1658 3.61093V4.90403ZM15.1055 7.33835C15.2482 6.74288 15.3701 6.23884 15.417 5.82886C15.4651 5.40819 15.4489 4.98099 15.2214 4.58475L14.1 5.22864C14.1284 5.27799 14.1668 5.37949 14.1323 5.68201C14.0965 5.99521 13.9985 6.40886 13.848 7.03697L15.1055 7.33835ZM13.9831 5.08036C14.0291 5.1238 14.0685 5.17376 14.1 5.22864L15.2214 4.58475C15.1269 4.4201 15.0087 4.27023 14.8706 4.13992L13.9831 5.08036ZM13.8178 8.64723H11.2316V9.94033H13.8178V8.64723ZM14.4368 6.70757L9.29196 6.70757V8.00067L14.4368 8.00067L14.4368 6.70757ZM13.848 7.03697C13.8345 7.09326 13.8212 7.14868 13.8081 7.20331L15.0655 7.50494C15.0787 7.45017 15.092 7.39462 15.1055 7.33835L13.848 7.03697ZM13.8081 7.20331C13.6153 8.00704 13.467 8.61345 13.3125 9.09699L14.5442 9.49057C14.7161 8.95259 14.8756 8.29647 15.0655 7.50494L13.8081 7.20331ZM13.3125 9.09699C13.1053 9.74548 12.9082 10.1002 12.647 10.3566L13.5528 11.2794C14.0319 10.8091 14.3101 10.2233 14.5442 9.49057L13.3125 9.09699ZM13.8178 9.94033H13.9283V8.64723H13.8178V9.94033Z"
                            fill="currentColor"
                    />
                    <path
                            d="M7.01351 13.786C7.01351 14.1619 6.7088 14.4666 6.33292 14.4666C5.95705 14.4666 5.65234 14.1619 5.65234 13.786C5.65234 13.4102 5.95705 13.1055 6.33292 13.1055C6.7088 13.1055 7.01351 13.4102 7.01351 13.786Z"
                            fill="currentColor"
                    />
                    <path
                            d="M11.097 13.786C11.097 14.1619 10.7923 14.4666 10.4164 14.4666C10.0405 14.4666 9.73583 14.1619 9.73583 13.786C9.73583 13.4102 10.0405 13.1055 10.4164 13.1055C10.7923 13.1055 11.097 13.4102 11.097 13.786Z"
                            fill="currentColor"
                    />
                </svg>
                <div class="badge-wrapper">
                    <span><?=$basketCount?></span>
                </div>
            </a>
            <script>
                /*document.addEventListener("DOMContentLoaded", function () {
                    updateBasketCounter();
                });*/
            </script>
            <a href="/personal/favorite/" class="mini-favorites">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                    <path
                        d="M13.2729 2.12607C11.7637 0.58702 10.0161 1.23612 8.93403 1.92254C8.3226 2.3104 7.47561 2.3104 6.86417 1.92254C5.78207 1.23612 4.03449 0.587037 2.52531 2.12607C-1.05724 5.77951 5.08653 12.8196 7.89912 12.8196C10.7117 12.8196 16.8555 5.7795 13.2729 2.12607Z"
                        stroke="currentColor"
                        stroke-width="1.2931"
                        stroke-linecap="round"
                    />
                </svg>
                <div class="badge-wrapper">
                    <span><?=$favCount?></span>
                </div>
            </a>
            <a href="/catalog/compare/" class="mini-compare">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path
                        d="M14.5312 16.3222V8.41992"
                        stroke="currentColor"
                        stroke-width="1.58046"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M9.79297 16.3214V3.67773"
                        stroke="currentColor"
                        stroke-width="1.58046"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M5.05078 16.3215V11.5801"
                        stroke="currentColor"
                        stroke-width="1.58046"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                <div class="badge-wrapper">
                    <span><?=$compareCount?></span>
                </div>
            </a>
            <a href="javascript:void(0);" class="header__connect request-trigger">Связаться с нами</a>
        </div>
        <div class="header__mobile">
            <img class="header__menu-trigger" src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/header-menu.svg" alt="" />
            <button class="header__catalog-btn-m">
                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/catalog.svg" alt="" />
            </button>
            <a href="<?=SITE_DIR?>" class="header__logo-m">
                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/logo.svg" alt="" />
            </a>
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="40" height="40" rx="11.1111" fill="white" />
                <g opacity="0.4">
                    <path
                        d="M14.6364 13.8243C14.6887 13.7719 14.7149 13.7458 14.7379 13.7246C15.3047 13.2038 16.1759 13.2038 16.7427 13.7246C16.7657 13.7458 16.7919 13.7719 16.8442 13.8243L17.9244 14.9044C18.5185 15.4985 18.6884 16.3957 18.3527 17.1659C18.0169 17.9362 18.1868 18.8334 18.781 19.4275L20.5564 21.2029C21.1505 21.797 22.0477 21.9669 22.8179 21.6312C23.5881 21.2955 24.4853 21.4654 25.0794 22.0595L26.1596 23.1396C26.2119 23.192 26.2381 23.2181 26.2593 23.2412C26.7801 23.808 26.7801 24.6792 26.2593 25.2459C26.2381 25.269 26.2119 25.2952 26.1596 25.3475L25.503 26.004C24.9684 26.5387 24.1976 26.7631 23.4595 26.5991C18.4302 25.4815 14.5024 21.5537 13.3847 16.5244C13.2207 15.7862 13.4452 15.0155 13.9798 14.4808L14.6364 13.8243Z"
                        stroke="#1A1A1A"
                        stroke-width="1.3"
                    />
                </g>
            </svg>
            <a href="#" class="search-icon mobile">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <rect width="40" height="40" rx="11.1111" fill="white" />
                    <g opacity="0.3">
                        <path
                            d="M23.9835 23.0642C23.7297 22.8104 23.3181 22.8104 23.0643 23.0642C22.8104 23.3181 22.8104 23.7296 23.0642 23.9835L23.9835 23.0642ZM25.5404 26.4596C25.7942 26.7135 26.2058 26.7135 26.4596 26.4596C26.7135 26.2058 26.7135 25.7942 26.4596 25.5404L25.5404 26.4596ZM23.0642 23.9835L25.5404 26.4596L26.4596 25.5404L23.9835 23.0642L23.0642 23.9835ZM18.5714 23.4928C15.8534 23.4928 13.65 21.2894 13.65 18.5714H12.35C12.35 22.0074 15.1354 24.7928 18.5714 24.7928V23.4928ZM23.4929 18.5714C23.4929 21.2894 21.2895 23.4928 18.5714 23.4928V24.7928C22.0074 24.7928 24.7929 22.0074 24.7929 18.5714H23.4929ZM18.5714 13.65C21.2895 13.65 23.4929 15.8534 23.4929 18.5714H24.7929C24.7929 15.1354 22.0074 12.35 18.5714 12.35V13.65ZM18.5714 12.35C15.1354 12.35 12.35 15.1354 12.35 18.5714H13.65C13.65 15.8534 15.8534 13.65 18.5714 13.65V12.35Z"
                            fill="#1A1A1A"
                        />
                    </g>
                </svg>
            </a>
            <div class="search_mobile_form_box">
                <form action="" class="search-form mobile">
                    <div class="search-form__overlay"></div>
                    <div class="search-input">
                        <div class="search-input__icon">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="17"
                                height="18"
                                viewBox="0 0 17 18"
                                fill="none"
                            >
                                <g opacity="0.3">
                                    <path
                                        d="M13.8494 12.8724C13.5128 12.5358 12.9669 12.5358 12.6303 12.8724C12.2936 13.2091 12.2936 13.7549 12.6303 14.0916L13.8494 12.8724ZM15.3888 16.8501C15.7255 17.1868 16.2713 17.1868 16.608 16.8501C16.9446 16.5135 16.9446 15.9677 16.608 15.631L15.3888 16.8501ZM12.6303 14.0916L15.3888 16.8501L16.608 15.631L13.8494 12.8724L12.6303 14.0916ZM7.72253 13.3095C4.77066 13.3095 2.37769 10.9166 2.37769 7.9647H0.653556C0.653556 11.8688 3.81845 15.0337 7.72253 15.0337V13.3095ZM13.0674 7.9647C13.0674 10.9166 10.6744 13.3095 7.72253 13.3095V15.0337C11.6266 15.0337 14.7915 11.8688 14.7915 7.9647H13.0674ZM7.72253 2.61988C10.6744 2.61988 13.0674 5.01284 13.0674 7.9647H14.7915C14.7915 4.06062 11.6266 0.895743 7.72253 0.895743V2.61988ZM7.72253 0.895743C3.81845 0.895743 0.653556 4.06062 0.653556 7.9647H2.37769C2.37769 5.01284 4.77066 2.61988 7.72253 2.61988V0.895743Z"
                                        fill="#1A1A1A"
                                    />
                                </g>
                            </svg>
                        </div>
                        <input type="text" placeholder="Поиск по сайту" />
                        <div class="search-input__clear">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="13"
                                height="13"
                                viewBox="0 0 13 13"
                                fill="none"
                            >
                                <path
                                    d="M0.958984 0.958987L12.0423 12.0423M0.959006 12.0423L6.50067 6.50065L12.0423 0.958984"
                                    stroke="#1A1A1A"
                                    stroke-width="1.6"
                                    stroke-linecap="round"
                                />
                            </svg>
                        </div>
                    </div>
                    <div class="search-result">
                        <div class="search-result__top">
                            <a href="#">
                                        <span>
                                            Школьные кабинеты
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="6"
                                                height="6"
                                                viewBox="0 0 6 6"
                                                fill="none"
                                            >
                                                <path
                                                    d="M2.25 4.5L3.75 3L2.25 1.5"
                                                    stroke="#9AB1CC"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                        </span>
                                <h3>Кабинет Химии</h3>
                            </a>
                            <a href="#">
                                        <span>
                                            Школьные кабинеты
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="6"
                                                height="6"
                                                viewBox="0 0 6 6"
                                                fill="none"
                                            >
                                                <path
                                                    d="M2.25 4.5L3.75 3L2.25 1.5"
                                                    stroke="#9AB1CC"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                            Кабинет Химии
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="6"
                                                height="6"
                                                viewBox="0 0 6 6"
                                                fill="none"
                                            >
                                                <path
                                                    d="M2.25 4.5L3.75 3L2.25 1.5"
                                                    stroke="#9AB1CC"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                        </span>
                                <h3>Химическое оборудование</h3>
                            </a>
                        </div>
                        <hr />
                        <div class="search-result__bottom">
                            <a href="#">
                                <div class="row">
                                    <div class="image-wrapper">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/search-img.png" alt="" />
                                    </div>
                                    <div class="col">
                                        <h3>Шкаф лабораторный химический ШЛ-4, 800х400х1900 мм</h3>
                                        <span>
                                                    Школьные кабинеты
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="6"
                                                        height="6"
                                                        viewBox="0 0 6 6"
                                                        fill="none"
                                                    >
                                                        <path
                                                            d="M2.25 4.5L3.75 3L2.25 1.5"
                                                            stroke="#9AB1CC"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                        />
                                                    </svg>
                                                </span>
                                    </div>
                                </div>

                                <span class="price">23 460 ₽</span>
                            </a>
                            <a href="#">
                                <div class="row">
                                    <div class="image-wrapper">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/search-img.png" alt="" />
                                    </div>
                                    <div class="col">
                                        <h3>Электронная таблица Периодическая система химических элеме...</h3>
                                        <span>
                                                    Кабинет Химии
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="6"
                                                        height="6"
                                                        viewBox="0 0 6 6"
                                                        fill="none"
                                                    >
                                                        <path
                                                            d="M2.25 4.5L3.75 3L2.25 1.5"
                                                            stroke="#9AB1CC"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                        />
                                                    </svg>
                                                    Стенды и плакаты
                                                </span>
                                    </div>
                                </div>

                                <span class="price">143 025 ₽</span>
                            </a>
                            <a href="#">
                                <div class="row">
                                    <div class="image-wrapper">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/search-img.png" alt="" />
                                    </div>
                                    <div class="col">
                                        <h3>Набор ОГЭ по химии Точка роста</h3>
                                        <span>
                                                    Кабинет Химии
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="6"
                                                        height="6"
                                                        viewBox="0 0 6 6"
                                                        fill="none"
                                                    >
                                                        <path
                                                            d="M2.25 4.5L3.75 3L2.25 1.5"
                                                            stroke="#9AB1CC"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                        />
                                                    </svg>
                                                    Учебники
                                                </span>
                                    </div>
                                </div>

                                <span class="price">42 690 ₽</span>
                            </a>
                            <a href="#">
                                <div class="row">
                                    <div class="image-wrapper">
                                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/search-img.png" alt="" />
                                    </div>
                                    <div class="col">
                                        <h3>Лабораторный комплекс для учебной деятельности по химии (ЛКХ)</h3>
                                        <span>
                                                    Школьные кабинеты
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="6"
                                                        height="6"
                                                        viewBox="0 0 6 6"
                                                        fill="none"
                                                    >
                                                        <path
                                                            d="M2.25 4.5L3.75 3L2.25 1.5"
                                                            stroke="#9AB1CC"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                        />
                                                    </svg>
                                                    Мебель
                                                </span>
                                    </div>
                                </div>

                                <span class="price">442 935 ₽</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?$APPLICATION->IncludeComponent(
        "bitrix:menu",
        "menu_main",
        Array(
            "ALLOW_MULTI_SELECT" => "N",
            "CHILD_MENU_TYPE" => "left",
            "COMPONENT_TEMPLATE" => "menu_main",
            "DELAY" => "N",
            "MAX_LEVEL" => "1",
            "MENU_CACHE_GET_VARS" => array(),
            "MENU_CACHE_TIME" => "3600",
            "MENU_CACHE_TYPE" => "N",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "ROOT_MENU_TYPE" => "main",
            "USE_EXT" => "Y"
        )
    );?>
    <div class="header__scroll">
        <button class="header__catalog-btn">
            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/catalog.svg" alt="" />
            <span>Каталог</span>
        </button>
        <a class="search-icon search-icon-scroll" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
                <rect width="50" height="50" rx="25" fill="white" />
                <path
                    d="M29.0542 27.9935C28.7613 27.7006 28.2864 27.7006 27.9935 27.9935C27.7006 28.2864 27.7006 28.7613 27.9935 29.0542L29.0542 27.9935ZM30.4697 31.5303C30.7626 31.8232 31.2374 31.8232 31.5303 31.5303C31.8232 31.2374 31.8232 30.7626 31.5303 30.4697L30.4697 31.5303ZM27.9935 29.0542L30.4697 31.5303L31.5303 30.4697L29.0542 27.9935L27.9935 29.0542ZM23.5714 28.3928C20.9086 28.3928 18.75 26.2342 18.75 23.5714H17.25C17.25 27.0626 20.0802 29.8928 23.5714 29.8928V28.3928ZM28.3929 23.5714C28.3929 26.2342 26.2342 28.3928 23.5714 28.3928V29.8928C27.0627 29.8928 29.8929 27.0626 29.8929 23.5714H28.3929ZM23.5714 18.75C26.2342 18.75 28.3929 20.9086 28.3929 23.5714H29.8929C29.8929 20.0802 27.0627 17.25 23.5714 17.25V18.75ZM23.5714 17.25C20.0802 17.25 17.25 20.0802 17.25 23.5714H18.75C18.75 20.9086 20.9086 18.75 23.5714 18.75V17.25Z"
                    fill="#1A1A1A"
                />
            </svg>
        </a>
        <form action="" class="search-form search-form--scroll">
            <div class="search-form__overlay"></div>
            <div class="search-input">
                <div class="search-input__icon">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="17"
                        height="18"
                        viewBox="0 0 17 18"
                        fill="none"
                    >
                        <g opacity="0.3">
                            <path
                                d="M13.8494 12.8724C13.5128 12.5358 12.9669 12.5358 12.6303 12.8724C12.2936 13.2091 12.2936 13.7549 12.6303 14.0916L13.8494 12.8724ZM15.3888 16.8501C15.7255 17.1868 16.2713 17.1868 16.608 16.8501C16.9446 16.5135 16.9446 15.9677 16.608 15.631L15.3888 16.8501ZM12.6303 14.0916L15.3888 16.8501L16.608 15.631L13.8494 12.8724L12.6303 14.0916ZM7.72253 13.3095C4.77066 13.3095 2.37769 10.9166 2.37769 7.9647H0.653556C0.653556 11.8688 3.81845 15.0337 7.72253 15.0337V13.3095ZM13.0674 7.9647C13.0674 10.9166 10.6744 13.3095 7.72253 13.3095V15.0337C11.6266 15.0337 14.7915 11.8688 14.7915 7.9647H13.0674ZM7.72253 2.61988C10.6744 2.61988 13.0674 5.01284 13.0674 7.9647H14.7915C14.7915 4.06062 11.6266 0.895743 7.72253 0.895743V2.61988ZM7.72253 0.895743C3.81845 0.895743 0.653556 4.06062 0.653556 7.9647H2.37769C2.37769 5.01284 4.77066 2.61988 7.72253 2.61988V0.895743Z"
                                fill="#1A1A1A"
                            />
                        </g>
                    </svg>
                </div>
                <input type="text" placeholder="Поиск по сайту" />
                <div class="search-input__clear">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="13"
                        height="13"
                        viewBox="0 0 13 13"
                        fill="none"
                    >
                        <path
                            d="M0.958984 0.958987L12.0423 12.0423M0.959006 12.0423L6.50067 6.50065L12.0423 0.958984"
                            stroke="#1A1A1A"
                            stroke-width="1.6"
                            stroke-linecap="round"
                        />
                    </svg>
                </div>
            </div>
            <div class="search-result">
                <div class="search-result__top">
                    <a href="#">
                                <span>
                                    Школьные кабинеты
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="6"
                                        height="6"
                                        viewBox="0 0 6 6"
                                        fill="none"
                                    >
                                        <path
                                            d="M2.25 4.5L3.75 3L2.25 1.5"
                                            stroke="#9AB1CC"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </span>
                        <h3>Кабинет Химии</h3>
                    </a>
                    <a href="#">
                                <span>
                                    Школьные кабинеты
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="6"
                                        height="6"
                                        viewBox="0 0 6 6"
                                        fill="none"
                                    >
                                        <path
                                            d="M2.25 4.5L3.75 3L2.25 1.5"
                                            stroke="#9AB1CC"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                    Кабинет Химии
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="6"
                                        height="6"
                                        viewBox="0 0 6 6"
                                        fill="none"
                                    >
                                        <path
                                            d="M2.25 4.5L3.75 3L2.25 1.5"
                                            stroke="#9AB1CC"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>
                                </span>
                        <h3>Химическое оборудование</h3>
                    </a>
                </div>
                <hr />
                <div class="search-result__bottom">
                    <a href="#">
                        <div class="row">
                            <div class="image-wrapper">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/search-img.png" alt="" />
                            </div>
                            <div class="col">
                                <h3>Шкаф лабораторный химический ШЛ-4, 800х400х1900 мм</h3>
                                <span>
                                            Школьные кабинеты
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="6"
                                                height="6"
                                                viewBox="0 0 6 6"
                                                fill="none"
                                            >
                                                <path
                                                    d="M2.25 4.5L3.75 3L2.25 1.5"
                                                    stroke="#9AB1CC"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                        </span>
                            </div>
                        </div>

                        <span class="price">23 460 ₽</span>
                    </a>
                    <a href="#">
                        <div class="row">
                            <div class="image-wrapper">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/search-img.png" alt="" />
                            </div>
                            <div class="col">
                                <h3>Электронная таблица Периодическая система химических элеме...</h3>
                                <span>
                                            Кабинет Химии
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="6"
                                                height="6"
                                                viewBox="0 0 6 6"
                                                fill="none"
                                            >
                                                <path
                                                    d="M2.25 4.5L3.75 3L2.25 1.5"
                                                    stroke="#9AB1CC"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                            Стенды и плакаты
                                        </span>
                            </div>
                        </div>

                        <span class="price">143 025 ₽</span>
                    </a>
                    <a href="#">
                        <div class="row">
                            <div class="image-wrapper">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/search-img.png" alt="" />
                            </div>
                            <div class="col">
                                <h3>Набор ОГЭ по химии Точка роста</h3>
                                <span>
                                            Кабинет Химии
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="6"
                                                height="6"
                                                viewBox="0 0 6 6"
                                                fill="none"
                                            >
                                                <path
                                                    d="M2.25 4.5L3.75 3L2.25 1.5"
                                                    stroke="#9AB1CC"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                            Учебники
                                        </span>
                            </div>
                        </div>

                        <span class="price">42 690 ₽</span>
                    </a>
                    <a href="#">
                        <div class="row">
                            <div class="image-wrapper">
                                <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/search-img.png" alt="" />
                            </div>
                            <div class="col">
                                <h3>Лабораторный комплекс для учебной деятельности по химии (ЛКХ)</h3>
                                <span>
                                            Школьные кабинеты
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="6"
                                                height="6"
                                                viewBox="0 0 6 6"
                                                fill="none"
                                            >
                                                <path
                                                    d="M2.25 4.5L3.75 3L2.25 1.5"
                                                    stroke="#9AB1CC"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>
                                            Мебель
                                        </span>
                            </div>
                        </div>

                        <span class="price">442 935 ₽</span>
                    </a>
                </div>
            </div>
        </form>
        <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"menu_header", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"COMPONENT_TEMPLATE" => "menu_header",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "main",
		"USE_EXT" => "Y"
	),
	false
);?>
        <div class="header__actions fixed-header">
            <a href="/personal/cart/" class="mini-basket">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
                    <path
                        d="M1.51396 1.37833C1.42735 1.03191 1.07631 0.8213 0.729892 0.907913C0.383475 0.994525 0.172862 1.34557 0.259475 1.69198L1.51396 1.37833ZM3.96795 11.0947L4.35659 10.578L3.96795 11.0947ZM2.19359 6.87034L2.82233 6.71965L2.19359 6.87034ZM3.85163 11.0029L4.26354 10.5046L3.85163 11.0029ZM14.4767 7.18766L15.1055 7.33835L14.4767 7.18766ZM13.0999 10.818L12.647 10.3566L13.0999 10.818ZM12.5508 11.2511L12.8939 11.7991L12.5508 11.2511ZM14.4269 4.61014L14.8706 4.13992L14.4269 4.61014ZM14.6607 4.9067L15.2214 4.58475L14.6607 4.9067ZM9.29196 6.70757C8.93488 6.70757 8.64541 6.99704 8.64541 7.35412C8.64541 7.7112 8.93488 8.00067 9.29196 8.00067V6.70757ZM11.2316 8.64723C10.8745 8.64723 10.5851 8.9367 10.5851 9.29378C10.5851 9.65086 10.8745 9.94033 11.2316 9.94033V8.64723ZM1.56737 4.90403H12.1658V3.61093H1.56737V4.90403ZM8.69949 11.0973H8.37318V12.3904H8.69949V11.0973ZM2.82233 6.71965L2.19611 4.10679L0.93862 4.40817L1.56484 7.02103L2.82233 6.71965ZM2.19461 4.10065L1.51396 1.37833L0.259475 1.69198L0.940122 4.41431L2.19461 4.10065ZM8.37318 11.0973C7.17721 11.0973 6.33568 11.0963 5.68337 11.0205C5.04741 10.9466 4.66234 10.8079 4.35659 10.578L3.57932 11.6114C4.13671 12.0306 4.77356 12.2166 5.53408 12.3049C6.27825 12.3914 7.20775 12.3904 8.37318 12.3904V11.0973ZM1.56484 7.02103C1.83647 8.15435 2.05212 9.05849 2.30967 9.76201C2.57288 10.481 2.90213 11.057 3.43973 11.5013L4.26354 10.5046C3.96864 10.2608 3.74405 9.91868 3.52396 9.31747C3.2982 8.70079 3.10108 7.88267 2.82233 6.71965L1.56484 7.02103ZM4.35659 10.578C4.32501 10.5542 4.29399 10.5297 4.26354 10.5046L3.43973 11.5013C3.48541 11.539 3.53195 11.5758 3.57932 11.6114L4.35659 10.578ZM8.69949 12.3904C9.70777 12.3904 10.512 12.3912 11.1611 12.3255C11.8232 12.2586 12.3844 12.1181 12.8939 11.7991L12.2076 10.7031C11.9301 10.8769 11.587 10.9828 11.031 11.039C10.4619 11.0965 9.73405 11.0973 8.69949 11.0973V12.3904ZM12.647 10.3566C12.5135 10.4877 12.3662 10.6038 12.2076 10.7031L12.8939 11.7991C13.1317 11.6502 13.3526 11.476 13.5528 11.2794L12.647 10.3566ZM12.1658 4.90403C12.8117 4.90403 13.2368 4.90517 13.5497 4.94335C13.852 4.98023 13.9417 5.0413 13.9831 5.08036L14.8706 4.13992C14.5383 3.82632 14.1266 3.71105 13.7064 3.65977C13.2967 3.60979 12.7781 3.61093 12.1658 3.61093V4.90403ZM15.1055 7.33835C15.2482 6.74288 15.3701 6.23884 15.417 5.82886C15.4651 5.40819 15.4489 4.98099 15.2214 4.58475L14.1 5.22864C14.1284 5.27799 14.1668 5.37949 14.1323 5.68201C14.0965 5.99521 13.9985 6.40886 13.848 7.03697L15.1055 7.33835ZM13.9831 5.08036C14.0291 5.1238 14.0685 5.17376 14.1 5.22864L15.2214 4.58475C15.1269 4.4201 15.0087 4.27023 14.8706 4.13992L13.9831 5.08036ZM13.8178 8.64723H11.2316V9.94033H13.8178V8.64723ZM14.4368 6.70757L9.29196 6.70757V8.00067L14.4368 8.00067L14.4368 6.70757ZM13.848 7.03697C13.8345 7.09326 13.8212 7.14868 13.8081 7.20331L15.0655 7.50494C15.0787 7.45017 15.092 7.39462 15.1055 7.33835L13.848 7.03697ZM13.8081 7.20331C13.6153 8.00704 13.467 8.61345 13.3125 9.09699L14.5442 9.49057C14.7161 8.95259 14.8756 8.29647 15.0655 7.50494L13.8081 7.20331ZM13.3125 9.09699C13.1053 9.74548 12.9082 10.1002 12.647 10.3566L13.5528 11.2794C14.0319 10.8091 14.3101 10.2233 14.5442 9.49057L13.3125 9.09699ZM13.8178 9.94033H13.9283V8.64723H13.8178V9.94033Z"
                        fill="currentColor"
                    />
                    <path
                        d="M7.01351 13.786C7.01351 14.1619 6.7088 14.4666 6.33292 14.4666C5.95705 14.4666 5.65234 14.1619 5.65234 13.786C5.65234 13.4102 5.95705 13.1055 6.33292 13.1055C6.7088 13.1055 7.01351 13.4102 7.01351 13.786Z"
                        fill="currentColor"
                    />
                    <path
                        d="M11.097 13.786C11.097 14.1619 10.7923 14.4666 10.4164 14.4666C10.0405 14.4666 9.73583 14.1619 9.73583 13.786C9.73583 13.4102 10.0405 13.1055 10.4164 13.1055C10.7923 13.1055 11.097 13.4102 11.097 13.786Z"
                        fill="currentColor"
                    />
                </svg>
                <div class="badge-wrapper">
                    <span><?=$basketCount?></span>
                </div>
            </a>
            <script>
                /*document.addEventListener("DOMContentLoaded", function () {
                    updateBasketCounter();
                });*/
            </script>
            <a href="/personal/favorite/" class="mini-favorites">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                    <path
                        d="M13.2729 2.12607C11.7637 0.58702 10.0161 1.23612 8.93403 1.92254C8.3226 2.3104 7.47561 2.3104 6.86417 1.92254C5.78207 1.23612 4.03449 0.587037 2.52531 2.12607C-1.05724 5.77951 5.08653 12.8196 7.89912 12.8196C10.7117 12.8196 16.8555 5.7795 13.2729 2.12607Z"
                        stroke="currentColor"
                        stroke-width="1.2931"
                        stroke-linecap="round"
                    />
                </svg>
                <div class="badge-wrapper">
                    <span><?=$favCount?></span>
                </div>
            </a>
            <a href="/catalog/compare/" class="mini-compare">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path
                        d="M14.5312 16.3222V8.41992"
                        stroke="currentColor"
                        stroke-width="1.58046"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M9.79297 16.3214V3.67773"
                        stroke="currentColor"
                        stroke-width="1.58046"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                    <path
                        d="M5.05078 16.3215V11.5801"
                        stroke="currentColor"
                        stroke-width="1.58046"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    />
                </svg>
                <div class="badge-wrapper">
                    <span><?=$compareCount?></span>
                </div>
            </a>
            <a href="javascript:void(0);" class="header__connect request-trigger">Связаться с нами</a>
        </div>
    </div>
    <div class="nav-menu">
        <a href="#" class="header__catalog-btn">
            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/catalog.svg" alt="" />
            <span>Каталог</span>
        </a>
        <ul>
            <li><a href="#">Оплата и доставка</a></li>
            <li><a href="#">О компании</a></li>
            <li><a href="#">Как купить</a></li>
            <li><a href="#">Презентация о компании</a></li>
        </ul>
        <div class="social-icons">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                    <g clip-path="url(#clip0_510_174214)">
                        <path
                            d="M6.18472 18.1884L6.50212 18.3766C7.83578 19.1681 9.36481 19.5866 10.9241 19.5875H10.9275C15.7161 19.5875 19.6135 15.691 19.6153 10.902C19.616 8.58103 18.7133 6.39893 17.073 4.7571C15.4325 3.11557 13.2515 2.21092 10.9306 2.20996C6.13832 2.20996 2.24094 6.10588 2.23914 10.8949C2.2385 12.5359 2.69757 14.1342 3.56738 15.5169L3.77412 15.8456L2.89624 19.0506L6.18472 18.1884ZM0.386719 21.5333L1.86962 16.1185C0.954949 14.5337 0.473766 12.736 0.474519 10.8944C0.476749 5.13276 5.16553 0.445312 10.9277 0.445312C13.7237 0.446518 16.3481 1.53472 18.3217 3.50992C20.295 5.48508 21.3814 8.11059 21.3805 10.9028C21.3781 16.6641 16.6883 21.3525 10.9277 21.3525C10.9273 21.3525 10.9279 21.3525 10.9277 21.3525H10.9232C9.17384 21.3519 7.4549 20.9131 5.92819 20.0804L0.386719 21.5333Z"
                            fill="#1A1A1A"
                        />
                        <path
                            d="M0.474519 10.8986C0.473886 12.7402 0.95507 14.5381 1.86974 16.1227L0.386719 21.5372L5.92801 20.0843C7.45481 20.9169 9.17366 21.3557 10.923 21.3564H10.9275C16.6881 21.3564 21.3779 16.668 21.3804 10.9067C21.3813 8.11435 20.2949 5.4889 18.3215 3.51383C16.3478 1.53875 13.7236 0.450424 10.9275 0.449219C5.16565 0.449219 0.476754 5.13667 0.474343 10.8983M3.77423 15.8497L3.56738 15.5211C2.69758 14.1383 2.23851 12.54 2.23914 10.8991C2.24104 6.11038 6.13832 2.21416 10.9306 2.21416C13.2513 2.21507 15.4324 3.1198 17.073 4.7613C18.7134 6.40292 19.616 8.5852 19.6154 10.9059C19.6133 15.6949 15.7159 19.5914 10.9273 19.5914H10.9239C9.36466 19.5905 7.83551 19.1719 6.50194 18.3806L6.18455 18.1924L2.89611 19.0546L3.77423 15.8497ZM10.9275 21.3564C10.9273 21.3564 10.9274 21.3564 10.9275 21.3564V21.3564Z"
                            fill="#1A1A1A"
                        />
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M8.30825 6.5277C8.11256 6.09273 7.90667 6.08403 7.72056 6.07637C7.56824 6.0699 7.39403 6.07032 7.22003 6.07032C7.04581 6.07032 6.76286 6.13569 6.52359 6.39706C6.28411 6.65843 5.60938 7.29025 5.60938 8.57524C5.60938 9.86035 6.54541 11.1021 6.67581 11.2765C6.80645 11.4506 8.48271 14.172 11.1372 15.2188C13.3436 16.0888 13.7925 15.9158 14.2714 15.8722C14.7503 15.8287 15.8167 15.2406 16.0343 14.6307C16.252 14.0209 16.252 13.4981 16.1867 13.389C16.1214 13.2801 15.9472 13.2148 15.686 13.0842C15.4248 12.9536 14.1407 12.3217 13.9014 12.2345C13.6619 12.1475 13.4878 12.104 13.3136 12.3655C13.1395 12.6266 12.6393 13.2148 12.4868 13.389C12.3345 13.5635 12.1821 13.5853 11.9209 13.4547C11.6596 13.3236 10.8184 13.0481 9.82055 12.1584C9.04409 11.4661 8.51994 10.6112 8.36751 10.3497C8.21519 10.0885 8.35125 9.94705 8.4822 9.81682C8.59955 9.69979 8.74347 9.51187 8.87411 9.35944C9.00442 9.2069 9.0479 9.09806 9.13495 8.92384C9.22212 8.74951 9.17853 8.59698 9.11327 8.46633C9.0479 8.33569 8.5405 7.04417 8.30825 6.5277Z"
                            fill="#1A1A1A"
                        />
                    </g>
                    <defs>
                        <clipPath id="clip0_510_174214">
                            <rect width="21.5108" height="22" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
            </a>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" fill="none">
                    <g clip-path="url(#clip0_510_174221)">
                        <path
                            d="M22.4742 2.62537C21.8337 2.03436 19.2453 0.155357 13.4799 0.129829C13.4799 0.129829 6.68101 -0.280164 3.36665 2.75997C1.52168 4.60532 0.872655 7.30547 0.804194 10.6531C0.735733 14.0007 0.647158 20.2744 6.69455 21.9755H6.70035L6.69648 24.5712C6.69648 24.5712 6.6578 25.6221 7.34976 25.8364C8.18676 26.0963 8.67798 25.2976 9.47708 24.4366C9.9157 23.9639 10.5214 23.2696 10.9778 22.739C15.1137 23.0871 18.2946 22.2915 18.6559 22.1739C19.491 21.9031 24.2163 21.2978 24.9849 15.0245C25.7781 8.55865 24.6012 4.46879 22.4742 2.62537ZM23.1751 14.5608C22.5264 19.7986 18.6938 20.1278 17.9871 20.3544C17.6866 20.4511 14.8928 21.1462 11.3797 20.9168C11.3797 20.9168 8.76191 24.0749 7.94425 24.8961C7.81661 25.0245 7.66654 25.0763 7.56636 25.0508C7.42557 25.0164 7.38689 24.8497 7.38844 24.606C7.39076 24.2579 7.41087 20.2926 7.41087 20.2926C2.29525 18.8723 2.59346 13.5327 2.65148 10.7366C2.7095 7.94057 3.23475 5.65003 4.79504 4.10946C7.59846 1.57022 13.3736 1.94965 13.3736 1.94965C18.2505 1.97093 20.5875 3.43955 21.1294 3.93154C22.9287 5.47211 23.8454 9.15856 23.1751 14.5592V14.5608Z"
                            fill="#1A1A1A"
                        />
                        <path
                            d="M15.8549 10.507C15.7914 9.22824 15.1419 8.55665 13.9062 8.49219"
                            stroke="#1A1A1A"
                            stroke-width="0.65212"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M17.5263 11.0676C17.5521 9.87631 17.1992 8.88098 16.4677 8.08163C15.7328 7.27943 14.7156 6.83772 13.4102 6.74219"
                            stroke="#1A1A1A"
                            stroke-width="0.65212"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M19.2396 11.7375C19.2238 9.67029 18.6061 8.04218 17.3865 6.8532C16.1668 5.66422 14.65 5.06342 12.8359 5.05078"
                            stroke="#1A1A1A"
                            stroke-width="0.65212"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M13.9704 14.8743C13.9704 14.8743 14.4288 14.913 14.6755 14.6089L15.1567 14.0036C15.3888 13.7035 15.9488 13.512 16.4973 13.8176C16.9083 14.052 17.3073 14.3068 17.6929 14.5811C18.0568 14.8488 18.8022 15.4707 18.8045 15.4707C19.1595 15.7705 19.2415 16.2106 18.9998 16.6748C18.9998 16.6775 18.9979 16.6821 18.9979 16.6844C18.7316 17.146 18.3936 17.5622 17.9965 17.9175C17.9918 17.9198 17.9918 17.9222 17.9876 17.9245C17.6426 18.2128 17.3036 18.3766 16.9707 18.4161C16.9217 18.4247 16.8719 18.4278 16.8222 18.4254C16.6754 18.4268 16.5294 18.4043 16.3898 18.3588L16.3789 18.343C15.8661 18.1983 15.0097 17.8363 13.5836 17.0496C12.7584 16.5997 11.9727 16.0807 11.2351 15.4982C10.8654 15.2064 10.5127 14.8936 10.1788 14.5614L10.1432 14.5258L10.1076 14.4902L10.072 14.4542C10.06 14.4426 10.0484 14.4306 10.0364 14.4187C9.70423 14.0848 9.39145 13.7321 9.09965 13.3623C8.51722 12.6248 7.99824 11.8392 7.54825 11.0142C6.76153 9.5877 6.3995 8.73213 6.25484 8.21848L6.23898 8.20765C6.19364 8.06805 6.1713 7.922 6.17284 7.77523C6.17013 7.72554 6.17312 7.67571 6.18174 7.6267C6.22325 7.29458 6.38738 6.9555 6.67412 6.60946C6.67644 6.6052 6.67876 6.6052 6.68108 6.60056C7.03626 6.20345 7.45252 5.86554 7.91415 5.59956C7.91647 5.59956 7.92111 5.59724 7.92382 5.59724C8.38796 5.3555 8.82812 5.4375 9.1275 5.79063C9.12982 5.79295 9.75061 6.53829 10.0171 6.90225C10.2914 7.28816 10.5462 7.68757 10.7806 8.09897C11.0862 8.64704 10.8947 9.20827 10.5946 9.43956L9.98925 9.92072C9.68369 10.1675 9.72392 10.6258 9.72392 10.6258C9.72392 10.6258 10.6205 14.0191 13.9704 14.8743Z"
                            fill="#1A1A1A"
                        />
                    </g>
                    <defs>
                        <clipPath id="clip0_510_174221">
                            <rect
                                width="24.4444"
                                height="25.7765"
                                fill="white"
                                transform="translate(0.789062 0.111328)"
                            />
                        </clipPath>
                    </defs>
                </svg>
            </a>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="22" viewBox="0 0 23 22" fill="none">
                    <g clip-path="url(#clip0_510_174229)">
                        <path
                            d="M8.47173 13.8848L8.05419 18.3223C8.05419 18.3223 7.87941 19.6821 9.23883 18.3223C10.5982 16.9626 11.8995 15.9141 11.8995 15.9141"
                            fill="#1A1A1A"
                        />
                        <path
                            d="M5.62486 12.559L1.15061 11.1012C1.15061 11.1012 0.615885 10.8843 0.788066 10.3923C0.82351 10.2909 0.89501 10.2046 1.1089 10.0562C2.10027 9.3652 19.4584 3.12621 19.4584 3.12621C19.4584 3.12621 19.9485 2.96106 20.2376 3.0709C20.3091 3.09304 20.3734 3.13377 20.424 3.18894C20.4746 3.2441 20.5097 3.31171 20.5256 3.38486C20.5568 3.51406 20.5699 3.64698 20.5644 3.77979C20.563 3.89468 20.5491 4.00117 20.5386 4.16815C20.4328 5.87392 17.2691 18.6046 17.2691 18.6046C17.2691 18.6046 17.0798 19.3495 16.4016 19.375C16.235 19.3804 16.0689 19.3522 15.9134 19.292C15.7579 19.2319 15.6161 19.141 15.4964 19.0249C14.1656 17.8801 9.56576 14.7888 8.54933 14.1089C8.5264 14.0933 8.5071 14.073 8.49271 14.0492C8.47832 14.0255 8.46918 13.999 8.46591 13.9714C8.45171 13.8998 8.52962 13.811 8.52962 13.811C8.52962 13.811 16.5392 6.69158 16.7523 5.9442C16.7688 5.88629 16.7064 5.85772 16.6227 5.88309C16.0907 6.07879 6.86878 11.9025 5.85097 12.5453C5.77771 12.5674 5.70027 12.5721 5.62486 12.559Z"
                            fill="#1A1A1A"
                        />
                    </g>
                    <defs>
                        <clipPath id="clip0_510_174229">
                            <rect width="22" height="22" fill="white" transform="translate(0.511719)" />
                        </clipPath>
                    </defs>
                </svg>
            </a>
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 24 16" fill="none">
                    <path
                        d="M13.2708 15.1493C5.44103 15.1493 0.975144 9.78153 0.789062 0.849609H4.71109C4.83992 7.40541 7.73127 10.1823 10.0215 10.7549V0.849609H13.7147V6.50363C15.9763 6.26029 18.3521 3.68378 19.1537 0.849609H22.8468C22.2313 4.34222 19.6547 6.91873 17.8225 7.97797C19.6547 8.83681 22.5892 11.0841 23.7057 15.1493H19.6404C18.7673 12.4296 16.5918 10.3255 13.7147 10.0392V15.1493H13.2708Z"
                        fill="#1A1A1A"
                    />
                </svg>
            </a>
        </div>
        <div class="text">
            <span>ПН-ПТ 8:00-17:00</span>
            <a href="#">+7(499) 647-95-36</a>
        </div>
        <div class="buttons">
            <a href="#">Вход</a>
            <a href="#" class="request-trigger">Связаться с нами</a>
        </div>
    </div>
</header>
<main>
    <?if ($curPage == '/about/'){?>
        <div class="about_company" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/src/assets/images/about_fon.png);">
            <div class="container">

                <ul class="breadcrumb_z white">
                    <li><a href="/">Главная</a></li>
                    <li><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/chevron-right-white.svg" alt=""></li>
                    <li>О компании</li>
                </ul>

                <div class="about_company_block">
                    <div class="about_company_top">
                        <h5>
                            С заботой <br>
                            о детях
                        </h5>
                        <p>
                            «Развитие» — это комплексный подход <br> к комплектованию образовательных учреждений <br> всем необходимым для эффективного обучения и <br> комфортной работы
                        </p>
                    </div>
                    <h1 class="about_company_title">О компании</h1>
                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/dog.png" alt="" class="dog">
                </div>
            </div>
        </div>
    <?}?>
<?if (!IS_INDEX && $curPage != '/about/'){?>

    <?if (strpos($curPage, '/catalog/') !== 0) {?>
        <div class="container main-page">
            <?$APPLICATION->IncludeComponent(
                "bitrix:breadcrumb",
                "breadcrumb",
                Array(
                    "PATH" => "",
                    "SITE_ID" => "s1",
                    "START_FROM" => "0"
                )
            );?>
        </div>
        <div class="page-head main-page<?=($curPage == "/personal/favorite/" || $curPage == "/personal/cart/")?(" cart_z_top_actions"):("");?>">
            <?if (!HIDE_TITLE){?>
                <h1><?$APPLICATION->ShowTitle()?><?=($curPage == "/services/" || $curPage == "/news/" || $curPage == "/projects/" || $curPage == "/reviews/" || $curPage == "/docs/")?($APPLICATION->ShowViewContent("elCnt")):('');?></h1>
            <?}?>
            <?if ($curPage == "/personal/favorite/"){?>
                <div class="cart_z_btns">
                    <button class="clear_featured">Очистить избранное</button>
                </div>
            <?}?>
            <?if ($curPage == "/personal/cart/") {?>
                <div class="cart_z_btns">
                    <button class="export_to_pdf">Экспорт в PDF</button>
                    <button class="clear_cart">Очистить корзину</button>
                </div>
            <?}?>
        </div>

        <?
        //echo '<pre>'; print_r($curPage); echo '</pre>';
        /*$APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "breadcrumb",
            array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0",
                "COMPONENT_TEMPLATE" => "breadcrumb"
            ),
            false
        );*/?>
    <?}?>
    <?if ($curPage == '/dev/'){?>
        <div class="<?=(CLASS_PAGE)??('')?>">
    <?}?>

<?}?>