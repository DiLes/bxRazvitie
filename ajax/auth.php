<?php
define("NO_KEEP_STATISTIC", true);
define("NO_AGENT_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

global $USER;

header('Content-Type: application/json; charset=utf-8');

// Проверка что запрос AJAX
if ($_POST["ajax_auth"] !== "Y") {
    echo json_encode([
        "STATUS" => "ERROR",
        "MESSAGE" => "Некорректный запрос."
    ]);
    die();
}

// Уже авторизован
if ($USER->IsAuthorized()) {
    echo json_encode([
        "STATUS" => "SUCCESS"
    ]);
    die();
}

$login = trim($_POST["USER_LOGIN"]);
$password = trim($_POST["USER_PASSWORD"]);

if (!$login || !$password) {
    echo json_encode([
        "STATUS" => "ERROR",
        "MESSAGE" => "Введите логин и пароль."
    ]);
    die();
}

// Авторизация
$arAuthResult = $USER->Login($login, $password, "Y");

// Формат ошибки (как system.auth.form)
if ($arAuthResult !== true && isset($arAuthResult["MESSAGE"])) {
    echo json_encode([
        "STATUS" => "ERROR",
        "MESSAGE" => strip_tags($arAuthResult["MESSAGE"])
    ]);
    die();
}

echo json_encode([
    "STATUS" => "SUCCESS"
]);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
