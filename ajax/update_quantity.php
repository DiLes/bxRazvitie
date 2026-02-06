<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Sale;

if (!CModule::IncludeModule("sale")) {
    echo json_encode(["status" => "error", "message" => "Модуль sale не подключен"]);
    exit;
}

$productId = (int)$_POST["id"];
$quantity = (float)$_POST["quantity"];

if ($productId <= 0 || $quantity <= 0) {
    echo json_encode(["status" => "error", "message" => "Неверные параметры"]);
    exit;
}

$basket = Sale\Basket::loadItemsForFUser(
    Sale\Fuser::getId(),
    Bitrix\Main\Context::getCurrent()->getSite()
);

$found = false;

foreach ($basket as $basketItem) {
    if ((int)$basketItem->getProductId() === $productId) {
        $basketItem->setField("QUANTITY", $quantity);
        $found = true;
        break;
    }
}

if ($found) {
    $basket->save();
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => "Товар не найден в корзине"]);
}
