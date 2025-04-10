<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/grupos.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100&icon_names=favorite,home,search,settings" rel="stylesheet" />    
    <link rel="stylesheet" href="CSS/nav.css">
    <link rel="icon" href="Imagenes/LOGO/Color-ico.ico" type="image/x-icon">
    <title>Grupos</title>
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
            <a id="chats" href="chats.php">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M320-320h480v-120H698q-21 37-58 58.5T560-360q-42 0-79-21.5T422-440H320v120Zm240-120q34 0 57-23.5t23-56.5h160v-280H320v280h160q0 33 23.5 56.5T560-440ZM320-240q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm160-240h480-480Z"/></svg>
              <span>Chats</span>
            </a>
          </li>
          <li>
            <a id="grupos" href="grupos.php">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z"/></svg>
              <span>Grupos</span>
            </a>
          </li>
          <li>
            <a id="logros" href="logros.php">
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
        <!-- Modal Adjunto -->
        <div class="modal fade" id="modalAdjunto" tabindex="-1" aria-labelledby="modalAdjuntoLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="modalAdjuntoLabel">Adjunto</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form method="POST" action="">
                      <div class="mb-3">
                        <label class="form-label">Archivo</label>
                        <input class="form-control" type="file">
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Ubicacion</label>
                        <button class="btn" >Ubicacion actual <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff"><path d="M480-480q33 0 56.5-23.5T560-560q0-33-23.5-56.5T480-640q-33 0-56.5 23.5T400-560q0 33 23.5 56.5T480-480Zm0 294q122-112 181-203.5T720-552q0-109-69.5-178.5T480-800q-101 0-170.5 69.5T240-552q0 71 59 162.5T480-186Zm0 106Q319-217 239.5-334.5T160-552q0-150 96.5-239T480-880q127 0 223.5 89T800-552q0 100-79.5 217.5T480-80Zm0-480Z"/></svg></button>
                      </div>
                    </form>
                    
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalAlert">Enviar</button>
                  </div>
              </div>
          </div>
        </div>
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
      <div class="lista-chat">
          <div class="lista col-5">
              <ul class="list-group list-group-flush">
                <li class="list-group-item ">
                  <a href="">
                    <img id="maestriaLista" src="Imagenes/LOGROS/carta.png">
                    <label>Nombre del grupo</label>
                  </a>
                </li>
                <li class="list-group-item ">
                  <a href="">
                    <img id="maestriaLista" src="Imagenes/LOGROS/carta.png">
                    <label>Nombre del grupo</label>
                  </a>
                </li>
                <li class="list-group-item ">
                  <a href="">
                    <img id="maestriaLista" src="Imagenes/LOGROS/carta.png">
                    <label>Nombre del grupo</label>
                  </a>
                </li>
                <li class="list-group-item ">
                  <a href="">
                    <img id="maestriaLista" src="Imagenes/LOGROS/carta.png">
                    <label>Nombre del grupo</label>
                  </a>
                </li>
                <li class="list-group-item ">
                  <a href="">
                    <img id="maestriaLista" src="Imagenes/LOGROS/carta.png">
                    <label>Nombre del grupo</label>
                  </a>
                </li>
                <li class="list-group-item ">
                  <a href="">
                    <img id="maestriaLista" src="Imagenes/LOGROS/carta.png">
                    <label>Nombre del grupo</label>
                  </a>
                </li>
                <li class="list-group-item ">
                  <a href="">
                    <img id="maestriaLista" src="Imagenes/LOGROS/carta.png">
                    <label>Nombre del grupo</label>
                  </a>
                </li>
                <li class="list-group-item ">
                  <a href="">
                    <img id="maestriaLista" src="Imagenes/LOGROS/carta.png">
                    <label>Nombre del grupo</label>
                  </a>
                </li>
                <li class="list-group-item ">
                  <a href="">
                    <img id="maestriaLista" src="Imagenes/LOGROS/carta.png">
                    <label>Nombre del grupo</label>
                  </a>
                </li>
                <li class="list-group-item ">
                  <a href="">
                    <img id="maestriaLista" src="Imagenes/LOGROS/carta.png">
                    <label>Nombre del grupo</label>
                  </a>
                </li>
              </ul>
          </div>
        <!-- CONTENEDOR CHAT y TAREAS-->
        <div class="chat col-7" id="contenedorChat">
          <div class="chat-header">
              <div class="chat-header-user">
                  <div class="h-left">
                      <div>
                          <img id="maestriaHader" src="Imagenes/LOGROS/carta.png" class="rounded-circle">
                          <label>Nombre del grupo</label>
                      </div>
                  </div>
                  <div class="h-right">
                      <a id="opciones-usuario" class="btn chat-privado"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff"><path d="M222-200 80-342l56-56 85 85 170-170 56 57-225 226Zm0-320L80-662l56-56 85 85 170-170 56 57-225 226Zm298 240v-80h360v80H520Zm0-320v-80h360v80H520Z"/></svg></a>
                  </div>
              </div>
          </div>
          <div class="chat-messages overflow-auto" id="contenidoChat">
              <div id="chat-contenido">
                  <div id="idChatMensaje" class="message message-usuario-1">
                      <img id="maestriaUsuario2" src="Imagenes/LOGROS/carta.png">
                      <div class="hour-message">
                          <label class="user-1">Nombre de Usuario 1</label>
                          <label class="text">Hola?</label>
                          <label class="hour">00:00</label>
                      </div>
                  </div>
                  <div id="idChatMensaje" class="message message-usuario-2">
                      <div class="hour-message">
                          <label class="user-2">Nombre de Usuario 2</label>
                          <label class="text">¡Qué hago aqui?</label>
                          <label class="hour">00:00</label>
                      </div>
                      <img id="maestriaUsuario" src="Imagenes/LOGROS/carta.png">
                  </div>
                  <div id="idChatMensaje" class="message message-usuario-1">
                    <img id="maestriaUsuario2" src="Imagenes/LOGROS/carta.png">
                    <div class="hour-message">
                        <label class="user-1">Nombre de Usuario 3</label>
                        <label class="text">¡Mamá?</label>
                        <label class="hour">00:00</label>
                    </div>
                </div>
              </div>
              <div id="tareas-contenido" class="d-none">
                  <form id="formTarea" class="mb-3">
                      <label class="form-label">Nueva Tarea</label>
                      <input id="inputTarea" class="form-control" type="text" placeholder="Escribe una tarea..." required>
                      <button type="submit" class="btn mt-2">Agregar</button>
                  </form>
                  <div class="tareas-lista">
                      <h4>Tareas</h4>
                      <ul id="listaTareas" class="list-group">
                          <li class="list-group-item">
                              <input type="checkbox" class="form-check-input me-2">
                              <label>Tarea 1</label>
                          </li>
                          <li class="list-group-item">
                              <input type="checkbox" class="form-check-input me-2">
                              <label>Tarea 2</label>
                          </li>
                          <li class="list-group-item">
                              <input type="checkbox" class="form-check-input me-2">
                              <label>Tarea 3</label>
                          </li>
                      </ul>
                  </div>
                  <button id="btnGuardar" class="btn"data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalAlert">Guardar Cambios</button>
              </div>
          </div>
          <form method="POST" class="chat-input">   
            <button type="button" data-bs-toggle="modal" data-bs-target="#modalAdjunto" id="btnFile" class="btn"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff"><path d="M720-330q0 104-73 177T470-80q-104 0-177-73t-73-177v-370q0-75 52.5-127.5T400-880q75 0 127.5 52.5T580-700v350q0 46-32 78t-78 32q-46 0-78-32t-32-78v-370h80v370q0 13 8.5 21.5T470-320q13 0 21.5-8.5T500-350v-350q-1-42-29.5-71T400-800q-42 0-71 29t-29 71v370q-1 71 49 120.5T470-160q70 0 119-49.5T640-330v-390h80v390Z"/></svg></button>
            <input type="text" placeholder="Escribe tu mensaje..." id="mensajeInput"></input>
            <button type="button" id="btnEnviar" class="btn btn-primary">Enviar</button>
        </form>
      </div>
      </div>
    </main>
</body>
<script src="JS/tareas.js"></script>
<script src="JS/jquery-3.7.1.min.js"></script>
<script src="JS/navbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</html>