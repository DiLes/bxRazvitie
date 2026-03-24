<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
 * Модальное окно подтверждения выхода из аккаунта
 */
?>
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
            <button class="btn_primary white cancel">Отмена</button>
            <button class="btn_primary logout_confirm_btn">Выйти из аккаунта</button>
        </div>
    </div>
</div>
