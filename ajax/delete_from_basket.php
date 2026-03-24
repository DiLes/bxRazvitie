<?
define("NO_KEEP_STATISTIC", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Sale\Basket;
use Bitrix\Sale\Fuser;

Loader::includeModule("sale");

header('Content-Type: application/json; charset=utf-8');

$basketItemId = (int)$_POST["id"];

if ($basketItemId <= 0) {
    echo json_encode(["status" => "error", "message" => "Некорректный ID"]);
    exit;
}

$fuserId = Fuser::getId();
$basket = Basket::loadItemsForFUser($fuserId, SITE_ID);

foreach ($basket as $basketItem) {
    if ($basketItem->getId() == $basketItemId) {
        $basketItem->delete();
        $basket->save();
        echo json_encode(["status" => "success"]);
        exit;
    }
}

echo json_encode(["status" => "error", "message" => "Товар не найден в корзине"]);
