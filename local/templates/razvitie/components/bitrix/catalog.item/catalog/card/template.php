<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Sale;

/**
 * @global CMain $APPLICATION
 * @global $USER
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array|null $price
 * @var float|int|null $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */

//pre($minOffer);
//pre($actualItem);
//$item['OFFERS'][$item['OFFERS_SELECTED']];
//pre($item['OFFERS'][$item['OFFERS_SELECTED']]);
//pre($item["PROPERTIES"]["ARTNUMBER"]["VALUE"]);
$isAvailable = false;
if ($item["CATALOG_QUANTITY"] > 0 || $actualItem["CATALOG_QUANTITY"] > 0) {
    $isAvailable = true;
}
$isComapre = false;
$IBLOCK_ID = 2;
if (isset($_SESSION["CATALOG_COMPARE_LIST"][$IBLOCK_ID]["ITEMS"][$item["ID"]])){
    $isComapre = true;
}
$isHit = $item["PROPERTIES"]["HIT"]["VALUE_XML_ID"] === "Y";
$inBasket = false;
$productId = $actualItem["ID"];
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
//pre($item["PROPERTIES"]["vote_count"]["VALUE"]);
//pre($item["PROPERTIES"]["vote_sum"]["VALUE"]);
//pre($item["PROPERTIES"]["rating"]["VALUE"]);
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();

$inFavs = false;
$favs = $arUser["UF_FAVORITES"];
if (is_string($favs)) {
    $decoded = json_decode($favs, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        $favs = $decoded;
    }
    if(in_array($item["ID"], $favs)){
        $inFavs = true;
    }
}
//pre($inFavs);

?>


    <div class="product-card__top">
        <?if (!empty($morePhoto)){?>
        <div class="swiper product-card__image-swiper">
            <div class="swiper-wrapper">
                <?foreach ($morePhoto as $key => $photo){?>
                    <div class="swiper-slide">
                        <img src="<?=$photo["SRC"]?>" alt="" />
                    </div>
                <?}?>
            </div>
        </div>
        <?}?>
        <div class="more-actions">
            <?if ($item["PROPERTIES"]["rating"]["VALUE"] > 0){?>
            <div class="stars">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="14"
                        height="14"
                        viewBox="0 0 14 14"
                        fill="none"
                >
                    <path
                            d="M6.37165 2.43766C6.62844 1.91744 7.37026 1.91744 7.62704 2.43766L8.63914 4.48805C8.74102 4.69444 8.93784 4.83756 9.16559 4.87085L11.43 5.20183C12.004 5.28572 12.2327 5.99121 11.8172 6.39592L10.1798 7.99079C10.0147 8.15161 9.93929 8.3834 9.97826 8.61057L10.3645 10.8629C10.4626 11.4347 9.86235 11.8708 9.34881 11.6007L7.32517 10.5365C7.1212 10.4293 6.8775 10.4293 6.67353 10.5365L4.64989 11.6007C4.13635 11.8708 3.53607 11.4347 3.63415 10.8629L4.02044 8.61057C4.05941 8.3834 3.98404 8.15161 3.81893 7.99079L2.18149 6.39592C1.76598 5.99121 1.99472 5.28572 2.56866 5.20183L4.83311 4.87085C5.06085 4.83756 5.25768 4.69444 5.35956 4.48805L6.37165 2.43766Z"
                            stroke="#033B80"
                            stroke-width="1.16667"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                    />
                </svg>
                <span><?=$item["PROPERTIES"]["rating"]["VALUE"]?></span>
            </div>
            <?}?>
            <div class="product-card__pagination"></div>
        </div>
        <div class="product-info">
            <?if ($price["PERCENT"] > 0){?>
            <span class="product-card-percent">-<?=$price["PERCENT"]?>%</span>
            <?}?>
            <?if ($isHit){?>
            <span class="product-card-hit">Хит</span>
            <?}?>
        </div>
        <div class="action-buttons">
            <button class="heart-btn-featured"
                    data-item="<?=$actualItem["ID"]?>"
                    data-action="favorite"
                    data-iblock="<?= $item["IBLOCK_ID"] ?>">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="17"
                        height="16"
                        viewBox="0 0 17 16"
                        fill="none"
                >
                    <path
                            d="M14.9043 2.11734C13.1687 0.347437 11.159 1.0939 9.91457 1.88329C9.21142 2.32932 8.23738 2.32932 7.53423 1.88329C6.28981 1.09391 4.28009 0.347456 2.54454 2.11734C-1.57539 6.31879 5.48994 14.4149 8.72442 14.4149C11.9589 14.4149 19.0242 6.31879 14.9043 2.11734Z"
                            stroke="#033B80"
                            stroke-width="1.48707"
                            stroke-linecap="round"
                    />
                </svg>
            </button>
            <button class="compare__btn__icon<?=($isComapre)?(' active'):('');?>"
                    data-item="<?=$actualItem["ID"]?>"
                    data-action="compare"
                    data-iblock="<?= $item["IBLOCK_ID"] ?>">
                <span><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/compare_little_ic.svg" alt=""></span>
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="19"
                        height="19"
                        viewBox="0 0 19 19"
                        fill="none"
                >
                    <path
                            d="M13.7383 15.1758V7.98828"
                            stroke="#033B80"
                            stroke-width="1.4375"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                    />
                    <path
                            d="M9.42578 15.1758V3.67578"
                            stroke="#033B80"
                            stroke-width="1.4375"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                    />
                    <path
                            d="M5.11328 15.1758V10.8633"
                            stroke="#033B80"
                            stroke-width="1.4375"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                    />
                </svg>
            </button>
        </div>
    </div>
    <div class="product-card__bottom">
        <div class="product-card__bottom_swiper_item">
            <div class="top-section">
                <?if ($isAvailable){?>
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
                <?}else{?>
                <div class="badge-red">
                    <svg
                            width="4"
                            height="5"
                            viewBox="0 0 4 5"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                    >
                        <rect y="0.5" width="4" height="4" rx="1" fill="#E73939" />
                    </svg>
                    <span>Нет в наличии</span>
                </div>
                <?}?>
                <?if ($actualItem["PROPERTIES"]["ARTNUMBER"]["VALUE"]){?>
                    <div class="art">арт. <?=$actualItem["PROPERTIES"]["ARTNUMBER"]["VALUE"]?></div>
                <?}?>
            </div>
            <a href="<?=$item["DETAIL_PAGE_URL"]?>">
                <h3 class="title"><?=$item["NAME"]?></h3>
            </a>
            <div class="price">
                <span class="new-price"><?=$price["PRINT_PRICE"]?></span>
                <span class="old-price"><?=$price["PRINT_BASE_PRICE"]?></span>
            </div>
            <div class="bottom-section">
                <a href="javascript:void(0);" class="buy-btn one_buy_click-trigger" data-item="<?=$actualItem["ID"]?>">Купить в 1 клик</a>
                <a href="javascript:void(0);" class="korzina-btn<?=($inBasket)?(' success'):('');?>" data-item="<?=$actualItem["ID"]?>">
                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/buy.svg" alt="" />
                </a>
            </div>
        </div>
    </div>