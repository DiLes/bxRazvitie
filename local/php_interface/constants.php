<?
//define('IS_INDEX', $APPLICATION->GetCurPage() == SITE_DIR . '/index.php');
define("IS_INDEX", ($APPLICATION->GetCurPage(false) == SITE_DIR) ? (true) : (false));
define("NO_IMAGE", '/local/templates/razvitie/src/assets/images/no-image.png');
define("NO_BG", '/local/templates/razvitie/src/assets/images/no-bg.png');
define("NO_AVATAR", '/local/templates/razvitie/src/assets/images/no_avatar.png');

define("CLASS_PAGE", $APPLICATION->GetDirProperty("class_page"));
define("BG_PAGE", $APPLICATION->GetDirProperty("bg_page"));
define("HIDE_TITLE", ($APPLICATION->GetDirProperty("hide_title")=="Y")?(true):(false));
define("HIDE_REQUEST_FORM", ($APPLICATION->GetDirProperty("hide_request_form")=="Y")?(true):(false));
/*
define("NO_FULL_WIDTH", ($APPLICATION->GetDirProperty("no_full_width")=="Y")?(true):(false));
define("NO_IMAGE_PROFILE", '/media/img/nophoto-profile.svg');
define("NO_IMAGE_SMALL", '/local/templates/express/media/img/no_photo70x70.png');
//define("FULL_WIDTH", ($APPLICATION->GetDirProperty("full_width")=="Y")?(true):(false));
*/
