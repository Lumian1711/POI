document.addEventListener("DOMContentLoaded", function () {
  const book = document.getElementById('book');
  const lateral = document.querySelector('.barra');
  const spans = document.querySelectorAll('span');
  const main = document.querySelector('main');

  book.addEventListener('click', () => {
    lateral.classList.toggle("lateral");
    main.classList.toggle("grande");
    spans.forEach((span) => {
      span.classList.toggle("oculto");
    });
  });

  // Mostrar segundo campo si el chat es grupal
  document.getElementById("tipoChat").addEventListener("change", function () {
    let extraUsuarioDiv = document.getElementById("extraUsuario");

    if (this.value === "grupal") {
      if (!document.getElementById("txtUsuario2")) {
        let newInput = document.createElement("div");
        newInput.classList.add("mb-3");
        newInput.innerHTML = `
          <label class="form-label">Segundo usuario</label>
          <input id="txtUsuario2" name="txtUsuario2" class="form-control" type="text" required placeholder="Nombre del segundo usuario">
          <div class="mb-3">
                      <label class="form-label">Nombre del grupo</label>
                      <input id="txtnombre" name="txtnombre" class="form-control" type="text" required placeholder="Nombre del grupo">
                    </div>
        `;
        extraUsuarioDiv.appendChild(newInput);
      }
    } else {
      extraUsuarioDiv.innerHTML = "";
    }
  });

  // Hacer clic en un usuario de la lista para seleccionarlo
  const listaUsuarios = document.getElementById("listaUsuarios");
  const txtUsuario1 = document.getElementById("txtUsuario");

  listaUsuarios.querySelectorAll("li").forEach((li) => {
    li.style.cursor = "pointer";
    li.addEventListener("click", () => {
      const nombre = li.textContent.trim();

      // Si el primero está vacío, lo ponemos ahí
      if (txtUsuario1.value === "") {
        txtUsuario1.value = nombre;
      }
      // Si es grupal y ya está el primero, ponemos al segundo
      else if (document.getElementById("txtUsuario2")) {
        const txtUsuario2 = document.getElementById("txtUsuario2");
        if (txtUsuario2 && txtUsuario2.value === "") {
          txtUsuario2.value = nombre;
        }
      }
    });
  });
});
