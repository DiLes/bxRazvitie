<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;

global $USER;

// Читаем JSON
$request = json_decode(file_get_contents("php://input"), true);

if (!is_array($request)) {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    die();
}

if (!$USER->IsAuthorized()) {
    echo json_encode(["status" => "guest"]);
    die();
}

$userId = (int)$USER->GetID();
$action = $request["action"] ?? "";
$productId = isset($request["id"]) ? (int)$request["id"] : 0;
$ids = isset($request["ids"]) && is_array($request["ids"]) ? array_map("intval", $request["ids"]) : [];

// Получаем текущие избранные
$userData = CUser::GetList(
    $by = "ID",
    $order = "ASC",
    ["ID" => $userId],
    ["SELECT" => ["UF_FAVORITES"]]
)->Fetch();

$favorites = $userData["UF_FAVORITES"] ?? [];

// Если хранится JSON-строкой → декодируем
if (is_string($favorites)) {
    $decoded = json_decode($favorites, true);
    $favorites = json_last_error() === JSON_ERROR_NONE ? $decoded : [];
}

// Гарантия массива
if (!is_array($favorites)) {
    $favorites = [];
}

// === ЛОГИКА ===

if ($action === "toggle" && $productId > 0) {

    if (in_array($productId, $favorites)) {
        $favorites = array_values(array_diff($favorites, [$productId]));
    } else {
        $favorites[] = $productId;
        $favorites = array_values(array_unique($favorites));
    }

} elseif ($action === "save" && !empty($ids)) {

    $favorites = array_values(array_unique($ids));
}

// === СОХРАНЕНИЕ ===
$user = new CUser;
$user->Update($userId, [
    "UF_FAVORITES" => json_encode($favorites, JSON_UNESCAPED_UNICODE)
]);

// === ОТВЕТ ===
echo json_encode([
    "status" => "success",
    "favorites" => $favorites
]);

die();
