<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

if (empty($arResult['SEARCH'])) {
    return;
}

// Разделяем на разделы и товары
$sections = [];
$products = [];

foreach ($arResult['SEARCH'] as $arItem) {
    if (!empty($arItem['IS_SECTION'])) {
        $sections[] = $arItem;
    } else {
        $products[] = $arItem;
    }
}

$arrowSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="6" viewBox="0 0 6 6" fill="none">
    <path d="M2.25 4.5L3.75 3L2.25 1.5" stroke="#9AB1CC" stroke-linecap="round" stroke-linejoin="round"/>
</svg>';
?>

<div class="search-result__top">
    <?php if (!empty($sections)): ?>
        <?php foreach (array_slice($sections, 0, 3) as $arSection): ?>
            <a href="<?= $arSection['URL'] ?>">
                <span>
                    <?php if (!empty($arSection['PARENT_SECTION_NAME'])): ?>
                        <?= htmlspecialcharsEx($arSection['PARENT_SECTION_NAME']) ?>
                        <?= $arrowSvg ?>
                    <?php endif; ?>
                </span>
                <h3><?= $arSection['NAME'] ?></h3>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (empty($sections) && !empty($products)): ?>
        <?php
        // Показываем уникальные разделы из товаров
        $shownSections = [];
        foreach (array_slice($products, 0, 2) as $arProduct):
            if (!empty($arProduct['SECTION_NAME']) && !in_array($arProduct['SECTION_NAME'], $shownSections)):
                $shownSections[] = $arProduct['SECTION_NAME'];
        ?>
            <a href="<?= $arProduct['URL'] ?>">
                <span>
                    <?php if (!empty($arProduct['PARENT_SECTION_NAME'])): ?>
                        <?= htmlspecialcharsEx($arProduct['PARENT_SECTION_NAME']) ?>
                        <?= $arrowSvg ?>
                    <?php endif; ?>
                </span>
                <h3><?= htmlspecialcharsEx($arProduct['SECTION_NAME']) ?></h3>
            </a>
        <?php
            endif;
        endforeach;
        ?>
    <?php endif; ?>
</div>

<?php if (!empty($products)): ?>
<hr />
<div class="search-result__bottom">
    <?php foreach (array_slice($products, 0, 4) as $arProduct): ?>
        <a href="<?= $arProduct['URL'] ?>">
            <div class="row">
                <div class="image-wrapper">
                    <?php if (!empty($arProduct['IMAGE'])): ?>
                        <img src="<?= $arProduct['IMAGE'] ?>" alt="<?= htmlspecialcharsEx($arProduct['NAME']) ?>" />
                    <?php endif; ?>
                </div>
                <div class="col">
                    <h3><?= $arProduct['NAME'] ?></h3>
                    <span>
                        <?php if (!empty($arProduct['PARENT_SECTION_NAME'])): ?>
                            <?= htmlspecialcharsEx($arProduct['PARENT_SECTION_NAME']) ?>
                            <?= $arrowSvg ?>
                        <?php endif; ?>
                        <?php if (!empty($arProduct['SECTION_NAME'])): ?>
                            <?= htmlspecialcharsEx($arProduct['SECTION_NAME']) ?>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            <?php if (!empty($arProduct['PRICE_FORMATTED'])): ?>
                <span class="price"><?= $arProduct['PRICE_FORMATTED'] ?></span>
            <?php endif; ?>
        </a>
    <?php endforeach; ?>
</div>
<?php endif; ?>
