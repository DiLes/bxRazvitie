<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Context;

$request = Context::getCurrent()->getRequest();
$action = $request->get("action");
$iblockId = (int)$request->get("iblock_id");
$productId = (int)$request->get("product_id");

if (!isset($_SESSION["CATALOG_COMPARE_LIST"])) {
    $_SESSION["CATALOG_COMPARE_LIST"] = [];
}

switch ($action) {
    case "add":
        $_SESSION["CATALOG_COMPARE_LIST"][$iblockId]["ITEMS"][$productId] = ["ID" => $productId];
        break;

    case "delete":
        unset($_SESSION["CATALOG_COMPARE_LIST"][$iblockId]["ITEMS"][$productId]);
        break;

    case "clear":
        $_SESSION["CATALOG_COMPARE_LIST"][$iblockId]["ITEMS"] = [];
        break;
}

$total = 0;
foreach ($_SESSION["CATALOG_COMPARE_LIST"] as $iblock) {
    if (!empty($iblock["ITEMS"])) {
        $total += count($iblock["ITEMS"]);
    }
}

header('Content-Type: application/json');
echo json_encode(["success" => true, "total" => $total]);
