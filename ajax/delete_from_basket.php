<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule("sale");
$id = (int)$_POST["id"];
$quantity = (int)$_POST["quantity"];
$id = (int)$_POST["id"];

if ($id > 0) {
    if (\CSaleBasket::Delete($id)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Не удалось удалить товар"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Некорректный ID"]);
}
