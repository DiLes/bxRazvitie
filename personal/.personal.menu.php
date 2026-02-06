<?
$aMenuLinks = Array(
	Array(
		"Текущие заказы",
		"/personal/orders/",
		Array(),
        Array("DATA_TARGET" => "current_orders"),
		""
	),
	Array(
		"История заказов",
		"/personal/orders/?filter_history=Y",
		Array(),
        Array("DATA_TARGET" => "order_history"),
		""
	),
    Array(
		"Данные аккаунта",
		"/personal/private/",
		Array(),
        Array("DATA_TARGET" => "acc_details"),
		""
	),
);
?>