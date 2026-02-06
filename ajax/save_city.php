<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

global $USER;

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$city = trim((string)$request->getPost("city"));

header("Content-Type: application/json; charset=UTF-8");

if ($city === "") {
    echo json_encode([
        "status" => "error",
        "message" => "no city"
    ]);
    die();
}

if ($USER->IsAuthorized()) {
    $USER->Update($USER->GetID(), [
        "WORK_CITY" => $city,
        "PERSONAL_CITY" => $city
    ]);

    echo json_encode([
        "status" => "ok",
        "city" => $city,
        "type" => "user"
    ]);
} else {
    $_SESSION["CITY"] = $city;

    echo json_encode([
        "status" => "ok",
        "city" => $city,
        "type" => "guest"
    ]);
}
