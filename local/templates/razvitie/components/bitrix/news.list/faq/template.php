<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>
<div class="faq">
    <div class="faq__top">
        <div class="col">
            <span>Вопрос-ответ</span>
            <h2>
                Часто задаваемые
                <span>вопросы</span>
            </h2>
        </div>
        <div class="faq__leave-a-request faq__leave-a-request--pc">
            <div class="img-wrapper">
                <img src="<?= SITE_TEMPLATE_PATH ?>/src/assets/images/manager.png" alt=""/>
                <svg
                        width="67"
                        height="68"
                        viewBox="0 0 67 68"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <rect
                            x="0.0195312"
                            y="0.238281"
                            width="66.9815"
                            height="66.9815"
                            rx="33.4907"
                            fill="white"
                    />
                    <path
                            d="M31.1693 31.0716L31.4487 30.2334C32.0351 28.4744 34.3556 28.0978 35.4681 29.5811C36.1198 30.45 36.0743 31.6564 35.3591 32.4738L34.5931 33.3493C33.9976 34.0299 33.6693 34.9035 33.6693 35.8078V36.0717M42.0027 33.5717C42.0027 38.1741 38.2717 41.905 33.6693 41.905C29.0669 41.905 25.3359 38.1741 25.3359 33.5717C25.3359 28.9693 29.0669 25.2383 33.6693 25.2383C38.2717 25.2383 42.0027 28.9693 42.0027 33.5717Z"
                            stroke="#056BE9"
                            stroke-width="1.21"
                            stroke-linecap="round"
                    />
                    <path
                            d="M34.5026 38.5716C34.5026 39.0319 34.1295 39.405 33.6693 39.405C33.209 39.405 32.8359 39.0319 32.8359 38.5716C32.8359 38.1114 33.209 37.7383 33.6693 37.7383C34.1295 37.7383 34.5026 38.1114 34.5026 38.5716Z"
                            fill="#056BE9"
                    />
                </svg>
            </div>
            <div class="row">
                <h4>Остались вопросы? Обсудите с менеджером</h4>
                <a href="#" class="request-trigger">Оставить заявку</a>
            </div>
        </div>
    </div>
    <div class="faq__accordions">
        <?
        //$i = 0;
        foreach($arResult["ITEMS"] as $i => $arItem){
            $this->AddEditAction($arItem['ID'],$arItem['EDIT_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'],$arItem['DELETE_LINK'],CIBlock::GetArrayByID($arItem["IBLOCK_ID"],"ELEMENT_DELETE"),array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            // Открываем колонку каждые 3 элемента
            if ($i % 3 === 0){ ?>
                <div class="column">
            <?}?>

            <div class="accordion" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="accordion-trigger">
                    <span><?= htmlspecialchars($arItem['NAME']) ?></span>
                    <div class="accordion-icon">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                        >
                            <path
                                    d="M8.21586 1.53678C8.21586 1.17992 7.92657 0.890625 7.56971 0.890625C7.21285 0.890625 6.92356 1.17992 6.92356 1.53678L6.92356 7.78293H0.677404C0.320543 7.78293 0.03125 8.07223 0.03125 8.42909C0.03125 8.78595 0.320543 9.07524 0.677404 9.07524H6.92356V15.3214C6.92356 15.6783 7.21285 15.9675 7.56971 15.9675C7.92657 15.9675 8.21587 15.6783 8.21587 15.3214V9.07524H14.462C14.8189 9.07524 15.1082 8.78595 15.1082 8.42909C15.1082 8.07223 14.8189 7.78293 14.462 7.78293H8.21587L8.21586 1.53678Z"
                                    fill="#1A1A1A"
                            />
                        </svg>
                    </div>
                </div>
                <div class="accordion-content">
                    <p><?= htmlspecialchars($arItem['PREVIEW_TEXT']) ?></p>
                </div>
            </div>

            <?
            $i++;
            // Закрываем колонку после 3-го элемента
            if ($i % 3 === 0){ ?>
                </div>
            <?
                }
            }

    // Если после последнего элемента колонка осталась открыта
    if ($i % 3 !== 0){ ?>
    </div>
    <?}?>
</div>

<div class="faq__leave-a-request faq__leave-a-request--mobile">
        <div class="img-wrapper">
            <img src="<?= SITE_TEMPLATE_PATH ?>/src/assets/images/manager.png" alt=""/>
            <svg width="67" height="68" viewBox="0 0 67 68" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect
                        x="0.0195312"
                        y="0.238281"
                        width="66.9815"
                        height="66.9815"
                        rx="33.4907"
                        fill="white"
                />
                <path
                        d="M31.1693 31.0716L31.4487 30.2334C32.0351 28.4744 34.3556 28.0978 35.4681 29.5811C36.1198 30.45 36.0743 31.6564 35.3591 32.4738L34.5931 33.3493C33.9976 34.0299 33.6693 34.9035 33.6693 35.8078V36.0717M42.0027 33.5717C42.0027 38.1741 38.2717 41.905 33.6693 41.905C29.0669 41.905 25.3359 38.1741 25.3359 33.5717C25.3359 28.9693 29.0669 25.2383 33.6693 25.2383C38.2717 25.2383 42.0027 28.9693 42.0027 33.5717Z"
                        stroke="#056BE9"
                        stroke-width="1.21"
                        stroke-linecap="round"
                />
                <path
                        d="M34.5026 38.5716C34.5026 39.0319 34.1295 39.405 33.6693 39.405C33.209 39.405 32.8359 39.0319 32.8359 38.5716C32.8359 38.1114 33.209 37.7383 33.6693 37.7383C34.1295 37.7383 34.5026 38.1114 34.5026 38.5716Z"
                        fill="#056BE9"
                />
            </svg>
        </div>
        <div class="row">
            <h4>Остались вопросы? Обсудите с менеджером</h4>
            <a href="#" class="request-trigger">Оставить заявку</a>
        </div>
    </div>
</div>