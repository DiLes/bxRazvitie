<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
{
	$basketAction = $arParams['COMMON_ADD_TO_BASKET_ACTION'] ?? '';
}
else
{
	$basketAction = $arParams['SECTION_ADD_TO_BASKET_ACTION'] ?? '';
}


if ($isSidebar)
{
	$contentBlockClass = ($isSidebarLeft ? "col-md-9 col-sm-8 order-1 order-sm-2" : "col-md-9 col-sm-8 order-1");
}
else
{
	$contentBlockClass = "col";
}
$sectionId = $arResult["VARIABLES"]["SECTION_ID"]; // если ID берётся из параметров
//echo '<pre>'; print_r($sectionId); echo '</pre>';
if ($sectionId) {
    $res = CIBlockSection::GetList(["SORT"=>"ASC"], ["IBLOCK_ID" => 2, "ID" => $sectionId], true, ["ID", "NAME", "DESCRIPTION", "DEPTH_LEVEL", "ELEMENT_CNT", "IBLOCK_SECTION_ID", "UF_*"], false);
    if ($section = $res->GetNext()) {
        //echo '<pre>'; print_r($section); echo '</pre>';
        $arResult["VARIABLES"]["DESCRIPTION"] = $section['DESCRIPTION'];
        $rsFile = CFile::GetByID($section["UF_BACKGROUND_IMAGE"]);
        $arFile = $rsFile->Fetch();
        $arResult["VARIABLES"]["SECTION"]["BG"] = $arFile;
        $arResult["VARIABLES"]["SECTION"]["DEPTH_LEVEL"] = $section["DEPTH_LEVEL"];
        $arResult["VARIABLES"]["ELEMENT_CNT"] = $section["ELEMENT_CNT"];

    }
}
if ($arResult["VARIABLES"]["SECTION"]["BG"]["SRC"]){
    $sectionImg = $arResult["VARIABLES"]["SECTION"]["BG"]["SRC"];
} else {
    $sectionImg = NO_BG;
}


//region Catalog Section
$sectionListParams = array(
    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
    "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
    "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
    "CACHE_TIME" => $arParams["CACHE_TIME"],
    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
    "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
    "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
    //"DEPTH_LEVEL" => $arResult["VARIABLES"]["SECTION"]["DEPTH_LEVEL"],
    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
    "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
    "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
    "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
    "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
);
?>

<?if ($arResult["VARIABLES"]["SECTION"]["DEPTH_LEVEL"] == 1){?>
    <?
    $APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"catalog_element", 
	[
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0",
		"COMPONENT_TEMPLATE" => "catalog_element"
	],
	false
);
    ?>
    <div class="page-head">
        <a href="javascript:void(0);" onclick="history.back()">
            <svg width="65" height="65" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="32.5" cy="32.5" r="32.5" fill="white" />
                <g opacity="0.5">
                    <path
                            d="M36 38L30 32L36 26"
                            stroke="#1A1A1A"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                    />
                </g>
            </svg>
        </a>
        <h1><?$APPLICATION->ShowTitle()?><span> <?=$arResult["VARIABLES"]["ELEMENT_CNT"]?> товаров</span></h1>
    </div>
    <?
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "catalog_sections",
        $sectionListParams,
        $component,
        array("HIDE_ICONS" => "Y")
    );
    unset($sectionListParams);
    //endregion
    ?>
<?}else{?>
    <div class="page-head-wrapper" style="background: url(<?=$sectionImg?>);background-repeat: no-repeat;background-position: center;background-size: cover;">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "catalog",
            Array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0"
            )
        );
        ?>

        <div class="page-head">
            <a href="javascript:void(0);" onclick="history.back()">
                <svg width="65" height="65" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="32.5" cy="32.5" r="32.5" fill="white" />
                    <g opacity="0.5">
                        <path
                                d="M36 38L30 32L36 26"
                                stroke="#1A1A1A"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                        />
                    </g>
                </svg>
            </a>
            <h1><?$APPLICATION->ShowTitle()?><span class="element-cnt"><?=$arResult["VARIABLES"]["ELEMENT_CNT"]?> товаров</span></h1>
        </div>
    </div>

    <?
    $sectionListParams = array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        //"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
        "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
        //"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
        //"DEPTH_LEVEL" => $arResult["VARIABLES"]["SECTION"]["DEPTH_LEVEL"],
        "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
        "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
        "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
        "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
        "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
    );
    //echo '<pre>'; print_r($sectionListParams["DEPTH_LEVEL"]); echo '</pre>';

    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "catalog_subsections",
        $sectionListParams,
        $component,
        array("HIDE_ICONS" => "Y")
    );
    unset($sectionListParams);
    ?>


    <div class="main-category">
        <div class="main-category__filter-top">
            <div class="filter-left-side">
                <span class="main-category__filter-title hide">Фильтры</span>
                <div class="main-category__filter-list">
                    <button>
                        От 64 000 ₽
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="6"
                                height="6"
                                viewBox="0 0 6 6"
                                fill="none"
                        >
                            <path
                                    d="M0.666016 0.666017L5.33268 5.33268M0.666025 5.33268L2.99936 2.99935L5.33269 0.666016"
                                    stroke="#1A1A1A"
                                    stroke-linecap="round"
                            />
                        </svg>
                    </button>
                    <button>
                        Социально-коммуникативное развитие
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="6"
                                height="6"
                                viewBox="0 0 6 6"
                                fill="none"
                        >
                            <path
                                    d="M0.666016 0.666017L5.33268 5.33268M0.666025 5.33268L2.99936 2.99935L5.33269 0.666016"
                                    stroke="#1A1A1A"
                                    stroke-linecap="round"
                            />
                        </svg>
                    </button>
                    <button>
                        Бренд 1
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="6"
                                height="6"
                                viewBox="0 0 6 6"
                                fill="none"
                        >
                            <path
                                    d="M0.666016 0.666017L5.33268 5.33268M0.666025 5.33268L2.99936 2.99935L5.33269 0.666016"
                                    stroke="#1A1A1A"
                                    stroke-linecap="round"
                            />
                        </svg>
                    </button>
                    <button>Сбросить все</button>
                </div>
            </div>
            <div class="filter-right-side">
                <div class="main-category__sort">
                    <span class="text">По цене:</span>
                    <div class="sort-dropdown">
                        <div class="sort-dropdown__trigger">
                            <span> Возрастание </span>
                            <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="18"
                                    viewBox="0 0 18 18"
                                    fill="none"
                            >
                                <g opacity="0.4">
                                    <path
                                            d="M4.5 6.75L9 11.25L13.5 6.75"
                                            stroke="#1A1A1A"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                    />
                                </g>
                            </svg>
                        </div>
                        <div class="sort-dropdown__content">
                            <span>Возрастание</span>
                            <span>По убыванию</span>
                        </div>
                    </div>
                </div>
                <div class="main-category__mobile-sort">
                    <button class="img-wrap">
                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/sort.svg" alt="" />
                    </button>
                    <button class="filter-btn">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="12"
                                height="12"
                                viewBox="0 0 12 12"
                                fill="none"
                        >
                            <path
                                    d="M5.99935 9.98399C6.35833 9.98399 6.64935 9.69297 6.64935 9.33399C6.64935 8.975 6.35833 8.68399 5.99935 8.68399V9.98399ZM0.666016 8.68399C0.307031 8.68399 0.0160157 8.975 0.0160156 9.33399C0.0160156 9.69297 0.30703 9.98399 0.666016 9.98399L0.666016 8.68399ZM5.99935 2.01732C5.64036 2.01732 5.34935 2.30833 5.34935 2.66732C5.34935 3.0263 5.64036 3.31732 5.99935 3.31732V2.01732ZM11.3327 3.31732C11.6917 3.31732 11.9827 3.0263 11.9827 2.66732C11.9827 2.30833 11.6917 2.01732 11.3327 2.01732V3.31732ZM5.99935 8.68399L0.666016 8.68399L0.666016 9.98399L5.99935 9.98399V8.68399ZM5.99935 3.31732L11.3327 3.31732V2.01732L5.99935 2.01732V3.31732ZM0.0160156 2.66732C0.0160156 3.76268 0.903984 4.65065 1.99935 4.65065V3.35065C1.62195 3.35065 1.31602 3.04471 1.31602 2.66732H0.0160156ZM1.99935 4.65065C3.09471 4.65065 3.98268 3.76268 3.98268 2.66732H2.68268C2.68268 3.04471 2.37674 3.35065 1.99935 3.35065V4.65065ZM3.98268 2.66732C3.98268 1.57195 3.09471 0.683984 1.99935 0.683984V1.98398C2.37674 1.98398 2.68268 2.28992 2.68268 2.66732H3.98268ZM1.99935 0.683984C0.903984 0.683984 0.0160156 1.57195 0.0160156 2.66732H1.31602C1.31602 2.28992 1.62195 1.98398 1.99935 1.98398V0.683984ZM11.9827 9.33399C11.9827 8.23862 11.0947 7.35065 9.99935 7.35065V8.65065C10.3767 8.65065 10.6827 8.95659 10.6827 9.33399L11.9827 9.33399ZM9.99935 7.35065C8.90398 7.35065 8.01601 8.23862 8.01601 9.33399L9.31601 9.33399C9.31601 8.95659 9.62195 8.65065 9.99935 8.65065V7.35065ZM8.01601 9.33399C8.01601 10.4294 8.90398 11.3173 9.99935 11.3173V10.0173C9.62195 10.0173 9.31601 9.71138 9.31601 9.33399L8.01601 9.33399ZM9.99935 11.3173C11.0947 11.3173 11.9827 10.4294 11.9827 9.33399L10.6827 9.33399C10.6827 9.71138 10.3767 10.0173 9.99935 10.0173V11.3173Z"
                                    fill="#1A1A1A"
                            />
                        </svg>
                        <span>Фильтры</span>
                    </button>
                </div>
                <div class="main-category__view">
                    <a href="#" class="view-item">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="14"
                                viewBox="0 0 14 14"
                                fill="none"
                        >
                            <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M4.10902 0.453078C3.88057 0.43749 3.60229 0.437495 3.26895 0.4375H3.23106C2.89772 0.437495 2.61943 0.43749 2.39098 0.453078C2.15315 0.469305 1.92851 0.504287 1.71072 0.594499C1.20535 0.80383 0.80383 1.20535 0.594499 1.71072C0.504287 1.92851 0.469305 2.15315 0.453078 2.39098C0.43749 2.61943 0.437495 2.89771 0.4375 3.23105V3.26894C0.437495 3.60228 0.43749 3.88057 0.453078 4.10902C0.469305 4.34685 0.504287 4.57149 0.594499 4.78929C0.80383 5.29466 1.20535 5.69617 1.71072 5.9055C1.92851 5.99571 2.15315 6.0307 2.39098 6.04692C2.61944 6.06251 2.89771 6.06251 3.23106 6.0625H3.26894C3.60229 6.06251 3.88057 6.06251 4.10902 6.04692C4.34685 6.0307 4.57149 5.99571 4.78929 5.9055C5.29466 5.69617 5.69617 5.29466 5.9055 4.78929C5.99571 4.57149 6.0307 4.34685 6.04692 4.10902C6.06251 3.88057 6.06251 3.60229 6.0625 3.26894V3.23106C6.06251 2.89771 6.06251 2.61944 6.04692 2.39098C6.0307 2.15315 5.99571 1.92851 5.9055 1.71072C5.69617 1.20535 5.29466 0.80383 4.78929 0.594499C4.57149 0.504287 4.34685 0.469305 4.10902 0.453078ZM2.14123 1.63386C2.1991 1.6099 2.28701 1.58779 2.46756 1.57547C2.65315 1.56281 2.89285 1.5625 3.25 1.5625C3.60715 1.5625 3.84685 1.56281 4.03244 1.57547C4.21299 1.58779 4.3009 1.6099 4.35877 1.63386C4.58848 1.72901 4.77099 1.91152 4.86614 2.14123C4.89011 2.1991 4.91221 2.28701 4.92453 2.46756C4.9372 2.65315 4.9375 2.89285 4.9375 3.25C4.9375 3.60715 4.9372 3.84685 4.92453 4.03244C4.91221 4.21299 4.89011 4.3009 4.86614 4.35877C4.77099 4.58848 4.58848 4.77099 4.35877 4.86614C4.3009 4.89011 4.21299 4.91221 4.03244 4.92453C3.84685 4.9372 3.60715 4.9375 3.25 4.9375C2.89285 4.9375 2.65315 4.9372 2.46756 4.92453C2.28701 4.91221 2.1991 4.89011 2.14123 4.86614C1.91152 4.77099 1.72901 4.58848 1.63386 4.35877C1.6099 4.3009 1.58779 4.21299 1.57547 4.03244C1.56281 3.84685 1.5625 3.60715 1.5625 3.25C1.5625 2.89285 1.56281 2.65315 1.57547 2.46756C1.58779 2.28701 1.6099 2.1991 1.63386 2.14123C1.72901 1.91152 1.91152 1.72901 2.14123 1.63386Z"
                                    fill="#1A1A1A"
                            />
                            <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M11.609 0.453078C11.3806 0.43749 11.1023 0.437495 10.7689 0.4375H10.7311C10.3977 0.437495 10.1194 0.43749 9.89098 0.453078C9.65315 0.469305 9.42851 0.504287 9.21072 0.594499C8.70535 0.80383 8.30383 1.20535 8.0945 1.71072C8.00429 1.92851 7.9693 2.15315 7.95308 2.39098C7.93749 2.61944 7.9375 2.89771 7.9375 3.23106V3.26894C7.9375 3.60229 7.93749 3.88057 7.95308 4.10902C7.9693 4.34685 8.00429 4.57149 8.0945 4.78929C8.30383 5.29466 8.70535 5.69617 9.21072 5.9055C9.42851 5.99571 9.65315 6.0307 9.89098 6.04692C10.1194 6.06251 10.3977 6.06251 10.7311 6.0625H10.7689C11.1023 6.06251 11.3806 6.06251 11.609 6.04692C11.8468 6.0307 12.0715 5.99571 12.2893 5.9055C12.7947 5.69617 13.1962 5.29466 13.4055 4.78929C13.4957 4.57149 13.5307 4.34685 13.5469 4.10902C13.5625 3.88057 13.5625 3.60229 13.5625 3.26894V3.23106C13.5625 2.89771 13.5625 2.61944 13.5469 2.39098C13.5307 2.15315 13.4957 1.92851 13.4055 1.71072C13.1962 1.20535 12.7947 0.80383 12.2893 0.594499C12.0715 0.504287 11.8468 0.469305 11.609 0.453078ZM9.64124 1.63386C9.6991 1.6099 9.78701 1.58779 9.96756 1.57547C10.1532 1.56281 10.3928 1.5625 10.75 1.5625C11.1072 1.5625 11.3468 1.56281 11.5324 1.57547C11.713 1.58779 11.8009 1.6099 11.8588 1.63386C12.0885 1.72901 12.271 1.91152 12.3661 2.14123C12.3901 2.1991 12.4122 2.28701 12.4245 2.46756C12.4372 2.65315 12.4375 2.89285 12.4375 3.25C12.4375 3.60715 12.4372 3.84685 12.4245 4.03244C12.4122 4.21299 12.3901 4.3009 12.3661 4.35877C12.271 4.58848 12.0885 4.77099 11.8588 4.86614C11.8009 4.89011 11.713 4.91221 11.5324 4.92453C11.3468 4.9372 11.1072 4.9375 10.75 4.9375C10.3928 4.9375 10.1532 4.9372 9.96756 4.92453C9.78701 4.91221 9.6991 4.89011 9.64124 4.86614C9.41152 4.77099 9.22901 4.58848 9.13386 4.35877C9.10989 4.3009 9.08779 4.21299 9.07547 4.03244C9.06281 3.84685 9.0625 3.60715 9.0625 3.25C9.0625 2.89285 9.06281 2.65315 9.07547 2.46756C9.08779 2.28701 9.10989 2.1991 9.13386 2.14123C9.22901 1.91152 9.41152 1.72901 9.64124 1.63386Z"
                                    fill="#1A1A1A"
                            />
                            <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M4.10902 7.95308C3.88057 7.93749 3.60229 7.9375 3.26894 7.9375H3.23106C2.89771 7.9375 2.61944 7.93749 2.39098 7.95308C2.15315 7.9693 1.92851 8.00429 1.71072 8.0945C1.20535 8.30383 0.80383 8.70535 0.594499 9.21072C0.504287 9.42851 0.469305 9.65315 0.453078 9.89098C0.43749 10.1194 0.437495 10.3977 0.4375 10.7311V10.7689C0.437495 11.1023 0.43749 11.3806 0.453078 11.609C0.469305 11.8468 0.504287 12.0715 0.594499 12.2893C0.80383 12.7947 1.20535 13.1962 1.71072 13.4055C1.92851 13.4957 2.15315 13.5307 2.39098 13.5469C2.61944 13.5625 2.89771 13.5625 3.23106 13.5625H3.26894C3.60229 13.5625 3.88057 13.5625 4.10902 13.5469C4.34685 13.5307 4.57149 13.4957 4.78929 13.4055C5.29466 13.1962 5.69617 12.7947 5.9055 12.2893C5.99571 12.0715 6.0307 11.8468 6.04692 11.609C6.06251 11.3806 6.06251 11.1023 6.0625 10.7689V10.7311C6.06251 10.3977 6.06251 10.1194 6.04692 9.89098C6.0307 9.65315 5.99571 9.42851 5.9055 9.21072C5.69617 8.70535 5.29466 8.30383 4.78929 8.0945C4.57149 8.00429 4.34685 7.9693 4.10902 7.95308ZM2.14123 9.13386C2.1991 9.10989 2.28701 9.08779 2.46756 9.07547C2.65315 9.06281 2.89285 9.0625 3.25 9.0625C3.60715 9.0625 3.84685 9.06281 4.03244 9.07547C4.21299 9.08779 4.3009 9.10989 4.35877 9.13386C4.58848 9.22901 4.77099 9.41152 4.86614 9.64124C4.89011 9.6991 4.91221 9.78701 4.92453 9.96756C4.9372 10.1532 4.9375 10.3928 4.9375 10.75C4.9375 11.1072 4.9372 11.3468 4.92453 11.5324C4.91221 11.713 4.89011 11.8009 4.86614 11.8588C4.77099 12.0885 4.58848 12.271 4.35877 12.3661C4.3009 12.3901 4.21299 12.4122 4.03244 12.4245C3.84685 12.4372 3.60715 12.4375 3.25 12.4375C2.89285 12.4375 2.65315 12.4372 2.46756 12.4245C2.28701 12.4122 2.1991 12.3901 2.14123 12.3661C1.91152 12.271 1.72901 12.0885 1.63386 11.8588C1.6099 11.8009 1.58779 11.713 1.57547 11.5324C1.56281 11.3468 1.5625 11.1072 1.5625 10.75C1.5625 10.3928 1.56281 10.1532 1.57547 9.96756C1.58779 9.78701 1.6099 9.6991 1.63386 9.64124C1.72901 9.41152 1.91152 9.22901 2.14123 9.13386Z"
                                    fill="#1A1A1A"
                            />
                            <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M11.609 7.95308C11.3806 7.93749 11.1023 7.9375 10.7689 7.9375H10.7311C10.3977 7.9375 10.1194 7.93749 9.89098 7.95308C9.65315 7.9693 9.42851 8.00429 9.21072 8.0945C8.70535 8.30383 8.30383 8.70535 8.0945 9.21072C8.00429 9.42851 7.9693 9.65315 7.95308 9.89098C7.93749 10.1194 7.9375 10.3977 7.9375 10.7311V10.7689C7.9375 11.1023 7.93749 11.3806 7.95308 11.609C7.9693 11.8468 8.00429 12.0715 8.0945 12.2893C8.30383 12.7947 8.70535 13.1962 9.21072 13.4055C9.42851 13.4957 9.65315 13.5307 9.89098 13.5469C10.1194 13.5625 10.3977 13.5625 10.7311 13.5625H10.7689C11.1023 13.5625 11.3806 13.5625 11.609 13.5469C11.8468 13.5307 12.0715 13.4957 12.2893 13.4055C12.7947 13.1962 13.1962 12.7947 13.4055 12.2893C13.4957 12.0715 13.5307 11.8468 13.5469 11.609C13.5625 11.3806 13.5625 11.1023 13.5625 10.7689V10.7311C13.5625 10.3977 13.5625 10.1194 13.5469 9.89098C13.5307 9.65315 13.4957 9.42851 13.4055 9.21072C13.1962 8.70535 12.7947 8.30383 12.2893 8.0945C12.0715 8.00429 11.8468 7.9693 11.609 7.95308ZM9.64124 9.13386C9.6991 9.10989 9.78701 9.08779 9.96756 9.07547C10.1532 9.06281 10.3928 9.0625 10.75 9.0625C11.1072 9.0625 11.3468 9.06281 11.5324 9.07547C11.713 9.08779 11.8009 9.10989 11.8588 9.13386C12.0885 9.22901 12.271 9.41152 12.3661 9.64124C12.3901 9.6991 12.4122 9.78701 12.4245 9.96756C12.4372 10.1532 12.4375 10.3928 12.4375 10.75C12.4375 11.1072 12.4372 11.3468 12.4245 11.5324C12.4122 11.713 12.3901 11.8009 12.3661 11.8588C12.271 12.0885 12.0885 12.271 11.8588 12.3661C11.8009 12.3901 11.713 12.4122 11.5324 12.4245C11.3468 12.4372 11.1072 12.4375 10.75 12.4375C10.3928 12.4375 10.1532 12.4372 9.96756 12.4245C9.78701 12.4122 9.6991 12.3901 9.64124 12.3661C9.41152 12.271 9.22901 12.0885 9.13386 11.8588C9.10989 11.8009 9.08779 11.713 9.07547 11.5324C9.06281 11.3468 9.0625 11.1072 9.0625 10.75C9.0625 10.3928 9.06281 10.1532 9.07547 9.96756C9.08779 9.78701 9.10989 9.6991 9.13386 9.64124C9.22901 9.41152 9.41152 9.22901 9.64124 9.13386Z"
                                    fill="#1A1A1A"
                            />
                        </svg>
                    </a>
                    <a href="#" class="view-item">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="15"
                                height="12"
                                viewBox="0 0 15 12"
                                fill="none"
                        >
                            <path
                                    d="M3.25 0.9375C2.93934 0.9375 2.6875 1.18934 2.6875 1.5C2.6875 1.81066 2.93934 2.0625 3.25 2.0625H13.75C14.0607 2.0625 14.3125 1.81066 14.3125 1.5C14.3125 1.18934 14.0607 0.9375 13.75 0.9375H3.25Z"
                                    fill="#1A1A1A"
                            />
                            <path
                                    d="M3.25 5.4375C2.93934 5.4375 2.6875 5.68934 2.6875 6C2.6875 6.31066 2.93934 6.5625 3.25 6.5625H13.75C14.0607 6.5625 14.3125 6.31066 14.3125 6C14.3125 5.68934 14.0607 5.4375 13.75 5.4375H3.25Z"
                                    fill="#1A1A1A"
                            />
                            <path
                                    d="M3.25 9.9375C2.93934 9.9375 2.6875 10.1893 2.6875 10.5C2.6875 10.8107 2.93934 11.0625 3.25 11.0625H13.75C14.0607 11.0625 14.3125 10.8107 14.3125 10.5C14.3125 10.1893 14.0607 9.9375 13.75 9.9375H3.25Z"
                                    fill="#1A1A1A"
                            />
                            <path
                                    d="M1.75 6C1.75 6.41421 1.41421 6.75 1 6.75C0.585786 6.75 0.25 6.41421 0.25 6C0.25 5.58579 0.585786 5.25 1 5.25C1.41421 5.25 1.75 5.58579 1.75 6Z"
                                    fill="#1A1A1A"
                            />
                            <path
                                    d="M1.75 1.5C1.75 1.91421 1.41421 2.25 1 2.25C0.585786 2.25 0.25 1.91421 0.25 1.5C0.25 1.08579 0.585786 0.75 1 0.75C1.41421 0.75 1.75 1.08579 1.75 1.5Z"
                                    fill="#1A1A1A"
                            />
                            <path
                                    d="M1.75 10.5C1.75 10.9142 1.41421 11.25 1 11.25C0.585786 11.25 0.25 10.9142 0.25 10.5C0.25 10.0858 0.585786 9.75 1 9.75C1.41421 9.75 1.75 10.0858 1.75 10.5Z"
                                    fill="#1A1A1A"
                            /></svg
                        ></a>
                    <a href="#" class="view-item">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="12"
                                height="12"
                                viewBox="0 0 12 12"
                                fill="none"
                        >
                            <path
                                    d="M0.75 0.9375C0.43934 0.9375 0.1875 1.18934 0.1875 1.5C0.1875 1.81066 0.43934 2.0625 0.75 2.0625H11.25C11.5607 2.0625 11.8125 1.81066 11.8125 1.5C11.8125 1.18934 11.5607 0.9375 11.25 0.9375H0.75Z"
                                    fill="#1A1A1A"
                            />
                            <path
                                    d="M0.75 5.4375C0.43934 5.4375 0.1875 5.68934 0.1875 6C0.1875 6.31066 0.43934 6.5625 0.75 6.5625H11.25C11.5607 6.5625 11.8125 6.31066 11.8125 6C11.8125 5.68934 11.5607 5.4375 11.25 5.4375H0.75Z"
                                    fill="#1A1A1A"
                            />
                            <path
                                    d="M0.75 9.9375C0.43934 9.9375 0.1875 10.1893 0.1875 10.5C0.1875 10.8107 0.43934 11.0625 0.75 11.0625H11.25C11.5607 11.0625 11.8125 10.8107 11.8125 10.5C11.8125 10.1893 11.5607 9.9375 11.25 9.9375H0.75Z"
                                    fill="#1A1A1A"
                            />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="main-category__content">
            <? if ($isFilter || $isSidebar){ ?>
                <div class="main-category__content-left">
                    <?
                    //region Filter
                    if ($isFilter){ ?>

                            <?
                            $APPLICATION->IncludeComponent(
                                    "bitrix:catalog.smart.filter",
                                    "catalog",
                                    array(
                                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                    "SECTION_ID" => $arCurSection['ID'],
                                    "FILTER_NAME" => $arParams["FILTER_NAME"],
                                    "PRICE_CODE" => $arParams["~PRICE_CODE"],
                                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                    "SAVE_IN_SESSION" => "N",
                                    "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                                    "XML_EXPORT" => "N",
                                    "SECTION_TITLE" => "NAME",
                                    "SECTION_DESCRIPTION" => "DESCRIPTION",
                                    'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                                    "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                                    'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                    'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                    "SEF_MODE" => $arParams["SEF_MODE"],
                                    "SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
                                    "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                                    "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                                    "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                                ),
                                $component,
                                array('HIDE_ICONS' => 'Y')
                            );
                            ?>

                    <? }
                    //endregion
                    ?>

                    <?
                    //region Sidebar
                    if ($isSidebar){ ?>

                        <a href="#" class="download-pdf">
                            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/Free_Square_Brochure_Mockup_05.png" alt="">
                            <div class="ctn">
                                <span>Скачать брошюру в формате PDF</span>
                                <svg width="92" height="91" viewBox="0 0 92 91" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle opacity="0.1" cx="46" cy="45.2548" r="31.5" transform="rotate(45 46 45.2548)" stroke="white"></circle>
                                    <path d="M41.0508 40.3047L50.9503 50.2042" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M50.9492 40.3047V50.2042H41.0497" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                        </a>
                            <?
                            /*$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "PATH" => $arParams["SIDEBAR_PATH"],
                                    "AREA_FILE_RECURSIVE" => "N",
                                    "EDIT_MODE" => "html",
                                    ),
                                false,
                                array('HIDE_ICONS' => 'Y')
                            );*/
                            ?>

                    <?}
                    //endregion
                    ?>
                </div>
            <?}?>
           <div class="main-category__content-right">
            <?
            $intSectionID = $APPLICATION->IncludeComponent(
                "bitrix:catalog.section",
                "catalog", array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                "PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
                "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
                "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                "BASKET_URL" => $arParams["BASKET_URL"],
                "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                "FILTER_NAME" => $arParams["FILTER_NAME"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "SET_TITLE" => $arParams["SET_TITLE"],
                "MESSAGE_404" => $arParams["~MESSAGE_404"],
                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                "SHOW_404" => $arParams["SHOW_404"],
                "FILE_404" => $arParams["FILE_404"],
                "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                "PRICE_CODE" => $arParams["~PRICE_CODE"],
                "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                "PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                "LAZY_LOAD" => $arParams["LAZY_LOAD"],
                "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
                "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

                "OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
                "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                "OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
                "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                "OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                'LABEL_PROP' => $arParams['LABEL_PROP'],
                'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'] ?? '',
                'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
                'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
                'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'] ?? '',
                'MESS_NOT_AVAILABLE_SERVICE' => $arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '',
                'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                "ADD_SECTIONS_CHAIN" => "N",
                'ADD_TO_BASKET_ACTION' => $basketAction,
                'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                'USE_COMPARE_LIST' => 'Y',
                'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
                'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
            ),
                $component
            );

            $GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;
            ?>

            <div class="pb-4 <?=(($isFilter || $isSidebar) ? "col-lg-9 col-md-8 col-sm-7" : "col")?>">
                <?
                if (ModuleManager::isModuleInstalled("sale"))
                {
                    $arRecomData = array();
                    $recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
                    $obCache = new CPHPCache();
                    if ($obCache->InitCache(36000, serialize($recomCacheID), "/sale/bestsellers"))
                    {
                        $arRecomData = $obCache->GetVars();
                    }
                    elseif ($obCache->StartDataCache())
                    {
                        if (Loader::includeModule("catalog"))
                        {
                            $arSKU = CCatalogSku::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
                            $arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
                        }
                        $obCache->EndDataCache($arRecomData);
                    }

                    //region Product Gift
                    if (!empty($arRecomData) && $arParams['USE_GIFTS_SECTION'] === 'Y')
                    {
                        ?>
                        <div class="row">
                            <div class="col" data-entity="parent-container">
                                <? if (!isset($arParams['GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE']) || $arParams['GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE'] !== 'Y')
                                {
                                    ?>
                                    <div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;"><?
                                        echo ($arParams['GIFTS_SECTION_LIST_BLOCK_TITLE'] ?: \Bitrix\Main\Localization\Loc::getMessage('CT_GIFTS_SECTION_LIST_BLOCK_TITLE_DEFAULT'));
                                    ?></div><?
                                }

                                CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.section');
                                $APPLICATION->IncludeComponent(
                                    'bitrix:sale.products.gift.section',
                                    'bootstrap_v4', array(
                                        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                                        'IBLOCK_ID' => $arParams['IBLOCK_ID'],

                                        'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
                                        'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
                                        'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],

                                        'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
                                        'ACTION_VARIABLE' => (!empty($arParams['ACTION_VARIABLE']) ? $arParams['ACTION_VARIABLE'] : 'action').'_spgs',

                                        'PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
                                            SaleProductsGiftSectionComponent::predictRowVariants(
                                                $arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT'],
                                                $arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT']
                                            )
                                        ),
                                        'PAGE_ELEMENT_COUNT' => $arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT'],
                                        'DEFERRED_PRODUCT_ROW_VARIANTS' => '',
                                        'DEFERRED_PAGE_ELEMENT_COUNT' => 0,

                                        'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
                                        'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                                        'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
                                        'PRODUCT_DISPLAY_MODE' => 'Y',
                                        'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                                        'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                                        'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                                        'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                                        'TEXT_LABEL_GIFT' => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],

                                        'LABEL_PROP_'.$arParams['IBLOCK_ID'] => array(),
                                        'LABEL_PROP_MOBILE_'.$arParams['IBLOCK_ID'] => array(),
                                        'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

                                        'ADD_TO_BASKET_ACTION' => $basketAction,
                                        'MESS_BTN_BUY' => $arParams['~GIFTS_MESS_BTN_BUY'],
                                        'MESS_BTN_ADD_TO_BASKET' => $arParams['~GIFTS_MESS_BTN_BUY'],
                                        'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
                                        'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],

                                        'PROPERTY_CODE' => (isset($arParams['LIST_PROPERTY_CODE']) ? $arParams['LIST_PROPERTY_CODE'] : []),
                                        'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
                                        'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],

                                        'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
                                        'OFFERS_PROPERTY_CODE' => (isset($arParams['LIST_OFFERS_PROPERTY_CODE']) ? $arParams['LIST_OFFERS_PROPERTY_CODE'] : []),
                                        'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
                                        'OFFERS_CART_PROPERTIES' => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : []),
                                        'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],

                                        'HIDE_NOT_AVAILABLE' => 'Y',
                                        'HIDE_NOT_AVAILABLE_OFFERS' => 'Y',
                                        'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                                        'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
                                        'PRICE_CODE' => $arParams['~PRICE_CODE'],
                                        'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
                                        'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
                                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                        'BASKET_URL' => $arParams['BASKET_URL'],
                                        'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
                                        'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
                                        'PARTIAL_PRODUCT_PROPERTIES' => $arParams['PARTIAL_PRODUCT_PROPERTIES'],
                                        'USE_PRODUCT_QUANTITY' => 'N',
                                        'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                                        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

                                        'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                                        'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                                        'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),
                                    ),
                                    $component,
                                    array("HIDE_ICONS" => "Y")
                                );
                                ?>
                            </div>
                        </div>
                        <?
                    }
                    //endregion
                }

                //region Catalog Section
                $sectionListParams = array(
                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                    "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                    "COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
                    "TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
                    "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                    "VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
                    "SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
                    "HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
                    "ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
                );
                if ($sectionListParams["COUNT_ELEMENTS"] === "Y")
                {
                    $sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
                    if ($arParams["HIDE_NOT_AVAILABLE"] == "Y")
                    {
                        $sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
                    }
                }
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "catalog_sections",
                    $sectionListParams,
                    $component,
                    array("HIDE_ICONS" => "Y")
                );
                unset($sectionListParams);
                //endregion

                //region Compare List
                /*if ($arParams["USE_COMPARE"]=="Y")
                {
                    $APPLICATION->IncludeComponent(
                        "bitrix:catalog.compare.list",
                        "132", array(
                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                            "NAME" => $arParams["COMPARE_NAME"],
                            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                            "COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
                            "ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action"),
                            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                            'POSITION_FIXED' => isset($arParams['COMPARE_POSITION_FIXED']) ? $arParams['COMPARE_POSITION_FIXED'] : '',
                            'POSITION' => isset($arParams['COMPARE_POSITION']) ? $arParams['COMPARE_POSITION'] : ''
                        ),
                        $component,
                        array("HIDE_ICONS" => "Y")
                    );
                }*/
                //endregion

                 /*$intSectionID = $APPLICATION->IncludeComponent(
                            "bitrix:catalog.section",
                            "catalog", array(
                                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                                "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                                "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                                "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                                "PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
                                "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
                                "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                                "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                                "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                                "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                                "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                                "BASKET_URL" => $arParams["BASKET_URL"],
                                "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                                "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                                "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                                "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                                "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                                "FILTER_NAME" => $arParams["FILTER_NAME"],
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                "SET_TITLE" => $arParams["SET_TITLE"],
                                "MESSAGE_404" => $arParams["~MESSAGE_404"],
                                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                                "SHOW_404" => $arParams["SHOW_404"],
                                "FILE_404" => $arParams["FILE_404"],
                                "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                                "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                                "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                                "PRICE_CODE" => $arParams["~PRICE_CODE"],
                                "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                                "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                                "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                                "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                                "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                                "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                                "PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

                                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                                "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                                "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                                "LAZY_LOAD" => $arParams["LAZY_LOAD"],
                                "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
                                "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

                                "OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
                                "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                                "OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
                                "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                                "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                                "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                                "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                                "OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

                                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                                "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                                "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                                'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                                'LABEL_PROP' => $arParams['LABEL_PROP'],
                                'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                                'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                                'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'] ?? '',
                                'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                                'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                                'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
                                'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                                'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                                'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                                'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                                'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                                'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                                'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
                                'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                                'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                                'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                                'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                                'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                                'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                                'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                                'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                                'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                                'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                                'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                                'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                                'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                                'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'] ?? '',
                                'MESS_NOT_AVAILABLE_SERVICE' => $arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '',
                                'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                                'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                                'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                                'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                                'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                                "ADD_SECTIONS_CHAIN" => "N",
                                'ADD_TO_BASKET_ACTION' => $basketAction,
                                'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                                'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                                'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                                'USE_COMPARE_LIST' => 'Y',
                                'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                                'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
                                'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
                            ),
                            $component
                        );

                        $GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;*/

                if (ModuleManager::isModuleInstalled("sale"))
                {
                    if (!empty($arRecomData))
                    {
                        if (!isset($arParams['USE_BIG_DATA']) || $arParams['USE_BIG_DATA'] != 'N')
                        {
                            ?>
                            <div class="row mb-3">
                                <div class="col" data-entity="parent-container">
                                    <div class="catalog-block-header" data-entity="header" data-showed="false" style="display: none; opacity: 0;">
                                        <?=GetMessage('CATALOG_PERSONAL_RECOM')?>
                                    </div>
                                    <? $APPLICATION->IncludeComponent("bitrix:catalog.section", "bootstrap_v4", array(
                                            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                                            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                                            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                                            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                                            "PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
                                            "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
                                            "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                                            "BASKET_URL" => $arParams["BASKET_URL"],
                                            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                                            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                                            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                                            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                                            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                                            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                            "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                                            "PAGE_ELEMENT_COUNT" => 0,
                                            "PRICE_CODE" => $arParams["~PRICE_CODE"],
                                            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                                            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                                            "SET_BROWSER_TITLE" => "N",
                                            "SET_META_KEYWORDS" => "N",
                                            "SET_META_DESCRIPTION" => "N",
                                            "SET_LAST_MODIFIED" => "N",
                                            "ADD_SECTIONS_CHAIN" => "N",

                                            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                                            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                                            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                                            "PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

                                            "OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
                                            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                                            "OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
                                            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                                            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                                            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                                            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                                            "OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

                                            "SECTION_ID" => $intSectionID,
                                            "SECTION_CODE" => "",
                                            "SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
                                            "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
                                            "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                                            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                            'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                                            'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                                            'LABEL_PROP' => $arParams['LABEL_PROP'],
                                            'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                                            'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                                            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                                            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                                            'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                                            'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':true}]",
                                            'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                                            'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                                            'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                                            'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                                            'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                                            "DISPLAY_TOP_PAGER" => 'N',
                                            "DISPLAY_BOTTOM_PAGER" => 'N',
                                            "HIDE_SECTION_DESCRIPTION" => "Y",

                                            "RCM_TYPE" => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
                                            "SHOW_FROM_SECTION" => 'Y',

                                            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                                            'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
                                            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                                            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                                            'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                                            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                                            'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                                            'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                                            'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                                            'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                                            'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                                            'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                                            'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                                            'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                                            'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                                            'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'] ?? '',
                                            'MESS_NOT_AVAILABLE_SERVICE' => $arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '',
                                            'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                                            'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                                            'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                                            'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                                            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                                            'ADD_TO_BASKET_ACTION' => $basketAction,
                                            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                                            'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
                                            'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                                            'USE_COMPARE_LIST' => 'Y',
                                            'BACKGROUND_IMAGE' => '',
                                            'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
                                        ),
                                        $component
                                    );
                                    ?>
                                </div>
                            </div>
                            <?
                        }
                    }
                }
                ?>
            </div>
        </div>

        <?if (!empty($arResult["VARIABLES"]["DESCRIPTION"])){?>
        <div class="main-category__desc">
            <div class="left-side">
                <p>
                    Что входит в перечень <br />оборудования<br />
                    для художественной школы
                </p>
            </div>
            <div class="right-side">
                <p>
                    <?=$arResult["VARIABLES"]["DESCRIPTION"]?>
                </p>
                <button>
                    <span>Раскрыть описание</span>
                    <svg
                            width="12"
                            height="7"
                            viewBox="0 0 12 7"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                                d="M11 1L6 6L1 1"
                                stroke="#056BE9"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                        />
                    </svg>
                </button>
            </div>
        </div>
        <?}?>
        <div class="filter-popup">
            <div class="filter-popup__content">
                <div class="filter-popup__header">
                    <button class="filter-back-btn"><svg width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.3327 5.74935C12.7469 5.74935 13.0827 5.41356 13.0827 4.99935C13.0827 4.58514 12.7469 4.24935 12.3327 4.24935V5.74935ZM1.66602 4.24935C1.2518 4.24935 0.916016 4.58514 0.916016 4.99935C0.916016 5.41356 1.2518 5.74935 1.66602 5.74935V4.24935ZM3.80472 8.86537C4.09892 9.15696 4.57379 9.15484 4.86537 8.86064C5.15696 8.56644 5.15484 8.09158 4.86064 7.79999L3.80472 8.86537ZM3.15737 7.16781L3.68533 6.63512L3.15737 7.16781ZM3.15737 2.83089L2.62941 2.2982V2.2982L3.15737 2.83089ZM4.86064 2.19871C5.15484 1.90712 5.15696 1.43225 4.86537 1.13806C4.57379 0.84386 4.09892 0.841741 3.80472 1.13332L4.86064 2.19871ZM1.67928 5.20824L0.935295 5.30307L0.935295 5.30307L1.67928 5.20824ZM1.67928 4.79046L0.935295 4.69563L0.935295 4.69563L1.67928 4.79046ZM12.3327 4.24935H1.66602V5.74935H12.3327V4.24935ZM4.86064 7.79999L3.68533 6.63512L2.62941 7.7005L3.80472 8.86537L4.86064 7.79999ZM3.68533 3.36358L4.86064 2.19871L3.80472 1.13332L2.62941 2.2982L3.68533 3.36358ZM3.68533 6.63512C3.20416 6.15822 2.8891 5.84436 2.67867 5.58234C2.47774 5.33215 2.43467 5.20296 2.42326 5.11341L0.935295 5.30307C0.996041 5.77965 1.22337 6.16576 1.50913 6.52158C1.78539 6.86557 2.17329 7.24844 2.62941 7.7005L3.68533 6.63512ZM2.62941 2.2982C2.17329 2.75026 1.78539 3.13313 1.50913 3.47711C1.22337 3.83294 0.996041 4.21905 0.935295 4.69563L2.42326 4.88529C2.43467 4.79574 2.47774 4.66655 2.67867 4.41636C2.8891 4.15434 3.20416 3.84048 3.68533 3.36358L2.62941 2.2982ZM2.42326 5.11341C2.4136 5.03767 2.4136 4.96103 2.42326 4.88529L0.935295 4.69563C0.909589 4.8973 0.909589 5.10139 0.935295 5.30307L2.42326 5.11341Z" fill="#1A1A1A"/>
                        </svg>
                        <span>Фильтры</span></button>
                </div>
                <div class="filter-popup__welcome">
                    <div class="input-section">
                        <span>Цена</span>
                        <div class="inputs">
                            <input type="text" placeholder="От 64 000 ₽" />
                            <input type="text" placeholder="До 898 632 ₽" />
                        </div>
                    </div>
                    <div class="welcome-item">
                        <span>Категория</span>
                        <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.749998 10L5.25 5.5L0.75 1" stroke="#1A1A1A" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="welcome-item">
                        <span>Назначение</span>
                        <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.749998 10L5.25 5.5L0.75 1" stroke="#1A1A1A" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="welcome-item">
                        <span>Бренд</span>
                        <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.749998 10L5.25 5.5L0.75 1" stroke="#1A1A1A" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                <div class="filter-popup__slide-content">
                    <div class="slide-item">
                        <h3>Категория</h3>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Спортивное оборудование</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Мебель</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Баскетбол</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Бадминтон</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Волейбол</span>
                        </label>
                    </div>
                    <div class="slide-item">
                        <h3>Назначение</h3>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Социально-коммуникативное развитие</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Познавательное развитие</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Речевое развитие</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Физическое развитие</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Групповая комната</span>
                        </label>
                    </div>
                    <div class="slide-item">
                        <h3>Бренд</h3>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Бренд номер один</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Бренд номер два</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Бренд номер три</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Бренд номер четыре</span>
                        </label>
                        <label class="custom-checkbox">
                            <input type="checkbox" />
                            <span class="checkmark">
                                                <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        width="10"
                                                        height="6"
                                                        viewBox="0 0 10 6"
                                                        fill="none"
                                                >
                                                    <path
                                                            d="M8.33268 0.916016L6.08657 3.61135C5.19651 4.67942 4.75148 5.21345 4.16602 5.21345C3.58055 5.21345 3.13552 4.67942 2.24546 3.61135L1.66602 2.91602"
                                                            stroke="#FAFAFA"
                                                            stroke-width="1.5"
                                                            stroke-linecap="round"
                                                    />
                                                </svg>
                                            </span>
                            <span class="checkbox-text">Бренд номер пять</span>
                        </label>
                    </div>
                </div>
                <button class="save-filter">Применить</button>
            </div>
        </div>
    </div>
<?}?>