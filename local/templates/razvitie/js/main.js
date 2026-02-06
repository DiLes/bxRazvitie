const App = (function() {
    // --- Module Zoom ---
    const ZoomModule = (function() {
        function setZoom() {
            const windowWidth = window.innerWidth;
            const baseWidth = windowWidth >= 1024 ? 1440 : 375;
            const zoomValue = windowWidth / baseWidth;

            const isFirefox = typeof InstallTrigger !== "undefined";

            if (isFirefox) {
                document.body.style.transform = `scale(${zoomValue})`;
                document.body.style.transformOrigin = "top left";
                document.body.style.width = `${100 / zoomValue}%`;
            } else {
                document.body.style.zoom = zoomValue;
            }
        }

        function init() {
            setZoom();
            window.addEventListener("resize", setZoom);
        }

        return {
            init
        };
    })();

    // GLIGHTBOX
    // if (typeof GLightbox !== 'undefined') {
    //     const lightbox = GLightbox({
    //         selector: '.glightbox',
    //         touchNavigation: false,
    //         loop: false,
    //         autoplayVideos: false,
    //         moreText: '', // “Show more” link чтобы не было
    //     });
    // } else {
    //     console.warn('GLightbox is not loaded!');
    // }

    (function () {
        try {
            // GLightbox проверяем наличие и конструкта
            if (typeof GLightbox === 'function') {
    
                // .glightbox проверяем, есть ли элементы с классом
                const glightboxElements = document.querySelectorAll('.glightbox');
                if (glightboxElements.length > 0) {
                    const lightbox = GLightbox({
                        selector: '.glightbox',
                        touchNavigation: false,
                        loop: false,
                        autoplayVideos: false,
                        moreText: '' // "Show more" link чтобы не было
                    });
                    console.log('GLightbox initialized successfully.');
                } else {
                    console.warn('GLightbox elements (.glightbox) not found on the page.');
                }
    
            } else {
                console.warn('GLightbox is not defined or not a function.');
            }
        } catch (error) {
            console.error('An error occurred while initializing GLightbox:', error);
        }
    })();
    

    



    // --- Module Swiper ---
    const SwiperModule = (function() {
        function init() {
            new Swiper(".welcome__swiper", {
                spaceBetween: 20,
                navigation: {
                    nextEl: ".welcome__swiper-next",
                    prevEl: ".welcome__swiper-prev",
                },
            });

            new Swiper(".categories-swiper__wrapper", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".categories__swiper-next",
                    prevEl: ".categories__swiper-prev",
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                    },
                    320: {
                        slidesPerView: 2,
                    },
                },
            });

            new Swiper(".projects__swiper", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".projects__swiper-next",
                    prevEl: ".projects__swiper-prev",
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 1.54,
                    },
                    320: {
                        slidesPerView: 1,
                    },
                },
            });

            new Swiper(".partners__swiper", {
                spaceBetween: 49,
                loop: true,
                speed: 500,
                autoplay: {
                    delay: 2000,
                },
                navigation: {
                    nextEl: ".partners__swiper-next",
                    prevEl: ".partners__swiper-prev",
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 6,
                    },
                    320: {
                        slidesPerView: 3,
                    },
                },
            });

            new Swiper(".news__swiper", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".news__swiper-next",
                    prevEl: ".news__swiper-prev",
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                    },
                    320: {
                        slidesPerView: 1.15,
                    },
                },
            });

            new Swiper(".letters__swiper", {
                spaceBetween: 10,
                slidesPerView: 1,
                navigation: {
                    nextEl: ".letters__swiper-next",
                    prevEl: ".letters__swiper-prev",
                },
            });

            new Swiper(".reviews__swiper", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".reviews__swiper-next",
                    prevEl: ".reviews__swiper-prev",
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                    },
                    320: {
                        slidesPerView: 1.15,
                    },
                },
            });

            new Swiper(".smilar-products__wrapper", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".smilar-products__swiper-next",
                    prevEl: ".smilar-products__swiper-prev",
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                    },
                    320: {
                        slidesPerView: 1,
                    },
                },
            });

            new Swiper(".recomended-products__wrapper", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".recomended-products__swiper-next",
                    prevEl: ".recomended-products__swiper-prev",
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                    },
                    320: {
                        slidesPerView: 1,
                    },
                },
            });

            new Swiper(".viewed-products__wrapper", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".viewed-products__swiper-next",
                    prevEl: ".viewed-products__swiper-prev",
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                    },
                    320: {
                        slidesPerView: 1,
                    },
                },
            });

            
            // COMPARE 
            const compareSwiper1 = new Swiper(".specifications_z_compare_swiper", {
                spaceBetween: 0,
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                        slidesPerGroup: 1,
                    },
                    320: {
                        slidesPerView: 1,
                        slidesPerGroup: 1,
                    },
                },
            });

            const compareSwiper2 = new Swiper(".recomended-products__wrapperrr", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".recomended-products__swiper-next",
                    prevEl: ".recomended-products__swiper-prev",
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                        slidesPerGroup: 1,
                    },
                    320: {
                        slidesPerView: 1,
                        slidesPerGroup: 1,
                    },
                },
            });

            if (Array.isArray(compareSwiper1)) {
                compareSwiper1.forEach((swiperA, i) => {
                    const swiperB = compareSwiper2[i];
                    if (!swiperA || !swiperB) return;
                
                    let syncing = false;
                
                    swiperA.on('slideChange', () => {
                        if (syncing) return;
                        syncing = true;
                        swiperB.slideTo(swiperA.activeIndex);
                        syncing = false;
                    });
                
                    swiperB.on('slideChange', () => {
                        if (syncing) return;
                        syncing = true;
                        swiperA.slideTo(swiperB.activeIndex);
                        syncing = false;
                    });
                });
            }


            
            
           
            

            
            


            // const productScreenSwiper = new Swiper(".product-screen__swiper", {
            //     spaceBetween: 10,
            //     slidesPerView: 1,
            //     navigation: {
            //         nextEl: ".product-screen__swiper-next",
            //         prevEl: ".product-screen__swiper-prev",
            //     },
            //     pagination: {
            //         el: '.swiper-pagination',
            //         clickable: true,
            //     },
            // });

            // document.querySelectorAll(".image-item").forEach((item, index) => {
            //     item.addEventListener("click", () => {
            //         productScreenSwiper.slideTo(index);
            //         document.querySelectorAll(".image-item").forEach(el => el.classList.remove("active"));
            //         item.classList.add("active");
            //     });
            // });


            // Basket
            /*function updateTotal() {
                let total = 0;
                document.querySelectorAll(".cart-item").forEach(item => {
                    let price = parseFloat(item.dataset.price);
                    let count = parseFloat(item.querySelector(".count").innerText);
                    total += price * count;
                });

                document.querySelectorAll(".total-price").forEach(el => {
                    el.innerText = total.toLocaleString() + " ₽";
                });
                updateOrderStatus(total);
            }*/

            function updateTotal() {
                let total = 0;
                let totalCount = 0;
                let oldTotal = 0;

                document.querySelectorAll(".cart-item").forEach(item => {
                    let price = parseFloat(item.dataset.price) || 0;
                    let count = parseInt(item.querySelector(".count").innerText) || 0;
                    let oldPrice = parseFloat(item.dataset.oldPrice) || 0;
                    total += price * count;
                    oldTotal += oldPrice * count;
                    // += totalCount;
                    ++ totalCount;
                });

                // итоговая сумма старой цены
                document.querySelectorAll(".summary-price .old-price").forEach(el => {
                    // el.innerText = total.toLocaleString("ru-RU") + " ₽";
                    el.innerText = oldTotal.toLocaleString("ru-RU") + " ₽";
                });
                // итоговая сумма
                document.querySelectorAll(".total-price").forEach(el => {
                    el.innerText = total.toLocaleString("ru-RU") + " ₽";
                });

                // количество товаров (в корзине / в шапке / где нужно)
                document.querySelectorAll(".items-count, .order_qty_main").forEach(el => {
                    el.innerText = `В корзине ${totalCount} ${declOfNum(totalCount, ['товар','товара','товаров'])}`;
                });

                // обновление прогресса/минималки
                updateOrderStatus(total);
            }

            // склонение слова "товар"
            function declOfNum(n, titles) {
                return titles[(n % 10 === 1 && n % 100 !== 11)
                    ? 0
                    : (n % 10 >= 2 && n % 10 <= 4 && (n % 100 < 10 || n % 100 >= 20))
                        ? 1
                        : 2];
            }

            /*function updateOrderStatus(totalPrice) {
                //let minOrder = 5000;
                let missingAmount = minOrder - totalPrice;

                //console.log(minOrder);

                document.querySelectorAll(".order-missing").forEach(el => {
                    el.innerText = missingAmount > 0 ? missingAmount.toLocaleString() + " ₽" : "Сумма достаточна!";
                });

                document.querySelectorAll(".order-bar").forEach(el => {
                    el.style.width = Math.min((totalPrice / minOrder) * 100, 100) + "%";
                });

                document.querySelectorAll(".checkout").forEach(btn => {
                    if (totalPrice >= minOrder) {
                        btn.classList.add("active");
                        btn.classList.remove("disabled");
                    } else {
                        btn.classList.remove("active");
                        btn.classList.add("disabled");
                    }
                });
            }*/

            function updateOrderStatus(totalPrice) {
                let missingAmount = minOrder - totalPrice;

                document.querySelectorAll(".order-missing").forEach(el => {
                    if (missingAmount > 0) {
                        el.innerText = missingAmount.toLocaleString("ru-RU") + " ₽";
                    } else {
                        el.innerText = "Сумма достаточна!";
                    }
                });

                document.querySelectorAll(".order-bar").forEach(el => {
                    el.style.width = Math.min((totalPrice / minOrder) * 100, 100) + "%";
                    el.style.transition = "width 0.3s ease"; // плавная анимация
                });

                document.querySelectorAll(".checkout").forEach(btn => {
                    if (totalPrice >= minOrder) {
                        btn.classList.add("active");
                        btn.classList.remove("disabled");
                        btn.disabled = false;
                    } else {
                        btn.classList.remove("active");
                        btn.classList.add("disabled");
                        btn.disabled = true;
                    }
                });
            }

            /*document.querySelectorAll(".increase").forEach(button => {
                button.addEventListener("click", function() {
                    let countElem = this.parentElement.querySelector(".count");
                    countElem.innerText = parseInt(countElem.innerText) + 1;
                    updateTotal();
                });
            });*/

            // увеличить
            document.querySelectorAll(".increase").forEach(button => {
                button.addEventListener("click", function() {
                    let cartItem = this.closest(".cart-item");
                    let countElem = cartItem.querySelector(".count");
                    let currentValue = parseInt(countElem.innerText);
                    let newValue = currentValue + 1;

                    countElem.innerText = newValue;

                    // Ajax обновление
                    fetch('/ajax/update_quantity.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: 'id=' + cartItem.dataset.itemId + '&quantity=' + newValue
                    })
                    .then(r => r.json())
                    .then(data => {
                            if (data.status !== "success") {
                            console.error(data.message);
                        } else {
                            updateTotal();
                        }
                    });
                });
            });

            /*document.querySelectorAll(".decrease").forEach(button => {
                button.addEventListener("click", function() {
                    let countElem = this.parentElement.querySelector(".count");
                    let currentValue = parseInt(countElem.innerText);
                    if (currentValue > 1) {
                        countElem.innerText = currentValue - 1;
                        updateTotal();
                    }
                });updateTotal
            });*/

            // уменьшить
            document.querySelectorAll(".decrease").forEach(button => {
                button.addEventListener("click", function() {
                    let cartItem = this.closest(".cart-item");
                    let countElem = cartItem.querySelector(".count");
                    let currentValue = parseInt(countElem.innerText);
                    if (currentValue > 1) {
                        let newValue = currentValue - 1;
                        countElem.innerText = newValue;

                        fetch('/ajax/update_quantity.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: 'id=' + cartItem.dataset.itemId + '&quantity=' + newValue
                        })
                            .then(r => r.json())
                    .then(data => {
                            if (data.status !== "success") {
                            console.error(data.message);
                        } else {
                            updateTotal();
                        }
                    });
                    }
                });
            });

            /*document.querySelectorAll(".remove").forEach(button => {
                button.addEventListener("click", function() {
                    this.closest(".cart-item").remove();
                    updateTotal();
                });
            });*/

            // удалить
            document.querySelectorAll(".remove").forEach(button => {
                button.addEventListener("click", function() {
                    const cartItem = this.closest(".cart-item");
                    const itemId = cartItem.dataset.id;

                    fetch('/ajax/delete_from_basket.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: 'id=' + encodeURIComponent(itemId)
                    })
                        .then(r => r.json())
                .then(data => {
                        if (data.status === "success") {
                        cartItem.remove();
                        updateTotal();
                    } else {
                        console.error(data.message || "Ошибка удаления");
                    }
                })
                .catch(err => console.error("Ошибка запроса:", err));
                });
            });

            // "clear_cart" проверяем наличие кнопки
            /*let clearCartButton = document.querySelector(".clear_cart");
            if (clearCartButton) {
                clearCartButton.addEventListener("click", function() {
                    const confirmation = confirm("Вы уверены, что хотите удалить все товары из корзины?");
                    if (confirmation) {
                        document.querySelectorAll(".cart-item").forEach(item => item.remove());
                        updateTotal();
                    }
                });
            }*/

            let clearCartButton = document.querySelector(".clear_cart");

            if (clearCartButton) {
                clearCartButton.addEventListener("click", function () {
                    if (confirm("Вы уверены, что хотите удалить все товары из корзины?")) {
                        fetch("/ajax/clear_basket.php", {
                            method: "POST"
                        })
                            .then(r => r.json())
                    .then(data => {
                            if (data.status === "success") {
                            document.querySelectorAll(".cart-item").forEach(item => item.remove());
                            updateTotal();
                        } else {
                            alert("Ошибка при очистке корзины: " + (data.message || ""));
                        }
                    })
                    .catch(err => console.error("Ошибка запроса:", err));
                    }
                });
            }



            // "export_to_pdf" проверяем наличие кнопки
            let exportToPdfButton = document.querySelector(".export_to_pdf");
            if (exportToPdfButton) {
                exportToPdfButton.addEventListener("click", function() {
                    const confirmation = confirm("Вы уверены, что хотите экспортировать в PDF?");
                    if (confirmation) {
                        window.print();
                    }
                });
            }

            updateTotal();




            // LK - При выборе Совпадает, поля в фактическом адресе должны скрываться
            const checkbox = document.getElementById("sameAddress");
            const actualAddressSection = document.querySelector(".actual-address");

            if (checkbox && actualAddressSection) {
                checkbox.addEventListener("change", () => {
                    if (checkbox.checked) {
                        actualAddressSection.style.display = "none";
                    } else {
                        actualAddressSection.style.display = "flex"; // Блок снова появляется
                    }
                });
            }




            const mainSwiperContainer = document.querySelector(".product-screen__swiper");
            const thumbsSwiperContainer = document.querySelector(".product-screen__left-side-bottom");

            if (mainSwiperContainer && thumbsSwiperContainer) {
                const isMobile = window.matchMedia('(max-width: 1023px)').matches;
                const thumbsSwiper = new Swiper(thumbsSwiperContainer, {
                    spaceBetween: 10,
                    slidesPerView: 4,
                    slidesPerGroup: 1,
                    watchSlidesProgress: true,
                    slideToClickedSlide: true,
                });

                const mainSwiperProduct = new Swiper(mainSwiperContainer, {
                    spaceBetween: 10,
                    slidesPerView: 1,
                    slidesPerGroup: 1,
                    navigation: {
                        nextEl: ".product-screen__swiper-next",
                        prevEl: ".product-screen__swiper-prev",
                    },
                    pagination: isMobile ?
                        {
                            el: '.swiper-nav',
                            clickable: true,
                            // dynamicBullets: true,
                            // dynamicMainBullets: 4,
                        } :
                        false,
                    thumbs: {
                        swiper: thumbsSwiper,
                    },
                    thumbs: {
                        swiper: thumbsSwiper,
                    },
                });

                // 🔁 Active class управление
                thumbsSwiper.on('click', () => {
                    const slides = thumbsSwiper.slides;

                    slides.forEach(slide => slide.classList.remove('active'));

                    const activeIndex = thumbsSwiper.clickedIndex;
                    if (typeof activeIndex !== 'undefined') {
                        slides[activeIndex].classList.add('active');
                    }
                });

                // 🔄 Main Swiper обновить – thumbnail active class даже если это изменится
                mainSwiperProduct.on('slideChange', () => {
                    const slides = thumbsSwiper.slides;
                    slides.forEach(slide => slide.classList.remove('active'));

                    const realIndex = mainSwiperProduct.realIndex;
                    if (slides[realIndex]) {
                        slides[realIndex].classList.add('active');
                    }
                });
            }




            // FEATURED HEART
            /*document.querySelectorAll(".heart-btn-featured").forEach(button => {
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
            });*/


            // BLACK HEART PRODUCT
            /*document.querySelectorAll(".black_heart").forEach(button => {
                button.addEventListener("click", () => {
                    const heartIcon = button.querySelector("svg path");

                    if (!heartIcon) return;

                    let currentFill = heartIcon.getAttribute("fill") || "none";

                    if (currentFill !== "none" && currentFill !== "") {
                        heartIcon.setAttribute("fill", "none"); // убрать сердце
                    } else {
                        heartIcon.setAttribute("fill", "#1A1A1A"); // заполнить сердце
                    }

                    heartIcon.setAttribute("stroke", "#1A1A1A"); // Граница всегда остается черной
                });
            });*/


            // ЗАГРУЗИТЬ ЕЩЁ 

            const items = document.querySelectorAll(".load_item");
            const button = document.querySelector(".load-more");

            if (button) {
                button.addEventListener("click", (e) => {
                    e.preventDefault(); // Чтобы кнопка не обновляла страницу

                    if (items.length > 0) {
                        items.forEach(item => {
                            item.classList.remove("hidd_z");
                        });
                    }
                    button.classList.add('remove');
                });
            }




            // FILTR 
            const filterList = document.querySelector(".main-category__filter-list");

            if (filterList) {
                // Проверка каждой кнопки фильтра
                filterList.querySelectorAll("button").forEach((button) => {
                    const svgIcon = button.querySelector("svg");

                    if (svgIcon) {
                        svgIcon.addEventListener("click", function(event) {
                            event.stopPropagation(); // Чтобы другие события не запускались при нажатии кнопки
                            button.remove(); // Отключить фильтр
                        });
                    }
                });

                // "Сбросить все" удалить все фильтры при нажатии
                const resetButton = [...filterList.children].find(
                    (btn) => btn.textContent.trim() === "Сбросить все"
                );

                if (resetButton) {
                    resetButton.addEventListener("click", function() {
                        filterList
                            .querySelectorAll("button:not(:last-child)")
                            .forEach((btn) => btn.remove());
                    });
                }
            }




            
            



            // FEATURED REMOVE BTN
            const buttonFeatured = document.querySelector(".clear_featured");
            const productCards = document.querySelectorAll(".main-category__products-grid .product-card");
            const pagination = document.querySelector(".main-category__products-pagination");

            if (buttonFeatured) {
                buttonFeatured.addEventListener("click", (e) => {
                    e.preventDefault(); // Чтобы страница не обновлялась

                    if (productCards.length === 0 && !pagination) {
                        alert("Нет элементов для удаления.");
                        return;
                    }

                    const confirmation = confirm("Вы уверены, что хотите удалить эти элементы?");
                    if (confirmation) {
                        productCards.forEach(card => card.remove());

                        if (pagination) {
                            pagination.remove();
                        }
                    }
                });
            }



            // COMPARE PRODUCTS
            const tabs = document.querySelectorAll(".filter-tag");
            const contents = document.querySelectorAll(".tab-content");

            if (tabs.length > 0 && contents.length > 0) {
                tabs.forEach(tab => {
                    tab.addEventListener("click", () => {
                        const tabId = tab.dataset.tab;
                        if (!tabId) return;

                        // Сначала мы удаляем все классы активов
                        tabs.forEach(t => t.classList.remove("active"));
                        contents.forEach(content => content.classList.remove("active"));

                        // Добавляем active class к нажатой вкладке и ее содержимому
                        tab.classList.add("active");
                        document.getElementById(tabId)?.classList.add("active");
                    });
                });
            }
            // Для кнопок закрытия
            const closeButtons = document.querySelectorAll(".close-btn");

            if (closeButtons.length > 0) {
                closeButtons.forEach(button => {
                    button.addEventListener("click", (e) => {
                        e.stopPropagation();

                        const confirmed = confirm("Вы уверены, что хотите удалить?");
                        if (!confirmed) return; // Ничего не делает, если отменяется

                        const tab = button.closest(".filter-tag");
                        if (tab) {
                            const tabId = tab.dataset.tab;
                            tab.remove();
                            document.getElementById(tabId)?.remove();
                        }
                    });
                });
            }




            // REMOVE COMPARE PRODUCTS
            const buttonCompare = document.querySelector(".clear_list");

            if (buttonCompare) {
                buttonCompare.addEventListener("click", (e) => {
                    e.preventDefault();

                    const productCardsCompare = document.querySelectorAll(".compare_products_block .product-card");
                    const characs = document.querySelectorAll(".compare_products_specifications_z");
                    const filterHeaderTags = document.querySelectorAll(".filter-tags");
                    const productCardsBtns = document.querySelectorAll(".smilar-products__swiper-button-wraper");
                    const productXarakteristika = document.querySelectorAll(".specifications_z_compare_swiper .swiper-slide");

                    const hasNothing =
                        productCardsCompare.length === 0 &&
                        characs.length === 0 &&
                        filterHeaderTags.length === 0 &&
                        productCardsBtns.length === 0 &&
                        productXarakteristika.length === 0;

                    if (hasNothing) {
                        alert("Нет элементов для удаления.");
                        return;
                    }

                    const confirmation = confirm("Вы уверены, что хотите удалить эти элементы?");
                    if (confirmation) {
                        productCardsCompare.forEach(card => card.remove());
                        characs.forEach(char => char.remove());
                        filterHeaderTags.forEach(tag => tag.remove());
                        productCardsBtns.forEach(btn => btn.remove());
                        productXarakteristika.forEach(xarak => xarak.remove());
                    }
                });
            }


            // COMPARE PRODUCTS X DELETE PRODUCT
            document.body.addEventListener("click", function (event) {
                const clearBtn = event.target.closest(".clear_compare_pr");
                if (!clearBtn) return;
        
                // Окно подтверждения
                const userConfirmed = confirm("Вы уверены, что хотите удалить этот товар из сравнения?");
                if (!userConfirmed) return;
        
                // находим swiper-Slide
                const productSlide = clearBtn.closest(".swiper-slide");
                if (!productSlide) return;
        
                // Получаем его значение Data-num
                const dataNum = productSlide.getAttribute("data-num");
                if (!dataNum) return;
        
                // находим соответствующий слайд
                const specSlide = document.querySelector(
                    `.specifications_z_compare_swiper .swiper-slide[data-num="${dataNum}"]`
                );
        
                // Удаляем оба
                productSlide.remove();
                if (specSlide) {
                    specSlide.remove();
                }
        
                console.log(`Удалено: data-num = ${dataNum}`);
            });




            // Увеличение и уменьшение количества продукта
            // const quantityValue = document.querySelector(".quantity-value");
            // const priceElement = document.querySelector(".price_z");
            // const btnIncrease = document.querySelector(".btn-increase");
            // const btnDecrease = document.querySelector(".btn-decrease");

            // const basePrice = 643428; // Базовая цена

            // if (btnIncrease && btnDecrease && quantityValue && priceElement) {
            //     btnIncrease.addEventListener("click", () => {
            //         let quantity = parseInt(quantityValue.innerText);
            //         quantity++;
            //         updateQuantity(quantity);
            //     });

            //     btnDecrease.addEventListener("click", () => {
            //         let quantity = parseInt(quantityValue.innerText);
            //         if (quantity > 1) {
            //             quantity--;
            //             updateQuantity(quantity);
            //         }
            //     });

            //     function updateQuantity(quantity) {
            //         quantityValue.innerText = quantity;
            //         priceElement.innerText = formatPrice(basePrice * quantity) + " ₽";
            //     }

            //     function formatPrice(price) {
            //         return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            //     }
            // }

            document.querySelectorAll(".quantity-selector").forEach((selector) => {
                const quantityValue = selector.querySelector(".quantity-value");
                const priceElement = selector.querySelector(".price_z");
                const btnIncrease = selector.querySelector(".btn-increase");
                const btnDecrease = selector.querySelector(".btn-decrease");
                const basePrice = parseFloat(selector.dataset.basePrice);
            
                if (!quantityValue || !priceElement || !btnIncrease || !btnDecrease || isNaN(basePrice)) {
                    console.warn("Some elements or base price are missing or incorrect in quantity-selector.");
                    return;
                }

                // ✅ Default значение: 1
                let quantity = quantityValue.textContent;
                quantityValue.innerText = quantity;
            
                updatePrice();
            
                btnIncrease.addEventListener("click", () => {
                    quantity++;
                    updateDisplay();
                });
            
                btnDecrease.addEventListener("click", () => {
                    if (quantity > 1) {
                        quantity--;
                        updateDisplay();
                    }
                });
            
                function updateDisplay() {
                    quantityValue.innerText = quantity;
                    updatePrice();
                }

                function updatePrice() {
                    const totalPrice = Number((basePrice * quantity).toFixed(2));
                    priceElement.innerText = formatPrice(totalPrice) + " ₽";
                }
                /*function updatePrice() {
                    const totalPrice = basePrice * quantity;
                    priceElement.innerText = formatPrice(totalPrice) + " ₽";
                }*/

                function formatPrice(price) {
                    return price
                        .toFixed(2)                             // округляем до 2 знаков
                        .replace(/\B(?=(\d{3})+(?!\d))/g, " ")  // добавляем пробелы
                        .replace('.', ',');                    // заменяем точку на запятую
                }

            });
            
            
            



            // Кнопка сердца (like button)
            const heartBtn = document.querySelector(".heart-btn");
            if (heartBtn) {
                heartBtn.addEventListener("click", () => {
                    heartBtn.classList.toggle("active");
                });
            }

            // Выбор цвета
            const colorOptions = document.querySelectorAll(".color-option");
            if (colorOptions.length > 0) {
                colorOptions.forEach(button => {
                    button.addEventListener("click", () => {
                        colorOptions.forEach(btn => btn.classList.remove("active"));
                        button.classList.add("active");
                    });
                });
            }

            // Выбор материалов
            const optionButtons = document.querySelectorAll(".option-btn");
            if (optionButtons.length > 0) {
                optionButtons.forEach(button => {
                    button.addEventListener("click", () => {
                        const group = button.parentElement.dataset.group;

                        document.querySelectorAll(`.option-buttons[data-group="${group}"] .option-btn`).forEach(btn => {
                            btn.classList.remove("active");
                        });

                        button.classList.add("active");
                        const selectedValue = button.dataset.value;
                        console.log(`Selected ${group}: ${selectedValue}`);
                    });
                });
            }



            // **Вкладки**  
            document.querySelectorAll('.tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    document.querySelectorAll('.tab, .content').forEach(el => el.classList.remove('active'));
                    tab.classList.add('active');
                    const target = document.getElementById(tab.getAttribute('data-target'));
                    if (target) target.classList.add('active');
                });
            });


            document.querySelectorAll(".order_cancel").forEach(button => {
                button.addEventListener("click", function() {
                    if (confirm("Вы уверены, что хотите отменить заказ?")) {
                        this.closest(".lk_order_item").remove();
                    }
                });
            });


            const orderItems = document.querySelectorAll(".order_block .order_item");

            if (orderItems.length > 0) {
                orderItems.forEach((item) => {
                    item.addEventListener("click", () => {
                        alert(`Вы выбрали: ${item.querySelector(".title").innerText}`);
                    });
                });
            }

            // **PRODUCT вкладки**  
            document.querySelectorAll('.product_tab').forEach(productTab => {
                productTab.addEventListener('click', (e) => {
                    e.preventDefault();
                    document.querySelectorAll('.product_tab, .pr_content').forEach(el => el.classList.remove('active'));
                    productTab.classList.add('active');
                    const targetId = productTab.getAttribute('data-target');
                    const targetContent = document.getElementById(targetId);
                    if (targetContent) targetContent.classList.add('active');
                });
            });

            // **DROPDOWN Меню**  
            document.querySelectorAll(".dropdown").forEach(dropdown => {
                const dropdownBtn = dropdown.querySelector(".dropdown-btn");
                const selectedText = dropdown.querySelector(".selected");
                const dropdownMenu = dropdown.querySelector(".dropdown-menu");

                if (dropdownBtn && selectedText && dropdownMenu) {
                    dropdownBtn.addEventListener("click", (e) => {
                        e.stopPropagation();
                        document.querySelectorAll(".dropdown").forEach(d => {
                            if (d !== dropdown) d.classList.remove("open");
                        });
                        dropdown.classList.toggle("open");
                    });

                    dropdownMenu.querySelectorAll("li").forEach(item => {
                        item.addEventListener("click", () => {
                            selectedText.textContent = item.textContent;
                            dropdown.classList.remove("open");
                        });
                    });
                }
            });

            // **Закрытие dropdown при нажатии снаружи**  
            document.addEventListener("click", () => {
                document.querySelectorAll(".dropdown").forEach(dropdown => dropdown.classList.remove("open"));
            });


            // **ФУНКЦИЯ ПОДЕЛИТЬСЯ**  
            const shareBtns = document.querySelectorAll(".share_btn");
            const shareContainers = document.querySelectorAll(".share-container");
            const copyLinks = document.querySelectorAll(".copy-link");

            // Добавить событие для каждой кнопки поделиться
            if (shareBtns.length > 0 && shareContainers.length > 0) {
                shareBtns.forEach((btn, index) => {
                    btn.addEventListener("click", (e) => {
                        e.stopPropagation();

                        // Просто открыть соответствующий share-contain
                        const shareContainer = shareContainers[index];
                        if (shareContainer) {
                            shareContainer.classList.toggle("active");
                        }
                    });
                });
            }

            // Функция копирования
            if (copyLinks.length > 0) {
                copyLinks.forEach((copyLink) => {
                    copyLink.addEventListener("click", () => {
                        navigator.clipboard.writeText(window.location.href).then(() => {
                            alert("Ссылка скопирована!");
                        });
                    });
                });
            }

            // **Создание ссылок для обмена в социальных сетях**  
            const socialPlatforms = {
                whatsapp: "https://wa.me/?text=",
                telegram: "https://t.me/share/url?url=",
                vk: "https://vk.com/share.php?url=",
                odnoklassniki: "https://connect.ok.ru/offer?url="
            };

            Object.keys(socialPlatforms).forEach((platform) => {
                document.querySelectorAll(`.${platform}`).forEach((link) => {
                    link.setAttribute("href", `${socialPlatforms[platform]}${encodeURIComponent(window.location.href)}`);
                });
            });

            // **Поделиться модальным закрытием при нажатии снаружи**  
            document.addEventListener("click", (e) => {
                shareContainers.forEach((shareContainer) => {
                    if (!shareContainer.contains(e.target)) {
                        shareContainer.classList.remove("active");
                    }
                });
            });


            // PRODUCT FULL DESCRIPTION
            const fullDescBtn = document.querySelector(".full-desc");
            const fullText = document.querySelector(".description.full");

            if (fullDescBtn && fullText) {
                fullDescBtn.addEventListener("click", function(event) {
                    event.preventDefault();

                    if (fullText.style.display === "none" || fullText.style.display === "") {
                        fullText.style.display = "block";
                        fullDescBtn.textContent = "Скрыть описание";
                    } else {
                        fullText.style.display = "none";
                        fullDescBtn.textContent = "Полное описание";
                    }
                });
            }


            // ALL CHARACTERS
            const fullCharBtn = document.querySelector(".all_charac");
            const fullChars = document.querySelector(".specs_z.full");

            if (fullCharBtn && fullChars) {
                fullCharBtn.addEventListener("click", function(event) {
                    event.preventDefault();

                    if (fullChars.style.display === "none" || fullChars.style.display === "") {
                        fullChars.style.display = "block";
                        fullCharBtn.textContent = "Скрыть";
                    } else {
                        fullChars.style.display = "none";
                        fullCharBtn.textContent = "Все характеристики";
                    }
                });
            }


            // PROJECT-PAGE FULL DESCRIPTION
            const fullDescPBtn = document.querySelector(".read_more");
            const fullPText = document.querySelector(".description.full");

            if (fullDescPBtn && fullPText) {
                fullDescPBtn.addEventListener("click", function(event) {
                    event.preventDefault();

                    if (fullPText.style.display === "none" || fullPText.style.display === "") {
                        fullPText.style.display = "block";
                        fullDescPBtn.textContent = "Скрыть";
                    } else {
                        fullPText.style.display = "none";
                        fullDescPBtn.textContent = "Подробнее";
                    }
                });
            }



            // **(AUTHORIZATION MODAL)**
            const authorizationModal = document.querySelector(".authorization-modal");
            const authorizationBtns = document.querySelectorAll(".authorization_btn");
            const authorizationCloseBtns = document.querySelectorAll(".close");
            const passwordEyes = document.querySelectorAll(".password_eye");

            if (authorizationModal) {
                // Открытие модального
                authorizationBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        authorizationModal.classList.add("active");
                    });
                });

                // Модальное закрытие (при нажатии на крестик)
                authorizationCloseBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        authorizationModal.classList.remove("active");
                    });
                });

                // Модальное закрытие (при нажатии на сток)
                authorizationModal.addEventListener("click", (e) => {
                    if (e.target === authorizationModal) {
                        authorizationModal.classList.remove("active");
                    }
                });
            }

            // Функция отображения / скрытия пароля
            if (passwordEyes.length > 0) {
                passwordEyes.forEach((eye) => {
                    eye.addEventListener("click", (e) => {
                        e.preventDefault();

                        // Нахождение соответствующего входного элемента
                        const inputField = eye.parentElement.querySelector("input");

                        if (inputField) {
                            if (inputField.type === "password") {
                                inputField.type = "text";
                                eye.classList.add("active"); // 🔵 Class добавить
                            } else {
                                inputField.type = "password";
                                eye.classList.remove("active"); // 🔴 Class удаление
                            }
                        }
                    });
                });
            }


            // RECOVERY PASSWORD MODAL
            const recoveryPasswordModal = document.querySelector(".recovery-password-modal");
            const recoveryPasswordBtns = document.querySelectorAll(".recovery_password_btn");
            const recoveryPasswordCloseBtns = document.querySelectorAll(".close");

            if (recoveryPasswordModal) {
                // Открытие модального
                recoveryPasswordBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        recoveryPasswordModal.classList.add("active");
                    });
                });

                // Модальное закрытие (при нажатии на крестик)
                recoveryPasswordCloseBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        recoveryPasswordModal.classList.remove("active");
                    });
                });

                // Модальное закрытие (при нажатии на сток)
                recoveryPasswordModal.addEventListener("click", (e) => {
                    if (e.target === recoveryPasswordModal) {
                        recoveryPasswordModal.classList.remove("active");
                    }
                });
            }


            // LINK SEND MODAL
            const linkSendModal = document.querySelector(".link-send-modal");
            const linkSendBtns = document.querySelectorAll(".link_send_btn");
            const linkSendCloseBtns = document.querySelectorAll(".close");
            const linkSendCloseOkBtns = document.querySelectorAll(".btn_primary.ok_btn");

            if (linkSendModal) {
                // Открытие модального
                linkSendBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        linkSendModal.classList.add("active");
                    });
                });

                // Модальное закрытие (при нажатии на крестик)
                linkSendCloseBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        linkSendModal.classList.remove("active");
                    });
                });

                // Модальное закрытие (при нажатии на крестик)
                linkSendCloseOkBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        linkSendModal.classList.remove("active");
                    });
                });

                // Модальное закрытие (при нажатии на сток)
                linkSendModal.addEventListener("click", (e) => {
                    if (e.target === linkSendModal) {
                        linkSendModal.classList.remove("active");
                    }
                });
            }



            // CHANGE PASSWORD MODAL
            const changePasswordModal = document.querySelector(".change-password-modal");
            const changePasswordBtns = document.querySelectorAll(".change_password_btn");
            const changePasswordCloseBtns = document.querySelectorAll(".close");

            if (changePasswordModal) {
                // Открытие модального
                changePasswordBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        changePasswordModal.classList.add("active");
                    });
                });

                // Модальное закрытие (при нажатии на крестик)
                changePasswordCloseBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        changePasswordModal.classList.remove("active");
                    });
                });

                // Модальное закрытие (при нажатии на сток)
                changePasswordModal.addEventListener("click", (e) => {
                    if (e.target === changePasswordModal) {
                        changePasswordModal.classList.remove("active");
                    }
                });
            }


            // 📌 Выбор полей пароля и кнопок
            //  const newPassword = document.querySelector("#password_1");
            //  const repeatPassword = document.querySelector("#password_2");
            //  const submitBtn = document.querySelector(".submit_btn");
            //  const errorText = document.createElement("p"); // Создадим элемент для сообщения об ошибке
            //  errorText.classList.add("error-message");
            //  errorText.style.color = "red";
            //  submitBtn.insertAdjacentElement("beforebegin", errorText); // Добавить перед кнопкой
            //  // 📌 Проверка паролей и активация кнопки
            // function checkPasswords() {
            //     if (newPassword.value && repeatPassword.value) {
            //         if (newPassword.value === repeatPassword.value) {
            //             submitBtn.disabled = false;
            //             errorText.textContent = ""; // Очистить сообщение об ошибке
            //         } else {
            //             submitBtn.disabled = true;
            //             errorText.textContent = "Пароли не совпадают!"; // Сообщение об ошибке
            //         }
            //     } else {
            //         submitBtn.disabled = true;
            //         errorText.textContent = ""; // Очистить сообщение, если поля пусты
            //     }
            // }
            // // 📌 Добавление событий
            // newPassword.addEventListener("input", checkPasswords);
            // repeatPassword.addEventListener("input", checkPasswords);
            // // 📌 Проверка формы и проверка перед отправкой
            // document.querySelector("#changePasswordForm").addEventListener("submit", function (e) {
            //     if (newPassword.value !== repeatPassword.value) {
            //         e.preventDefault(); // Остановить отправку
            //         errorText.textContent = "Пароли не совпадают!";
            //         submitBtn.disabled = true;
            //     }
            // });


            const newPassword = document.querySelector("#password_1");
            const repeatPassword = document.querySelector("#password_2");
            const submitBtn = document.querySelector(".submit_btn");

            if (submitBtn) {
                const errorText = document.createElement("p");
                errorText.classList.add("error-message");
                errorText.style.color = "red";
                submitBtn.insertAdjacentElement("beforebegin", errorText); // Добавить перед кнопкой

                function checkPasswords() {
                    if (newPassword.value && repeatPassword.value) {
                        if (newPassword.value === repeatPassword.value) {
                            submitBtn.disabled = false;
                            errorText.textContent = ""; // Очистить сообщение об ошибке
                        } else {
                            submitBtn.disabled = true;
                            errorText.textContent = "Пароли не совпадают!";
                        }
                    } else {
                        submitBtn.disabled = true;
                        errorText.textContent = "";
                    }
                }

                newPassword.addEventListener("input", checkPasswords);
                repeatPassword.addEventListener("input", checkPasswords);

                document.querySelector("#changePasswordForm").addEventListener("submit", function(e) {
                    if (newPassword.value !== repeatPassword.value) {
                        e.preventDefault();
                        errorText.textContent = "Пароли не совпадают!";
                        submitBtn.disabled = true;
                    }
                });
            }




            // REGISTRATION MODAL
            const registrationModal = document.querySelector(".registration-modal");
            const registrationBtns = document.querySelectorAll(".registration_btn");
            const registrationCloseBtns = document.querySelectorAll(".close");

            if (registrationModal) {
                // Открытие модального
                registrationBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        registrationModal.classList.add("active");
                        authorizationModal.classList.remove("active");
                    });
                });

                // Модальное закрытие (при нажатии на крестик)
                registrationCloseBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        registrationModal.classList.remove("active");
                    });
                });

                // Модальное закрытие (при нажатии на сток)
                registrationModal.addEventListener("click", (e) => {
                    if (e.target === registrationModal) {
                        registrationModal.classList.remove("active");
                    }
                });
            }


            // CANCEL ORDER MODAL
            const calcelOrderModal = document.querySelector(".cancel-order-modal");
            const calcelOrderBtns = document.querySelectorAll(".cancel_order_btn");
            const calcelOrderCloseBtns = document.querySelectorAll(".close");
            const calcelOrderCloseOkBtns = document.querySelectorAll(".btn_primary.ok_btn");

            if (calcelOrderModal) {
                // Открытие модального
                calcelOrderBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        calcelOrderModal.classList.add("active");
                    });
                });

                // Модальное закрытие (при нажатии на крестик)
                calcelOrderCloseBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        calcelOrderModal.classList.remove("active");
                    });
                });

                // Modalni yopish (krestik bosilganda)
                calcelOrderCloseOkBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        calcelOrderModal.classList.remove("active");
                    });
                });

                // Модальное закрытие (при нажатии на сток)
                calcelOrderModal.addEventListener("click", (e) => {
                    if (e.target === calcelOrderModal) {
                        calcelOrderModal.classList.remove("active");
                    }
                });
            }


            // LOGOUT MODAL
            const logoutModal = document.querySelector(".logout-modal");
            const logoutBtns = document.querySelectorAll(".logout_btn");
            const logoutCloseBtns = document.querySelectorAll(".close");
            const logoutCloseOkBtns = document.querySelectorAll(".btn_primary.cancel");

            if (logoutModal) {
                // Открытие модального
                logoutBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        logoutModal.classList.add("active");
                    });
                });

                // Модальное закрытие (при нажатии на крестик)
                logoutCloseBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        logoutModal.classList.remove("active");
                    });
                });

                // Модальное закрытие (при нажатии на крестик)
                logoutCloseOkBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        logoutModal.classList.remove("active");
                    });
                });

                // Модальное закрытие (при нажатии на сток)
                logoutModal.addEventListener("click", (e) => {
                    if (e.target === logoutModal) {
                        logoutModal.classList.remove("active");
                    }
                });
            }




            // **(PAYMENT MODAL)**  
            const paymentOptionsModal = document.querySelector(".payment-options-modal");
            const paymentOptionsBtns = document.querySelectorAll(".pay_option_btn");
            const closeBtns = document.querySelectorAll(".close");

            if (paymentOptionsModal) {
                paymentOptionsBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        paymentOptionsModal.classList.add("active");
                    });
                });

                closeBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        paymentOptionsModal.classList.remove("active");
                    });
                });

                paymentOptionsModal.addEventListener("click", (e) => {
                    if (e.target === paymentOptionsModal) {
                        paymentOptionsModal.classList.remove("active");
                    }
                });
            }

            // **СПОСОБ ДОСТАВКИ (DELIVERY MODAL)**  
            const deliveryModal = document.querySelector(".delivery-modal");
            const deliveryBtns = document.querySelectorAll(".delivery_btn");

            if (deliveryModal) {
                deliveryBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        deliveryModal.classList.add("active");
                    });
                });

                closeBtns.forEach((btn) => {
                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        deliveryModal.classList.remove("active");
                    });
                });

                deliveryModal.addEventListener("click", (e) => {
                    if (e.target === deliveryModal) {
                        deliveryModal.classList.remove("active");
                    }
                });
            }


            // ADD REVIEWS MODAL
            const reviewBtn = document.querySelector(".add-review");
            const reviewModal = document.querySelector(".review-modal");
            const closeBtn = document.querySelector(".close");
            const ratingStars = document.querySelectorAll(".rating span");
            const submitReview = document.querySelector(".submit-review");
            const nameInput = document.querySelector("#review-name");
            const orgInput = document.querySelector("#review-org");
            const reviewText = document.querySelector("#review-text");

            let selectedRating = 0;

            // Если есть элементы, мы добавляем event listener
            if (reviewBtn && reviewModal) {
                reviewBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    reviewModal.classList.add("active");
                });
            }

            if (closeBtn && reviewModal) {
                closeBtn.addEventListener("click", (e) => {
                    e.preventDefault();
                    reviewModal.classList.remove("active");
                    resetForm();
                });

                reviewModal.addEventListener("click", (e) => {
                    if (e.target === reviewModal) {
                        reviewModal.classList.remove("active");
                        resetForm();
                    }
                });
            }

            if (ratingStars.length > 0) {
                ratingStars.forEach(star => {
                    star.addEventListener("click", (e) => {
                        e.preventDefault();
                        selectedRating = star.getAttribute("data-value");

                        ratingStars.forEach(s => s.classList.remove("active"));
                        star.classList.add("active");

                        let prev = star.previousElementSibling;
                        while (prev) {
                            prev.classList.add("active");
                            prev = prev.previousElementSibling;
                        }

                        checkFormValidity();
                    });
                });
            }

            function showError(input, message) {
                const parent = input.parentElement;
                let error = parent.querySelector(".error-message");

                if (!error) {
                    error = document.createElement("div");
                    error.classList.add("error-message");
                    parent.appendChild(error);
                }

                error.textContent = message;
                input.classList.add("error-border");
            }

            function removeError(input) {
                const parent = input.parentElement;
                let error = parent.querySelector(".error-message");

                if (error) error.remove();
                input.classList.remove("error-border");
            }

            function checkFormValidity() {
                let isValid = true;

                if (!nameInput.value.trim()) {
                    showError(nameInput, "Имя обязательно");
                    isValid = false;
                } else {
                    removeError(nameInput);
                }

                if (!orgInput.value.trim()) {
                    showError(orgInput, "Организация обязательна");
                    isValid = false;
                } else {
                    removeError(orgInput);
                }

                if (!reviewText.value.trim()) {
                    showError(reviewText, "Отзыв обязателен");
                    isValid = false;
                } else {
                    removeError(reviewText);
                }

                if (selectedRating === 0) {
                    showError(ratingStars[0], "Оценка обязательна");
                    isValid = false;
                } else {
                    removeError(ratingStars[0]);
                }

                if (isValid) {
                    submitReview.classList.remove("disabled");
                    submitReview.style.background = "#056BE9";
                    submitReview.style.color = "#fff";
                    submitReview.removeAttribute("disabled");
                } else {
                    submitReview.classList.add("disabled");
                    submitReview.style.background = "#E8F1FA";
                    submitReview.style.color = "#8ca9c9";
                    submitReview.setAttribute("disabled", "true");
                }
            }

            if (submitReview) {
                submitReview.addEventListener("click", (e) => {
                    e.preventDefault();

                    checkFormValidity();

                    if (submitReview.hasAttribute("disabled")) return;

                    alert(`Спасибо за ваш отзыв!\nИмя: ${nameInput.value.trim()}\nОрганизация: ${orgInput.value.trim()}\nОценка: ${selectedRating}⭐\nОтзыв: ${reviewText.value.trim()}`);

                    resetForm();
                    reviewModal.classList.remove("active");
                });
            }

            function resetForm() {
                if (nameInput) nameInput.value = "";
                if (orgInput) orgInput.value = "";
                if (reviewText) reviewText.value = "";
                selectedRating = 0;

                ratingStars.forEach(s => s.classList.remove("active"));
                document.querySelectorAll(".error-message").forEach(e => e.remove());
                document.querySelectorAll(".error-border").forEach(i => i.classList.remove("error-border"));

                if (submitReview) {
                    submitReview.classList.add("disabled");
                    submitReview.style.background = "#E8F1FA";
                    submitReview.style.color = "#8ca9c9";
                    submitReview.setAttribute("disabled", "true");
                }
            }

            // const toggleCheckbox = document.getElementById("toggleDifferences");

            // toggleCheckbox.addEventListener("change", function () {
            //     const rows = document.querySelectorAll(".compare_products_specifications_z tbody tr");

            //     rows.forEach(row => {
            //         const cells = Array.from(row.children);
            //         const uniqueValues = new Set(cells.map(cell => cell.textContent.trim()));

            //         if (uniqueValues.size === 1) {
            //             row.classList.toggle("hidden", this.checked);
            //         }
            //     });
            // });

            const compareBlocks = document.querySelectorAll(".compare_products_specifications_z");

            compareBlocks.forEach(block => {
                const toggleCheckbox = block.querySelector(".toggle-differences input");

                if (!toggleCheckbox) return; // Если кнопки нет, пусть код не работает

                toggleCheckbox.addEventListener("change", function() {
                    const rows = block.querySelectorAll("tbody tr");

                    rows.forEach(row => {
                        const cells = Array.from(row.children);
                        const textValues = cells.map(cell => cell.textContent.trim());
                        const uniqueValues = new Set(textValues.filter(text => text !== ""));

                        // Если весь массив имеет одинаковое значение, мы скрываем
                        if (uniqueValues.size === 1) {
                            row.classList.toggle("hidden__z", this.checked);
                        }
                    });
                });
            });


            /*// Значок рядом с сердцем
            const compareButtons = document.querySelectorAll(".compare__btn__icon");

            if (compareButtons.length > 0) { // Проверяем, есть ли
                compareButtons.forEach(button => {
                    button.addEventListener("click", () => {
                        button.classList.toggle("active");
                    });
                });
            }*/


            const modal = document.querySelector(".product-modal");
            const modalOverlay = document.querySelector(".product-modal__overlay");
            const closeModalBtn = document.querySelector(".product-modal__close");
            const openModalBtns = document.querySelectorAll(".open-product-modal");

            if (modal && modalOverlay && closeModalBtn && openModalBtns.length > 0) {
                openModalBtns.forEach(button => {
                    button.addEventListener("click", () => {
                        modal.classList.add("active");
                    });
                });

                closeModalBtn.addEventListener("click", () => {
                    modal.classList.remove("active");
                });

                modalOverlay.addEventListener("click", () => {
                    modal.classList.remove("active");
                });
            }

            // SWIPER
            const mainSwiper = new Swiper(".product-slider", {
                spaceBetween: 10,
                slidesPerView: 1,
                slidesPerGroup: 1,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: new Swiper(".product-thumbnails", {
                        spaceBetween: 10,
                        slidesPerView: 4,
                        slidesPerGroup: 1,
                        watchSlidesProgress: true,
                    }),
                },
            });


            // LK
            // Фактический адрес checkbox
            const sameAddressCheckbox = document.querySelector("#sameAddress");
            if (sameAddressCheckbox) {
                sameAddressCheckbox.addEventListener("change", function() {
                    document.querySelector(".address-section .input-groups-z").classList.toggle("disabled", this.checked);
                });
            }

            // Добавление контактного лица
            // const addPersonBtn = document.querySelector(".add-person");
            // const personList = document.querySelector(".person-list");

            // if (addPersonBtn && personList) {
            //     addPersonBtn.addEventListener("click", () => {
            //         const newPerson = document.querySelector(".person").cloneNode(true);
            //         personList.appendChild(newPerson);
            //     });
            // }

            let contactCounter = 2; // Чтобы второй контакт был №2
            const contactsList = document.getElementById("contacts-list");
            const addPersonBtn = document.getElementById("add-person");

            // Функция создания нового контакта
            function createContactBlock(number) {
                const div = document.createElement("div");
                div.classList.add("company-data");
                div.innerHTML = `
            <h5>Контактное лицо №${number} 
                <button class="remove-btn">Удалить</button>
            </h5>
            <div class="input-groups-z">
                <div class="input-group-z select_group_z">
                    <select style="background-image: url(./src/assets/svgicons/arr_select.svg);">
                        <option>Директор</option>
                        <option>Менеджер</option>
                        <option>Бухгалтер</option>
                    </select>
                    <label>Должность</label>
                </div>
                <div class="input-group-z">
                    <input type="text" placeholder="ФИО" required>
                    <label>ФИО</label>
                </div>
                <div class="input-group-z">
                    <input type="tel" placeholder="Контактный телефон" required>
                    <label>Контактный телефон</label>
                </div>
            </div>
        `;
                contactsList.appendChild(div);
            }

            // Делегирование событий для удаления элементов
            if (contactsList) {
                contactsList.addEventListener("click", function(event) {
                    if (event.target.classList.contains("remove-btn")) {
                        event.target.closest(".company-data").remove();
                        updateContactNumbers();
                    }
                });
            }

            // Обновление номеров
            function updateContactNumbers() {
                const contacts = document.querySelectorAll(".company-data");
                contacts.forEach((block, index) => {
                    block.querySelector("h5").innerHTML = `Контактное лицо №${index + 2} 
                <button class="remove-btn">Удалить</button>`;
                });
                contactCounter = contacts.length + 2;
            }

            // Добавить новый контакт
            if (addPersonBtn) {
                addPersonBtn.addEventListener("click", () => {
                    createContactBlock(contactCounter++);
                    contactsList.classList.add('active');
                });
            }

            // Чтобы первый контакт не мог быть изменен
            document.addEventListener("DOMContentLoaded", () => {
                document.querySelector(".contact-persons select").setAttribute("disabled", "disabled");
            });


            // DISABLED SELECT
            // document.querySelectorAll(".readonly_select").forEach(select => {
            //     if (select) { // Проверить наличие Select
            //         select.addEventListener("mousedown", function (event) {
            //             event.preventDefault();
            //         });
            //     }
            // });


            // ADD USER PHOTO
            const profilePreview = document.getElementById("profilePreview");
            const profileUpload = document.getElementById("profileUpload");
            const removePhoto = document.getElementById("removePhoto");
            const defaultAvatar = "reviews-avatar.png";

            if (profilePreview && profileUpload && removePhoto) {
                // 📌 Функция загрузки изображения профиля
                profileUpload.addEventListener("change", function() {
                    const file = this.files[0];

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            profilePreview.src = e.target.result;
                            removePhoto.style.display = "block"; // Показать кнопку выключения
                        };
                        reader.readAsDataURL(file);
                    }
                });

                // 📌 Функция удаления изображения профиля
                removePhoto.addEventListener("click", function() {
                    profilePreview.src = defaultAvatar;
                    profileUpload.value = "";
                    removePhoto.style.display = "none"; // Показать кнопку выключения
                });

                // 📌 Скрыть кнопку "Удалить", если пользователь не загрузил изображение
                if (profilePreview.src.includes(defaultAvatar)) {
                    removePhoto.style.display = "none";
                }
            }


            // projects page
            if (typeof Swiper !== "undefined") {
                const swiper = new Swiper(".right_top_slider .swiper", {
                    loop: true, // Бесконечная прокрутка ползунка
                    autoplay: {
                        delay: 9000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: ".projects__swiper-next",
                        prevEl: ".projects__swiper-prev",
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    slidesPerView: 1,
                    spaceBetween: 10,
                });
            } else {
                console.error("Swiper.js yuklanmagan! Iltimos, kutubxonani tekshiring.");
            }

            // news page
            if (typeof Swiper !== "undefined") {
                const swiper = new Swiper(".news_page_slider .swiper", {
                    loop: true, // Бесконечная прокрутка ползунка
                    autoplay: {
                        delay: 9000,
                        disableOnInteraction: false,
                    },
                    navigation: {
                        nextEl: ".projects__swiper-next",
                        prevEl: ".projects__swiper-prev",
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    slidesPerView: 1,
                    spaceBetween: 10,
                });
            } else {
                console.error("Swiper.js не загружен! Пожалуйста, проверьте библиотеку.");
            }


            // ORDER
            /*const deliveryOptions = document.querySelectorAll(".delivery-option input");
            const checkoutButtons = document.querySelectorAll(".checkout-btn"); // Две кнопки
            const requiredInputs = document.querySelectorAll("#checkout-form input:not([type=radio])");
            const orderTotalElement = document.querySelector(".checkout-summary .total_sum span");
            const deliveryCostElement = document.querySelector(".checkout-summary p:nth-child(2) span");

            let baseTotal = 64999; // Сумма основных продуктов
            let deliveryCost = 5000; // Стоимость доставки по умолчанию

            // 🚚 Изменение стоимости доставки
            deliveryOptions.forEach(option => {
                option.addEventListener("change", function() {
                    deliveryOptions.forEach(opt => opt.parentElement.classList.remove("selected"));
                    this.parentElement.classList.add("selected");

                    const optionText = this.parentElement.querySelector(".option-content small").textContent;
                    if (optionText.includes("5 000")) {
                        deliveryCost = 5000;
                    } else if (optionText.includes("8 000")) {
                        deliveryCost = 8000;
                    } else if (optionText.includes("11 000")) {
                        deliveryCost = 11000;
                    }

                    updateSummary();
                });
            });

            // 📌 Обновление общей суммы
            function updateSummary() {
                if (deliveryCostElement && orderTotalElement) {
                    deliveryCostElement.textContent = `${deliveryCost.toLocaleString()} ₽`;
                    orderTotalElement.textContent = `${(baseTotal + deliveryCost).toLocaleString()} ₽`;
                }
            }

            // Полная функция проверки формы
            function checkFormCompletion() {
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
            }

            // Удаление ошибки при записи в inputs
            requiredInputs.forEach(input => {
                input.addEventListener("input", function() {
                    let errorMessage = input.nextElementSibling;
                    if (errorMessage && errorMessage.classList.contains("error-message") && input.value.trim() !== "") {
                        errorMessage.remove();
                    }
                });
            });


            // ✅ Добавление события проверки к двум кнопкам проверки
            checkoutButtons.forEach(button => {
                button.addEventListener("click", function(event) {
                    if (!checkFormCompletion()) {
                        alert("Пожалуйста, заполните все поля!");
                        event.preventDefault();
                    } else {
                        alert("Ваш заказ принят!");
                    }
                });
            });

            // 📝 Корректировка общей суммы изначально
            updateSummary();*/




            document.querySelectorAll(".product-card").forEach((card) => {
                const imageSwiperEl = card.querySelector(".product-card__image-swiper");
                // const bottomSwiperEl = card.querySelector(".product-card__bottom_swiper");

                if (imageSwiperEl) {
                    // Swiper для изображения продукта
                    const imageSwiper = new Swiper(imageSwiperEl, {
                        spaceBetween: 10,
                        slidesPerView: 1,
                        pagination: {
                            el: card.querySelector(".product-card__pagination"),
                            clickable: true,
                        },
                        nested: true,
                    });




                }
            });




            document.querySelectorAll(".product-card").forEach((card) => {
                new Swiper(card.querySelector(".product-card__image-swiper_list"), {
                    spaceBetween: 10,
                    slidesPerView: 1,
                    pagination: {
                        el: card.querySelector(".product-card__pagination"),
                        clickable: true,
                    },
                    nested: true,
                });
            });

            window.letterSwiperInstance = new Swiper(".letter-modal__swiper", {
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".letter-modal__swiper-next",
                    prevEl: ".letter-modal__swiper-prev",
                },
            });


            const popupGallery = document.querySelector(".popup-gallery");

            if (popupGallery) {
                const slides = document.querySelectorAll(".product-screen__swiper .swiper-slide");
                const closePopup = document.querySelector(".close-popup");

                if (slides.length > 0) {
                    slides.forEach((slide) => {
                        slide.addEventListener("click", () => {
                            popupGallery.style.display = "block";
                        });
                    });
                }

                if (closePopup) {
                    closePopup.addEventListener("click", () => {
                        popupGallery.style.display = "none";
                    });
                }

                popupGallery.addEventListener("click", (e) => {
                    if (e.target === popupGallery) {
                        popupGallery.style.display = "none";
                    }
                });

                const popupSwiperContainer = popupGallery.querySelector(".product-screen__popup");
                const popupVerticalContainer = popupGallery.querySelector(".popup_left");

                if (popupSwiperContainer && popupVerticalContainer) {
                    const thumbsSwiper = new Swiper(popupVerticalContainer, {
                        // direction: window.innerWidth <= 1024 ? 'horizontal' : 'vertical',
                        // slidesPerView: window.innerWidth <= 1024 ? 4 : 8.5,
                        spaceBetween: 10,
                        watchSlidesProgress: true,
                        slideToClickedSlide: true,
                        mousewheel: true,
                        breakpoints: {
                            0: {
                                direction: 'horizontal',
                                slidesPerView: 4,
                            },
                            1025: {
                                direction: 'vertical',
                                slidesPerView: 8.5,
                            }
                        }
                    });

                    const mainSwiper = new Swiper(popupSwiperContainer, {
                        spaceBetween: 10,
                        slidesPerView: 1,
                        navigation: {
                            nextEl: ".product-popup-next",
                            prevEl: ".product-popup-prev",
                        },
                        thumbs: {
                            swiper: thumbsSwiper,
                        },
                    });

                    const thumbSlides = popupGallery.querySelectorAll(".popup_vertical .swiper-slide");

                    function updateActiveClass(index) {
                        thumbSlides.forEach(slide => slide.classList.remove("active"));
                        if (thumbSlides[index]) {
                            thumbSlides[index].classList.add("active");
                        }
                    }

                    thumbSlides.forEach((slide, index) => {
                        slide.addEventListener("click", () => {
                            mainSwiper.slideTo(index);
                            updateActiveClass(index);
                        });
                    });

                    mainSwiper.on("slideChange", () => {
                        updateActiveClass(mainSwiper.realIndex);
                    });

                    updateActiveClass(mainSwiper.realIndex);
                }
            }



            
        }

        return {
            init
        };
    })();

    // --- Module Accordion ---
    const AccordionModule = (function() {
        function init() {
            const accordions = document.querySelectorAll(".accordion");

            accordions.forEach((accordion) => {
                const trigger = accordion.querySelector(".accordion-trigger");
                const content = accordion.querySelector(".accordion-content");

                trigger.addEventListener("click", () => {
                    const isOpen = accordion.classList.contains("is-open");

                    if (isOpen) {
                        content.style.height = content.scrollHeight + "px";
                        setTimeout(() => {
                            content.style.height = "0";
                            content.style.opacity = 0;
                        }, 10);
                    } else {
                        content.style.height = content.scrollHeight + "px";
                        content.style.opacity = 1;
                    }

                    accordion.classList.toggle("is-open");

                    content.addEventListener("transitionend", () => {
                        if (!accordion.classList.contains("is-open")) {
                            content.style.height = "0";
                        } else {
                            content.style.height = "auto";
                        }
                    });
                });
            });

            viewAll();
        }

        function viewAll() {
            document.querySelectorAll(".main-category__content-left .accordion").forEach((accordion) => {
                const accordionContent = accordion.querySelector(".accordion-content");
                const checkboxes = accordionContent.querySelectorAll(".custom-checkbox");
                const viewAllButton = accordionContent.querySelector(".view-all");

                const maxVisible = 5;
                let isExpanded = false; // Флаг состояния

                if (checkboxes.length > maxVisible) {
                    checkboxes.forEach((checkbox, index) => {
                        if (index >= maxVisible) {
                            checkbox.style.display = "none";
                        }
                    });

                    viewAllButton.style.display = "block";

                    viewAllButton.addEventListener("click", function() {
                        isExpanded = !isExpanded; // Переключаем состояние

                        checkboxes.forEach((checkbox, index) => {
                            checkbox.style.display = isExpanded || index < maxVisible ? "flex" : "none";
                        });

                        viewAllButton.textContent = isExpanded ? "Скрыть" : "Показать все";
                    });
                } else {
                    viewAllButton.style.display = "none";
                }
            });
        }

        return {
            init
        };
    })();


/*
    // --- Module Modal ---
    const ModalModule = (function () {
        function init(modalSelector, triggerSelector) {
            const modal = document.querySelector(modalSelector);
            const modalTriggers = document.querySelectorAll(triggerSelector);

            console.log(modal, 'modal-2360');
            console.log(modalTriggers, 'modalTriggers-2361');

            if (!modal) {
                console.warn(`Модальное окно ${modalSelector} не найдено`);
                return;
            }

            const closeButton = modal.querySelector(".modal__close-btn");
            const modalContent = modal.querySelector(".modal__content");

            // Проверка: если контент не найден — тоже предупреждение
            if (!modalContent) {
                console.warn(`Контейнер .modal__content не найден в ${modalSelector}`);
            }

            // Навешиваем события на триггеры
            modalTriggers.forEach((modalTrigger) => {
                modalTrigger.addEventListener("click", function (e) {
                    e.preventDefault();
                    modal.classList.add("show");
                });
        });

            // Закрытие при клике вне окна
            modal.addEventListener("click", function (event) {
                if (!modalContent || !modalContent.contains(event.target)) {
                    modal.classList.remove("show");
                }
            });

            // Закрытие по кнопке
            if (closeButton) {
                closeButton.addEventListener("click", function () {
                    modal.classList.remove("show");
                });
            }
        }

        return {
            init
        };
    })();
*/

    // --- Module: Modal ---
    const ModalModule = (function () {
        function init(modalSelector, triggerSelector) {
            // document.addEventListener("DOMContentLoaded", function () {
                const modal = document.querySelector(modalSelector);
                const triggers = document.querySelectorAll(triggerSelector);

                if (!modal) {
                    console.warn(`⚠ Модалка ${modalSelector} не найдена на странице`);
                    return;
                }

                const closeBtn = modal.querySelector(".modal__close-btn");
                const modalContent = modal.querySelector(".modal__content") || modal;

                // --- Открытие модалки ---
                document.addEventListener("click", function (e) {
                    const trigger = e.target.closest(triggerSelector);
                    if (trigger) {
                        e.preventDefault();
                        modal.classList.add("show");

                        // Если кнопка содержит data-item — запишем в скрытое поле формы
                        const productId = trigger.dataset.item;
                        const input = modal.querySelector("input[name='PRODUCT_ID']");
                        if (input && productId) input.value = productId;
                    }
                });

                // --- Закрытие по кнопке ---
                if (closeBtn) {
                    closeBtn.addEventListener("click", function () {
                        modal.classList.remove("show");
                    });
                }

                // --- Закрытие по клику вне модалки ---
                modal.addEventListener("click", function (e) {
                    if (!modalContent.contains(e.target)) {
                        modal.classList.remove("show");
                    }
                });

                // --- Закрытие по ESC ---
                document.addEventListener("keydown", function (e) {
                    if (e.key === "Escape") {
                        modal.classList.remove("show");
                    }
                });

                // --- Обработка формы внутри модалки ---
                const form = modal.querySelector("form.request__form");
                if (form) {
                    form.addEventListener("submit", async function (e) {
                        e.preventDefault();

                        const formData = new FormData(form);
                        formData.append("ajax", "Y");

                        try {
                            const response = await fetch("/ajax/one_click_order.php", {
                                method: "POST",
                                body: formData
                            });
                            const data = await response.json();

                            if (data.status === "success") {
                                alert("✅ Заявка успешно отправлена!");
                                modal.classList.remove("show");
                                form.reset();
                            } else {
                                alert("Ошибка: " + (data.message || "Не удалось отправить заявку"));
                            }
                        } catch (err) {
                            console.error("Ошибка при отправке формы:", err);
                            alert("Ошибка сети. Попробуйте позже.");
                        }
                    });
                }
            // });
        }

        return { init };
    })();


    // --- Module City Modal ---
    const CityModule = (function() {
        function init() {
            const cityTitle = document.querySelector(".map-pick__text");
            const cityList = document.querySelector(".city-grid");
            const modal = document.querySelector(".modal");


            cityList.addEventListener("click", function(event) {
                if (event.target.tagName === "LI") {

                    const activeCity = cityList.querySelector(".active");
                    if (activeCity) activeCity.classList.remove("active");
                    event.target.classList.add("active");

                    const cityItem = event.target.closest(".city-grid li");
                    if (!cityItem) return;

                    const city = cityItem.textContent.trim();
                    if (!city) return;

                    console.log(cityItem, 'cityItem-2531');
                    console.log(city, 'city-2532');

                    fetch("/ajax/save_city.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
                        },
                        body: "city=" + encodeURIComponent(city)
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status !== "ok") {
                                console.error("Ошибка сохранения города", data);
                                return;
                            }

                            // подсветка выбранного города
                            document.querySelectorAll(".city-grid li.active")
                                .forEach(li => li.classList.remove("active"));
                            cityItem.classList.add("active");

                            // обновление города в шапке
                            const cityHeader = document.querySelector(".header__city");
                            if (cityHeader) {
                                cityHeader.textContent = data.city;
                            }

                            // закрытие модалки (через модуль, если есть)
                            if (window.ModalModule?.close) {
                                ModalModule.close("cityModal");
                            } else {
                                document.getElementById("cityModal")?.classList.remove("active");
                            }
                        })
                        .catch(err => {
                            console.error("Fetch error:", err);
                        });

                    cityTitle.textContent = event.target.textContent;
                    modal.classList.remove("show");
                }
            });
        }

        return {
            init
        };
    })();

    // --- Module Letters Modal
    const LetterModule = (function() {
        function init() {
            const swiperWrapper = document.querySelector(".letter-modal__swiper .swiper-wrapper");
            const letterItems = document.querySelectorAll(".letters__item img");

            letterItems.forEach((img) => {
                const swiperSlide = document.createElement("div");
                const swiperImage = document.createElement("img");

                swiperSlide.classList.add("swiper-slide");
                swiperImage.src = img.src;

                swiperSlide.appendChild(swiperImage);
                swiperWrapper.appendChild(swiperSlide);
            });

            document.querySelectorAll(".letters__item").forEach((item, idx) => {
                item.addEventListener("click", () => letterSwiperInstance.slideTo(idx));
            });
        }

        return {
            init
        };
    })();

    // --- Module Announcement ---
    const AnnouncementModule = (function() {
        function init() {
            if (document.querySelector(".announcement.active")) {
                document.querySelector(".header").classList.add("announcement-active");
                // document.querySelector(".nav-menu").style.height = "calc(100dvh - 70px - 149px - 59px)";
            }
        }

        return {
            init
        };
    })();

    // --- Module Catalog ---
    const CatalogModule = (function() {
        function init() {
            const catalogContainer = document.querySelector(".catalog-popup");
            const catalogTriggers = document.querySelectorAll(".header__catalog-btn");

            const oldImg = "/local/templates/razvitie/src/assets/svgicons/catalog.svg";
            const newImg = "/local/templates/razvitie/src/assets/svgicons/catalog-close.svg";

            let isOpen = false;

            catalogTriggers.forEach((catalogTrigger) => {
                if (window.innerWidth > 1024) {
                    catalogTrigger.addEventListener("click", (e) => {
                        e.preventDefault();

                        isOpen = !isOpen;
                        catalogContainer.classList.toggle("active");

                        catalogTriggers.forEach((btn) => {
                            const imgElement = btn.querySelector("img");
                            imgElement.src = isOpen ? newImg : oldImg;
                        });
                    });
                }
            });

            changeOnHover();
        }

        function changeOnHover() {
            const items = document.querySelectorAll(".catalog-popup__left .item");
            const centerItems = document.querySelectorAll(".catalog-popup__center .center-item");
            const moreButtons = document.querySelectorAll(
                ".catalog-popup__center button, .catalog-content__right button"
            );

            items.forEach((item, index) => {
                item.addEventListener("mouseenter", () => {
                    centerItems.forEach((center) => (center.style.display = "none"));
                    centerItems[index].style.display = "flex";
                });
            });

            moreButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const linksContainer = this.parentElement;
                    const hiddenLinks = linksContainer.querySelectorAll("a:nth-child(n+5)");

                    hiddenLinks.forEach((link) => {
                        link.style.display =
                            link.style.display === "none" || link.style.display === "" ? "block" : "none";
                    });

                    if (this.textContent.trim() === "Ещё") {
                        this.innerHTML = `Свернуть <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"12\" height=\"13\" viewBox=\"0 0 12 13\" fill=\"none\"> <g> <path d=\"M2.25 7.25L6 3.5L9.75 7.25\" stroke=\"#1A1A1A\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\" /> </g> </svg>`;
                    } else {
                        this.innerHTML = `Ещё <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"12\" height=\"13\" viewBox=\"0 0 12 13\" fill=\"none\"> <g> <path d=\"M9.75 5.75L6 9.5L2.25 5.75\" stroke=\"#1A1A1A\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\" /> </g> </svg>`;
                    }
                });
            });

            centerItems.forEach((center) => (center.style.display = "none"));
            if (centerItems.length > 0) {
                centerItems[0].style.display = "flex";
            }
        }

        return {
            init
        };
    })();

    // --- Module Navbar Menu ---
    const NavMenuModule = (function() {
        function init() {
            const trigger = document.querySelector(".header__menu-trigger");
            const navMenu = document.querySelector(".nav-menu");

            let clicked = false;

            trigger.addEventListener("click", () => {
                navMenu.classList.toggle("active");
                document.body.classList.toggle("hidden_body");
                trigger.src = clicked ?
                    "./src/assets/svgicons/header-menu.svg" :
                    "./src/assets/svgicons/header-menu-close.svg";
                clicked = !clicked;
            });
        }

        return {
            init
        };
    })();

    // --- Module Header ---
    const HeaderModule = (function() {
        function init() {
            const headerBottom = document.querySelector(".header__bottom");
            const headerScroll = document.querySelector(".header__scroll");

            if (headerBottom && headerScroll) {
                const observer = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((entry) => {
                            if (!entry.isIntersecting) {
                                headerScroll.classList.add("active");
                            } else {
                                headerScroll.classList.remove("active");
                            }
                        });
                    }, {
                        threshold: 0
                    }
                );

                observer.observe(headerBottom);
            }

            scrollFunc();
            scrollMobile();
            searchInput();
        }

        function scrollFunc() {
            const headerBottom = document.querySelector(".header__bottom");
            const headerScroll = document.querySelector(".header__scroll");
            const fixedElement = document.querySelector(".catalog-popup");

            if (headerBottom && headerScroll && fixedElement) {
                headerBottom.appendChild(fixedElement);

                const observer = new IntersectionObserver(
                    (entries) => {
                        entries.forEach((entry) => {
                            if (!entry.isIntersecting) {
                                fixedElement.classList.remove("top");
                                fixedElement.classList.add("scroll");
                                headerScroll.appendChild(fixedElement);
                            } else {
                                fixedElement.classList.add("top");
                                fixedElement.classList.remove("scroll");
                                headerBottom.appendChild(fixedElement);
                            }
                        });
                    }, {
                        threshold: 0
                    }
                );

                observer.observe(headerBottom);
            }
        }

        function scrollMobile() {
            if (window.innerWidth <= 1024) {
                const header = document.querySelector(".header");
                const navMenu = document.querySelector(".nav-menu");

                window.addEventListener("scroll", () => {
                    if (window.scrollY > 55) {
                        header.classList.add("scroll-mobile");
                        // navMenu.style.height = "calc(100dvh - 210px)";
                        navMenu.style.borderRadius = 0;
                    } else {
                        header.classList.remove("scroll-mobile");
                        // navMenu.style.height = "calc(100dvh - 278px)";
                        navMenu.style.borderTopLeftRadius = "20px";
                        navMenu.style.borderTopRightRadius = "20px";
                    }
                });
            }
        }

        function searchInput() {
            const searchContainers = document.querySelectorAll(".search-input");
            const searchButtonHeaderScroll = document.querySelector(".search-icon-scroll");
            const searchFormScroll = document.querySelector(".search-form--scroll");
            const headerScrollNav = document.querySelector(".header__scroll nav");
            const searchBtnMobile = document.querySelector(".search-icon.mobile");
            const searchFormMobile = document.querySelector(".search_mobile_form_box");
            const overlayMobile = document.querySelector(".search-form__overlay");
            const searchResults = document.querySelector(".search-result");

            let isSecondHeader = false;

            searchContainers.forEach((container, idx) => {
                const input = container.querySelector("input");
                const icon = container.querySelector(".search-input__icon");
                const clear = container.querySelector(".search-input__clear");
                const searchPopup = document.querySelectorAll(".search-result")[idx];
                const overlay = document.querySelectorAll(".search-form__overlay")[idx];

                input.addEventListener("focus", () => {
                    container.classList.add("active");
                    input.classList.add("focused");
                    icon.classList.add("square");
                    clear.classList.add("show");
                    overlay.classList.add("active");
                });

                clear.addEventListener("mousedown", (event) => {
                    event.preventDefault();
                });

                input.addEventListener("blur", () => {
                    if (document.activeElement === clear) return;

                    if (isSecondHeader) {
                        searchButtonHeaderScroll.style.display = "block";
                        headerScrollNav.style.display = "flex";
                        searchFormScroll.classList.remove("active");
                        isSecondHeader = false;
                        return;
                    }

                    container.classList.remove("active");
                    input.classList.remove("focused");
                    icon.classList.remove("square");
                    clear.classList.remove("show");
                    searchPopup.classList.remove("active");
                    overlay.classList.remove("active");
                    searchFormMobile.classList.remove("show");
                });

                input.addEventListener("input", () => {
                    searchPopup.classList.add("active");

                    if (input.value.length === 0) {
                        searchPopup.classList.remove("active");
                    }
                });

                clear.addEventListener("click", () => {
                    input.value = "";
                });
            });

            searchButtonHeaderScroll.addEventListener("click", (e) => {
                e.preventDefault();
                searchButtonHeaderScroll.style.display = "none";
                headerScrollNav.style.display = "none";
                searchFormScroll.classList.add("active");
                searchFormScroll.querySelector("input").focus();

                isSecondHeader = true;
            });

            searchBtnMobile.addEventListener("click", (e) => {
                e.preventDefault();
                searchFormMobile.classList.add('show');
                // overlayMobile.classList.add('active');
            });

            // document.addEventListener("click", (e) => {
            //     if (!searchFormMobile.contains(e.target) && !searchBtnMobile.contains(e.target)) {
            //         searchFormMobile.classList.remove('show');
            //         overlayMobile.classList.remove('active');
            //     }
            // });

            if (searchBtnMobile && searchFormMobile && overlayMobile) {
                document.addEventListener("click", function(e) {
                    const clickedInsideForm = searchFormMobile.contains(e.target);
                    const clickedInsideResults = searchResults && searchResults.contains(e.target);
                    const clickedBtn = searchBtnMobile.contains(e.target);

                    if (!clickedInsideForm && !clickedInsideResults && !clickedBtn) {
                        searchFormMobile.classList.remove("show");
                        overlayMobile.classList.remove("active");
                    }
                });

                // Optionally — show form when button clicked
                searchBtnMobile.addEventListener("click", function() {
                    searchFormMobile.classList.add("show");
                    overlayMobile.classList.add("active");
                });
            } else {
                console.warn("❗ Один из элементов не найден: .search-icon.mobile, .search_mobile_form_box, .search-form__overlay");
            }

        }

        return {
            init
        };
    })();


    const SortDropdown = (function() {
        function init() {
            const dropdownTrigger = document.querySelector(".sort-dropdown__trigger");
            const dropdownContent = document.querySelector(".sort-dropdown__content");

            if (!dropdownTrigger || !dropdownContent) return; // <-- Избегание ошибок

            const dropdownOptions = dropdownContent.querySelectorAll("span");
            const triggerText = dropdownTrigger.querySelector("span");
            const arrowIcon = dropdownTrigger.querySelector("svg");

            dropdownTrigger.addEventListener("click", function() {
                dropdownContent.classList.toggle("open");
                arrowIcon.style.transform = dropdownContent.classList.contains("open") ?
                    "rotate(180deg)" :
                    "rotate(0deg)";
            });

            dropdownOptions.forEach((option) => {
                option.addEventListener("click", function() {
                    triggerText.textContent = this.textContent;
                    dropdownContent.classList.remove("open");
                    arrowIcon.style.transform = "rotate(0deg)";
                });
            });

            document.addEventListener("click", function(e) {
                if (!dropdownTrigger.contains(e.target) && !dropdownContent.contains(e.target)) {
                    dropdownContent.classList.remove("open");
                    arrowIcon.style.transform = "rotate(0deg)";
                }
            });
        }

        return {
            init
        };
    })();

    // --- Module Category Page ---
    const CategoryPageModule = (function() {
        function init() {
            const container = document.querySelector(".main-category__desc .right-side");
            if (!container) return; // <-- Избегание ошибок

            const paragraph = container.querySelector("p");
            const button = container.querySelector("button");
            const buttonText = button?.querySelector("span");
            const icon = button?.querySelector("svg");

            if (!paragraph || !button || !buttonText || !icon) return; // <-- Избегание ошибок

            const maxHeight = "3em";
            paragraph.style.overflow = "hidden";
            paragraph.style.maxHeight = maxHeight;
            paragraph.style.transition = "max-height 0.3s ease-in-out";

            button.addEventListener("click", function() {
                if (paragraph.style.maxHeight === maxHeight) {
                    paragraph.style.maxHeight = paragraph.scrollHeight + "px";
                    buttonText.textContent = "Скрыть описание";
                    icon.style.transform = "rotate(180deg)";
                } else {
                    paragraph.style.maxHeight = maxHeight;
                    buttonText.textContent = "Раскрыть описание";
                    icon.style.transform = "rotate(0deg)";
                }
            });

            filterPopup();
        }

        function filterPopup() {
            const filterPopup = document.querySelector(".filter-popup");
            const slideScreen = document.querySelector(".filter-popup__slide-content");
            const welcomeScreen = document.querySelector(".filter-popup__welcome");
            const filterBackBtn = document.querySelector(".filter-back-btn");
            const filterBtn = document.querySelector(".filter-btn");
            const saveFilterBtn = document.querySelector(".save-filter");

            if (!filterPopup || !slideScreen || !welcomeScreen || !filterBackBtn || !filterBtn || !saveFilterBtn) return; // <-- Избегание ошибок

            const slideItems = slideScreen.querySelectorAll(".slide-item");
            const welcomeItems = welcomeScreen.querySelectorAll(".welcome-item");

            welcomeScreen.classList.add("active");

            let isInSlideScreen = false;

            welcomeItems.forEach((item, idx) => {
                item.addEventListener("click", () => {
                    welcomeScreen.classList.remove("active");
                    slideScreen.classList.add("active");
                    slideItems[idx]?.classList.add("active"); // <-- Проверить наличие
                    isInSlideScreen = true;
                });
            });

            filterBackBtn.addEventListener("click", () => {
                if (isInSlideScreen) {
                    welcomeScreen.classList.add("active");
                    slideScreen.classList.remove("active");
                    slideItems.forEach((i) => i.classList.remove("active"));
                    isInSlideScreen = false;
                } else {
                    filterPopup.classList.remove("active");
                    // document.body.classList.remove("hidden");
                }
            });

            filterBtn.addEventListener("click", () => {
                filterPopup.classList.add("active");
                // document.body.classList.add("hidden");
            });

            saveFilterBtn.addEventListener("click", () => {
                welcomeScreen.classList.add("active");
                slideScreen.classList.remove("active");
                filterPopup.classList.remove("active");
                // document.body.classList.remove("hidden");
                slideItems.forEach((i) => i.classList.remove("active"));
                isInSlideScreen = false;
            });
        }

        // ===========================
        //  AUTH FORM SEND (Bitrix)
        // ===========================

        const authForm = document.querySelector("#authForm");

        if (authForm) {
            authForm.addEventListener("submit", async function(e) {
                e.preventDefault();

                const formData = new FormData(authForm);

                try {
                    const response = await fetch(authForm.getAttribute("action"), {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-Requested-With": "XMLHttpRequest"
                        }
                    });

                    const text = await response.text();

                    // Если Bitrix вернул редирект после успеха — перезагружаем
                    if (response.redirected) {
                        window.location.href = response.url;
                        return;
                    }

                    // Ищем ошибки system.auth.form (они в блоке auth-error)
                    const temp = document.createElement("div");
                    temp.innerHTML = text;

                    const error = temp.querySelector(".auth-error");

                    if (error) {
                        // Показать ошибку внутри модалки
                        let errBlock = document.querySelector(".auth-error");
                        if (!errBlock) {
                            errBlock = document.createElement("div");
                            errBlock.classList.add("auth-error");
                            authForm.prepend(errBlock);
                        }
                        errBlock.textContent = error.textContent;
                    } else {
                        // Успех → закрываем модалку и обновляем страницу
                        document.querySelector(".authorization-modal")?.classList.remove("active");
                        location.reload();
                    }

                } catch (err) {
                    console.error("Auth error:", err);
                }
            });
        }


        return {
            init
        };
    })();

    // --- Init all modules ---
    function init() {
        ZoomModule.init();
        if (typeof SwiperModule !== "undefined") SwiperModule.init();
        if (typeof AccordionModule !== "undefined") AccordionModule.init();

        if (typeof ModalModule !== "undefined") {
            ModalModule.init("#cityModal", ".map-pick");
            // ModalModule.init("#cityModal", ".map-pick");
            ModalModule.init("#letterModal", ".letters__item");
            //ModalModule.init("#requestModal", ".request-trigger");
            //ModalModule.init("#oneBuyClickModal", ".one_buy_click-trigger");
            // ModalModule.init("#videoModal", ".video-play");
        }

        if (typeof CityModule !== "undefined") CityModule.init();
        if (typeof LetterModule !== "undefined") LetterModule.init();
        if (typeof AnnouncementModule !== "undefined") AnnouncementModule.init();
        if (typeof CatalogModule !== "undefined") CatalogModule.init();
        if (typeof NavMenuModule !== "undefined") NavMenuModule.init();
        if (typeof HeaderModule !== "undefined") HeaderModule.init();

        SortDropdown.init();
        CategoryPageModule.init();
    }
    return {
        init
    };
})();

document.addEventListener("DOMContentLoaded", App.init);