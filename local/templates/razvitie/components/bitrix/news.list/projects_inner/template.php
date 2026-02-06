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

//$elCnt = count($arResult["ITEMS"]);
$elCnt = $arResult['NAV_RESULT']->NavRecordCount;
$type = 'project';
$plural = plural($elCnt, $type);

?>
<?$this->SetViewTarget("elCnt");?>
<span><?=$plural;?></span>
<?$this->EndViewTarget();?>

<div class="projects_z">
    <div class="container">
        <div class="projects_z_block">
            <?foreach ($arResult["ITEMS"] as $k => $arItem){
                $this->AddEditAction($arItem['ID'],$arItem['EDIT_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_DELETE"),array("CONFIRM" =>GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                $class = ($k >= 6) ? " hidd_z" : "";
                ?>
            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="projects_z_item load_item<?=$class?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="left" style="--img-url: url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>')">
                    <div class="item">
                        <svg
                                width="46"
                                height="46"
                                viewBox="0 0 46 46"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                        >
                            <rect width="46" height="46" rx="15" fill="#F4F6F8" />
                            <path
                                    d="M23 33C28.5228 33 33 28.5228 33 23C33 17.4772 28.5228 13 23 13C17.4772 13 13 17.4772 13 23C13 28.5228 17.4772 33 23 33Z"
                                    stroke="#056BE9"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                            />
                            <path
                                    d="M23 17V23L27 25"
                                    stroke="#056BE9"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                            />
                        </svg>
                        <div class="deadlines_sp">
                            <span>СРОКИ</span>
                            <p><?=$arItem['PROPERTIES']['DEADLINES']['VALUE']?></p>
                        </div>
                    </div>
                    <div class="item">
                        <b>₽</b>
                        <div class="deadlines_sp">
                            <span>БЮДЖЕТ</span>
                            <p><?=$arItem['PROPERTIES']['BUDGET']['VALUE']?></p>
                        </div>
                    </div>
                </div>
                <div class="right">
                        <span>
                            <?=$arItem['PROPERTIES']['CITY']['~VALUE']['TEXT']?>
                        </span>
                    <h3><?=$arItem['NAME']?></h3>
                    <p><?=$arItem['PREVIEW_TEXT']?></p>
                </div>
            </a>
            <?}?>
        </div>
        <?if ($elCnt > 6){?>
            <a href="javascript:void(0);" class="btn_z mini load-more">Загрузить ещё</a>
        <?}?>
    </div>
</div>