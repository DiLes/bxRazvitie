<?php
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Sale;

Loader::includeModule("sale");

try {
    $basket = Sale\Basket::loadItemsForFUser(
        Sale\Fuser::getId(),
        \Bitrix\Main\Context::getCurrent()->getSite()
    );

    foreach ($basket as $item) {
        $item->delete();
    }

    $basket->save();

    echo json_encode(["status" => "success"]);
} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
