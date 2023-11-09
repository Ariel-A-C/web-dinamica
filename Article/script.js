function abrirNuevaPagina() {

    // URL de la nueva página en blanco (puedes cambiarla si es necesario)
    var nuevaPaginaURL = "nuevo_articulo.html";

    // Abre una nueva ventana o pestaña en blanco con la URL especificada
    window.open(nuevaPaginaURL, "_blank");
}

function editar() {


    var parrafos = document.getElementsByClassName('articulos');

    for (var i = 0; i < parrafos.length; i++) {
        var parrafo = parrafos[i];
        var textoOriginal = parrafo.textContent.trim();

        var formulario = document.createElement('textarea');
        formulario.value = textoOriginal;

        parrafo.innerHTML = '';
        parrafo.appendChild(formulario);
        var guardarButton = document.createElement('button');
        guardarButton.textContent = "Guardar";
        guardarButton.onclick = function () {
            var nuevoTexto = formulario.value;
            parrafo.textContent = nuevoTexto;
        };

        parrafo.appendChild(guardarButton);
    }




}
