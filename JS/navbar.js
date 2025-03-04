const book = document.getElementById('book');
const lateral = document.querySelector('.barra');
const spans = document.querySelectorAll('span');
const main = document.querySelector('main');

book.addEventListener('click',()=>{
    lateral.classList.toggle("lateral");
    main.classList.toggle("grande");
    spans.forEach((span)=>{
        span.classList.toggle("oculto");
    });
});
document.getElementById("tipoChat").addEventListener("change", function() {
let extraUsuarioDiv = document.getElementById("extraUsuario");

if (this.value === "grupal") {
    if (!document.getElementById("txtUsuario2")) {
    let newInput = document.createElement("div");
    newInput.classList.add("mb-3");
    newInput.innerHTML = `
        <label class="form-label">Segundo usuario</label>
        <input id="txtUsuario2" name="txtUsuario2" class="form-control" type="text" required placeholder="Nombre del segundo usuario">
    `;
    extraUsuarioDiv.appendChild(newInput);
    }
} else {
    extraUsuarioDiv.innerHTML = "";
}
});