// declara a variavel do button
const hamburguer = document.querySelector(".toggle-btn");

// Quando você cliicar no icon dentro do button, a nav vai espandir
hamburguer.addEventListener("click", function(){
    document.querySelector("#sidebar").classList.toggle("expanded");
});

