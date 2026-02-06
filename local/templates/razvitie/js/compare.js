document.addEventListener("DOMContentLoaded", () => {

    const compareCounter = document.querySelector('.mini-compare .badge-wrapper span');

    // ==========================================================
    // 🔹 1. Добавление / удаление товара из сравнения
    // ==========================================================
    document.body.addEventListener("click", function (event) {
        const button = event.target.closest('[data-action="compare"]');
        if (!button) return;

        const productId = button.dataset.item;
        const iblockId = button.dataset.iblock;
        const isActive = button.classList.contains('active');
        const action = isActive ? 'delete' : 'add';

        fetch(`/ajax/compare.php?action=${action}&product_id=${productId}&iblock_id=${iblockId}`)
        .then(res => res.json())
        .then(data => {
                if (data.success) {
                button.classList.toggle('active', !isActive);
                if (compareCounter) compareCounter.textContent = data.total;
            } else {
                console.warn('Ошибка при обновлении сравнения');
            }
        })
        .catch(err => console.error('Compare error:', err));
    });

    // ==========================================================
    // 🔹 2. Удаление одного товара со страницы сравнения
    // ==========================================================
    document.body.addEventListener("click", function (event) {
        const clearBtn = event.target.closest(".clear_compare_pr");
        if (!clearBtn) return;

        if (!confirm("Вы уверены, что хотите удалить этот товар из сравнения?")) return;

        const productSlide = clearBtn.closest(".swiper-slide");
        if (!productSlide) return;

        const productId = productSlide.dataset.num;
        const iblockId = productSlide.dataset.iblock;

        fetch(`/ajax/compare.php?action=delete&product_id=${productId}&iblock_id=${iblockId}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                // Удаляем карточки
                productSlide.remove();
                const specSlide = document.querySelector(`.specifications_z_compare_swiper .swiper-slide[data-num="${productId}"]`);
                if (specSlide) specSlide.remove();

                // Обновляем счётчик
                if (compareCounter) compareCounter.textContent = data.total;
            }
        })
        .catch(err => console.error('Compare delete error:', err));
    });

    // ==========================================================
    // 🔹 3. Очистить весь список сравнения
    // ==========================================================
    const clearAllBtn = document.querySelector(".clear_list");
    if (clearAllBtn) {
        clearAllBtn.addEventListener("click", (e) => {
            e.preventDefault();

        if (!confirm("Вы уверены, что хотите очистить весь список сравнения?")) return;

        const iblockId = clearAllBtn.dataset.iblock || 2; // можно задать ID инфоблока

        fetch(`/ajax/compare.php?action=clear&iblock_id=${iblockId}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                    document.querySelectorAll(".compare_products_block .product-card, .compare_products_specifications_z, .filter-tags, .smilar-products__swiper-button-wraper, .specifications_z_compare_swiper .swiper-slide")
                        .forEach(el => el.remove());
                    if (compareCounter) compareCounter.textContent = data.total;
                }
            })
            .catch(err => console.error('Compare clear error:', err));
        });
    }

});
