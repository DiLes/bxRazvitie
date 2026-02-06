// --- Module for all modals ---
const ModalModule = (function () {
    function init(modalSelector, triggerSelector) {
        const modal = document.querySelector(modalSelector);
        if (!modal) return;

        const modalContent = modal.querySelector(".modal__content") || modal;
        const closeBtn = modal.querySelector(".modal__close-btn");
        const triggers = document.querySelectorAll(triggerSelector);

        // --- Открытие ---
        triggers.forEach(trigger => {
            trigger.addEventListener("click", (e) => {
                e.preventDefault();
                modal.classList.add("show");

                // Передаём ID товара в input[name="PRODUCT_ID"]
                const productId = trigger.dataset.item;
                const input = modal.querySelector("input[name='PRODUCT_ID']");
                if (input && productId) input.value = productId;
            });
        });

        // --- Закрытие ---
        const closeModal = () => modal.classList.remove("show");

        if (closeBtn) closeBtn.addEventListener("click", closeModal);
        modal.addEventListener("click", (e) => {
            if (!modalContent.contains(e.target)) closeModal();
        });
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") closeModal();
        });
    }

    return { init };
})();

// --- Инициализация ---
document.addEventListener("DOMContentLoaded", () => {
    ModalModule.init("#oneBuyClickModal", ".one_buy_click-trigger");
ModalModule.init("#requestModal", ".request-trigger");
});
