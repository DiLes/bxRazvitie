<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * $arResult
 *
*/
CJSCore::Init();
//echo '<pre>'; print_r($arResult["FORM_TYPE"]); echo '</pre>';
//echo '<pre>'; print_r($arResult); echo '</pre>';
?>
<h2>Авторизация
    <div class="subtitle">
        Войдите, чтобы управлять личными данными <br> и следить за статусом заказов
    </div>
</h2>

<?
if ($arResult['SHOW_ERRORS'] === 'Y' && $arResult['ERROR'] && !empty($arResult['ERROR_MESSAGE']))
{
	ShowMessage($arResult['ERROR_MESSAGE']);
}
?>

<?if($arResult["FORM_TYPE"] == "login"){?>
    <form id="authForm" name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
    <?if($arResult["BACKURL"] <> ''){?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
    <?}?>
    <?foreach ($arResult["POST"] as $key => $value){?>
        <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
    <?}?>
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="AUTH" />

        <div class="input_grups">
            <label for="inn" class="label_z">ИНН
                <input type="text" id="auth-login-inn" name="USER_LOGIN" class="input_z" placeholder="Введите ИНН организации" required>
                <script>
                    BX.ready(function() {
                        var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
                        if (loginCookie)
                        {
                            var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
                            var loginInput = form.elements["USER_LOGIN"];
                            loginInput.value = loginCookie;
                        }
                    });
                </script>
            </label>
            <label for="password" class="label_z">Пароль
                <input type="password" id="auth-password" class="input_z" name="USER_PASSWORD" placeholder="Введите пароль" required>
                <a href="#" class="password_eye">
                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/show_eye_ic.svg" alt="" class="show_eye">
                    <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/hide_eye_ic.svg" alt="" class="hide_eye">
                </a>
            </label>
        </div>
        <div class="modal_actions">
        <?if ($arResult["STORE_PASSWORD"] == "Y"){?>
            <label class="toggle-differences">
                <input type="checkbox" id="authToggleDifferences" name="USER_REMEMBER" value="Y">
                <?=GetMessage("AUTH_REMEMBER_SHORT")?>
            </label>
        <?}?>
            <a href="<?=$arResult["AUTH_REGISTER_URL"]?>" class="forgot_password" rel="nofollow">Забыли пароль?</a>
        </div>
        <?if ($arResult["CAPTCHA_CODE"]){?>
            <?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
            <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
            <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
            <input type="text" name="captcha_word" maxlength="50" value="" />
        <?}?>
        <input type="submit" name="Login" class="btn_primary" id="auth-submit-btn" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />
        <?if($arResult["NEW_USER_REGISTRATION"] == "Y"){?>
            <div class="signup_text">Нет аккаунта?
                <noindex>
                    <a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow">Зарегистрироваться
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                            <path d="M6.75 13.5L11.25 9L6.75 4.5" stroke="#056BE9" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </noindex>
            </div>
        <?}?>
    </form>
<?
}elseif($arResult["FORM_TYPE"] == "otp"){
?>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="OTP" />
	<table width="95%">
		<tr>
			<td colspan="2">
			<?echo GetMessage("auth_form_comp_otp")?><br />
			<input type="text" name="USER_OTP" maxlength="50" value="" size="17" autocomplete="off" /></td>
		</tr>
<?if ($arResult["CAPTCHA_CODE"]):?>
		<tr>
			<td colspan="2">
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
<?endif?>
<?if ($arResult["REMEMBER_OTP"] == "Y"):?>
		<tr>
			<td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y" /></td>
			<td width="100%"><label for="OTP_REMEMBER_frm" title="<?echo GetMessage("auth_form_comp_otp_remember_title")?>"><?echo GetMessage("auth_form_comp_otp_remember")?></label></td>
		</tr>
<?endif?>
		<tr>
			<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
		</tr>
		<tr>
			<td colspan="2"><noindex><a href="<?=$arResult["AUTH_LOGIN_URL"]?>" rel="nofollow"><?echo GetMessage("auth_form_comp_auth")?></a></noindex><br /></td>
		</tr>
	</table>
</form>

<?
}else{
?>

<form action="<?=$arResult["AUTH_URL"]?>">
	<table width="95%">
		<tr>
			<td align="center">
				<?=$arResult["USER_NAME"]?><br />
				[<?=$arResult["USER_LOGIN"]?>]<br />
				<a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=GetMessage("AUTH_PROFILE")?></a><br />
			</td>
		</tr>
		<tr>
			<td align="center">
			<?foreach ($arResult["GET"] as $key => $value){?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?}?>
			<?=bitrix_sessid_post()?>
			<input type="hidden" name="logout" value="yes" />
			<input type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" />
			</td>
		</tr>
	</table>
</form>
<?}?>
