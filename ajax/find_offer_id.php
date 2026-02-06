<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;

Loader::includeModule("iblock");
Loader::includeModule("catalog");

$productId = (int)$_POST["id"];
$selectedTree = $_POST["tree"] ?? [];

if ($productId <= 0 || empty($selectedTree)) {
    echo json_encode(["status" => "error", "message" => "Данные отсутствуют"]);
    exit;
}

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
        // Получаем цену
        $priceData = CCatalogProduct::GetOptimalPrice($offer["ID"]);
        $price = round($priceData["RESULT_PRICE"]["DISCOUNT_PRICE"], 2);

        // Артикул
        $article = "";
        $el = CIBlockElement::GetByID($offer["ID"])->Fetch();
        if ($el && $el["CODE"]) {
            $article = $el["CODE"]; // либо $el["XML_ID"] или свойство
        }

        echo json_encode([
            "status" => "success",
            "offerId" => $offer["ID"],
            "price" => $price,
            "article" => $article,
        ]);
        return;
    }
}

echo json_encode(["status" => "error", "message" => "Совпадающий оффер не найден"]);
