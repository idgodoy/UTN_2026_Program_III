function actualizarPerfil() {
    // 1. Capturar los elementos de entrada (inputs)
    const nombre = document.getElementById('inputNombre').value;
    const profesion = document.getElementById('inputProfesion').value;
    const imagen = document.getElementById('inputImagen').value;
    const color = document.getElementById('inputColor').value;

    // 2. Capturar los elementos de salida (donde vamos a mostrar los datos)
    const displayNombre = document.getElementById('nombrePerfil');
    const displayProfesion = document.getElementById('profesionPerfil');
    const displayFoto = document.getElementById('fotoPerfil');
    const tarjeta = document.getElementById('tarjetaPerfil');

    // 3. Aplicar los cambios al DOM
    if (nombre !== "") {
        displayNombre.innerHTML = nombre;
    }

    if (profesion !== "") {
        displayProfesion.innerHTML = profesion;
    }

    if (imagen !== "") {
        displayFoto.src = imagen;
    }

    // Cambiar estilo de fondo dinámicamente
    tarjeta.style.backgroundColor = color;
}