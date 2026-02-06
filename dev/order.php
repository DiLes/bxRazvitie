<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?><?$APPLICATION->IncludeComponent(
	"tega:order.simple", 
	"order", 
	[
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ANONYMOUS_USER_ID" => "",
		"BASKET_PAGE" => "/personal/cart/",
		"EMAIL_PROPERTY" => "13",
		"ENABLE_VALIDATION_INPUT_ID" => "simple_order_form_validation",
		"ENABLE_VALIDATION_INPUT_NAME" => "validation",
		"EVENT_TYPES" => [
			0 => "SALE_NEW_ORDER",
		],
		"FIO_PROPERTY" => "12",
		"FORM_ID" => "simple_order_form",
		"FORM_NAME" => "simple_order_form",
		"ORDER_PROPS" => [
			0 => "8",
			1 => "9",
			2 => "10",
			3 => "11",
			4 => "12",
			5 => "13",
			6 => "14",
			7 => "15",
			8 => "16",
			9 => "17",
			10 => "18",
			11 => "19",
		],
		"ORDER_RESULT_PAGE" => "success.php",
		"PERSON_TYPE_ID" => "2",
		"PHONE_PROPERTY" => "14",
		"REQUIRED_ORDER_PROPS" => [
			0 => "8",
			1 => "9",
			2 => "10",
			3 => "14",
		],
		"SET_DEFAULT_PROPERTIES_VALUES" => "Y",
		"SITE_ID" => "s1",
		"USER_CONSENT" => "Y",
		"USER_CONSENT_ID" => "1",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "Y",
		"USE_DATE_CALCULATION" => "N",
		"COMPONENT_TEMPLATE" => "order"
	],
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>