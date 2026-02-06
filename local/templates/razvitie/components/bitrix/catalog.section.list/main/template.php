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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
//pre($arResult['ALL_ELEMENTS_CNT']);

// Находим основные разделы по их кодам
$mainSections = [];
foreach ($arResult['SECTIONS_TREE'] as $section) {
    if (in_array($section['CODE'], ['dlya_sadov', 'dlya_shkol', 'dlya_do'])) {
        $mainSections[$section['CODE']] = $section;
    }
}

//pre($mainSections["dlya_sadov"]);
?>
<div class="categories__top">
    <!-- Первый блок - Для садов -->
    <?php if (!empty($mainSections['dlya_sadov'])): ?>
        <div class="categories__item categories__item--first" id="<?=$this->GetEditAreaId($mainSections['dlya_sadov']['ID']);?>">
            <img src="<?= $mainSections['dlya_sadov']['PICTURE']['SRC'] ?>" alt="" />
            <?php if(!empty($mainSections['dlya_sadov']['CHILD'])): ?>
                <div class="categories__item-list">
                    <?php
                    $children = array_slice($mainSections['dlya_sadov']['CHILD'], 0, 10);
                    foreach ($children as $child): ?>
                        <a href="<?= $child['SECTION_PAGE_URL'] ?>"><?= $child['NAME'] ?></a>
                    <?php endforeach; ?>
                    <?php if (count($mainSections['dlya_sadov']['CHILD']) > 10): ?>
                        <a href="<?= $mainSections['dlya_sadov']['SECTION_PAGE_URL'] ?>">+<?= count($mainSections['dlya_sadov']['CHILD']) - 10 ?></a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <p>Для садов</p>
        </div>
    <?php endif; ?>

    <div class="col">
        <!-- Второй блок - Для школ -->
        <?php if (!empty($mainSections['dlya_shkol'])): ?>
            <div class="categories__item categories__item--second" id="<?=$this->GetEditAreaId($mainSections['dlya_shkol']['ID']);?>">
                <img src="<?= $mainSections['dlya_shkol']['PICTURE']['SRC'] ?>" alt="" />
                <div class="shadow"></div>
                <?php if(!empty($mainSections['dlya_shkol']['CHILD'])): ?>
                    <div class="categories__item-list">
                        <?php
                        $children = array_slice($mainSections['dlya_shkol']['CHILD'], 0, 5);
                        foreach ($children as $child): ?>
                            <a href="<?= $child['SECTION_PAGE_URL'] ?>"><?= $child['NAME'] ?></a>
                        <?php endforeach; ?>
                        <?php if (count($mainSections['dlya_shkol']['CHILD']) > 5): ?>
                            <a href="<?= $mainSections['dlya_shkol']['SECTION_PAGE_URL'] ?>">+<?= count($mainSections['dlya_shkol']['CHILD']) - 5 ?></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <p>Для школ</p>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Третий блок - Для ДО -->
            <?php if (!empty($mainSections['dlya_do'])): ?>
                <div class="categories__item categories__item--third" id="<?=$this->GetEditAreaId($mainSections['dlya_do']['ID']);?>">
                    <img src="<?= $mainSections['dlya_do']['PICTURE']['SRC'] ?>" alt="" />
                    <div class="shadow"></div>
                    <?php if(!empty($mainSections['dlya_do']['CHILD'])): ?>
                        <div class="categories__item-list">
                            <?php
                            $children = array_slice($mainSections['dlya_do']['CHILD'], 0, 4);
                            foreach ($children as $child): ?>
                                <a href="<?= $child['SECTION_PAGE_URL'] ?>"><?= $child['NAME'] ?></a>
                            <?php endforeach; ?>
                            <?php if (count($mainSections['dlya_do']['CHILD']) > 4): ?>
                                <a href="<?= $mainSections['dlya_do']['SECTION_PAGE_URL'] ?>">+<?= count($mainSections['dlya_do']['CHILD']) - 4 ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <p>Для ДО</p>
                </div>
            <?php endif; ?>

            <!-- Блок "Больше категорий" -->
            <a href="/catalog/" class="categories__item categories__item--four">
                <span>+<?= $arResult['ALL_ELEMENTS_CNT'] -
                    (!empty($mainSections['dlya_sadov']['CHILD']) ? count($mainSections['dlya_sadov']['CHILD']) : 0) -
                    (!empty($mainSections['dlya_shkol']['CHILD']) ? count($mainSections['dlya_shkol']['CHILD']) : 0) -
                    (!empty($mainSections['dlya_do']['CHILD']) ? count($mainSections['dlya_do']['CHILD']) : 0) ?> категорий</span>
                <div class="row">
                    <p>Больше категорий в каталоге</p>
                    <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle opacity="0.1" cx="32" cy="32.0009" r="31.5" transform="rotate(45 32 32.0009)" stroke="white"/>
                        <path d="M27.0508 27.0527L36.9503 36.9522" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M36.9492 27.0527V36.9522H27.0497" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </a>
        </div>
    </div>
</div>