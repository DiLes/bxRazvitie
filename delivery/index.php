<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оплата и доставка");
?>
<div class="container white deli_con instruction_block">
    <div class="tabs-container">
        <div class="tabs">
            <div class="tab active" data-target="payment"><span></span> Варианты оплаты</div>
            <div class="tab" data-target="delivery"><span></span> Доставка</div>
        </div>

        <div class="content-container">
            <div class="content active" id="payment">
                <h2>Варианты оплаты</h2>
                <div class="content_item">
                    <p>
                        Формат оплаты обсуждается индивидуально и будет зависеть от вашего запроса и наших возможностей. Мы стремимся к прозрачности и удобству для наших клиентов, поэтому все условия доставки и оплаты детально прописаны в договоре. Гарантируем, что все процессы будут проведены в соответствии с законодательством и вашими пожеланиями.
                    </p>
                    <ul>
                        <li>Оплата после получения заказа (без предоплаты).</li>
                        <li>Частичная оплата 15/30/50% до поставки.</li>
                        <li>100% предоплата.</li>
                    </ul>
                </div>
                </div>

            <div class="content" id="delivery">
                <h2>Доставка</h2>

                <div class="content_item">
                    <h3>До двери</h3>
                    <p>
                        Обеспечиваем доставку в любую точку России, до двери вашего учебного учреждения. Доставка включена в стоимость заказа.
                    </p>
                </div>
                <div class="content_item">
                    <h3>В пункт выдачи</h3>
                    <p>
                        Возможно оформить доставку до пункта выдачи транспортной/курьерской компании. Доставка до терминала включена в стоимость заказа.
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>