/**
 * Модуль управления скидками от игры (привязка к ИНН юрлица)
 *
 * Уровень 1 = 5%
 * Уровень 2 = 10%
 * Уровень 3 = 15%
 */

const GameDiscountModule = (function() {

    // Текущие данные скидки
    let currentDiscount = window.gameDiscount || 0;
    let currentLevel = window.gameLevel || 0;
    let currentINN = window.gameINN || "";
    let currentCompany = window.gameCompany || "";

    /**
     * Получить текущую скидку
     */
    function getDiscount() {
        return currentDiscount;
    }

    /**
     * Получить текущий уровень
     */
    function getLevel() {
        return currentLevel;
    }

    /**
     * Получить ИНН
     */
    function getINN() {
        return currentINN;
    }

    /**
     * Проверить есть ли скидка
     */
    function hasDiscount() {
        return currentDiscount > 0;
    }

    /**
     * Проверить скидку по ИНН на сервере
     */
    function checkDiscountByINN(inn) {
        return fetch("/ajax/game_discount.php?action=check&inn=" + encodeURIComponent(inn))
            .then(function(res) { return res.json(); });
    }

    /**
     * Сохранить скидку по ИНН на сервер
     */
    function saveDiscount(inn, discount, level, company) {
        return fetch("/ajax/game_discount.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "action=save&inn=" + encodeURIComponent(inn) +
                  "&discount=" + discount +
                  "&level=" + level +
                  "&company=" + encodeURIComponent(company || "")
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.status === "success") {
                currentDiscount = data.discount;
                currentLevel = data.level;
                currentINN = data.inn || inn;
                window.gameDiscount = currentDiscount;
                window.gameLevel = currentLevel;
                window.gameINN = currentINN;
                updateUI();
            }
            return data;
        });
    }

    /**
     * Получить скидку с сервера по текущему ИНН
     */
    function fetchDiscount(inn) {
        var checkINN = inn || currentINN;
        if (!checkINN) return Promise.resolve({ status: "error", message: "ИНН не указан" });

        return fetch("/ajax/game_discount.php?action=get&inn=" + encodeURIComponent(checkINN))
            .then(function(res) { return res.json(); })
            .then(function(data) {
                if (data.status === "success" && data.discount > 0) {
                    currentDiscount = data.discount;
                    currentLevel = data.level;
                    currentINN = data.inn || checkINN;
                    currentCompany = data.company || "";
                    window.gameDiscount = currentDiscount;
                    window.gameLevel = currentLevel;
                    window.gameINN = currentINN;
                    updateUI();
                }
                return data;
            });
    }

    /**
     * Применить скидку к цене
     */
    function applyToPrice(price) {
        if (currentDiscount <= 0) return price;
        return Math.round(price * (1 - currentDiscount / 100) * 100) / 100;
    }

    /**
     * Рассчитать сумму скидки
     */
    function calculateSavings(price) {
        if (currentDiscount <= 0) return 0;
        return Math.round(price * currentDiscount / 100 * 100) / 100;
    }

    /**
     * Обновить UI (бейдж скидки)
     */
    function updateUI() {
        var badge = document.querySelector(".game-discount-badge");

        if (currentDiscount > 0) {
            var innDisplay = currentINN ? " (ИНН: " + currentINN.slice(0, 4) + "...)" : "";

            if (!badge) {
                badge = document.createElement("div");
                badge.className = "game-discount-badge";
                document.body.appendChild(badge);

                if (!document.querySelector("#game-discount-styles")) {
                    var style = document.createElement("style");
                    style.id = "game-discount-styles";
                    style.textContent = ".game-discount-badge{position:fixed;bottom:20px;right:20px;background:linear-gradient(135deg,#4CAF50 0%,#2E7D32 100%);color:#fff;padding:12px 20px;border-radius:12px;box-shadow:0 4px 15px rgba(76,175,80,0.4);z-index:9999;font-size:14px;cursor:pointer;transition:transform 0.2s,box-shadow 0.2s}.game-discount-badge:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(76,175,80,0.5)}.game-discount-badge .discount-value{font-size:24px;font-weight:bold;display:block}.game-discount-badge .discount-label{opacity:0.9;font-size:12px}.game-discount-badge .discount-inn{opacity:0.7;font-size:10px;display:block;margin-top:2px}";
                    document.head.appendChild(style);
                }
            }

            badge.innerHTML =
                '<span class="discount-label">Ваша скидка</span>' +
                '<span class="discount-value">-' + currentDiscount + '%</span>' +
                (currentINN ? '<span class="discount-inn">ИНН: ' + currentINN + '</span>' : '');

            badge.onclick = function() {
                var msg = "Ваша скидка " + currentDiscount + "% будет применена автоматически при оформлении заказа.";
                if (currentINN) {
                    msg += "\n\nПривязана к ИНН: " + currentINN;
                }
                if (currentCompany) {
                    msg += "\nОрганизация: " + currentCompany;
                }
                alert(msg);
            };
            badge.title = "Скидка от игры" + innDisplay;

        } else if (badge) {
            badge.remove();
        }
    }

    /**
     * Показать уведомление
     */
    function showNotification(message, type) {
        var notification = document.createElement("div");
        notification.style.cssText = "position:fixed;top:20px;right:20px;background:" + (type === "success" ? "#4CAF50" : "#f44336") + ";color:#fff;padding:15px 25px;border-radius:8px;z-index:99999;box-shadow:0 4px 12px rgba(0,0,0,0.2);max-width:300px;";
        notification.innerHTML = message;
        document.body.appendChild(notification);

        setTimeout(function() {
            notification.style.opacity = "0";
            notification.style.transition = "opacity 0.3s";
            setTimeout(function() { notification.remove(); }, 300);
        }, 4000);
    }

    /**
     * Показать форму ввода ИНН для проверки скидки
     */
    function showCheckINNForm() {
        var overlay = document.createElement("div");
        overlay.id = "check-inn-overlay";
        overlay.style.cssText = "position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.7);display:flex;align-items:center;justify-content:center;z-index:99999;font-family:Arial,sans-serif;";

        overlay.innerHTML =
            '<div style="background:#fff;padding:30px 40px;border-radius:16px;text-align:center;max-width:400px;width:90%;">' +
                '<h3 style="margin:0 0 15px;color:#333;">Проверить скидку по ИНН</h3>' +
                '<p style="color:#666;font-size:14px;margin:0 0 20px;">Введите ИНН вашей организации</p>' +
                '<input type="text" id="check-inn-input" placeholder="ИНН (10 или 12 цифр)" maxlength="12" ' +
                    'style="width:100%;padding:12px;font-size:16px;border:2px solid #ddd;border-radius:8px;text-align:center;box-sizing:border-box;" ' +
                    'oninput="this.value=this.value.replace(/\\D/g,\'\').slice(0,12)">' +
                '<div id="check-inn-result" style="min-height:40px;margin-top:15px;font-size:14px;"></div>' +
                '<button onclick="GameDiscountModule.doCheckINN()" style="width:100%;padding:12px;font-size:16px;background:#033B80;color:#fff;border:none;border-radius:8px;cursor:pointer;margin-top:10px;">Проверить</button>' +
                '<button onclick="document.getElementById(\'check-inn-overlay\').remove()" style="width:100%;padding:10px;font-size:14px;background:transparent;color:#999;border:none;cursor:pointer;margin-top:5px;">Закрыть</button>' +
            '</div>';

        document.body.appendChild(overlay);
        document.getElementById("check-inn-input").focus();
    }

    /**
     * Выполнить проверку ИНН из формы
     */
    function doCheckINN() {
        var inn = document.getElementById("check-inn-input").value.replace(/\D/g, "");
        var resultDiv = document.getElementById("check-inn-result");

        if (inn.length !== 10 && inn.length !== 12) {
            resultDiv.innerHTML = '<span style="color:#f44336;">Введите корректный ИНН</span>';
            return;
        }

        resultDiv.innerHTML = '<span style="color:#999;">Проверка...</span>';

        checkDiscountByINN(inn).then(function(data) {
            if (data.status === "success") {
                if (data.hasDiscount) {
                    resultDiv.innerHTML =
                        '<div style="background:#E8F5E9;padding:15px;border-radius:8px;">' +
                            '<div style="color:#4CAF50;font-size:24px;font-weight:bold;">Скидка ' + data.discount + '%</div>' +
                            (data.company ? '<div style="color:#666;font-size:12px;margin-top:5px;">' + data.company + '</div>' : '') +
                        '</div>';

                    // Сохраняем в сессию
                    currentDiscount = data.discount;
                    currentLevel = data.level;
                    currentINN = inn;
                    currentCompany = data.company || "";
                    window.gameDiscount = currentDiscount;
                    window.gameINN = currentINN;
                    updateUI();
                } else {
                    resultDiv.innerHTML = '<span style="color:#FF9800;">По данному ИНН скидка не найдена.<br>Пройдите игру чтобы получить скидку!</span>';
                }
            } else {
                resultDiv.innerHTML = '<span style="color:#f44336;">' + (data.message || "Ошибка проверки") + '</span>';
            }
        }).catch(function() {
            resultDiv.innerHTML = '<span style="color:#f44336;">Ошибка сети</span>';
        });
    }

    /**
     * Обработчик события получения скидки из игры
     */
    function onDiscountEarned(event) {
        var detail = event.detail || {};
        currentDiscount = detail.discount || 0;
        currentLevel = detail.level || 0;
        currentINN = detail.inn || "";
        updateUI();
        showNotification("Скидка <b>" + currentDiscount + "%</b> привязана к ИНН " + currentINN, "success");
    }

    /**
     * Инициализация
     */
    function init() {
        window.addEventListener("gameDiscountEarned", onDiscountEarned);

        // Проверяем localStorage на случай если есть несохранённая скидка
        var pending = localStorage.getItem("pendingGameDiscount");
        if (pending) {
            try {
                var data = JSON.parse(pending);
                if (data.inn && data.discount > currentDiscount) {
                    saveDiscount(data.inn, data.discount, data.level, data.company)
                        .then(function(result) {
                            if (result.status === "success") {
                                localStorage.removeItem("pendingGameDiscount");
                                showNotification("Скидка " + data.discount + "% синхронизирована", "success");
                            }
                        });
                }
            } catch (e) {}
        }

        console.log("[GameDiscount] Initialized. Discount:", currentDiscount + "%, INN:", currentINN || "not set");
    }

    // Публичный API
    return {
        init: init,
        getDiscount: getDiscount,
        getLevel: getLevel,
        getINN: getINN,
        hasDiscount: hasDiscount,
        applyToPrice: applyToPrice,
        calculateSavings: calculateSavings,
        saveDiscount: saveDiscount,
        fetchDiscount: fetchDiscount,
        checkDiscountByINN: checkDiscountByINN,
        showCheckINNForm: showCheckINNForm,
        doCheckINN: doCheckINN,
        updateUI: updateUI,
        showNotification: showNotification
    };

})();

// Инициализация при загрузке страницы
document.addEventListener("DOMContentLoaded", GameDiscountModule.init);
