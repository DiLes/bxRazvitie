document.addEventListener("DOMContentLoaded", () => {
    const deliveryOptions = document.querySelectorAll(".delivery-option input");
    const orderTotalElement = document.querySelector(".checkout-summary .total_sum span");
    const deliveryCostElement = document.querySelector(".checkout-summary .deivery_summ");
    const itemsSummElement = document.querySelector(".checkout-summary .items_summ");

    // Служебные поля Bitrix
    const signedParamsInput = document.querySelector('[name="signedParamsString"]');
    const sessidInput = document.querySelector('[name="sessid"]');
    const siteIdInput = document.querySelector('[name="SITE_ID"]');
    const siteId = siteIdInput?.value || BX?.message?.("SITE_ID") || "s1";

    console.log(deliveryOptions, 'deliveryOptions-13');
    
    if (!deliveryOptions.length) {
        // console.warn("⚠️ Способы доставки не найдены");
        return;
    }

    // === Инициализация цен ===
    const basePrice = parseFloat(itemsSummElement?.dataset.productsPrice || 0); // ТОВАРЫ — постоянная
    let deliveryPrice = parseFloat(deliveryCostElement?.dataset.deliveryPrice || 0); // доставка
    let totalPrice = parseFloat(orderTotalElement?.dataset.totalPrice || basePrice + deliveryPrice);

    updateSummary();

    // === Восстановление выбранного способа ===
    const savedDeliveryId = localStorage.getItem("selectedDeliveryId");
    if (savedDeliveryId) {
        const savedOption = document.querySelector(`.delivery-option input[data-delivery-id="${savedDeliveryId}"]`);
        if (savedOption) {
            savedOption.checked = true;
            savedOption.parentElement.classList.add("selected");
            recalcOrder(savedDeliveryId); // пересчитываем при загрузке
        }
    }

    // === Обработка выбора доставки ===
    deliveryOptions.forEach(option => {
        option.addEventListener("change", async function () {
            deliveryOptions.forEach(opt => opt.parentElement.classList.remove("selected"));
            this.parentElement.classList.add("selected");

            const deliveryId = this.dataset.deliveryId;
            if (!deliveryId) return;

            localStorage.setItem("selectedDeliveryId", deliveryId);
            console.log(`🚚 Изменён способ доставки: ${deliveryId}`);

            await recalcOrder(deliveryId);
        });
    });

    // === Обновление итогов ===
    function updateSummary() {
        // Товары — не трогаем
        if (itemsSummElement)
            itemsSummElement.textContent = `${basePrice.toLocaleString("ru-RU")} ₽`;

        // Обновляем доставку
        if (deliveryCostElement) {
            deliveryCostElement.textContent = `${deliveryPrice.toLocaleString("ru-RU")} ₽`;
            deliveryCostElement.dataset.deliveryPrice = deliveryPrice;
        }

        // Общая сумма
        totalPrice = basePrice + deliveryPrice;
        if (orderTotalElement) {
            orderTotalElement.textContent = `${totalPrice.toLocaleString("ru-RU")} ₽`;
            orderTotalElement.dataset.totalPrice = totalPrice;
        }
    }

    // ✅ Добавление события проверки к двум кнопкам проверки
/*    checkoutButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            if (!checkFormCompletion()) {
                alert("Пожалуйста, заполните все поля!");
                event.preventDefault();
            } else {
                alert("Ваш заказ принят!");
            }
        });
    });*/

    // Полная функция проверки формы
/*    function checkFormCompletion() {
        let isValid = true;

        requiredInputs.forEach(input => {
            // Заметка: мы находим сообщение об ошибке с " nextElementSibling
            let errorMessage = input.nextElementSibling;
        // Мы проверим, действительно ли этот элемент".имеет класс' сообщение об ошибке'
        if (errorMessage && !errorMessage.classList.contains("error-message")) {
            errorMessage = null;
        }

        if (input.value.trim() === "") {
            isValid = false;
            // Если раньше не было сообщения об ошибке, мы создадим новое
            if (!errorMessage) {
                const errorSpan = document.createElement("span");
                errorSpan.classList.add("error-message");
                errorSpan.textContent = "Это поле обязательно!";
                Object.assign(errorSpan.style, {
                    color: "red",
                    fontSize: "12px",
                    display: "block",
                    marginTop: "5px"
                });
                // Мы добавляем сообщение об ошибке в следующий элемент ввода
                input.insertAdjacentElement("afterend", errorSpan);
            }
        } else {
            // Если Input заполнен, мы удаляем сообщение об ошибке
            if (errorMessage) {
                errorMessage.remove();
            }
        }
    });

        return isValid;
    }*/

    // === Пересчёт заказа ===
    async function recalcOrder(deliveryId) {
        try {
            const formData = new FormData();
            formData.append("soa-action", "refreshOrderAjax");
            formData.append("via_ajax", "Y");
            formData.append("SITE_ID", siteId);
            formData.append("sessid", sessidInput?.value || BX.bitrix_sessid());
            formData.append("order[DELIVERY_ID]", deliveryId);
            formData.append("order[PERSON_TYPE]", 2);
            formData.append("signedParamsString", signedParamsInput?.value || "");

            console.log("📦 Отправляем запрос на /ajax/order.php ...");

            const response = await fetch("/ajax/order.php", { method: "POST", body: formData });
            const text = await response.text();

            // Bitrix может вернуть HTML + JSON — достаем JSON
            const match = text.match(/\{[\s\S]*\}$/);
            if (!match) {
                console.error("⚠️ Не удалось выделить JSON:", text);
                return;
            }

            const data = JSON.parse(match[0]);
            if (!data.order) {
                console.error("⚠️ Некорректный ответ Bitrix:", data);
                return;
            }

            console.log(data.order.DELIVERY,'data-102');

            // Берём актуальные данные по доставке
            const activeDelivery = Object.values(data.order.DELIVERY || {}).find(d => d.CHECKED === "Y");
            deliveryPrice = parseFloat(activeDelivery?.PRICE || data.order.PRICE_DELIVERY || 0);

            updateSummary();

            console.log("✅ Пересчёт выполнен:", {
                activeDelivery: activeDelivery?.NAME,
                deliveryPrice,
                totalPrice
        });
        } catch (err) {
            console.error("❌ Ошибка при пересчёте заказа:", err);
        }
    }
});
