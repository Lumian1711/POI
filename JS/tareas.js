document.addEventListener("DOMContentLoaded", function() {
    const btnOpciones = document.getElementById("opciones-usuario");
    const chatContenido = document.getElementById("chat-contenido");
    const tareasContenido = document.getElementById("tareas-contenido");
    const btnOpcionesUsuario = document.getElementById("opciones-usuario");
    const mensajeInput = document.getElementById("mensajeInput");
    const btnEnviar = document.getElementById("btnEnviar");

    const svgOriginal = `<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff"><path d="M222-200 80-342l56-56 85 85 170-170 56 57-225 226Zm0-320L80-662l56-56 85 85 170-170 56 57-225 226Zm298 240v-80h360v80H520Zm0-320v-80h360v80H520Z"/></svg>`;
    const svgAlternativo = `<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff"><path d="M880-80 720-240H320q-33 0-56.5-23.5T240-320v-40h440q33 0 56.5-23.5T760-440v-280h40q33 0 56.5 23.5T880-640v560ZM160-473l47-47h393v-280H160v327ZM80-280v-520q0-33 23.5-56.5T160-880h440q33 0 56.5 23.5T680-800v280q0 33-23.5 56.5T600-440H240L80-280Zm80-240v-280 280Z"/></svg>`;

    let modoTareas = false;
    let alternado = false;

    btnOpciones.addEventListener("click", function() {
        modoTareas = !modoTareas;
        chatContenido.classList.toggle("d-none", modoTareas);
        tareasContenido.classList.toggle("d-none", !modoTareas);
        mensajeInput.disabled = modoTareas;
        btnEnviar.disabled = modoTareas;
    });

    btnOpcionesUsuario.addEventListener("click", function () {
        alternado = !alternado;
        btnOpcionesUsuario.innerHTML = alternado ? svgAlternativo : svgOriginal;
    });
});