const AppCustom = (function () {

    // маска для телефонов
    document.addEventListener('DOMContentLoaded', function () {
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
    });

    // выборка торговый предложений
    document.addEventListener("DOMContentLoaded", function () {
        const products = document.querySelectorAll(".product[data-product-id]");

        products.forEach(product => {
            const productId = product.dataset.productId;
        const buttons = product.querySelectorAll("button[data-treevalue]");

        buttons.forEach(btn => {
            btn.addEventListener("click", () => {
                const group = btn.closest(".option-buttons, .color-picker");
        if (group) group.querySelectorAll("button").forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        const selectedProps = [];
        product.querySelectorAll("button.active[data-treevalue]").forEach(activeBtn => {
            const treeVal = activeBtn.dataset.treevalue;
        if (treeVal && !treeVal.endsWith("_0")) {
            selectedProps.push(treeVal);
        }
    });

        if (selectedProps.length === 0) return;

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

                    // Обновляем цену
                    const priceEl = product.querySelector(".new-price");
                    if (priceEl && response.price) {
                        priceEl.textContent = response.price + " ₽";
                    }

                    // Обновляем артикул
                    const articleEl = product.querySelector(".product-article");
                    if (articleEl && response.article) {
                        articleEl.textContent = response.article;
                    }
                }
            }
        });
    });
    });
    });
    });

    // малая корзина
    function updateBasketCounter() {
        fetch('/ajax/basket_info.php')
            .then(res => res.json())
            .then(data => {
                    const count = data.count || 0;

                // Обновим все .mini-basket на странице
                document.querySelectorAll('.header__actions .mini-favorites .badge-wrapper span')
                    .forEach(el => el.textContent = count);
            })
            .catch(() => {
                    console.warn('Ошибка получения количества товаров в корзине');
            });
    }

    // купить в один клик
    document.addEventListener("DOMContentLoaded", function () {
        const openButtons = document.querySelectorAll(".onebuyclick_btn");

        openButtons.forEach(btn => {
            btn.addEventListener("click", function (e) {
                e.preventDefault();

                const modal = document.querySelector(".buy-one-click-modal");
                const form = document.getElementById("buyOneClickForm");

                if (!modal || !form) {
                    console.warn("Модалка или форма не найдены");
                    return;
                }

                const productId = btn.dataset.id;
                modal.classList.add("active");

                const input = form.querySelector("input[name='PRODUCT_ID']");
                if (input) {
                    input.value = productId;
                }

                const closeButton = modal.querySelector(".modal__close-btn");
                const overlay = modal.querySelector(".modal__overlay");

                if (closeButton) {
                    closeButton.addEventListener("click", () => modal.classList.remove("active"));
                }

                if (overlay) {
                    overlay.addEventListener("click", () => modal.classList.remove("active"));
                }

                form.addEventListener("submit", function (e) {
                    e.preventDefault();
                    const formData = new FormData(form);

                    BX.ajax({
                        url: "/ajax/one_click_order.php",
                        method: "POST",
                        dataType: "json",
                        data: formData,
                        onsuccess: function (response) {
                            if (response.status === "success") {
                                alert("Заявка отправлена!");
                                modal.classList.remove("active");
                                form.reset();
                            } else {
                                alert("Ошибка: " + response.message);
                            }
                        },
                        onfailure: function () {
                            alert("Ошибка отправки. Попробуйте позже.");
                        }
                    });
                }, { once: true }); // чтобы не дублировался submit
            });
        });
    });


    // добавление в корзину
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".korzina-btn[data-item]").forEach(button => {
            button.addEventListener("click", function (e) {
                e.preventDefault();

                const wrapper = button.closest(".pb-bottom");
                const productId = button.dataset.item;
                const productContainer = button.closest(".product") || document;
                const optionsWrapper = productContainer.querySelector(".product-options");

                const selectedProps = [];

                if (optionsWrapper) {
                    optionsWrapper.querySelectorAll("button.active[data-treevalue]").forEach(btn => {
                        selectedProps.push(btn.dataset.treevalue); // пример: "23_13"
                });
                }

                BX.ajax({
                    url: "/ajax/add2basket.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id: productId,
                        quantity: 1,
                        tree: selectedProps,
                        sessid: BX.bitrix_sessid()
                    },
                    onsuccess(response) {
                        if (response.status === "success") {
                            alert("Товар добавлен в корзину");
                            updateBasketCounter();
                        } else {
                            alert("Ошибка: " + response.message);
                        }
                    },
                    onfailure() {
                        alert("Ошибка отправки запроса");
                    }
                });
            });
        });
    });


    // управление кол-во (плюс и минус)
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".quantity-selector").forEach((selector) => {
            const quantityValue = selector.querySelector(".quantity-value");
            const priceElement = selector.querySelector(".price_z");
            const btnIncrease = selector.querySelector(".btn-increase");
            const btnDecrease = selector.querySelector(".btn-decrease");
            const basePrice = parseFloat(selector.dataset.basePrice);
            const productId = parseInt(selector.dataset.item);

            if (!quantityValue || !priceElement || !btnIncrease || !btnDecrease || isNaN(basePrice) || isNaN(productId)) {
                console.warn("Ошибка в .quantity-selector: отсутствуют элементы или данные.");
                return;
            }

            let quantity = parseInt(quantityValue.innerText) || 1;

            updatePrice();

            btnIncrease.addEventListener("click", () => {
                quantity++;
                updateDisplay();
                updateBasket(productId, quantity);
            });

            btnDecrease.addEventListener("click", () => {
                if (quantity > 1) {
                    quantity--;
                    updateDisplay();
                    updateBasket(productId, quantity);
                } else {
                    // Удаление товара из корзины
                    deleteFromBasket(productId, selector);
                }
            });

            function updateDisplay() {
                quantityValue.innerText = quantity;
                updatePrice();
            }

            function updatePrice() {
                const totalPrice = Math.round(basePrice * quantity * 100) / 100; // округление до 2 знаков
                priceElement.innerText = formatPrice(totalPrice) + " ₽";
            }

            function formatPrice(price) {
                return price
                    .toFixed(2)                             // два знака после запятой
                    .replace(/\B(?=(\d{3})+(?!\d))/g, " ")  // пробелы между тысячами
                    .replace('.', ',');                    // замена точки на запятую
            }

            function updateBasket(productId, quantity) {
                BX.ajax({
                    url: "/ajax/update_quantity.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id: productId,
                        quantity: quantity,
                        sessid: BX.bitrix_sessid()
                    },
                    onsuccess: function (response) {
                        if (response.status !== "success") {
                            alert("Ошибка при обновлении количества");
                        }
                        updateBasketCounter();
                    },
                    onfailure: function () {
                        alert("Сбой связи с сервером");
                    }
                });
            }

            function deleteFromBasket(productId, selector) {
                BX.ajax({
                    url: "/ajax/delete_from_basket.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id: productId,
                        quantity: quantity,
                        sessid: BX.bitrix_sessid()
                    },
                    onsuccess: function (response) {
                        if (response.status === "success") {
                            const inBasket = selector.closest(".in-basket");
                            const noBasket = inBasket?.parentElement.querySelector(".no-basket");

                            if (inBasket) inBasket.style.display = "none";
                            if (noBasket) noBasket.style.display = "ruby"; // или "block" — зависит от верстки
                        } else {
                            alert("Ошибка при удалении из корзины");
                        }
                        updateBasketCounter();
                    },
                    onfailure: function () {
                        alert("Сбой связи с сервером при удалении");
                    }
                });
            }
        });
    });

    // добавление в корзину и управление
    /*document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".korzina-btn[data-item]").forEach((button) => {
            button.addEventListener("click", function (e) {
                e.preventDefault();
                const productId = this.dataset.item;
                if (!productId) return;

                BX.ajax({
                    url: "/ajax/add2basket.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id: productId,
                        quantity: 1,
                        sessid: BX.bitrix_sessid()
                    },
                    onsuccess: function (response) {
                        if (response.status === "success") {
                            // Скрываем блок "Добавить в корзину", показываем блок "В корзине"
                            const addBlock = document.querySelector(`.add-to-cart-controls[data-id="${productId}"]`);
                            const cartBlock = document.querySelector(`.cart-controls[data-id="${productId}"]`);
                            if (addBlock) {
                                addBlock.style.display = "none";
                            }
                            if (cartBlock) {
                                cartBlock.style.display = "flex";
                            }
                        }
                    }
                });
            });
    });

        // Уменьшение количества
        document.querySelectorAll(".quantity-selector").forEach((selector) => {
            const btnDecrease = selector.querySelector(".btn-decrease");
        const quantityValue = selector.querySelector(".quantity-value");
        const productId = selector.dataset.item;

        btnDecrease.addEventListener("click", function () {
            let quantity = parseInt(quantityValue.innerText);
            if (quantity <= 1) {
                // Плавное скрытие блока и возврат кнопки
                const cartBlock = selector.closest(".cart-controls");
                const addBlock = document.querySelector(`.add-to-cart-controls[data-id="${productId}"]`);
                if (cartBlock) cartBlock.style.display = "none";
                if (addBlock) addBlock.style.display = "flex";

                // Также можно отправить AJAX для удаления или обновления количества
                BX.ajax({
                    url: "/ajax/update_quantity.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        id: productId,
                        quantity: 0,
                        sessid: BX.bitrix_sessid()
                    }
                });
            }
        });
    });
    });*/

    const currentUrl = window.location.href;

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert("Ссылка скопирована");
    }).catch(() => {
            alert("Ошибка копирования");
    });
    }

    // FEATURED HEART
    document.querySelectorAll(".heart-btn-featured").forEach(button => {
        button.addEventListener("click", () => {
            const heartIcon = button.querySelector("svg path");

            if (!heartIcon) return;

            const currentFill = heartIcon.getAttribute("fill");

            if (currentFill && currentFill !== "none") {
                heartIcon.setAttribute("fill", "none"); // убрать сердце
            } else {
                heartIcon.setAttribute("fill", "#033B80"); // заполнить сердце
            }

            heartIcon.setAttribute("stroke", "#033B80"); // Граница всегда остается синей
        });
    });

    // BLACK HEART PRODUCT
    document.querySelectorAll(".black_heart").forEach(button => {
        button.addEventListener("click", () => {
            const heartIcon = button.querySelector("svg path");

            console.log(button, 'button-385');

            if (!heartIcon) return;

            let currentFill = heartIcon.getAttribute("fill") || "none";

            if (currentFill !== "none" && currentFill !== "") {
                heartIcon.setAttribute("fill", "none"); // убрать сердце
            } else {
                heartIcon.setAttribute("fill", "#1A1A1A"); // заполнить сердце
            }

            heartIcon.setAttribute("stroke", "#1A1A1A"); // Граница всегда остается черной
        });
    });

    //избранное
    document.addEventListener("DOMContentLoaded", function () {
        const isAuth = document.body.dataset.userAuth === "Y"; // передайте в body data-user-auth="Y" для авторизованных

        // Обновить счетчик в шапке
        function updateFavoritesCounter(count) {
            const badge = document.querySelector(".mini-favorites .badge-wrapper span");
            if (badge) badge.textContent = count;
        }

        // Получить избранное (из localStorage или с сервера)
        function getFavorites() {
            if (isAuth) {
                // Для авторизованных можно грузить AJAX-ом, но для счетчика можно передать с PHP
                return window.serverFavorites || [];
            } else {
                return JSON.parse(localStorage.getItem("favorites") || "[]");
            }
        }

        // Сохранить избранное
        function saveFavorites(favs) {
            if (isAuth) {
                fetch("/ajax/favorites.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ action: "save", ids: favs })
                });
            } else {
                localStorage.setItem("favorites", JSON.stringify(favs));
            }

            console.log(favs, 'favs-433');
            updateFavoritesCounter(favs.length);
        }

        // Инициализация кнопок избранного
        function initFavoriteButtons() {
            const favs = getFavorites();

            document.querySelectorAll("[data-action='favorite'], .heart-btn-featured").forEach(btn => {
                const itemId = parseInt(btn.dataset.item || btn.closest("[data-item]")?.dataset.item);
            if (!itemId) return;

            // Покрасить, если уже в избранном
            if (favs.includes(itemId)) {
                btn.classList.add("active");
            }

            btn.addEventListener("click", function (e) {
                e.preventDefault();
                let favorites = getFavorites();

                if (favorites.includes(itemId)) {
                    // Удаляем
                    favorites = favorites.filter(id => id !== itemId);
                    btn.classList.remove("active");
                } else {
                    // Добавляем
                    favorites.push(itemId);
                    btn.classList.add("active");
                }

                saveFavorites(favorites);
            });
        });
        }

        initFavoriteButtons();
        updateFavoritesCounter(getFavorites().length);
    });

    //SELECT CITY
    document.addEventListener("click", function(e) {
        let cityItem = e.target.closest(".city-grid li");
        if (cityItem) {
            let city = cityItem.innerText;

            fetch("/ajax/save_city.php", {
                method: "POST",
                headers: {"Content-Type": "application/x-www-form-urlencoded"},
                body: "city=" + encodeURIComponent(city)
            })
                .then(r => r.json())
        .then(data => {
                if (data.status === "ok") {
                    // подсветим выбранный город
                    document.querySelectorAll(".city-grid li").forEach(li => li.classList.remove("active"));
                    cityItem.classList.add("active");

                    // закрыть модалку
                    document.querySelector("#cityModal").classList.remove("active");

                    // обновить город в шапке
                    let cityHeader = document.querySelector(".header__city");
                    if (cityHeader) cityHeader.innerText = data.city;
                }
            });
        }
    });

    // закрытие модалки
    document.querySelectorAll(".modal__close-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            btn.closest(".modal").classList.remove("active");
        });
    });

    // SELECT CITY
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.querySelector("#cityModal input[type='text']");
        const cityItems = document.querySelectorAll(".city-modal__cities li");
        const cityBlocks = document.querySelectorAll(".city-modal__item");

        if (!searchInput) return;

        searchInput.addEventListener("input", function () {
            const query = this.value.trim().toLowerCase();

            if (query === "") {
                // Показываем всё
                cityItems.forEach(li => li.style.display = "");
                cityBlocks.forEach(block => block.style.display = "");
                return;
            }

            cityItems.forEach(li => {
                const city = li.textContent.toLowerCase();
            if (city.includes(query)) {
                li.style.display = "";
            } else {
                li.style.display = "none";
            }
        });

            // Скрываем блоки, если внутри нет видимых li
            cityBlocks.forEach(block => {
                const visible = block.querySelector("li:not([style*='display: none'])");
                block.style.display = visible ? "" : "none";
            });
        });

        // Клик по городу
        cityItems.forEach(li => {
            li.addEventListener("click", function () {
                const cityName = this.textContent;

                // Меняем выбранный город в шапке
                const mapPickText = document.querySelector(".map-pick__text");
                if (mapPickText) {
                    mapPickText.textContent = cityName;
                }

                // Сохраняем выбор (например, в localStorage)
                localStorage.setItem("user_city", cityName);

                // Закрыть модалку
                document.getElementById("cityModal").classList.remove("show");
            });
        });
    });

    /*document.addEventListener("DOMContentLoaded", function () {
        const storageKey = "favorites";
        let favorites = JSON.parse(localStorage.getItem(storageKey) || "[]");

        // Обновление всех кнопок
        function updateButtons() {
            document.querySelectorAll("[data-action='favorite'], .heart-btn-featured").forEach(btn => {
                const id = btn.dataset.item;
            if (id && favorites.includes(id)) {
                btn.classList.add("active");
            } else {
                btn.classList.remove("active");
            }
        });

            // Обновляем счетчик в шапке
            const counter = document.querySelector(".mini-favorites .badge-wrapper span");
            if (counter) {
                counter.textContent = favorites.length;
            }
        }

        // Обработчик клика
        function toggleFavorite(id) {
            if (favorites.includes(id)) {
                favorites = favorites.filter(item => item !== id);
            } else {
                favorites.push(id);
            }
            localStorage.setItem(storageKey, JSON.stringify(favorites));
            updateButtons();

            // Если пользователь авторизован — шлём на сервер
            if (window.isUserAuthorized) {
                fetch("/ajax/favorite.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ action: "toggle", id })
                });
            }
        }

        // Навешиваем события
        document.body.addEventListener("click", function (e) {
            const btn = e.target.closest("[data-action='favorite'], .heart-btn-featured");
            if (btn) {
                e.preventDefault();
                const id = btn.dataset.item;
                if (id) toggleFavorite(id);
            }
        });

        // Первичная отрисовка
        updateButtons();
    });*/


})();

//document.addEventListener("DOMContentLoaded", AppCustom.init);




/*
const AppCustom = (function () {




    const CustomFunc = (function() {
        function init() {
            //...
        }

        return {
            init
        };
    })();



    function init() {
        if (typeof CustomFunc !== "undefined") CustomFunc.init();
        //if (typeof HeaderModule !== "undefined") HeaderModule.init();

        return {
            init
        };
    })();


document.addEventListener("DOMContentLoaded", AppCustom.init);
*/