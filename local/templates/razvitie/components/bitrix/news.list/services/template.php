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
<span><?=$elCnt;?> услуг</span>
<?$this->EndViewTarget();?>
<div class="services_z">
    <div class="container">

        <?php
        // Разделяем элементы
        $topItems = array_slice($arResult["ITEMS"], 0, 5);
        $bottomItems = array_slice($arResult["ITEMS"], 5, 3);
        ?>

        <div class="our-services__list">
            <?foreach ($topItems as $arItem){?>
                <?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), [
                    "CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')
                ]);
                $bg = CFile::GetPath($arItem["PROPERTIES"]["BG"]["VALUE"]);
                ?>
                <div class="list-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" <?=(!empty($bg))?('style="background: url('.$bg.');"'):('');?>>
                    <h3><?=$arItem["NAME"]?></h3>
                    <p><?=$arItem["PREVIEW_TEXT"]?></p>
                    <div class="item-bottom">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <svg class="btn-icon" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="23" cy="23" r="23" fill="#F4F6F8"></circle>
                                <path d="M17.9688 23H28.0312" stroke="#056BE9" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M23 17.9688L28.0312 23L23 28.0312" stroke="#056BE9" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                        <?if (!empty($arItem["ICON"])){?>
                            <?=$arItem["~ICON"];?>
                        <?}?>
                    </div>
                </div>
            <?}?>
        </div>

        <div class="our_services_lists_bottom">
            <?foreach ($bottomItems as $arItem){?>
                <?$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), [
                    "CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')
                ]);?>
                <div class="list-item w_3" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <h3><?=$arItem["NAME"]?></h3>
                    <p><?=$arItem["PREVIEW_TEXT"]?></p>
                    <div class="item-bottom">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <svg class="btn-icon" width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="23" cy="23" r="23" fill="#F4F6F8"></circle>
                                <path d="M17.9688 23H28.0312" stroke="#056BE9" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M23 17.9688L28.0312 23L23 28.0312" stroke="#056BE9" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                        <?if (!empty($arItem["ICON"])){?>
                            <?=$arItem["~ICON"];?>
                        <?}?>
                    </div>
                </div>
            <?}?>
        </div>

    </div>
</div>
