<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $USER;

//pre($USER);
$userName = null;
if ($USER->IsAuthorized()) {
    $rsUser = CUser::GetByID($USER->GetID());
    if ($arUser = $rsUser->Fetch()) {
        if (!empty($arUser["NAME"])) {
            $userName = $arUser["NAME"];
        } else {
            $userName = $arUser["LOGIN"];
        }
    }
}

?>
<?if (!empty($arResult)){?>

    <div class="menu menu-mobile">
        <?foreach($arResult as $arItem) {
            ?>
            <a class="menu__item<?=($arItem["SELECTED"])?(' active'):('')?>" href="<?=$arItem["LINK"]?>">
                <?=$arItem["PARAMS"]["SVG"]?>
                <span><?=$arItem["TEXT"]?></span>
            </a>
        <?}?>
        <?if ($USER->IsAuthorized()) {?>
            <a class="menu__item" href="/personal/">
                <div class="menu__item-avatar">
                    <?=substr($userName, 0, 1);?>
                </div>
                <span>Профиль</span>
            </a>
        <?} else {?>
            <a class="menu__item authorization_btn" href="javascript:void(0);">
                <?=SVG_AUTH?>
                <span>Войти</span>
            </a>
        <?}?>
    </div>
<?}?>