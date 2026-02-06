document.addEventListener("DOMContentLoaded", () => {
    const deliveryOptions = document.querySelectorAll(".delivery-option input");
    const orderTotalElement = document.querySelector(".checkout-summary .total_sum span");
    const deliveryCostElement = document.querySelector(".checkout-summary .deivery_summ");
    const itemsSummElement = document.querySelector(".checkout-summary .items_summ");

    // --- Найдём зашифрованные параметры компонента Bitrix (обязательные!)
    const signedParamsInput = document.querySelector('[name="signedParamsString"]');
    const sessidInput = document.querySelector('[name="sessid"]');
    const siteId = BX?.message?.("SITE_ID") || "s1";

    // console.log(deliveryOptions, 'deliveryOptions-12');
    // console.log(orderTotalElement, 'orderTotalElement-13');
    // console.log(deliveryCostElement, 'deliveryCostElement-14');
    // console.log(itemsSummElement, 'itemsSummElement-15');

    // --- Изменение способа доставки ---
    deliveryOptions.forEach(option => {
        option.addEventListener("change", async function () {
            deliveryOptions.forEach(opt => opt.parentElement.classList.remove("selected"));
            this.parentElement.classList.add("selected");

            const deliveryId = this.dataset.deliveryId;
            console.log(deliveryId, 'deliveryId-24');
            if (!deliveryId) return;

            await recalcOrder(deliveryId);
        });
    });

    // --- Функция пересчёта заказа через ajax.php ---
    async function recalcOrder(deliveryId) {
        try {
            const formData = new FormData();
            formData.append("soa-action", "refreshOrderAjax");
            formData.append("via_ajax", "Y");
            formData.append("SITE_ID", siteId);
            formData.append("sessid", sessidInput?.value || BX.bitrix_sessid());
            formData.append("order[DELIVERY_ID]", deliveryId);
            formData.append("order[PERSON_TYPE]", 2); // если физ/юр лицо фиксировано
            formData.append("signedParamsString", signedParamsInput?.value || "");

            const response = await fetch("/ajax/order.php", {
                method: "POST",
                body: formData
            });

            const text = await response.text();
            const match = text.match(/\{.*\}$/s);
            if (!match) {
                console.error("Не удалось распарсить JSON ответ:", text);
                return;
            }

            const data = JSON.parse(match[0]);
            const price = parseFloat(data?.order?.PRICE || 0);
            const delivery = parseFloat(data?.order?.PRICE_DELIVERY || 0);
            const total = parseFloat(data?.order?.ORDER_TOTAL_PRICE || 0);

            console.log(data.order.DELIVERY, 'data-60');
            console.log(price, 'price-61');
            console.log(delivery, 'delivery-62');
            console.log(total, 'total-63');

            // --- Обновляем DOM ---
            if (itemsSummElement) itemsSummElement.textContent = `${price.toLocaleString()} ₽`;
            if (deliveryCostElement) deliveryCostElement.textContent = `${delivery.toLocaleString()} ₽`;
            if (orderTotalElement) orderTotalElement.textContent = `${total.toLocaleString()} ₽`;

            console.log("Обновлено:", { price, delivery, total });
        } catch (err) {
            console.error("Ошибка при пересчёте заказа:", err);
        }
    }
});
