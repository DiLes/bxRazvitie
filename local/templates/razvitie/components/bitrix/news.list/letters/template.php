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
<div class="letters">
    <div class="letters__header">
        <h2>
            Благодарственные
            <br/>
            письма
        </h2>
        <p>Слова благодарности от наших клиентов</p>
    </div>
    <div class="swiper letters__swiper">
        <div class="swiper-wrapper">
            <?
            $count = count($arResult["ITEMS"]);
            foreach($arResult["ITEMS"] as $k => $arItem){
                // Открытие нового слайда каждые 6 элементов
                if ($k % 6 == 0) {
                    if ($k > 0) echo '</div>'; // Закрываем предыдущий слайд
                    echo '<div class="swiper-slide">';
                }

                $this->AddEditAction($arItem['ID'],$arItem['EDIT_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_DELETE"),array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

                $img = $arItem['DETAIL_PICTURE'] ?: $arItem['PREVIEW_PICTURE'];
                $date = $arItem['ACTIVE_FROM'] ?: $arItem['TIMESTAMP_X'];
                ?>

                <a href="#" class="letters__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="letters__image-wrapper">
                        <img src="<?=$img['SRC']?>" alt=""/>
                    </div>
                    <div>
                        <p><?=$arItem['NAME']?></p>
                        <span><?=$date?></span>
                    </div>
                </a>

            <? } // Конец foreach ?>

            <? // Закрываем последний открытый слайд
            if ($count > 0) echo '</div>';
            ?>
        </div>
    </div>
    <div class="letters__swiper-button-wraper">
        <div class="letters__swiper-prev swiper-btn">
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
        <div class="letters__swiper-next swiper-btn">
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