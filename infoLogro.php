<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/infoLogro.css">
    <link rel="stylesheet" href="CSS/nav.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100&icon_names=favorite,home,search,settings" rel="stylesheet" />    
    <link rel="icon" href="Imagenes/LOGO/Color-ico.ico" type="image/x-icon">
    <title>Logros</title>
</head>
<body>
    <!--nav-->
    <div class="barra">
      <div class="nombre-pagina">
        <img id="book" src="Imagenes/LOGO/Color-ico.ico" width="30px">
        <span>Chatify </span>
      </div>
      <button class="nuevo-chat material-symbols-outlined" data-bs-toggle="modal" data-bs-target="#modalNuevoMensaje">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M120-160v-600q0-33 23.5-56.5T200-840h480q33 0 56.5 23.5T760-760v203q-10-2-20-2.5t-20-.5q-10 0-20 .5t-20 2.5v-203H200v400h283q-2 10-2.5 20t-.5 20q0 10 .5 20t2.5 20H240L120-160Zm160-440h320v-80H280v80Zm0 160h200v-80H280v80Zm400 280v-120H560v-80h120v-120h80v120h120v80H760v120h-80ZM200-360v-400 400Z"/></svg>
        <span>Nuevo Chat</span>
      </button>
      <nav class="navegacion">
          <li>
            <a id="chats" href="chats.html">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M320-320h480v-120H698q-21 37-58 58.5T560-360q-42 0-79-21.5T422-440H320v120Zm240-120q34 0 57-23.5t23-56.5h160v-280H320v280h160q0 33 23.5 56.5T560-440ZM320-240q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm160-240h480-480Z"/></svg>
              <span>Chats</span>
            </a>
          </li>
          <li>
            <a id="grupos" href="grupos.html">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z"/></svg>
              <span>Grupos</span>
            </a>
          </li>
          <li>
            <a id="logros" href="logros.html">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M280-120v-80h160v-124q-49-11-87.5-41.5T296-442q-75-9-125.5-65.5T120-640v-40q0-33 23.5-56.5T200-760h80v-80h400v80h80q33 0 56.5 23.5T840-680v40q0 76-50.5 132.5T664-442q-18 46-56.5 76.5T520-324v124h160v80H280Zm0-408v-152h-80v40q0 38 22 68.5t58 43.5Zm200 128q50 0 85-35t35-85v-240H360v240q0 50 35 85t85 35Zm200-128q36-13 58-43.5t22-68.5v-40h-80v152Zm-200-52Z"/></svg>
              <span>Logros</span>
            </a>
          </li>
      </nav>
      <div class="linea"></div>
      <br>

      <div class="usuario">
        <img src="Imagenes/LOGROS/carta.png" alt="">
        <div class="info-usuario">
          <div class="nombre-correo">
          <span class="nombre">Nombre de usuario</span>
          <span class="correo">correo01@gmail.com</span>
          </div>
            <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"></a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEditar">Editar usuario</a></li>
              <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalCerrarSesion">Cerrar sesión</a></li>
            </ul>
        </div>
      </div>
    </div>

    <!--MODALES-->
        <!-- Modal nuevo mensaje -->
        <div class="modal fade" id="modalNuevoMensaje" tabindex="-1" aria-labelledby="modalNuevoMensajeLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="modalNuevoMensajeLabel">Nuevo chat</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body d-flex">
                    <!-- Formulario -->
                    <div class="w-50 pe-3">
                      <form method="POST" action="">
                        <div class="mb-3">
                          <label class="form-label">Tipo de chat</label>
                          <select class="form-control" name="tipoChat" id="tipoChat">
                            <option value="privado">Privado</option>
                            <option value="grupal">Grupal</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Nombre de usuario</label>
                          <input id="txtUsuario" name="txtUsuario" class="form-control" type="text" required placeholder="Nombre de usuario">
                        </div>
                        <div id="extraUsuario"></div>
                      </form>
                    </div>
                    
                    <!-- Lista de usuarios -->
                    <div class="w-50 border-start ps-3" style="max-height: 300px; overflow-y: auto;">
                      <h6>Usuarios existentes</h6>
                      <ul class="list-group" id="listaUsuarios">
                      </ul>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalAlert">Crear chat</button>
                  </div>
              </div>
          </div>
        </div>
        
        <script>
          document.addEventListener("DOMContentLoaded", function() {
            const listaUsuarios = document.getElementById("listaUsuarios");
            const usuarios = ["usuario1", "usuario2", "usuario3", "usuario4", "usuario5", "usuario6", "usuario7"]; // Reemplazar con datos dinámicos
            
            usuarios.forEach(usuario => {
              const li = document.createElement("li");
              li.classList.add("list-group-item", "list-group-item-action");
              li.textContent = usuario;
              li.style.cursor = "pointer";
              li.addEventListener("click", function() {
                document.getElementById("txtUsuario").value = usuario;
              });
              listaUsuarios.appendChild(li);
            });
          });
        </script>
        <!-- Modal LOGRO -->
        <div class="modal fade" id="modalNuevoMensaje" tabindex="-1" aria-labelledby="modalLogroLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="modalNuevoMensajeLabel">Car</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="">
                      <div class="mb-3">
                        <label class="form-label">Tipo de chat</label>
                        <select class="form-control" name="tipoChat" id="tipoChat">
                          <option value="privado">Privado</option>
                          <option value="grupal">Grupal</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Nombre de usuario</label>
                        <input id="txtUsuario" name="txtUsuario" class="form-control" type="text" required placeholder="Nombre de usuario">
                      </div>
                      <div id="extraUsuario"></div>
                    </form>
                    
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalAlert">Crear chat</button>
                  </div>
              </div>
          </div>
        </div>
        <!-- Modal Editar usuario -->
        <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="modalEditarLabel">Editar usuario</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="">
                      <div class="mb-3">
                          <label class="form-label">Nombre de usuario</label>
                          <input id="txtUsuario" name="txtUsuario" class="form-control"type="text" required placeholder="Nombre de usuario">
                      </div>
                      <div class="mb-3">
                          <label class="form-label">Correo</label>
                          <input id="txtCorreo" name="txtUsuario" class="form-control"type="text" required placeholder="@email.com">
                      </div>
                      <div class="mb-3">
                          <label class="form-label">Contraseña</label>
                          <input id="txtPassword" class="form-control" name="txtPassword" type="password" required placeholder="Contraseña">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalAlert">Guardar</button>
                  </div>
              </div>
          </div>
        </div>
        <!-- Modal Alert -->
        <div class="modal fade" id="modalAlert" tabindex="-1" aria-labelledby="modalAlertLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="modalAlertLabel">¡Exito!</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <p>¡Movimiento exitoso!</p>
                  </div>
                  <div class="modal-footer">
                      <a href="chats.html" class="btn">Cerrar</a>
                  </div>
              </div>
          </div>
        </div>
      <!-- Modal para cerrar sesión -->
        <div class="modal fade" id="modalCerrarSesion" tabindex="-1" aria-labelledby="modalCerrarSesionLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="modalCerrarSesionLabel">Cerrar Sesión</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <p>¿Estás seguro de que deseas cerrar sesión?</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                      <a href="login.html" class="btn">Cerrar Sesión</a>
                  </div>
              </div>
          </div>
        </div>

    <!--MAIN-->
    <main>
      <div class="main-contenedor">
        <h2>MAESTRIAS</h2>
        <div class="logros">
          <div class="info-logro">
            <img src="Imagenes/LOGROS/carta.png" alt="">
            <div class="nombre-descripcion">
              <h3 class="nombre">Carta (principiante)</h3>
            </div>
            <div class="descripcion">
                <span>Por haber creado tu primer chat</span>
            </div>
          </div>
          <div class="info-logro">
            <img src="Imagenes/LOGROS/logro-av.png" alt="">
            <div class="nombre-descripcion">
              <h3 class="nombre">Carta (avanzado)</h3>
            </div>
            <div class="descripcion">
                <span>Por haber creado tus primeros 3 chats</span>
            </div>
          </div>
        </div>
    </div>
    </main>
    
</body>
<script src="JS/navbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="JS/jquery-3.7.1.min.js"></script>
</html>