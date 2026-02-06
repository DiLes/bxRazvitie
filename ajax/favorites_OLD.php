<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;

global $USER;

$requestData = json_decode(file_get_contents("php://input"), true);

if (!is_array($requestData)) {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
    exit;
}

if ($USER->IsAuthorized()) {
    $userId = (int)$USER->GetID();
    $action = $requestData["action"] ?? "";
    $productId = isset($requestData["id"]) ? (int)$requestData["id"] : 0;
    $ids = isset($requestData["ids"]) && is_array($requestData["ids"]) ? array_map("intval", $requestData["ids"]) : [];

    // Получаем текущие избранные
    $userData = CUser::GetList(
        $by = "ID",
        $order = "ASC",
        ["ID" => $userId],
        ["SELECT" => ["UF_FAVORITES"]]
    )->Fetch();

    $favorites = $userData["UF_FAVORITES"] ?? [];

    // Декодируем, если в БД JSON-строка
    if (is_string($favorites)) {
        $decoded = json_decode($favorites, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $favorites = $decoded;
        } else {
            $favorites = [];
        }
    }

    if (!is_array($favorites)) {
        $favorites = [];
    }

    // Логика действий
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
    echo '<pre>'; print_r($favorites); echo '</pre>';
    pre(json_encode($favorites,JSON_UNESCAPED_UNICODE));

    // Сохраняем в JSON
    $user = new CUser;
    $user->Update($userId, [
        "UF_FAVORITES" => json_encode($favorites, JSON_UNESCAPED_UNICODE)
    ]);

    echo json_encode([
        "status" => "success",
        "favorites" => $favorites
    ]);

} else {
    echo json_encode(["status" => "guest"]);
}
