// Selecionando os botões
var btnSignin = document.querySelector("#signin");
var btnSignup = document.querySelector("#signup");
var body = document.querySelector("body");

// Adicionando eventos de clique
btnSignin.addEventListener("click", function () {
    body.className = "sign-in-js"; // Altera a classe do body
});

btnSignup.addEventListener("click", function () {
    body.className = "sign-up-js"; // Altera a classe do body
});
