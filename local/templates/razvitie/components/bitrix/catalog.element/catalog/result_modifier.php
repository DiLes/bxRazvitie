<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 * @var $arResult
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
/*use Bitrix\Catalog\CatalogViewedProductTable;

if ($arResult["ID"] > 0)
{
    // Записываем просмотр
    CatalogViewedProductTable::refresh(
        $arResult["ID"],
        CSaleUser::GetID(),
        SITE_ID
    );

    // Записываем в сессию как Bitrix делает SHOW_COUNTER
//    $_SESSION["IBLOCK_COUNTER"][$arResult["ID"]] = time();
}*/

//pre($arResult["ID"]);