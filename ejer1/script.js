function prepararPagina() {
 //   var boton = document.querySelector('#boton-estilo');
//    var parrafo = document.querySelector('#texto');

document.querySelector('#boton-estilo').addEventListener('click', function () {
    var parrafo = document.querySelector('#texto');
    parrafo.classList.toggle('lectura-facil');
}, false);

}

window.addEventListener('load', prepararPagina, false);