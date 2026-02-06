<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arViewModeList = array('LIST', 'LINE', 'TEXT', 'TILE');

$columnCountList = array('1', '2', '3', '4', '6', '12');

$arDefaultParams = array(
	'VIEW_MODE' => 'LIST',
	'SHOW_PARENT_NAME' => 'Y',
	'HIDE_SECTION_NAME' => 'N',
	'LIST_COLUMNS_COUNT' => '6'
);

$arParams = array_merge($arDefaultParams, $arParams);

if (!in_array($arParams['VIEW_MODE'], $arViewModeList))
	$arParams['VIEW_MODE'] = 'LIST';
if ('N' != $arParams['SHOW_PARENT_NAME'])
	$arParams['SHOW_PARENT_NAME'] = 'Y';
if ('Y' != $arParams['HIDE_SECTION_NAME'])
	$arParams['HIDE_SECTION_NAME'] = 'N';
if (!in_array($arParams['LIST_COLUMNS_COUNT'], $columnCountList))
	$arParams['LIST_COLUMNS_COUNT'] = '6';

$arResult['VIEW_MODE_LIST'] = $arViewModeList;

if (0 < $arResult['SECTIONS_COUNT'])
{
	if ('LIST' != $arParams['VIEW_MODE'])
	{
		$boolClear = false;
		$arNewSections = array();
		foreach ($arResult['SECTIONS'] as &$arOneSection)
		{
			if (1 < $arOneSection['RELATIVE_DEPTH_LEVEL'])
			{
				$boolClear = true;
				continue;
			}
			$arNewSections[] = $arOneSection;
		}
		unset($arOneSection);
		if ($boolClear)
		{
            //pre($arNewSections);
			$arResult['SECTIONS'] = $arNewSections;
			$arResult['SECTIONS_COUNT'] = count($arNewSections);
            /*if (!isset($arResult['ALL_ELEMENTS_CNT'])) {
                $arResult['ALL_ELEMENTS_CNT'] = 0;
            }
            $arResult['ALL_ELEMENTS_CNT'] += (int)$arNewSections['ELEMENT_CNT'];*/
		}
		unset($arNewSections);
	}
}

if (0 < $arResult['SECTIONS_COUNT'])
{
	$boolPicture = false;
	$boolDescr = false;
	$arSelect = array('ID');
	$arMap = array();
	if ('LINE' == $arParams['VIEW_MODE'] || 'TILE' == $arParams['VIEW_MODE'])
	{
		reset($arResult['SECTIONS']);
		$arCurrent = current($arResult['SECTIONS']);
		if (!isset($arCurrent['PICTURE']))
		{
			$boolPicture = true;
			$arSelect[] = 'PICTURE';
		}
		if ('LINE' == $arParams['VIEW_MODE'] && !array_key_exists('DESCRIPTION', $arCurrent))
		{
			$boolDescr = true;
			$arSelect[] = 'DESCRIPTION';
			$arSelect[] = 'DESCRIPTION_TYPE';
		}
	}
	if ($boolPicture || $boolDescr)
	{
		foreach ($arResult['SECTIONS'] as $key => $arSection)
		{
			$arMap[$arSection['ID']] = $key;
		}
		$rsSections = CIBlockSection::GetList(array(), array('ID' => array_keys($arMap)), false, $arSelect);
		while ($arSection = $rsSections->GetNext())
		{
			if (!isset($arMap[$arSection['ID']]))
				continue;
			$key = $arMap[$arSection['ID']];
			if ($boolPicture)
			{
				$arSection['PICTURE'] = intval($arSection['PICTURE']);
				$arSection['PICTURE'] = (0 < $arSection['PICTURE'] ? CFile::GetFileArray($arSection['PICTURE']) : false);
				$arResult['SECTIONS'][$key]['PICTURE'] = $arSection['PICTURE'];
				$arResult['SECTIONS'][$key]['~PICTURE'] = $arSection['~PICTURE'];
			}
			if ($boolDescr)
			{
				$arResult['SECTIONS'][$key]['DESCRIPTION'] = $arSection['DESCRIPTION'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION'] = $arSection['~DESCRIPTION'];
				$arResult['SECTIONS'][$key]['DESCRIPTION_TYPE'] = $arSection['DESCRIPTION_TYPE'];
				$arResult['SECTIONS'][$key]['~DESCRIPTION_TYPE'] = $arSection['~DESCRIPTION_TYPE'];
			}
		}
	}
}


/*
$sectionsById = [];
$sectionsTree = [];

// Инициализируем массив с разделами и CHILDREN
foreach ($arResult['SECTIONS'] as &$section) {
    $section['CHILDREN'] = [];
    $sectionsById[$section['ID']] = &$section;
}
unset($section);

// Строим дерево
foreach ($arResult['SECTIONS'] as &$section) {
    if ($section['DEPTH_LEVEL'] == 1 || empty($section['IBLOCK_SECTION_ID'])) {
        // Верхний уровень
        $sectionsTree[] = &$section;
    } else {
        // Вложенный раздел
        if (isset($sectionsById[$section['IBLOCK_SECTION_ID']])) {
            $sectionsById[$section['IBLOCK_SECTION_ID']]['CHILDREN'][] = &$section;
        }
    }
}
unset($section);

// Теперь $sectionsTree содержит все разделы, вложенные до 4 уровней
$arResult['SECTIONS_TREE'] = $sectionsTree;

//pre($arResult['SECTIONS_TREE']);
*/

/*
$newResult = [];
$arResult["NEW"] = [];

//pre($arResult);
foreach ($arResult["SECTIONS"] as $key => $arItem)
{
    if($arItem["DEPTH_LEVEL"] == 1)
    {
        $f = $key;
        $newResult[$key] = $arItem;
    }elseif($arItem["DEPTH_LEVEL"] == 2)
    {
        $s = $key;
        $newResult[$f]["CHILD"][$key] = $arItem;
    }elseif($arItem["DEPTH_LEVEL"] == 3)
    {
        $n = $key;
        $newResult[$f]["BIG_MENU"] = true;
        $newResult[$f]["CHILD"][$s]["CHILD"][$key] = $arItem;
    }
    elseif($arItem["DEPTH_LEVEL"] == 4)
    {
        $newResult[$f]["CHILD"][$s]["CHILD"][$n]['CHILD'][$key] = $arItem;
    }
}
$arResult["NEW"] = $newResult;
unset($newResult);
*/

$sectionsById = [];
$newResult = [];
$arResult['ALL_ELEMENTS_CNT'] = 0;

// Подготовка: сохраняем разделы по ID и инициализируем CHILD
foreach ($arResult["SECTIONS"] as &$arItem) {
    $arItem["CHILD"] = [];

    // Складываем количество элементов
    if (!empty($arItem['ELEMENT_CNT'])) {
        $arResult['ALL_ELEMENTS_CNT'] += (int)$arItem['ELEMENT_CNT'];
    }

    $sectionsById[$arItem["ID"]] = &$arItem;

}
unset($arItem);

// Построение дерева
foreach ($arResult["SECTIONS"] as &$arItem) {
    if ($arItem["DEPTH_LEVEL"] == 2) {
        $newResult[$arItem["ID"]] = &$arItem;
    } else {
        $parentId = $arItem["IBLOCK_SECTION_ID"];
        if (isset($sectionsById[$parentId])) {
            $sectionsById[$parentId]["CHILD"][$arItem["ID"]] = &$arItem;
        }
    }
}

// Сохраняем итоговую структуру
$arResult["SECTIONS_TREE"] = $newResult;
unset($arItem, $newResult);

