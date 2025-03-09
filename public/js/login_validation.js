// document.addEventListener("DOMContentLoaded", function () {
//     const form = document.getElementById("loginForm");
//     const emailInput = document.getElementById("email");
//     const passwordInput = document.getElementById("password");
//     const emailError = document.getElementById("emailError");
//     const passwordError = document.getElementById("passwordError");

//     form.addEventListener("submit", function (event) {
//         let valid = true;

//         if (emailInput.value.trim() === "") {
//             emailError.textContent = "El correo es obligatorio.";
//             emailError.classList.remove("d-none");
//             valid = false;
//         } else if (!/^\S+@\S+\.\S+$/.test(emailInput.value)) {
//             emailError.textContent = "El formato del correo no es válido.";
//             emailError.classList.remove("d-none");
//             valid = false;
//         } else {
//             emailError.classList.add("d-none");
//         }

//         if (passwordInput.value.trim() === "") {
//             passwordError.textContent = "La contraseña es obligatoria.";
//             passwordError.classList.remove("d-none");
//             valid = false;
//         } else {
//             passwordError.classList.add("d-none");
//         }

//         if (typeof grecaptcha !== "undefined") {
//             let response = grecaptcha.getResponse();
//             if (response.length === 0) {
//                 alert("Por favor, verifica el captcha.");
//                 valid = false;
//             }
//         }

//         if (!valid) {
//             event.preventDefault();
//         }
//     });
// });

// document.addEventListener("DOMContentLoaded", function () {
//     let loginErrorElement = document.getElementById("loginError");

//     if (loginError) {
//         loginErrorElement.textContent = loginError;
//         loginErrorElement.classList.remove("d-none");
//     }
// });