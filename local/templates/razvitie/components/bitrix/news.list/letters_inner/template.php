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
$type = 'docs';
$plural = plural($elCnt, $type);

?>
<?$this->SetViewTarget("elCnt");?>
<span><?=$plural;?></span>
<?$this->EndViewTarget();?>

<div class="container white doc_con">
    <div class="doc_block">
        <?
        foreach($arResult["ITEMS"] as $k => $arItem){
            $this->AddEditAction($arItem['ID'],$arItem['EDIT_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_DELETE"),array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $img = $arItem['DETAIL_PICTURE'] ?: $arItem['PREVIEW_PICTURE'];
            $date = $arItem['ACTIVE_FROM'] ?: $arItem['TIMESTAMP_X'];
            $hide = ($k >= 9) ? " hidd_z" : "";
        ?>
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="doc_item load_item letters__item<?=$hide;?>">
                <div class="doc_item_img">
                    <img src="<?=$img['SRC']?>" alt="<?=$img['ALT']?>">
                </div>
                <div class="doc_item_content">
                    <h5><?=$arItem['NAME']?></h5>
                    <span><?=$date?></span>
                </div>
            </a>
        <?}?>
    </div>
    <?if ($elCnt > 9){?>
        <a href="#" class="btn_z mini load-more">Загрузить ещё</a>
    <?}?>
</div>
