<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
$aMenuLinksExt = array();
$menuLinksExt = array();

if(CModule::IncludeModule('iblock'))
{
	$arFilter = array(
		"TYPE" => "catalog",
		"SITE_ID" => SITE_ID,
	);

	$dbIBlock = CIBlock::GetList(array('SORT' => 'ASC', 'ID' => 'ASC'), $arFilter);
	$dbIBlock = new CIBlockResult($dbIBlock);

	if ($arIBlock = $dbIBlock->GetNext())
	{

		if(defined("BX_COMP_MANAGED_CACHE"))
			$GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_".$arIBlock["ID"]);


		/*$sections = CIBlockSection::GetList(
            ["SORT" => "ASC"],
            ["IBLOCK_ID" => $arIBlock["ID"], "DEPTH_LEVEL" => false, "GLOBAL_ACTIVE" => "Y"],
            false,
            ["UF_SHORT_NAME"]
        );
        while ($section = $sections->GetNext()) {

            $menuLinksExt[] = [
				$section["NAME"], // текст ссылки
				$section["SECTION_PAGE_URL"], // URL
				[], // дополнительные параметры
				[
					"FROM_IBLOCK" => true,
					"IS_PARENT" => false,
                    "DEPTH_LEVEL" => $section["DEPTH_LEVEL"],
					"DESCRIPTION" => $section["DESCRIPTION"],
					"PICTURE" => CFile::GetPath($section["PICTURE"]),
					"DETAIL_PICTURE" => CFile::GetPath($section["DETAIL_PICTURE"]),
				],

			];
        }*/

		if($arIBlock["ACTIVE"] == "Y")
		{
			$aMenuLinksExt = $APPLICATION->IncludeComponent("main:menu.sections", "", array(
				"IS_SEF" => "Y",
				"SEF_BASE_URL" => "",
				"SECTION_PAGE_URL" => $arIBlock['SECTION_PAGE_URL'],
				"DETAIL_PAGE_URL" => $arIBlock['DETAIL_PAGE_URL'],
				"IBLOCK_TYPE" => $arIBlock['IBLOCK_TYPE_ID'],
				"IBLOCK_ID" => $arIBlock['ID'],
				"DEPTH_LEVEL" => "4",
				"CACHE_TYPE" => "N",
                "SECTION" => "",
			), false, Array('HIDE_ICONS' => 'Y'));
		}

	}

	if(defined("BX_COMP_MANAGED_CACHE"))
		$GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_new");
}
//$aMenuLinks = array_merge($menuLinksExt, $aMenuLinks);
$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
?>
