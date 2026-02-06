<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="swiper welcome__swiper">
    <div class="swiper-wrapper">
        <?
        foreach($arResult["ITEMS"] as $arItem){
            $this->AddEditAction($arItem['ID'],$arItem['EDIT_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_DELETE"),array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            if($arItem['DETAIL_PICTURE']){
                $img = $arItem['DETAIL_PICTURE'];
            } else {
                $img = $arItem['PREVIEW_PICTURE'];
            }
        ?>
        <div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="image-container">
                <img src="<?=$img['SRC']?>" alt="<?=$img['ALT']?>"/>
            </div>
            <h1><?=$arItem['PROPERTIES']['TITLE']['~VALUE']['TEXT']?></h1>
            <p><?=$arItem['PROPERTIES']['DOP_TEXT']['~VALUE']['TEXT']?></p>
            <a href="<?=$arItem['PROPERTIES']['LINK']['VALUE']?>">Хочу!</a>
        </div>
        <?}?>
    </div>
    <div class="welcome__swiper-button-wraper">
        <div class="welcome__swiper-prev swiper-btn">
            <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
            >
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
        <div class="welcome__swiper-next swiper-btn">
            <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
            >
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

<div class="leave-a-request">
    <div class="leave-a-request__img-wrapper">
        <img src="<?= SITE_TEMPLATE_PATH ?>/src/assets/images/manager.png" alt=""/>
        <div class="leave-a-request__logo">
            <svg
                    width="53"
                    height="53"
                    viewBox="0 0 53 53"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
            >
                <g clip-path="url(#clip0_510_109635)">
                    <mask
                            id="mask0_510_109635"
                            style="mask-type: luminance"
                            maskUnits="userSpaceOnUse"
                            x="-225"
                            y="-112"
                            width="504"
                            height="291"
                    >
                        <path d="M278.361 -111.176H-224.941V178.754H278.361V-111.176Z" fill="white"/>
                    </mask>
                    <g mask="url(#mask0_510_109635)">
                        <path
                                d="M26.4922 49.1244C26.8041 49.1378 27.1161 49.1485 27.4332 49.1485C39.5938 49.1485 49.4685 39.1674 49.6913 26.7676"
                                stroke="#EC9605"
                                stroke-width="6.96111"
                                stroke-miterlimit="10"
                        />
                        <path
                                d="M4.53516 26.7676C4.75535 39.0601 14.4675 48.9713 26.4839 49.1405"
                                stroke="#F60504"
                                stroke-width="6.96111"
                                stroke-miterlimit="10"
                        />
                        <path
                                d="M49.6189 26.6642V3.65234H26.9336"
                                stroke="#056BE9"
                                stroke-width="6.96111"
                                stroke-miterlimit="10"
                        />
                        <path
                                d="M27.0003 3.63672H4.52734V26.8687"
                                stroke="black"
                                stroke-width="6.96111"
                                stroke-miterlimit="10"
                        />
                    </g>
                </g>
                <defs>
                    <clipPath id="clip0_510_109635">
                        <rect
                                width="52.193"
                                height="51.831"
                                fill="white"
                                transform="translate(0.613281 0.583984)"
                        />
                    </clipPath>
                </defs>
            </svg>
        </div>
    </div>
    <h2>Нужна помощь с заказом?</h2>
    <p>Помогаем учебным учреждениям выгрывать гранты и получать субсидии до 1 млн</p>
    <a href="#" class="request-trigger">Оставить заявку</a>
</div>
<a href="#" class="welcome__btn">Хочу!</a>