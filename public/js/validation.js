document.addEventListener("DOMContentLoaded", function() {
    // Validación del formulario de inicio de sesión
    var loginForm = document.querySelector("form[action='/login']");
    if (loginForm) {
        loginForm.addEventListener("submit", function(event) {
            var username = loginForm.querySelector("input[name='username']").value.trim();
            var password = loginForm.querySelector("input[name='password']").value.trim();

            if (!username || !password) {
                event.preventDefault();
                alert("Por favor, complete todos los campos.");
            }
        });
    }

    // Validación del formulario de registro
    var registerForm = document.querySelector("form[action='/register']");
    if (registerForm) {
        registerForm.addEventListener("submit", function(event) {
            var username = registerForm.querySelector("input[name='username']").value.trim();
            var email = registerForm.querySelector("input[name='email']").value.trim();
            var password = registerForm.querySelector("input[name='password']").value.trim();
            var passwordConfirm = registerForm.querySelector("input[name='password_confirm']").value.trim();

            if (!username || !email || !password || !passwordConfirm) {
                event.preventDefault();
                alert("Por favor, complete todos los campos.");
            } else if (password !== passwordConfirm) {
                event.preventDefault();
                alert("Las contraseñas no coinciden.");
            }
        });
    }

    // Validación del formulario de recuperación de contraseña
    var forgotPasswordForm = document.querySelector("form[action='/forgot-password']");
    if (forgotPasswordForm) {
        forgotPasswordForm.addEventListener("submit", function(event) {
            var email = forgotPasswordForm.querySelector("input[name='email']").value.trim();

            if (!email) {
                event.preventDefault();
                alert("Por favor, ingrese su correo electrónico.");
            }
        });
    }

    // Validación del formulario de restablecimiento de contraseña
    var resetPasswordForm = document.querySelector("form[action^='/reset-password']");
    if (resetPasswordForm) {
        resetPasswordForm.addEventListener("submit", function(event) {
            var password = resetPasswordForm.querySelector("input[name='password']").value.trim();
            var passwordConfirm = resetPasswordForm.querySelector("input[name='password_confirm']").value.trim();

            if (!password || !passwordConfirm) {
                event.preventDefault();
                alert("Por favor, complete todos los campos.");
            } else if (password !== passwordConfirm) {
                event.preventDefault();
                alert("Las contraseñas no coinciden.");
            }
        });
    }
});
