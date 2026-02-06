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

<div class="news">
    <span class="news__links-text">ПОЛЕЗНЫЕ ССЫЛКИ</span>
    <div class="news__header">
        <h2>Новости</h2>
        <p>Рассказываем о важном и полезном</p>
    </div>
    <div class="swiper news__swiper">
        <div class="swiper-wrapper">
            <?
            foreach($arResult["ITEMS"] as $k => $arItem){
            $this->AddEditAction($arItem['ID'],$arItem['EDIT_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_DELETE"),array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                if($arItem['DETAIL_PICTURE']){
                    $img = $arItem['DETAIL_PICTURE'];
                } else {
                    $img = $arItem['PREVIEW_PICTURE'];
                }
                if($arItem['ACTIVE_FROM']) {
                    $date = $arItem['ACTIVE_FROM'];
                } else {
                    $date = $arItem['TIMESTAMP_X'];
                }
                $rsFile = CFile::GetByID($arItem['PROPERTIES']['AUTHOR_IMG']['VALUE']);
                $arFile = $rsFile->Fetch();
                $class = ($k % 2 === 0) ? "short" : "long";
            ?>
                <div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                    <div class="news__new-image-wrapper news__new-image-wrapper--<?=$class?>">
                        <span><?=$date?></span>
                        <img src="<?=$img['SRC']?>" alt="<?=$img['ALT']?>"/>
                    </div>
                    <div class="news__new-author">
                        <img src="<?= $arFile['SRC']?>" alt=""/>
                        <div>
                            <h4><?=$arItem['PROPERTIES']['AUTHOR_NAME']['VALUE']?></h4>
                            <span>Автор</span>
                        </div>
                    </div>
                    <p class="news__new-desc">
                        <?=$arItem['NAME']?>
                    </p>
                </a>
            </div>
            <?}?>
        </div>
    </div>
    <div class="news__swiper-button-wraper">
        <div class="news__swiper-prev swiper-btn">
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
        <div class="news__swiper-next swiper-btn">
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
    <a href="/news/" class="news__all-news">Все новости</a>
</div>