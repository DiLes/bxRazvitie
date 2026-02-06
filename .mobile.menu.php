<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$aMenuLinks = Array(
	Array(
		"Главная",
		"/",
		Array(), 
		Array("SVG" => SVG_HOME),
		"" 
	),
    Array(
		"Каталог",
		"/catalog/",
		Array(),
		Array("SVG" => SVG_CATALOG),
		""
	),
    Array(
		"Корзина",
		"/personal/cart/",
		Array(),
		Array("SVG" => SVG_BASKET),
		""
	),
    Array(
		"Избранное",
		"/personal/favorite/",
		Array(),
		Array("SVG" => SVG_FAVORITE),
		""
	),
);
?>