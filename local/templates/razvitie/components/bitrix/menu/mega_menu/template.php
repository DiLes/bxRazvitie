<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!empty($arResult)){

    ?>

        <div class="catalog-popup__left">
            <?foreach($arResult as $arItem) {
                //pre($arItem['CHILD']);
                ?>
                <a href="<?=$arItem['LINK']?>" class="item">
                    <span><?=$arItem['TEXT']?></span>
                    <svg width="46" height="46" viewBox="0 0 46 46" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="23" cy="23" r="23" fill="#F4F6F8"></circle>
                        <path d="M17.9688 23H28.0312" stroke="#056BE9" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M23 17.9688L28.0312 23L23 28.0312" stroke="#056BE9" stroke-width="1.4375" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <img src="<?=$arItem['PARAMS']['PICTURE']?>" alt="">
                </a>
            <?}?>

        </div>


        <div class="catalog-popup__center">
            <?foreach($arResult as $k => $arItem) {?>
                <?if (!empty($arItem['CHILD'])){
                    $childCount = count($arItem['CHILD']);
                    $leftCount = (int)ceil($childCount / 2);
                    $rightCount = $childCount - $leftCount;

                    $leftItems = array_slice($arItem['CHILD'], 0, $leftCount);
                    $rightItems = array_slice($arItem['CHILD'], $leftCount, $rightCount);

//                    pre(count($leftItems));
//                    pre(count($rightItems));
//                    pre($rightItems);
//                    pre($rightCount);
                    ?>
                    <div class="center-item" style="display:<?=($k == 0)?(' flex'):(' none')?>;" data-child-id="<?=$k?>">
                        <?if ($leftItems) {?>
                        <div class="left">
                            <?foreach ($leftItems as $i => $arChild){?>
                                <div data-child-id="<?=$i?>">
                                    <a href="<?=$arChild["LINK"]?>" class="item-child"><?=$arChild["TEXT"]?></a>
                                    <?
                                    //pre(count($arChild["CHILD"]));
                                    foreach ($arChild["CHILD"] as $s => $subChild){
                                    ?>
                                        <a href="<?=$subChild["LINK"]?>" class="item-subchild"><?=$subChild["TEXT"]?></a>

                                    <?}?>
                                    <?if (is_array($arChild["CHILD"]) && count($arChild["CHILD"]) > 4){?>
                                        <button class="more">
                                            Ещё
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                                                <g>
                                                    <path d="M9.75 5.75L6 9.5L2.25 5.75" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </button>
                                    <?}?>
                                </div>
                            <?}?>
                        </div>
                        <?}?>
                        <?if ($rightItems) {?>
                        <div class="right">
                            <?foreach ($rightItems as $a => $arChild){?>
                                <div data-child-id="<?=$a?>">
                                    <a href="<?=$arChild["LINK"]?>" class="item-child"><?=$arChild["TEXT"]?></a>
                                    <?
                                    //pre(count($arChild["CHILD"]));
                                    foreach ($arChild["CHILD"] as $d => $subChild){
                                    ?>
                                        <a href="<?=$subChild["LINK"]?>" class="item-subchild"><?=$subChild["TEXT"]?></a>

                                    <?}?>
                                    <?if (is_array($arChild["CHILD"]) && count($arChild["CHILD"]) > 4){?>
                                    <button class="more">
                                        Ещё
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13" fill="none">
                                            <g>
                                                <path d="M9.75 5.75L6 9.5L2.25 5.75" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </g>
                                        </svg>
                                    </button>
                                    <?}?>
                                </div>
                            <?}?>
                        </div>
                        <?}?>
                    </div>
                <?}?>
            <?}?>
        </div>
        <div class="catalog-popup__right">
            <h2>Не знаете какая категория нужна?</h2>
            <p>Оставьте заявку, и мы поможем найти то, что вам нужно</p>
            <a href="#" class="request-trigger">Оставить заявку</a>
            <img src="<?=SITE_TEMPLATE_PATH?>/src/assets/images/classroom.png" alt="">
            <div class="shadow"></div>
        </div>
    </div>

<?}?>
