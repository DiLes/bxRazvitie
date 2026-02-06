document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.request__form').forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(form);
            formData.append("FORM_TYPE", form.dataset.formType || "request");

            const modal = form.closest('.modal');
            const successBlock = modal?.querySelector('.order-success');
            const orderNumberEl = modal?.querySelector('#orderNumber');

            try {
                const response = await fetch(form.dataset.action || '/ajax/form_handler.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (result.status === "success") {
                    // Скрываем форму
                    form.style.display = "none";

                    if (successBlock) {
                        // Показываем блок "Спасибо"
                        successBlock.style.display = "block";

                        // Если сервер вернул номер — вставляем его
                        if ((result.orderId || result.requestNumber) && orderNumberEl) {
                            orderNumberEl.textContent = result.orderId || result.requestNumber;
                        }
                    } else {
                        // Если нет блока "спасибо", просто показываем уведомление
                        alert("✅ " + (result.message || "Заявка успешно отправлена!"));
                        // Можно закрыть модалку через 1.5 сек
                        if (modal) {
                            setTimeout(() => modal.classList.remove('show'), 1500);
                        }
                    }
                } else {
                    alert("Ошибка: " + (result.message || "Не удалось отправить форму"));
                }
            } catch (err) {
                console.error("Ошибка сети:", err);
                alert("Ошибка сети. Попробуйте позже.");
            }
        });
    });
});