document.addEventListener("DOMContentLoaded", function () {

    // --- ELEMENTS ---
    const form = document.querySelector("#authForm");
    if (!form) return;
    
    // console.log(form, 'form-7');

    const loginInput = form.querySelector("#auth-login-inn");
    const passInput = form.querySelector("#auth-password");
    const submitBtn = form.querySelector("#auth-submit-btn");
    const errorBox = form.querySelector(".auth-error");
    const successBox = form.querySelector(".auth-success");

    // console.log(loginInput, 'loginInput-13');
    // console.log(passInput, 'passInput-14');
    // console.log(submitBtn, 'submitBtn-15');
    // console.log(errorBox, 'errorBox-16');
    // console.log(successBox, 'successBox-17');

    // --- UTILS ---
    function showError(message) {
        if (errorBox) {
            errorBox.textContent = message;
            errorBox.style.display = "block";
        }
    }

    function hideError() {
        if (errorBox) errorBox.style.display = "none";
    }

    function showSuccess(message) {
        if (successBox) {
            successBox.textContent = message;
            successBox.style.display = "block";
        }
    }

    function disableForm(disabled = true) {
        if (submitBtn) submitBtn.disabled = disabled;
        if (loginInput) loginInput.disabled = disabled;
        if (passInput) passInput.disabled = disabled;
    }

    // --- FORM SUBMIT ---
    form.addEventListener("submit", async function (e) {
        e.preventDefault();
        hideError();

        const login = loginInput.value.trim();
        const pass = passInput.value.trim();

        console.log(login, 'login-54');
        console.log(pass, 'pass-55');

        if (!login || !pass) {
            showError("Введите логин и пароль.");
            return;
        }

        disableForm(true);

        try {
            const formData = new FormData(form);
            formData.append("ajax_auth", "Y");

            const response = await fetch(form.getAttribute("action"), {
                method: "POST",
                body: formData,
            });

            const result = await response.json();

            if (result.STATUS === "SUCCESS") {
                showSuccess("Успешная авторизация!");
                setTimeout(() => {
                    location.reload();
                }, 500);
            } else {
                showError(result.MESSAGE || "Ошибка авторизации.");
            }

        } catch (error) {
            showError("Сетевая ошибка. Попробуйте позже.");
        }

        disableForm(false);
    });

});
