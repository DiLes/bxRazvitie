<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
<a href="/personal/cart/" class="mini-basket">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" viewBox="0 0 16 15" fill="none">
        <path
                d="M1.51396 1.37833C1.42735 1.03191 1.07631 0.8213 0.729892 0.907913C0.383475 0.994525 0.172862 1.34557 0.259475 1.69198L1.51396 1.37833ZM3.96795 11.0947L4.35659 10.578L3.96795 11.0947ZM2.19359 6.87034L2.82233 6.71965L2.19359 6.87034ZM3.85163 11.0029L4.26354 10.5046L3.85163 11.0029ZM14.4767 7.18766L15.1055 7.33835L14.4767 7.18766ZM13.0999 10.818L12.647 10.3566L13.0999 10.818ZM12.5508 11.2511L12.8939 11.7991L12.5508 11.2511ZM14.4269 4.61014L14.8706 4.13992L14.4269 4.61014ZM14.6607 4.9067L15.2214 4.58475L14.6607 4.9067ZM9.29196 6.70757C8.93488 6.70757 8.64541 6.99704 8.64541 7.35412C8.64541 7.7112 8.93488 8.00067 9.29196 8.00067V6.70757ZM11.2316 8.64723C10.8745 8.64723 10.5851 8.9367 10.5851 9.29378C10.5851 9.65086 10.8745 9.94033 11.2316 9.94033V8.64723ZM1.56737 4.90403H12.1658V3.61093H1.56737V4.90403ZM8.69949 11.0973H8.37318V12.3904H8.69949V11.0973ZM2.82233 6.71965L2.19611 4.10679L0.93862 4.40817L1.56484 7.02103L2.82233 6.71965ZM2.19461 4.10065L1.51396 1.37833L0.259475 1.69198L0.940122 4.41431L2.19461 4.10065ZM8.37318 11.0973C7.17721 11.0973 6.33568 11.0963 5.68337 11.0205C5.04741 10.9466 4.66234 10.8079 4.35659 10.578L3.57932 11.6114C4.13671 12.0306 4.77356 12.2166 5.53408 12.3049C6.27825 12.3914 7.20775 12.3904 8.37318 12.3904V11.0973ZM1.56484 7.02103C1.83647 8.15435 2.05212 9.05849 2.30967 9.76201C2.57288 10.481 2.90213 11.057 3.43973 11.5013L4.26354 10.5046C3.96864 10.2608 3.74405 9.91868 3.52396 9.31747C3.2982 8.70079 3.10108 7.88267 2.82233 6.71965L1.56484 7.02103ZM4.35659 10.578C4.32501 10.5542 4.29399 10.5297 4.26354 10.5046L3.43973 11.5013C3.48541 11.539 3.53195 11.5758 3.57932 11.6114L4.35659 10.578ZM8.69949 12.3904C9.70777 12.3904 10.512 12.3912 11.1611 12.3255C11.8232 12.2586 12.3844 12.1181 12.8939 11.7991L12.2076 10.7031C11.9301 10.8769 11.587 10.9828 11.031 11.039C10.4619 11.0965 9.73405 11.0973 8.69949 11.0973V12.3904ZM12.647 10.3566C12.5135 10.4877 12.3662 10.6038 12.2076 10.7031L12.8939 11.7991C13.1317 11.6502 13.3526 11.476 13.5528 11.2794L12.647 10.3566ZM12.1658 4.90403C12.8117 4.90403 13.2368 4.90517 13.5497 4.94335C13.852 4.98023 13.9417 5.0413 13.9831 5.08036L14.8706 4.13992C14.5383 3.82632 14.1266 3.71105 13.7064 3.65977C13.2967 3.60979 12.7781 3.61093 12.1658 3.61093V4.90403ZM15.1055 7.33835C15.2482 6.74288 15.3701 6.23884 15.417 5.82886C15.4651 5.40819 15.4489 4.98099 15.2214 4.58475L14.1 5.22864C14.1284 5.27799 14.1668 5.37949 14.1323 5.68201C14.0965 5.99521 13.9985 6.40886 13.848 7.03697L15.1055 7.33835ZM13.9831 5.08036C14.0291 5.1238 14.0685 5.17376 14.1 5.22864L15.2214 4.58475C15.1269 4.4201 15.0087 4.27023 14.8706 4.13992L13.9831 5.08036ZM13.8178 8.64723H11.2316V9.94033H13.8178V8.64723ZM14.4368 6.70757L9.29196 6.70757V8.00067L14.4368 8.00067L14.4368 6.70757ZM13.848 7.03697C13.8345 7.09326 13.8212 7.14868 13.8081 7.20331L15.0655 7.50494C15.0787 7.45017 15.092 7.39462 15.1055 7.33835L13.848 7.03697ZM13.8081 7.20331C13.6153 8.00704 13.467 8.61345 13.3125 9.09699L14.5442 9.49057C14.7161 8.95259 14.8756 8.29647 15.0655 7.50494L13.8081 7.20331ZM13.3125 9.09699C13.1053 9.74548 12.9082 10.1002 12.647 10.3566L13.5528 11.2794C14.0319 10.8091 14.3101 10.2233 14.5442 9.49057L13.3125 9.09699ZM13.8178 9.94033H13.9283V8.64723H13.8178V9.94033Z"
                fill="currentColor"
        />
        <path
                d="M7.01351 13.786C7.01351 14.1619 6.7088 14.4666 6.33292 14.4666C5.95705 14.4666 5.65234 14.1619 5.65234 13.786C5.65234 13.4102 5.95705 13.1055 6.33292 13.1055C6.7088 13.1055 7.01351 13.4102 7.01351 13.786Z"
                fill="currentColor"
        />
        <path
                d="M11.097 13.786C11.097 14.1619 10.7923 14.4666 10.4164 14.4666C10.0405 14.4666 9.73583 14.1619 9.73583 13.786C9.73583 13.4102 10.0405 13.1055 10.4164 13.1055C10.7923 13.1055 11.097 13.4102 11.097 13.786Z"
                fill="currentColor"
        />
    </svg>
    <div class="badge-wrapper">
        <span>5</span>
    </div>
</a>
<div class="bx-hdr-profile">
<?if (!$compositeStub && $arParams['SHOW_AUTHOR'] == 'Y'):?>
	<div class="bx-basket-block">
		<i class="fa fa-user"></i>
		<?if ($USER->IsAuthorized()):
			$name = trim($USER->GetFullName());
			if (! $name)
				$name = trim($USER->GetLogin());
			if (mb_strlen($name) > 15)
				$name = mb_substr($name, 0, 12).'...';
			?>
			<a href="<?=$arParams['PATH_TO_PROFILE']?>"><?=htmlspecialcharsbx($name)?></a>
			&nbsp;
			<a href="?logout=yes&<?=bitrix_sessid_get()?>"><?=GetMessage('TSB1_LOGOUT')?></a>
		<?else:
			$arParamsToDelete = array(
				"login",
				"login_form",
				"logout",
				"register",
				"forgot_password",
				"change_password",
				"confirm_registration",
				"confirm_code",
				"confirm_user_id",
				"logout_butt",
				"auth_service_id",
				"clear_cache",
				"backurl",
			);

			$currentUrl = urlencode($APPLICATION->GetCurPageParam("", $arParamsToDelete));
			if ($arParams['AJAX'] == 'N')
			{
				?><script><?=$cartId?>.currentUrl = '<?=$currentUrl?>';</script><?
			}
			else
			{
				$currentUrl = '#CURRENT_URL#';
			}
			
			$pathToAuthorize = $arParams['PATH_TO_AUTHORIZE'];
			$pathToAuthorize .= (mb_stripos($pathToAuthorize, '?') === false ? '?' : '&');
			$pathToAuthorize .= 'login=yes&backurl='.$currentUrl;
			?>
			<a href="<?=$pathToAuthorize?>">
				<?=GetMessage('TSB1_LOGIN')?>
			</a>
			<?
			if ($arParams['SHOW_REGISTRATION'] === 'Y')
			{
				$pathToRegister = $arParams['PATH_TO_REGISTER'];
				$pathToRegister .= (mb_stripos($pathToRegister, '?') === false ? '?' : '&');
				$pathToRegister .= 'register=yes&backurl='.$currentUrl;
				?>
				<a href="<?=$pathToRegister?>">
					<?=GetMessage('TSB1_REGISTER')?>
				</a>
				<?
			}
			?>
		<?endif?>
	</div>
<?endif?>
	<div class="bx-basket-block"><?
		if (!$arResult["DISABLE_USE_BASKET"])
		{
			?><i class="fa fa-shopping-cart"></i>
			<a href="<?= $arParams['PATH_TO_BASKET'] ?>"><?= GetMessage('TSB1_CART') ?></a><?
		}

		if (!$compositeStub)
		{
			if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'))
			{
				echo $arResult['BASKET_COUNT_DESCRIPTION'];

				if ($arParams['SHOW_TOTAL_PRICE'] == 'Y')
				{
					?>
					<br <? if ($arParams['POSITION_FIXED'] == 'Y'): ?>class="hidden-xs"<? endif; ?>/>
					<span>
						<?=GetMessage('TSB1_TOTAL_PRICE')?> <strong><?=$arResult['TOTAL_PRICE']?></strong>
					</span>
					<?
				}
			}
		}

		if ($arParams['SHOW_PERSONAL_LINK'] == 'Y'):?>
			<div style="padding-top: 4px;">
			<span class="icon_info"></span>
			<a href="<?=$arParams['PATH_TO_PERSONAL']?>"><?=GetMessage('TSB1_PERSONAL')?></a>
			</div>
		<?endif?>
	</div>
</div>