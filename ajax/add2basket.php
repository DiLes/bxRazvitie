<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;

Loader::includeModule("sale");
Loader::includeModule("catalog");
Loader::includeModule("iblock");

$productId = (int)$_POST["id"];
$quantity = isset($_POST["quantity"]) ? (float)$_POST["quantity"] : 1;
$selectedTree = $_POST["tree"] ?? [];

if ($productId <= 0) {
    echo json_encode(["status" => "error", "message" => "Некорректный ID товара"]);
    exit;
}

// Есть ли SKU
if (!empty($selectedTree)) {
    $offers = CCatalogSKU::getOffersList($productId, 0, ['ACTIVE' => 'Y'], ['ID', 'IBLOCK_ID']);

    if (!$offers || !isset($offers[$productId])) {
        echo json_encode(["status" => "error", "message" => "Офферы не найдены"]);
        exit;
    }

    foreach ($offers[$productId] as $offer) {
        $propsRes = CIBlockElement::GetProperty($offer['IBLOCK_ID'], $offer['ID'], [], []);
        $propsMatch = [];

        while ($prop = $propsRes->Fetch()) {
            if (!$prop["VALUE_ENUM_ID"]) continue;
            $propsMatch[] = $prop["ID"] . "_" . $prop["VALUE_ENUM_ID"];
        }

        sort($propsMatch);
        $sortedTree = $selectedTree;
        sort($sortedTree);

        if ($propsMatch == $sortedTree) {
            if (Add2BasketByProductID($offer["ID"], $quantity)) {
                echo json_encode(["status" => "success", "offerId" => $offer["ID"]]);
                return;
            } else {
                echo json_encode(["status" => "error", "message" => "Ошибка при добавлении торгового предложения"]);
                return;
            }
        }
    }

    echo json_encode(["status" => "error", "message" => "Совпадающее торговое предложение не найдено"]);
    return;
}

// Обычный товар
if (Add2BasketByProductID($productId, $quantity)) {
    echo json_encode(["status" => "success", "productId" => $productId]);
} else {
    echo json_encode(["status" => "error", "message" => "Не удалось добавить обычный товар"]);
}
