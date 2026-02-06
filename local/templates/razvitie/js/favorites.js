(function () {

    function updateHeartColor(btn, isActive) {
        const heartIcon = btn.querySelector("svg path");
        if (!heartIcon) return;

        if (isActive) {
            heartIcon.setAttribute("fill", "#033B80");
            heartIcon.setAttribute("stroke", "#033B80");
        } else {
            heartIcon.setAttribute("fill", "none");
            heartIcon.setAttribute("stroke", "#033B80");
        }
    }

    function initFavorites() {
        const isAuth = document.body.dataset.userAuth === "Y";

        function getFavorites() {
            if (isAuth) {
                return Array.isArray(window.serverFavorites) ? window.serverFavorites : [];
            }
            return JSON.parse(localStorage.getItem("favorites") || "[]");
        }

        function saveFavoritesLocal(favs) {
            localStorage.setItem("favorites", JSON.stringify(favs));
        }

        function updateFavoritesCounter(count) {
            const badge = document.querySelector(".mini-favorites .badge-wrapper span");
            if (badge) badge.textContent = count;
        }

        // -----------------------
        //   Toggle Favorite
        // -----------------------
        function toggleFavorite(itemId, btn) {

            if (isAuth) {
                // Авторизованный — отправляем toggle
                fetch("/ajax/favorites.php", {
                    method: "POST",
                    headers: {"Content-Type": "application/json"},
                    body: JSON.stringify({ action: "toggle", id: itemId })
                })
                    .then(r => r.json())
                    .then(r => {
                        if (r.status === "success") {

                            window.serverFavorites = r.favorites;

                            const exists = r.favorites.includes(itemId);

                            btn.classList.toggle("active", exists);
                            updateHeartColor(btn, exists);

                            updateFavoritesCounter(r.favorites.length);
                        }
                    });

            } else {
                // Гость — localStorage
                let favorites = getFavorites();
                const exists = favorites.includes(itemId);

                if (exists) {
                    favorites = favorites.filter(id => id !== itemId);
                } else {
                    favorites.push(itemId);
                }

                saveFavoritesLocal(favorites);

                btn.classList.toggle("active", !exists);
                updateHeartColor(btn, !exists);
                updateFavoritesCounter(favorites.length);
            }
        }

        // -----------------------
        //   INIT BUTTONS
        // -----------------------
        function initFavoriteButtons() {
            const favs = getFavorites();
            const favSet = new Set(favs);

            document.querySelectorAll("[data-action='favorite'], .heart-btn-featured")
                .forEach(btn => {

                    const itemId = Number(btn.dataset.item || btn.closest("[data-item]")?.dataset.item);
                    if (!itemId) return;

                    const isActive = favSet.has(itemId);

                    if (isActive) btn.classList.add("active");
                    updateHeartColor(btn, isActive);

                    btn.addEventListener("click", (e) => {
                        e.preventDefault();
                        toggleFavorite(itemId, btn);
                    });
                });
        }

        initFavoriteButtons();
        updateFavoritesCounter(getFavorites().length);
    }

    document.addEventListener("DOMContentLoaded", initFavorites);

})();