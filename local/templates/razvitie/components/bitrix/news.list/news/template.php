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
$elCnt = count($arResult["ITEMS"]);
?>
<?$this->SetViewTarget("elCnt");?>
<span><?=$elCnt;?> новостей</span>
<?$this->EndViewTarget();?>
<div class="news_z">
    <div class="container">
        <div class="news_z_block">
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
                    $date = ConvertDateTime($arItem['DATE_CREATE'], "DD.MM.YYYY");
                }
                $rsFile = CFile::GetByID($arItem['PROPERTIES']['AUTHOR_IMG']['VALUE']);
                $arFile = $rsFile->Fetch();
                $class = ($k >= 7) ? " hidd_z" : "";
//            pre($arItem);
            ?>
            <div class="news_z_item load_item<?=$class?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                    <div class="news__new-image-wrapper news__new-image-wrapper--long">
                        <span><?=$date?></span>
                        <img src="<?=$img['SRC']?>" alt="<?=$img['ALT']?>">
                    </div>
                    <div class="news__new-author">
                        <img src="<?= $arFile['SRC']?>" alt="<?= $arFile['ALT']?>">
                        <div>
                            <h4><?=$arItem['PROPERTIES']['AUTHOR_NAME']['VALUE']?></h4>
                            <span>Автор</span>
                        </div>
                    </div>
                    <p class="news__new-desc">
                        <?=$arItem["NAME"]?>
                    </p>
                </a>
            </div>
            <?}?>
        </div>
        <?if ($elCnt > 7){?>
            <a href="javascript:void(0);" class="btn_z mini load-more">Загрузить ещё</a>
        <?}?>
    </div>
</div>