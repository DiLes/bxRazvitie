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
$elCnt = $arResult['NAV_RESULT']->NavRecordCount;
$type = 'review';
$plural = plural($elCnt, $type);
?>
<?$this->SetViewTarget("elCnt");?>
<span><?=$plural?></span>
<?$this->EndViewTarget();?>
<div class="container reviews_z">
    <div class="reviews_section">
        <div class="reviews_block">
            <? foreach ($arResult["ITEMS"] as $k => $arItem):
                $this->AddEditAction($arItem['ID'],$arItem['EDIT_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),["CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')]);

                $pic = $arItem['DETAIL_PICTURE'] ?: $arItem['PREVIEW_PICTURE'];
                $img = CFile::GetPath($arItem['PROPERTIES']['IMG']['VALUE']);
                $videoBG = CFile::GetPath($arItem['PROPERTIES']['VIDEO_BG']['VALUE']);
                $jobTitle = $arItem['PROPERTIES']['JOB_TITLE']['VALUE'];
                $fio = $arItem['PROPERTIES']['FIO']['VALUE'];
                $institution = $arItem['PROPERTIES']['INSTITUTION']['VALUE'];
                $play = ($arItem['PROPERTIES']['VIDEO']['VALUE']) ? $arItem['PROPERTIES']['VIDEO']['VALUE']['path'] : $arItem['PROPERTIES']['VIDEO_YOUTUBE']['VALUE'];
                $hide = ($k >= 8) ? " hidd_z" : "";


    //            pre($arItem['PROPERTIES']['VIDEO']['VALUE']['path']);
                ?>
                <? if ($arItem['PROPERTIES']['TYPE']['VALUE_XML_ID'] === 'video'): ?>
                    <div class="reviews__item reviews__item--video load_item <?=$hide;?>"
                         id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
                         style="--img: url(<?= $videoBG ?: $pic['SRC'] ?>)">

                        <div class="row">
                            <a href="<?=$play?>" class="play-btn video-play glightbox">
                                <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="15"
                                        height="16"
                                        viewBox="0 0 15 16"
                                        fill="none"
                                >
                                    <path
                                            d="M9.05263 3.40857C11.6952 4.91531 13.0165 5.66868 13.4599 6.65225C13.8467 7.51015 13.8467 8.48985 13.4599 9.34775C13.0165 10.3313 11.6952 11.0847 9.05263 12.5914C6.41005 14.0982 5.08876 14.8515 4.00454 14.739C3.05884 14.6408 2.19973 14.151 1.6408 13.3912C1 12.5202 1 11.0135 1 8C1 4.98652 1 3.47978 1.6408 2.60875C2.19973 1.84901 3.05884 1.35916 4.00454 1.261C5.08876 1.14846 6.41005 1.90183 9.05263 3.40857Z"
                                            fill="#1A1A1A"
                                            stroke="#1A1A1A"
                                            stroke-width="1.5"
                                    />
                                </svg>
                            </a>
                            <span>Смотреть отзыв</span>
                        </div>

                        <div class="col">
                            <? if ($fio): ?><h4><?= $fio ?></h4><? endif ?>
                            <? if ($jobTitle): ?><p><?= $jobTitle ?></p><? endif ?>
                        </div>

                        <div class="shadow-1"></div>
                        <div class="shadow-2"></div>
                    </div>
                <? else: ?>
                    <div class="reviews__item reviews__item--text load_item <?=$hide;?>"
                         id="<?= $this->GetEditAreaId($arItem['ID']); ?>">

                        <span class="apos">“</span>
                        <h3><?= $arItem['NAME'] ?></h3>
                        <p><?=($arItem['PREVIEW_TEXT']) ? : $arItem['DETAIL_TEXT'] ?></p>

                        <div class="reviews__author">
                            <? if ($img): ?>
                                <div><img src="<?= $img ?>" alt=""></div>
                            <? else: ?>
                                <div><?= mb_substr($institution, 0, 1, 'UTF-8') ?></div>
                            <? endif ?>

                            <? if ($institution): ?>
                                <span><?= $institution ?></span>
                            <? endif ?>
                        </div>
                    </div>
                <? endif ?>
            <? endforeach; ?>
        </div>
        <?if ($elCnt > 6){?>
            <a href="#" class="btn_z load-more">Загрузить ещё</a>
        <?}?>

        <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
            <div class="reviews__pager">
                <?= $arResult["NAV_STRING"] ?>
            </div>
        <? endif ?>
    </div>
</div>