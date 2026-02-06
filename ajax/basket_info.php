<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Loader;
use Bitrix\Sale;

$response = ['count' => 0];

if (Loader::includeModule("sale")) {
    $basket = Sale\Basket::loadItemsForFUser(
    Sale\Fuser::getId(), \Bitrix\Main\Context::getCurrent()->getSite()
    );

    foreach ($basket as $item) {
        ++ $response['count'];
    }
}
header('Content-Type: application/json');
echo json_encode($response);