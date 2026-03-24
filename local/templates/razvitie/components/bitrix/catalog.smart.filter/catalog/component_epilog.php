<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
/** @var array $arParams */
/** @var CBitrixComponentTemplate $this */
/** @global CMain $APPLICATION */

// Не выводим HTML при AJAX запросах - это ломает JSON ответ
if (isset($_REQUEST['ajax']) && $_REQUEST['ajax'] === 'y') {
    return;
}

CJSCore::Init(array('fx', 'popup', 'ui.fonts.opensans'));

// Собираем выбранные фильтры
$selectedFilters = [];
$closeIconSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="6" viewBox="0 0 6 6" fill="none"><path d="M0.666016 0.666017L5.33268 5.33268M0.666025 5.33268L2.99936 2.99935L5.33269 0.666016" stroke="#1A1A1A" stroke-linecap="round"/></svg>';

if (!empty($arResult["ITEMS"])) {
    foreach ($arResult["ITEMS"] as $propKey => $arItem) {
        // Цена
        if (isset($arItem["PRICE"])) {
            $minValue = $arItem["VALUES"]["MIN"]["HTML_VALUE"];
            $maxValue = $arItem["VALUES"]["MAX"]["HTML_VALUE"];

            if (!empty($minValue)) {
                $selectedFilters[] = [
                    'id' => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                    'label' => 'От ' . number_format($minValue, 0, '', ' ') . ' ₽',
                    'type' => 'price_min'
                ];
            }
            if (!empty($maxValue)) {
                $selectedFilters[] = [
                    'id' => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                    'label' => 'До ' . number_format($maxValue, 0, '', ' ') . ' ₽',
                    'type' => 'price_max'
                ];
            }
        }
        // Свойства с чекбоксами
        elseif (!empty($arItem["VALUES"]) && !isset($arItem["PRICE"])) {
            foreach ($arItem["VALUES"] as $valueKey => $arValue) {
                if (!empty($arValue["CHECKED"])) {
                    $selectedFilters[] = [
                        'id' => $arValue["CONTROL_ID"],
                        'label' => $arValue["VALUE"],
                        'type' => 'checkbox',
                        'property' => $arItem["NAME"]
                    ];
                }
            }
        }
    }
}

$hasSelectedFilters = !empty($selectedFilters);
?>

<?php if ($hasSelectedFilters): ?>
<div id="smart-filter-selected-tags" style="display:none;">
    <?php foreach ($selectedFilters as $filter): ?>
        <button type="button" class="filter-tag" data-control-id="<?= htmlspecialcharsEx($filter['id']) ?>" data-type="<?= htmlspecialcharsEx($filter['type']) ?>">
            <?= htmlspecialcharsEx($filter['label']) ?>
            <?= $closeIconSvg ?>
        </button>
    <?php endforeach; ?>
    <button type="button" class="filter-tag reset-all" id="reset-all-filters">Сбросить все</button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var tagsContainer = document.getElementById('smart-filter-selected-tags');
    var targetContainer = document.getElementById('active-filters-list');
    var filterTitle = document.querySelector('.main-category__filter-title');

    if (tagsContainer && targetContainer) {
        // Перемещаем теги в целевой контейнер
        while (tagsContainer.firstChild) {
            targetContainer.appendChild(tagsContainer.firstChild);
        }
        tagsContainer.remove();

        // Показываем заголовок "Фильтры"
        // if (filterTitle) {
        //     filterTitle.classList.remove('hide');
        // }

        // Обработчики клика для удаления фильтров
        var filterTags = targetContainer.querySelectorAll('.filter-tag:not(.reset-all)');
        filterTags.forEach(function(tag) {
            tag.addEventListener('click', function() {
                var controlId = this.getAttribute('data-control-id');
                var type = this.getAttribute('data-type');

                if (type === 'price_min' || type === 'price_max') {
                    // Очищаем поле цены
                    var input = document.getElementById(controlId);
                    if (input) {
                        input.value = '';
                        smartFilter.keyup(input);
                    }
                } else {
                    // Снимаем чекбокс
                    var checkbox = document.getElementById(controlId);
                    if (checkbox) {
                        checkbox.checked = false;
                        smartFilter.click(checkbox);
                    }
                }

                // Удаляем тег
                this.remove();

                // Если не осталось тегов, скрываем заголовок и кнопку сброса
                var remainingTags = targetContainer.querySelectorAll('.filter-tag:not(.reset-all)');
                if (remainingTags.length === 0) {
                    var resetBtn = document.getElementById('reset-all-filters');
                    if (resetBtn) resetBtn.remove();
                    if (filterTitle) filterTitle.classList.add('hide');
                }
            });
        });

        // Обработчик "Сбросить все"
        var resetBtn = document.getElementById('reset-all-filters');
        if (resetBtn) {
            resetBtn.addEventListener('click', function() {
                // Ищем кнопку del_filter или переходим по URL сброса
                var delFilterBtn = document.getElementById('del_filter');
                if (delFilterBtn) {
                    delFilterBtn.click();
                } else {
                    // Перезагружаем страницу без параметров фильтра
                    var url = window.location.pathname;
                    window.location.href = url;
                }
            });
        }
    }
});
</script>
<?php endif; ?>
