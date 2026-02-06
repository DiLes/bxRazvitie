<?php

use Bitrix\Main\Web\Json;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if(isset($arResult["SHOW_SMS_FIELD"]) && $arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}

$arUser = $arResult["arUser"];
if (!empty($arUser["PERSONAL_PHOTO"])){
    $pic = CFile::GetPath($arUser["PERSONAL_PHOTO"]);
}else{
    $pic = NO_AVATAR;
}

//no_avatar.png
/*
 * Company Data:
 * Наименование компании:   $arUser["WORK_COMPANY"];
 * ИНН компании:            $arUser["UF_USER_INN"];
 * КПП компании:            $arUser["UF_USER_KPP"];
 * ЕГРЮЛ (ОГРН) компании:   $arUser["UF_USER_YEGRYUL"];
 *
 * Address:
 * Область, район:          $arUser["WORK_STATE"];
 * Город:                   $arUser["WORK_CITY"];
 * Улица, дом:              $arUser["WORK_STREET"];
 * Офис/квартира:           $arUser["WORK_NOTES"];
 * Индекс:                  $arUser["WORK_ZIP"];
 *
 * Fact Address:
 * Область, район:          $arUser["UF_USER_FAKT_STATE"]
 * Город:                   $arUser["UF_USER_FAKT_CITY"]
 * Улица, дом:              $arUser["UF_USER_FAKT_STREET"]
 * Офис/квартира:           $arUser["UF_USER_FAKT_OFIS"]
 * Индекс:                  $arUser["UF_USER_FAKT_ZIP"]
 *
 * Banking Information:
 * Название банка:          $arUser["UF_USER_BANK_NAME"]
 * БИК банка:               $arUser["UF_USER_BANK_BIK"]
 * ИНН Банка:               $arUser["UF_USER_BANK_INN"]
 * КПП Банка:               $arUser["UF_USER_BANK_KPP"]
 * Расч. счёт:               $arUser["UF_USER_BANK_RASCH"]
 * Корр. счёт:               $arUser["UF_USER_BANK_KORR"]
 *
 *
 *
 * Contact Information:
 * Email организации:       $arUser["EMAIL"]
 * Телефон организации:     $arUser["WORK_PHONE"]
 *
 */

?>
<div class="container white lk_block">
    <div class="tabs-container">
        <?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "menu_personal",
            [
                "ALLOW_MULTI_SELECT" => "N",
                "CHILD_MENU_TYPE" => "left",
                "DELAY" => "N",
                "MAX_LEVEL" => "1",
                "MENU_CACHE_GET_VARS" => [
                ],
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_TYPE" => "A",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "ROOT_MENU_TYPE" => "personal",
                "USE_EXT" => "N",
                "COMPONENT_TEMPLATE" => "menu_personal"
            ],
            false
        );

        ?>
        <div class="content-container">
            <div class="content active" id="acc_details">
                <form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
                    <?=$arResult["BX_SESSION_CHECK"]?>
                    <input type="hidden" name="lang" value="<?=LANG?>" />
                    <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
                    <input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />
                    <div class="company-profile">
                        <div class="profile-container">
                            <div class="profile-image">
                                <img src="<?=$pic?>" alt="Фото" id="profilePreview">
                                <input type="file" id="profileUpload" accept="image/*" name="PERSONAL_PHOTO">
                                <label for="profileUpload" class="upload-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                        <path d="M1 9H17M9 17V9L9 1" stroke="white" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </label>
                            </div>
                            <p class="profile-text">ФОТО ПРОФИЛЯ</p>
                            <input type="checkbox" name="PERSONAL_PHOTO_del" value="Y" id="PERSONAL_PHOTO_del" class="remove-btn hidden">
                            <label for="PERSONAL_PHOTO_del" id="removePhoto" class="personal-photo-del">Удалить фото</label>
                        </div>

                        <!-- Company Data -->
                        <div class="company-data">
                            <h2>Данные компании</h2>
                            <div class="input-group-z">
                                <input type="text" class="input" placeholder="Введите название компании" value="<?=$arUser["WORK_COMPANY"]?>" name="WORK_COMPANY">
                                <label class="user_label">Юридическое наименование организации</label>
                            </div>

                            <div class="input-groups-z">
                                <div class="input-group-z">
                                    <input type="text" placeholder="ИНН" value="<?=$arUser["UF_USER_INN"]?>" name="USER_INN">
                                    <label class="user_label">ИНН</label>
                                </div>
                                <div class="input-group-z">
                                    <input type="text" placeholder="КПП" value="<?=$arUser["UF_USER_KPP"]?>" name="USER_KPP">
                                    <label class="user_label">КПП</label>
                                </div>
                                <div class="input-group-z">
                                    <input type="text" placeholder="ОГРН" value="<?=$arUser["UF_USER_YEGRYUL"]?>" name="USER_YERGYUL">
                                    <label class="user_label">ЕГРЮЛ (ОГРН)</label>
                                </div>
                            </div>
                        </div>

                        <!-- Address Section -->
                        <div class="address-section company-data">
                            <h2>Юридический адрес</h2>
                            <div class="input-groups-z">
                                <div class="input-group-z w_50">
                                    <input type="text" placeholder="Забайкальский край" name="WORK_STATE" value="<?=$arUser["WORK_STATE"]?>" >
                                    <label>Область, район, город</label>
                                </div>
                                <div class="input-group-z w_50">
                                    <input type="text" placeholder="Борзя" name="WORK_CITY" value="<?=$arUser["WORK_CITY"]?>" >
                                    <label>Город</label>
                                </div>
                                <div class="input-group-z w_mob_50">
                                    <input type="text" placeholder="Ул. Ленина, 26" name="WORK_STREET" value="<?=$arUser["WORK_STREET"]?>" >
                                    <label>Улица, дом</label>
                                </div>
                                <div class="input-group-z w_mob_50">
                                    <input type="text" placeholder="45" name="WORK_NOTES" value="<?=$arUser["WORK_NOTES"]?>" >
                                    <label>Офис/квартира</label>
                                </div>
                                <div class="input-group-z w_mob_50">
                                    <input type="text" placeholder="674600" name="WORK_ZIP" value="<?=$arUser["WORK_ZIP"]?>">
                                    <label>Индекс</label>
                                </div>
                            </div>
                        </div>

                        <div class="address-section company-data actual_data">
                            <h2>Фактический адрес
                                <label class="checkbox">
                                    <input type="checkbox" id="sameAddress">
                                    Совпадает с юридическим адресом
                                </label>
                            </h2>
                            <div class="input-groups-z actual-address">
                                <div class="input-group-z w_50">
                                    <input type="text" placeholder="Забайкальский край" name="UF_USER_FAKT_STATE" value="<?=$arUser["UF_USER_FAKT_STATE"]?>" >
                                    <label>Область, район</label>
                                </div>
                                <div class="input-group-z w_50">
                                    <input type="text" placeholder="Архангельск" name="UF_USER_FAKT_CITY" value="<?=$arUser["UF_USER_FAKT_CITY"]?>" >
                                    <label>Город</label>
                                </div>
                                <div class="input-group-z w_mob_50">
                                    <input type="text" placeholder="Ул. Ленина" name="UF_USER_FAKT_STREET" value="<?=$arUser["UF_USER_FAKT_STREET"]?>" >
                                    <label>Улица, дом</label>
                                </div>
                                <div class="input-group-z w_mob_50">
                                    <input type="text" placeholder="-" name="UF_USER_FAKT_OFIS" value="<?=$arUser["UF_USER_FAKT_OFIS"]?>" >
                                    <label>Офис/квартира</label>
                                </div>
                                <div class="input-group-z w_mob_50">
                                    <input type="text" placeholder="674600" name="UF_USER_FAKT_ZIP" value="<?=$arUser["UF_USER_FAKT_ZIP"]?>" >
                                    <label>Индекс</label>
                                </div>
                            </div>
                        </div>

                        <!-- Banking Information -->
                        <div class="bank-data company-data">
                            <h2>Банковские данные</h2>
                            <div class="input-groups-z">
                                <div class="input-group-z">
                                    <input type="text" placeholder="ООО 'Банк Точка'" name="UF_USER_BANK_NAME" value="<?=$arUser["UF_USER_BANK_NAME"]?>" >
                                    <label>Название банка</label>
                                </div>
                                <div class="input-group-z w_mob_50">
                                    <input type="text" placeholder="256 377 909" name="UF_USER_BANK_BIK" value="<?=$arUser["UF_USER_BANK_BIK"]?>" >
                                    <label>БИК Банка</label>
                                </div>
                                <div class="input-group-z w_mob_50">
                                    <input type="text" placeholder="9721 944 61" name="UF_USER_BANK_INN" value="<?=$arUser["UF_USER_BANK_INN"]?>" >
                                    <label>ИНН Банка</label>
                                </div>
                                <div class="input-group-z">
                                    <input type="text" placeholder="997 950 001" name="UF_USER_BANK_KPP" value="<?=$arUser["UF_USER_BANK_KPP"]?>" >
                                    <label>КПП Банка</label>
                                </div>
                                <div class="input-group-z">
                                    <input type="text" placeholder="2080 4810 6055 0033 6093" name="UF_USER_BANK_RASCH" value="<?=$arUser["UF_USER_BANK_RASCH"]?>" >
                                    <label>Расч. счёт</label>
                                </div>
                                <div class="input-group-z">
                                    <input type="text" placeholder="30101 4509 9090 9090" name="UF_USER_BANK_KORR" value="<?=$arUser["UF_USER_BANK_KORR"]?>" >
                                    <label>Корр. счёт</label>
                                </div>
                            </div>

                        </div>

                        <!-- Contact Information -->
                        <div class="contact-data company-data">
                            <h2>Контактные данные</h2>
                            <div class="input-groups-z">
                                <div class="input-group-z w_50">
                                    <input type="email" placeholder="example@gmail.com" name="EMAIL" value="<?=$arUser["EMAIL"]?>" >
                                    <label>Email организации</label>
                                </div>
                                <div class="input-group-z w_50">
                                    <input type="tel" placeholder="+7 (923) 446-35-55" name="WORK_PHONE" value="<?=$arUser["WORK_PHONE"]?>" >
                                    <label>Телефон организации</label>
                                </div>
                            </div>
                        </div>


<?/*?>
                        <!--
                        <div class="contact-persons company-data con_per">
                        <h2>Контактные лица</h2>
                        <h5>Контактное лицо №1</h5>
                        <div class="input-groups-z">
                            <div class="input-group-z select_group_z">
                                <select class="_select" style="background-image: url(./src/assets/svgicons/arr_select.svg);">
                                    <option>Директор</option>
                                    <option>Менеджер</option>
                                    <option>Бухгалтер</option>
                                </select>
                                <label>Должность</label>
                            </div>
                            <div class="input-group-z">
                                <input type="text" placeholder="Петров Иван Иванович" value="Петров Иван Иванович" >
                                <label>ФИО</label>
                            </div>
                            <div class="input-group-z">
                                <input type="tel" placeholder="+7 (923) 446-35-55" value="+7 (923) 446-35-55" >
                                <label>Контактный телефон</label>
                            </div>
                        </div>
                        <div id="contacts-list"></div>
                        <button class="add-person" id="add-person">
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19" viewBox="0 0 18 19" fill="none">
                                                    <path d="M8.71094 1.66211L8.71094 17.3363M0.873852 9.49922L8.71095 9.49922H16.5481" stroke="#056BE9" stroke-width="1.6" stroke-linecap="round"/>
                                                </svg>
                                            </span>
                            Добавить контактное лицо
                        </button>
                    </div>-->
<?*/?>
                        <!-- Buttons -->
                        <div class="buttons-section">
                            <div class="input-groups-z actual-address">
                                <div class="w_mob_50">
                                    <input class="btn" type="submit" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
                                </div>
                                <div class="w_mob_50">
                                    <input class="btn" type="reset" value="<?=GetMessage('MAIN_RESET');?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>