<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$INPUT_ID = trim($arParams['~INPUT_ID']);
if ($INPUT_ID == '') {
    $INPUT_ID = 'title-search-input';
}
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams['~CONTAINER_ID']);
if ($CONTAINER_ID == '') {
    $CONTAINER_ID = 'title-search';
}
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if ($arParams['SHOW_INPUT'] !== 'N'):
?>
<div id="<?= $CONTAINER_ID ?>">
    <form action="<?= $arResult['FORM_ACTION'] ?>" class="search-form">
        <div class="search-form__overlay"></div>
        <div class="search-input">
            <div class="search-input__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18" fill="none">
                    <g opacity="0.3">
                        <path d="M13.8494 12.8724C13.5128 12.5358 12.9669 12.5358 12.6303 12.8724C12.2936 13.2091 12.2936 13.7549 12.6303 14.0916L13.8494 12.8724ZM15.3888 16.8501C15.7255 17.1868 16.2713 17.1868 16.608 16.8501C16.9446 16.5135 16.9446 15.9677 16.608 15.631L15.3888 16.8501ZM12.6303 14.0916L15.3888 16.8501L16.608 15.631L13.8494 12.8724L12.6303 14.0916ZM7.72253 13.3095C4.77066 13.3095 2.37769 10.9166 2.37769 7.9647H0.653556C0.653556 11.8688 3.81845 15.0337 7.72253 15.0337V13.3095ZM13.0674 7.9647C13.0674 10.9166 10.6744 13.3095 7.72253 13.3095V15.0337C11.6266 15.0337 14.7915 11.8688 14.7915 7.9647H13.0674ZM7.72253 2.61988C10.6744 2.61988 13.0674 5.01284 13.0674 7.9647H14.7915C14.7915 4.06062 11.6266 0.895743 7.72253 0.895743V2.61988ZM7.72253 0.895743C3.81845 0.895743 0.653556 4.06062 0.653556 7.9647H2.37769C2.37769 5.01284 4.77066 2.61988 7.72253 2.61988V0.895743Z" fill="#1A1A1A"/>
                    </g>
                </svg>
            </div>
            <input id="<?= $INPUT_ID ?>" type="text" placeholder="Поиск по сайту" name="q" autocomplete="off"/>
            <div class="search-input__clear">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13" fill="none">
                    <path d="M0.958984 0.958987L12.0423 12.0423M0.959006 12.0423L6.50067 6.50065L12.0423 0.958984" stroke="#1A1A1A" stroke-width="1.6" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
        <div class="search-result">
            <!-- AJAX результаты будут загружены сюда -->
        </div>
    </form>
</div>
<?php endif; ?>

<script>
BX.ready(function(){
    new JCTitleSearch({
        'AJAX_PAGE': '<?= CUtil::JSEscape(POST_FORM_ACTION_URI) ?>',
        'CONTAINER_ID': '<?= $CONTAINER_ID ?>',
        'INPUT_ID': '<?= $INPUT_ID ?>',
        'MIN_QUERY_LEN': 2,
        'WAIT_IMAGE': '/bitrix/components/bitrix/search.title/images/wait.gif'
    });
});
</script>
