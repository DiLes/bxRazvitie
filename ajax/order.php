<?php
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Security\Sign\Signer;

const STOP_STATISTICS = true;
const NO_KEEP_STATISTIC = 'Y';
const NO_AGENT_STATISTIC = 'Y';
const DisableEventsCheck = true;
const BX_SECURITY_SHOW_MESSAGE = true;
const NOT_CHECK_PERMISSIONS = true;

// --- Сначала определяем SITE_ID до пролога ---
$siteId = isset($_REQUEST['SITE_ID']) && is_string($_REQUEST['SITE_ID'])
    ? preg_replace('/[^a-z0-9_]/i', '', $_REQUEST['SITE_ID'])
    : 's1';

define('SITE_ID', substr($siteId, 0, 2));

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

// --- Проверка модулей ---
if (!Loader::includeModule('sale')) {
    exit('Module sale not loaded');
}

$request = Application::getInstance()->getContext()->getRequest();
$signer = new Signer;

try {
    $signedParamsString = $request->get('signedParamsString') ?: '';
    $params = $signer->unsign($signedParamsString, 'sale.order.ajax');
    $params = unserialize(base64_decode($params), ['allowed_classes' => false]);
} catch (\Bitrix\Main\Security\Sign\BadSignatureException $e) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'Bad signature']);
    exit;
}

// --- Обработка действия ---
$actionVariable = $params['ACTION_VARIABLE'] ?? 'soa-action';
$action = $request->get($actionVariable);

if (empty($action)) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['error' => 'Empty action']);
    exit;
}

// --- Запускаем стандартный компонент ---
global $APPLICATION;
$APPLICATION->IncludeComponent(
    'bitrix:sale.order.ajax',
    '.default',
    $params
);
