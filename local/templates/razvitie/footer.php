<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//$curPage = $APPLICATION->GetCurPage(true);
?>

<?if (!IS_INDEX){?>
    <?if ($curPage == '/dev/'){?>
        </div>
    <?}?>
<?}?>
<?
if (!HIDE_REQUEST_FORM){
    $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/blocks/request.php"), false);
}

?>

<?
$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/blocks/contacts.php"), false);
?>
</main>
<footer class="footer">
    <div class="footer__top">
        <div class="footer__left">
            <a href="/">
                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/logo_footer.php"), false);?></a>
            <div class="row">
                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/info_footer.php"), false);?>
                <span><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/work_time_footer.php"), false);?></span>
            </div>
        </div>
        <div class="footer__right">
            <div class="footer__right-item">
                <span>КАТАЛОГ</span>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"menu_footer", 
	[
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => [
		],
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "bottom_catalog",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "menu_footer"
	],
	false
);?>
            </div>
            <div class="footer__right-item center">
                <span>КОМПАНИЯ</span>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"menu_footer", 
	[
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => [
		],
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "bottom",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "menu_footer"
	],
	false
);?>
            </div>
            <div class="footer__right-item">
                <span>ПОКУПАТЕЛЮ</span>
<?$APPLICATION->IncludeComponent(
    "bitrix:menu",
    "menu_footer",
    [
        "ALLOW_MULTI_SELECT" => "N",
        "CHILD_MENU_TYPE" => "",
        "DELAY" => "N",
        "MAX_LEVEL" => "1",
        "MENU_CACHE_GET_VARS" => [
        ],
        "MENU_CACHE_TIME" => "3600",
        "MENU_CACHE_TYPE" => "N",
        "MENU_CACHE_USE_GROUPS" => "Y",
        "ROOT_MENU_TYPE" => "personal",
        "USE_EXT" => "N",
        "COMPONENT_TEMPLATE" => "menu_footer"
    ],
    false
);?>
            </div>
            <div class="footer__right-item icon">
                <a href="javascript:void(0);">
                    <svg
                        width="60"
                        height="60"
                        viewBox="0 0 60 60"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <circle cx="30" cy="30" r="29.5" fill="#F4F6F8" stroke="white" />
                        <path
                            d="M29.625 34.4062L29.625 24.3438"
                            stroke="#056BE9"
                            stroke-width="1.4375"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                        <path
                            d="M24.5938 29.375L29.625 24.3437L34.6562 29.375"
                            stroke="#056BE9"
                            stroke-width="1.4375"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <span><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/copyright.php"), false);?></span>
        <div>
            <a href="/policy/"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/policy.php"), false);?></a>
            <a href="/agree/"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/user_agree.php"), false);?></a>

                <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/development.php"), false);?>
            </p>
        </div>
    </div>
</footer>

<div class="modal" id="requestModal">
    <div class="modal__content request-modal">
        <svg
                class="modal__close-btn"
                width="51"
                height="50"
                viewBox="0 0 51 50"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
        >
            <rect x="0.792969" width="50" height="50" rx="25" fill="#F4F6F8" />
            <path
                    d="M19.957 18.959L31.0404 30.0423M19.9571 30.0423L25.4987 24.5007L31.0404 18.959"
                    stroke="#1A1A1A"
                    stroke-width="1.6"
                    stroke-linecap="round"
            />
        </svg>
        <form action="" class="request__form" data-form-type="request" data-action="/ajax/form_handler.php">
            <h3>Заполните форму, и мы свяжемся с вами в ближайшее время</h3>

            <div class="request__inputs">
                <input type="text"  name="NAME" placeholder="Введите Ваше имя" required />
                <input type="text" name="INN" placeholder="ИНН организации" />
                <input type="text" name="COMPANY" placeholder="Название организации" />
                <input type="email" name="EMAIL" placeholder="Email" />
                <input type="text" name="POSITION" placeholder="Ваша должность" />
                <input type="tel" name="PHONE" placeholder="Телефон" required />
            </div>

            <label>
                <span>Комментарий</span>
                <textarea name="comment" placeholder="Введите ваш комментарий"></textarea>
            </label>

            <div class="row">
                <button class="request-send-btn">Получить консультацию</button>
                <p>
                    Нажимая на кнопку и передавая свои данные, вы даёте согласие на обработку
                    <a href="#">персональных данных</a>
                </p>
            </div>
        </form>
    </div>
</div>

<div class="modal" id="oneBuyClickModal">
    <div class="modal__content one_buy_click-modal">
        <svg
                class="modal__close-btn"
                width="51"
                height="50"
                viewBox="0 0 51 50"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
        >
            <rect x="0.792969" width="50" height="50" rx="25" fill="#F4F6F8" />
            <path
                    d="M19.957 18.959L31.0404 30.0423M19.9571 30.0423L25.4987 24.5007L31.0404 18.959"
                    stroke="#1A1A1A"
                    stroke-width="1.6"
                    stroke-linecap="round"
            />
        </svg>
        <form action="" class="request__form" data-form-type="one_click" data-action="/ajax/form_handler.php">
            <h3>Купить в 1 клик</h3>

            <div class="request__inputs">
                <input type="hidden" name="PRODUCT_ID" value="">
                <input type="text" name="NAME" placeholder="Введите Ваше имя" />
                <input type="text" name="INN" placeholder="ИНН организации" />
                <input type="text" name="COMPANY" placeholder="Название организации" />
                <input type="email" name="EMAIL" placeholder="Email" />
                <input type="text" name="POSITION" placeholder="Ваша должность" />
                <input type="tel" name="PHONE" placeholder="Телефон" />
            </div>

            <label>
                <span>Комментарий</span>
                <textarea name="COMMENT" placeholder="Введите ваш комментарий"></textarea>
            </label>

            <div class="row">
                <button type="submit">Оформить</button>
                <p>
                    Нажимая на кнопку и передавая свои данные, вы даёте согласие на обработку
                    <a href="#">персональных данных</a>
                </p>
            </div>
        </form>

        <!-- Блок "Спасибо за заказ" -->
        <div class="order-success" style="display:none;">
            <div class="call_back_info_block">
                <div class="call_back_info_ic">
                    <img src="/local/templates/razvitie/src/assets/svgicons/like.svg" alt="">
                </div>
                <h4 class="call_back_info_title">Спасибо за заказ!</h4>
                <div class="call_back_info_subtitle">Номер заказа №<span id="orderNumber"></span></div>
                <p class="call_back_info_text">
                    Мы приняли ваш заказ в работу. В ближайшее время с вами свяжется менеджер.
                </p>
                <a href="/catalog/" class="call_back_info_btn">В каталог</a>
            </div>
        </div>
    </div>
</div>

<div class="authorization-modal modal_z">
    <div class="modal-content">
        <span class="close"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/modal_x.svg" alt=""></span>
        <?$APPLICATION->IncludeComponent(
            "bitrix:system.auth.form",
            "main",
            Array(
                "FORGOT_PASSWORD_URL" => "/auth/",
                "PROFILE_URL" => "/auth/",
                "REGISTER_URL" => "/auth/",
                "SHOW_ERRORS" => "Y"
            )
        );?>
    </div>
</div>

<div class="recovery-password-modal modal_z">
    <div class="modal-content">
        <span class="close"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/modal_x.svg" alt=""></span>
        <h2>Восстановление <br>
            пароля
            <div class="subtitle">
                Введите e-mail, который вы использовали при <br> регистрации. На него будет отправлена ссылка для <br> восстановления пароля
            </div>
        </h2>

        <form id="recoveryPasswordForm">
            <div class="input_grups">
                <label for="inn" class="label_z">Email организации
                    <input type="email" id="inn" name="email" class="input_z" placeholder="drumbaram@mail.ru" required>
                </label>
            </div>
            <button type="submit" class="btn_primary">Войти</button>
        </form>
    </div>
</div>

<div class="link-send-modal modal_z">
    <div class="modal-content">
        <span class="close"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/modal_x.svg" alt=""></span>
        <div class="icon_box">
            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/message_ic.svg" alt="">
        </div>
        <h2>Ссылка <br>
            отправлена
            <div class="subtitle">
                Отправили ссылку для восстановления пароля на вашу электронную почту <a href="#">example@gmail.com</a>
                <br><br>
                Перейдите по ссылке в письме, чтобы восстановить пароль
            </div>
        </h2>
        <button type="submit" class="btn_primary ok_btn">Отлично</button>
    </div>
</div>

<div class="change-password-modal modal_z">
    <div class="modal-content">
        <span class="close"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/modal_x.svg" alt=""></span>
        <h2>Смена пароля
            <div class="subtitle">
                Введите новый пароль ниже
            </div>
        </h2>

        <form id="changePasswordForm">
            <div class="input_grups">
                <label for="password_1" class="label_z">Новый пароль
                    <input type="password" id="password_1" class="input_z" name="password_1" placeholder="Введите пароль" required>
                    <a href="#" class="password_eye">
                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/show_eye_ic.svg" alt="" class="show_eye">
                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/hide_eye_ic.svg" alt="" class="hide_eye">
                    </a>
                </label>
                <label for="password_2" class="label_z">Повторите пароль
                    <input type="password" id="password_2" class="input_z" name="password_2" placeholder="Введите пароль" required>
                    <a href="#" class="password_eye">
                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/show_eye_ic.svg" alt="" class="show_eye">
                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/hide_eye_ic.svg" alt="" class="hide_eye">
                    </a>
                </label>
            </div>
            <p class="error-message" style="color: red;"></p>
            <button type="submit" class="btn_primary submit_btn">Сменить пароль</button>
        </form>
    </div>
</div>

<div class="registration-modal modal_z">
    <div class="modal-content">
        <span class="close"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/modal_x.svg" alt=""></span>
        <h2>Регистрация
            <div class="subtitle">
                Зарегистрируйтесь, чтобы сделать заказ.
                Для регистрации используйте ИНН и Email вашей организации — они понадобятся, если будет утерян доступ к аккаунту организации
            </div>
        </h2>

        <form id="registrationForm">
            <div class="input_grups">
                <label for="inn" class="label_z">ИНН
                    <input type="text" id="reg-inn" name="inn" class="input_z" placeholder="Введите ИНН организации" required>
                </label>
                <label for="email" class="label_z">Email
                    <input type="email" id="reg-email" name="email" class="input_z" placeholder="Введите Email организации" required>
                </label>
                <label for="password" class="label_z">Пароль
                    <input type="password" id="reg-password" class="input_z" name="password" placeholder="Введите пароль" required>
                    <a href="#" class="password_eye">
                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/show_eye_ic.svg" alt="" class="show_eye">
                        <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/hide_eye_ic.svg" alt="" class="hide_eye">
                    </a>
                </label>
            </div>

            <div class="modal_actions">
                <label class="toggle-differences">
                    <input type="checkbox" id="regToggleDifferences" name="checkbox">
                    Запомнить меня
                </label>
                <a href="#" class="forgot_password">Забыли пароль?</a>
            </div>

            <button type="submit" class="btn_primary">Войти</button>

            <div class="signup_text">Уже есть аккаунт?
                <a href="#">Войти
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path d="M6.75 13.5L11.25 9L6.75 4.5" stroke="#056BE9" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </form>
    </div>
</div>

<div class="cancel-order-modal modal_z">
    <div class="modal-content">
        <span class="close"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/modal_x.svg" alt=""></span>
        <div class="icon_box">
            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/cancel_order_ic.svg" alt="">
        </div>
        <h2>Хотите <br>
            отменить заказ?
            <div class="subtitle">
                После отмены ваш заказ будет перемещен в раздел «История заказов», где вы сможете повторить его.
            </div>
        </h2>
        <div class="modal-buttons">
            <button class="btn_primary white" data-order-id="12345">Отменить заказ</button>
            <button class="btn_primary ok_btn">Не отменять</button>
        </div>
    </div>
</div>

<div class="logout-modal modal_z">
    <div class="modal-content">
        <span class="close"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/modal_x.svg" alt=""></span>
        <div class="icon_box">
            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/exit_ic.svg" alt="">
        </div>
        <h2>Выйти <br>
            из аккаунта?
            <div class="subtitle">
                Вы уверены, что хотите выйти из аккаунта?
            </div>
        </h2>
        <div class="modal-buttons">
            <button class="btn_primary white cancel" data-order-id="12345">Отмена</button>
            <button class="btn_primary ok_btn">Выйти из аккаунта</button>
        </div>
    </div>
</div>

<div class="product-modal">
    <div class="product-modal__overlay"></div>
    <div class="product-modal__content">
        <button class="product-modal__close"><span><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/close_x_mod.svg" alt=""></span></button>

        <div class="product-modal__body">
            <div class="product-modal__gallery">
                <div class="swiper product-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                    </div>
                    <div class="swiper-button-next"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/modal_arr_product.svg" alt=""></div>
                    <div class="swiper-button-prev"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/modal_arr_product.svg" alt=""></div>
                </div>
                <div class="swiper product-thumbnails">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                        <div class="swiper-slide"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/product-0.png" alt=""></div>
                    </div>
                </div>
            </div>

            <div class="product-modal__details">
                <div class="product-modal__details_top">
                    <div class="product-status"><span></span> В наличии</div>
                    <div class="product-art">Арт. 156060</div>
                </div>
                <h2 class="product-title">Комплект ученической <br> мебели (4-6 р. гр.)</h2>

                <ul class="product-specs">
                    <li>Ростовая группа: <span>4-6</span></li>
                    <li>Высота, м: <span>150</span></li>
                    <li>Ширина, м: <span>1</span></li>
                    <li>Глубина, м: <span>1 шт</span></li>
                    <li>Глубина, м: <span>1 шт</span></li>
                    <li>Глубина, м: <span>1 шт</span></li>
                    <li>Глубина, м: <span>1 шт</span></li>
                    <li>Глубина, м: <span>1 шт</span></li>
                </ul>

                <div class="product-price">
                    <span class="current-price">643 428 ₽</span>
                    <span class="old-price">649 428 ₽</span>
                </div>

                <div class="product-modal__buttons">
                    <button class="add-to-cart"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/buy.svg" alt=""> Добавить в корзину</button>
                    <button class="buy-one-click">Купить в 1 клик</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="payment-options-modal modal_z">
    <div class="modal-content">
        <span class="close"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/modal_x.svg" alt=""></span>
        <div class="ic"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/payment_options.svg" alt=""></div>
        <h2>Варианты оплаты</h2>
        <p>
            Формат оплаты обсуждается индивидуально и будет зависеть от вашего запроса и наших возможностей. Мы стремимся к прозрачности и удобству для наших клиентов, поэтому все условия доставки и оплаты детально прописаны в договоре. Гарантируем, что все процессы будут проведены в соответствии с законодательством и вашими пожеланиями.
        </p>
        <ul>
            <li>Оплата после получения заказа (без предоплаты);</li>
            <li>Частичная оплата 15/30/50% до поставки;</li>
            <li>100% предоплата.</li>
        </ul>
    </div>
</div>

<div class="delivery-modal modal_z">
    <div class="modal-content">
        <span class="close"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/modal_x.svg" alt=""></span>
        <div class="ic"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/delivery.svg" alt=""></div>
        <h2>Доставка</h2>
        <div class="deli_item">
            <h5>До двери</h5>
            <p>
                Обеспечиваем доставку в любую точку России, до двери вашего учебного учреждения. Доставка включена в стоимость заказа.
            </p>
        </div>
        <div class="deli_item">
            <h5>В пункт выдачи</h5>
            <p>
                Возможно оформить доставку до пункта выдачи транспортной/курьерской компании. Доставка до терминала включена в стоимость заказа.
            </p>
        </div>
    </div>
</div>

<div class="review-modal modal_z">
    <div class="modal-content">
        <span class="close"><img src="<?=SITE_TEMPLATE_PATH?>/src/assets/svgicons/modal_x.svg" alt=""></span>
        <h2>Оставить отзыв</h2>

        <form class="reviews_form">
            <div class="rating">
                        <span data-value="1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
                                <path opacity="0.25" d="M14.319 5.72495C14.8693 4.61019 16.4589 4.61019 17.0091 5.72495L19.1779 10.1186C19.3962 10.5609 19.818 10.8676 20.306 10.9389L25.1584 11.6482C26.3883 11.8279 26.8784 13.3397 25.988 14.2069L22.4792 17.6245C22.1254 17.9691 21.9639 18.4658 22.0474 18.9526L22.8752 23.7789C23.0854 25.0044 21.7991 25.9388 20.6986 25.3601L16.3622 23.0797C15.9252 22.8498 15.403 22.8498 14.9659 23.0797L10.6295 25.3601C9.52907 25.9388 8.24274 25.0044 8.45292 23.7789L9.28069 18.9526C9.36418 18.4658 9.20269 17.9691 8.84888 17.6245L5.34008 14.2069C4.44969 13.3397 4.93987 11.8279 6.16974 11.6482L11.0221 10.9389C11.5101 10.8676 11.9319 10.5609 12.1502 10.1186L14.319 5.72495Z" fill="#056BE9" stroke="#056BE9" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                <span data-value="2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
                                <path opacity="0.25" d="M14.319 5.72495C14.8693 4.61019 16.4589 4.61019 17.0091 5.72495L19.1779 10.1186C19.3962 10.5609 19.818 10.8676 20.306 10.9389L25.1584 11.6482C26.3883 11.8279 26.8784 13.3397 25.988 14.2069L22.4792 17.6245C22.1254 17.9691 21.9639 18.4658 22.0474 18.9526L22.8752 23.7789C23.0854 25.0044 21.7991 25.9388 20.6986 25.3601L16.3622 23.0797C15.9252 22.8498 15.403 22.8498 14.9659 23.0797L10.6295 25.3601C9.52907 25.9388 8.24274 25.0044 8.45292 23.7789L9.28069 18.9526C9.36418 18.4658 9.20269 17.9691 8.84888 17.6245L5.34008 14.2069C4.44969 13.3397 4.93987 11.8279 6.16974 11.6482L11.0221 10.9389C11.5101 10.8676 11.9319 10.5609 12.1502 10.1186L14.319 5.72495Z" fill="#056BE9" stroke="#056BE9" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                <span data-value="3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
                                <path opacity="0.25" d="M14.319 5.72495C14.8693 4.61019 16.4589 4.61019 17.0091 5.72495L19.1779 10.1186C19.3962 10.5609 19.818 10.8676 20.306 10.9389L25.1584 11.6482C26.3883 11.8279 26.8784 13.3397 25.988 14.2069L22.4792 17.6245C22.1254 17.9691 21.9639 18.4658 22.0474 18.9526L22.8752 23.7789C23.0854 25.0044 21.7991 25.9388 20.6986 25.3601L16.3622 23.0797C15.9252 22.8498 15.403 22.8498 14.9659 23.0797L10.6295 25.3601C9.52907 25.9388 8.24274 25.0044 8.45292 23.7789L9.28069 18.9526C9.36418 18.4658 9.20269 17.9691 8.84888 17.6245L5.34008 14.2069C4.44969 13.3397 4.93987 11.8279 6.16974 11.6482L11.0221 10.9389C11.5101 10.8676 11.9319 10.5609 12.1502 10.1186L14.319 5.72495Z" fill="#056BE9" stroke="#056BE9" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                <span data-value="4">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
                                <path opacity="0.25" d="M14.319 5.72495C14.8693 4.61019 16.4589 4.61019 17.0091 5.72495L19.1779 10.1186C19.3962 10.5609 19.818 10.8676 20.306 10.9389L25.1584 11.6482C26.3883 11.8279 26.8784 13.3397 25.988 14.2069L22.4792 17.6245C22.1254 17.9691 21.9639 18.4658 22.0474 18.9526L22.8752 23.7789C23.0854 25.0044 21.7991 25.9388 20.6986 25.3601L16.3622 23.0797C15.9252 22.8498 15.403 22.8498 14.9659 23.0797L10.6295 25.3601C9.52907 25.9388 8.24274 25.0044 8.45292 23.7789L9.28069 18.9526C9.36418 18.4658 9.20269 17.9691 8.84888 17.6245L5.34008 14.2069C4.44969 13.3397 4.93987 11.8279 6.16974 11.6482L11.0221 10.9389C11.5101 10.8676 11.9319 10.5609 12.1502 10.1186L14.319 5.72495Z" fill="#056BE9" stroke="#056BE9" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                <span data-value="5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" viewBox="0 0 31 31" fill="none">
                                <path opacity="0.25" d="M14.319 5.72495C14.8693 4.61019 16.4589 4.61019 17.0091 5.72495L19.1779 10.1186C19.3962 10.5609 19.818 10.8676 20.306 10.9389L25.1584 11.6482C26.3883 11.8279 26.8784 13.3397 25.988 14.2069L22.4792 17.6245C22.1254 17.9691 21.9639 18.4658 22.0474 18.9526L22.8752 23.7789C23.0854 25.0044 21.7991 25.9388 20.6986 25.3601L16.3622 23.0797C15.9252 22.8498 15.403 22.8498 14.9659 23.0797L10.6295 25.3601C9.52907 25.9388 8.24274 25.0044 8.45292 23.7789L9.28069 18.9526C9.36418 18.4658 9.20269 17.9691 8.84888 17.6245L5.34008 14.2069C4.44969 13.3397 4.93987 11.8279 6.16974 11.6482L11.0221 10.9389C11.5101 10.8676 11.9319 10.5609 12.1502 10.1186L14.319 5.72495Z" fill="#056BE9" stroke="#056BE9" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
            </div>
            <p>Оцените товар</p>

            <div class="inputs">
                <div class="input-group">
                    <input required="" type="text" name="name" autocomplete="off" class="input_z" id="review-name">
                    <label class="user-label">Ваше имя</label>
                </div>
                <div class="input-group">
                    <input required="" type="text" name="organization" autocomplete="off" class="input_z" id="review-org">
                    <label class="user-label">Ваша организация</label>
                </div>
                <div class="input-group">
                    <textarea required="" type="text" name="text" autocomplete="off" class="input_z" id="review-text"></textarea>
                    <label class="user-label">Ваш отзыв</label>
                </div>
            </div>

            <button class="submit-review">Отправить</button>
        </form>
    </div>
</div>

<!-- Popup modal -->

</body>
</html>
