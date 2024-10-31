document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.querySelector("form");

    loginForm.addEventListener("submit", function (event) {
        const username = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();

        if (username.length < 4) {
            alert("El nombre de usuario debe tener al menos 4 caracteres.");
            event.preventDefault();
            return;
        }
        if (password.length < 6) {
            alert("La contraseña debe tener al menos 6 caracteres.");
            event.preventDefault();
            return;
        }
    });
});
