const AppCustom = (function () {

    /* === МАСКА ТЕЛЕФОНА === */
    function initPhoneMask() {
        const phoneInputs = document.querySelectorAll('input[type="tel"], input[name*="phone"], input[name*="PHONE"]');
        phoneInputs.forEach(input => {
            Inputmask({
                  mask: "+7 (999) 999-99-99",
                  showMaskOnHover: false,
                  showMaskOnFocus: true,
                  clearIncomplete: true,
                  placeholder: "_"
              }).mask(input);
        });
    }

    /* === ДОБАВЛЕНИЕ В КОРЗИНУ === */

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".korzina-btn[data-item]").forEach(button => {
            button.addEventListener("click", function (e) {
                e.preventDefault();

                const productId = this.dataset.item;
                console.log(productId,'productId-25');
                if (!productId) {
                    console.error("❌ Не найден data-item у кнопки");
                    return;
                }

                fetch("/ajax/add2basket.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: "id=" + encodeURIComponent(productId) + "&quantity=1"
                })
                    .then(res => res.json())
            .then(data => {
                    if (data.status === "success") {
                    // ✅ Товар добавлен — меняем блоки
                    const pbBottom = button.closest(".pb-bottom");
                    if (pbBottom) {
                        const noBasket = pbBottom.querySelector(".no-basket");
                        const inBasket = pbBottom.querySelector(".in-basket");

                        if (noBasket && inBasket) {
                            noBasket.style.display = "none";
                            inBasket.style.display = "ruby";
                        }
                    }

                    // обновим мини-корзину (если есть функция)
                    if (typeof updateBasketCounter === "function") {
                        updateBasketCounter();
                    }
                } else {
                    alert("Ошибка: " + (data.message || "Не удалось добавить товар"));
                }
            })
            .catch(err => console.error("Ошибка запроса:", err));
            });
        });
    });



    /* === ТОРГОВЫЕ ПРЕДЛОЖЕНИЯ === */
    function initOffers() {
        document.querySelectorAll(".product[data-product-id]").forEach(product => {
            const productId = product.dataset.productId;
        product.querySelectorAll("button[data-treevalue]").forEach(btn => {
            btn.addEventListener("click", () => {
                const group = btn.closest(".option-buttons, .color-picker");
        if (group) group.querySelectorAll("button").forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        const selectedProps = Array.from(product.querySelectorAll("button.active[data-treevalue]"))
            .map(el => el.dataset.treevalue)
    .filter(v => !v.endsWith("_0"));

        if (!selectedProps.length) return;

        BX.ajax({
            url: "/ajax/find_offer_id.php",
            method: "POST",
            dataType: "json",
            data: {
                id: productId,
                tree: selectedProps,
                sessid: BX.bitrix_sessid()
            },
            onsuccess(response) {
                if (response.status === "success") {
                    const addBtn = product.querySelector(".korzina-btn");
                    if (addBtn) addBtn.dataset.item = response.offerId;

                    const priceEl = product.querySelector(".new-price");
                    if (priceEl && response.price) priceEl.textContent = response.price + " ₽";

                    const articleEl = product.querySelector(".product-article");
                    if (articleEl && response.article) articleEl.textContent = response.article;
                }
            }
        });
        });
        });
        });
    }

    /* === ОБНОВЛЕНИЕ МАЛОЙ КОРЗИНЫ === */

    function updateBasketCounter() {
        fetch('/ajax/basket_info.php').then(res => res.json()).then(data => {
            const count = data.count || 0;

            document.querySelectorAll('.header__actions .mini-basket .badge-wrapper span').forEach(el => el.textContent = count);
        }).catch(() => console.warn('Ошибка получения количества товаров в корзине'));
    }

    /*function markProductsInBasket() {
        fetch('/ajax/basket_info.php')
        .then(res => res.json())
        .then(data => {
            if (!data.items) return;
            const idsInBasket = data.items.map(item => item.productId);

            document.querySelectorAll(".product-card").forEach(card => {
                const id = parseInt(card.dataset.productId);
                if (idsInBasket.includes(id)) {
                    card.querySelector(".korzina-btn")?.style.setProperty('display', 'none');
                    card.querySelector(".in-basket-btn")?.style.setProperty('display', 'inline-flex');
                }
            });
        });
    }*/

    /* === ГОРОД === */
/*
    function initCitySelector() {
        const searchInput = document.querySelector("#cityModal input[type='text']");
        const cityItems = document.querySelectorAll(".city-modal__cities li");
        const cityBlocks = document.querySelectorAll(".city-modal__item");

        console.log(searchInput, 'searchInput-142');
        console.log(cityItems, 'cityItems-143');
        console.log(cityBlocks, 'cityBlocks-144');

        if (!searchInput) return;

        searchInput.addEventListener("input", function () {
            const query = this.value.trim().toLowerCase();
            cityItems.forEach(li => {
                const visible = li.textContent.toLowerCase().includes(query);
            li.style.display = visible ? "" : "none";
            });
                cityBlocks.forEach(block => {
                    const visibleLi = block.querySelector("li:not([style*='display: none'])");
                block.style.display = visibleLi ? "" : "none";
            });
        });

        cityItems.forEach(li => {
            li.addEventListener("click", function () {
                const cityName = this.textContent;
                localStorage.setItem("user_city", cityName);
                const mapPickText = document.querySelector(".map-pick__text");
                if (mapPickText) mapPickText.textContent = cityName;
                document.getElementById("cityModal").classList.remove("show");
            });
        });
    }
*/
    /* === ИНИЦИАЛИЗАЦИЯ === */
    function init() {
        initPhoneMask();
        initOffers();
        // initFavorites();
        // initCitySelector();
        updateBasketCounter();
    }

    return { init };

})();

// Запускаем всё при загрузке страницы
document.addEventListener("DOMContentLoaded", AppCustom.init);
