<?php
/**
 * AJAX обработчик скидок от игры (привязка к ИНН юрлица)
 *
 * Уровень 1 = 5%
 * Уровень 2 = 10%
 * Уровень 3 = 15%
 */

define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;
use Bitrix\Main\Loader;

Loader::includeModule("iblock");

header('Content-Type: application/json; charset=utf-8');

global $USER;

// ID инфоблока для хранения скидок (создайте инфоблок "Скидки от игры")
const GAME_DISCOUNT_IBLOCK_ID = 14; // Измените на реальный ID инфоблока

// Получаем данные
$request = Application::getInstance()->getContext()->getRequest();

$action = $request->get("action") ?: "save";
$inn = preg_replace('/\D/', '', $request->get("inn") ?: ""); // Только цифры
$discount = (int)$request->get("discount");
$level = (int)$request->get("level");
$companyName = trim($request->get("company") ?: "");

/**
 * Валидация ИНН
 * ИНН юрлица = 10 цифр
 * ИНН ИП = 12 цифр
 */
function validateINN($inn) {
    $len = strlen($inn);
    if ($len !== 10 && $len !== 12) {
        return false;
    }
    // Дополнительная проверка контрольной суммы для 10-значного ИНН
    if ($len === 10) {
        $coefficients = [2, 4, 10, 3, 5, 9, 4, 6, 8];
        $sum = 0;
        for ($i = 0; $i < 9; $i++) {
            $sum += (int)$inn[$i] * $coefficients[$i];
        }
        return (int)$inn[9] === ($sum % 11) % 10;
    }
    return true;
}

/**
 * Получить скидку по ИНН из инфоблока
 */
function getDiscountByINN($inn) {
    $result = ["discount" => 0, "level" => 0, "company" => "", "element_id" => 0];

    $res = CIBlockElement::GetList(
        ["ID" => "DESC"],
        [
            "IBLOCK_ID" => GAME_DISCOUNT_IBLOCK_ID,
            "ACTIVE" => "Y",
            "=PROPERTY_INN" => $inn
        ],
        false,
        ["nTopCount" => 1],
        ["ID", "NAME", "PROPERTY_INN", "PROPERTY_DISCOUNT", "PROPERTY_LEVEL"]
    );

    if ($row = $res->GetNext()) {
        $result["discount"] = (int)$row["PROPERTY_DISCOUNT_VALUE"];
        $result["level"] = (int)$row["PROPERTY_LEVEL_VALUE"];
        $result["company"] = $row["NAME"];
        $result["element_id"] = $row["ID"];
    }

    return $result;
}

/**
 * Сохранить/обновить скидку по ИНН
 */
function saveDiscountByINN($inn, $discount, $level, $companyName) {
    $existing = getDiscountByINN($inn);

    $el = new CIBlockElement;

    $props = [
        "INN" => $inn,
        "DISCOUNT" => $discount,
        "LEVEL" => $level,
    ];

    $arFields = [
        "IBLOCK_ID" => GAME_DISCOUNT_IBLOCK_ID,
        "NAME" => $companyName ?: "Компания ИНН: " . $inn,
        "ACTIVE" => "Y",
        "PROPERTY_VALUES" => $props,
    ];

    if ($existing["element_id"] > 0) {
        // Обновляем существующую запись
        $el->Update($existing["element_id"], $arFields);
        return $existing["element_id"];
    } else {
        // Создаём новую запись
        return $el->Add($arFields);
    }
}

// === ВАЛИДАЦИЯ СКИДКИ ===
$allowedDiscounts = [5, 10, 15];

// === ПОЛУЧЕНИЕ СКИДКИ ПО ИНН ===
if ($action === "get") {
    $checkInn = $inn ?: ($_SESSION["GAME_INN"] ?? "");

    if (empty($checkInn)) {
        echo json_encode([
            "status" => "error",
            "message" => "ИНН не указан"
        ]);
        die();
    }

    $data = getDiscountByINN($checkInn);

    // Также проверяем сессию (может быть ещё не сохранено в БД)
    $sessionDiscount = $_SESSION["GAME_DISCOUNT"] ?? 0;
    $sessionInn = $_SESSION["GAME_INN"] ?? "";

    if ($sessionInn === $checkInn && $sessionDiscount > $data["discount"]) {
        $data["discount"] = $sessionDiscount;
        $data["level"] = $_SESSION["GAME_LEVEL"] ?? 0;
    }

    echo json_encode([
        "status" => "success",
        "inn" => $checkInn,
        "discount" => $data["discount"],
        "level" => $data["level"],
        "company" => $data["company"]
    ]);
    die();
}

// === ПРОВЕРКА ИНН (без сохранения) ===
if ($action === "check") {
    if (empty($inn)) {
        echo json_encode(["status" => "error", "message" => "ИНН не указан"]);
        die();
    }

    if (!validateINN($inn)) {
        echo json_encode(["status" => "error", "message" => "Некорректный ИНН"]);
        die();
    }

    $data = getDiscountByINN($inn);

    echo json_encode([
        "status" => "success",
        "inn" => $inn,
        "hasDiscount" => $data["discount"] > 0,
        "discount" => $data["discount"],
        "level" => $data["level"],
        "company" => $data["company"]
    ]);
    die();
}

// === СОХРАНЕНИЕ СКИДКИ ===
if ($action === "save") {

    // Проверяем ИНН
    if (empty($inn)) {
        echo json_encode(["status" => "error", "message" => "Укажите ИНН организации"]);
        die();
    }

    if (!validateINN($inn)) {
        echo json_encode(["status" => "error", "message" => "Некорректный ИНН. Для юрлица - 10 цифр, для ИП - 12 цифр"]);
        die();
    }

    // Проверяем скидку
    if (!in_array($discount, $allowedDiscounts)) {
        echo json_encode(["status" => "error", "message" => "Недопустимое значение скидки"]);
        die();
    }

    // Проверяем текущую скидку по ИНН
    $existing = getDiscountByINN($inn);

    if ($discount <= $existing["discount"]) {
        echo json_encode([
            "status" => "error",
            "message" => "По ИНН {$inn} уже есть скидка {$existing['discount']}%",
            "currentDiscount" => $existing["discount"],
            "inn" => $inn
        ]);
        die();
    }

    // Сохраняем в инфоблок
    $elementId = saveDiscountByINN($inn, $discount, $level, $companyName);

    if (!$elementId) {
        echo json_encode(["status" => "error", "message" => "Ошибка сохранения скидки"]);
        die();
    }

    // Сохраняем в сессию для текущего пользователя
    $_SESSION["GAME_DISCOUNT"] = $discount;
    $_SESSION["GAME_LEVEL"] = $level;
    $_SESSION["GAME_INN"] = $inn;
    $_SESSION["GAME_COMPANY"] = $companyName;
    $_SESSION["GAME_DISCOUNT_TIME"] = time();

    // Сохраняем в куки
    setcookie("GAME_DISCOUNT", $discount, time() + 365 * 24 * 60 * 60, "/");
    setcookie("GAME_INN", $inn, time() + 365 * 24 * 60 * 60, "/");

    // Логируем
    \Bitrix\Main\Diag\Debug::writeToFile([
        "inn" => $inn,
        "company" => $companyName,
        "discount" => $discount,
        "level" => $level,
        "element_id" => $elementId,
        "user_id" => $USER->IsAuthorized() ? $USER->GetID() : "guest",
        "time" => date("Y-m-d H:i:s")
    ], "Game discount saved by INN", "/local/logs/game_discount.log");

    echo json_encode([
        "status" => "success",
        "message" => "Поздравляем! Скидка {$discount}% привязана к ИНН {$inn}",
        "discount" => $discount,
        "level" => $level,
        "inn" => $inn
    ]);
    die();
}

// === СБРОС СКИДКИ (для админов) ===
if ($action === "reset") {
    if (!$USER->IsAdmin()) {
        echo json_encode(["status" => "error", "message" => "Доступ запрещён"]);
        die();
    }

    if (empty($inn)) {
        // Сбрасываем только сессию
        unset($_SESSION["GAME_DISCOUNT"]);
        unset($_SESSION["GAME_LEVEL"]);
        unset($_SESSION["GAME_INN"]);
        unset($_SESSION["GAME_COMPANY"]);
        setcookie("GAME_DISCOUNT", "", time() - 3600, "/");
        setcookie("GAME_INN", "", time() - 3600, "/");
    } else {
        // Удаляем запись из инфоблока
        $data = getDiscountByINN($inn);
        if ($data["element_id"] > 0) {
            CIBlockElement::Delete($data["element_id"]);
        }
    }

    echo json_encode(["status" => "success", "message" => "Скидка сброшена"]);
    die();
}

// === СПИСОК ВСЕХ СКИДОК (для админов) ===
if ($action === "list") {
    if (!$USER->IsAdmin()) {
        echo json_encode(["status" => "error", "message" => "Доступ запрещён"]);
        die();
    }

    $list = [];
    $res = CIBlockElement::GetList(
        ["ID" => "DESC"],
        ["IBLOCK_ID" => GAME_DISCOUNT_IBLOCK_ID, "ACTIVE" => "Y"],
        false,
        false,
        ["ID", "NAME", "DATE_CREATE", "PROPERTY_INN", "PROPERTY_DISCOUNT", "PROPERTY_LEVEL"]
    );

    while ($row = $res->GetNext()) {
        $list[] = [
            "id" => $row["ID"],
            "company" => $row["NAME"],
            "inn" => $row["PROPERTY_INN_VALUE"],
            "discount" => (int)$row["PROPERTY_DISCOUNT_VALUE"],
            "level" => (int)$row["PROPERTY_LEVEL_VALUE"],
            "date" => $row["DATE_CREATE"]
        ];
    }

    echo json_encode(["status" => "success", "list" => $list, "total" => count($list)]);
    die();
}

echo json_encode(["status" => "error", "message" => "Неизвестное действие"]);
