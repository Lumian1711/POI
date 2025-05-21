<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/chats.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100&icon_names=favorite,home,search,settings" rel="stylesheet" />    
    <link rel="stylesheet" href="CSS/nav.css">
    <link rel="icon" href="Imagenes/LOGO/Color-ico.ico" type="image/x-icon">
    <title>Chats</title>
</head>
<body>
    
    <?php include('PHP/conexion.php'); ?>
    <?php include('nav_bar.php'); ?>

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
                  <button type="button" data-bs-dismiss="modal" class="btn">Cerrar</button>
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
                  <a href="../PHP/logout.php" class="btn">Cerrar Sesión</a>
              </div>
          </div>
      </div>
    </div>

  
  <!--MAIN-->
  <main> 
    <div class="lista-chat">
      <?php
        $id_user = intval($_SESSION['id_user']);
        $id_chat = intval($_GET['id_chat']); // Aquí usamos el chat como si fuera grupo

        $sql = "SELECT u.name, c.crea_date, c.id_chat
                FROM user_group ug
                JOIN user u ON ug.id_user = u.id_user
                JOIN chats c ON c.id_chat = ug.id_group
                WHERE ug.id_user != ?
                  AND c.tipo = 1
                LIMIT 1"; // Solo queremos al otro

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id_user);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($row = $resultado->fetch_assoc()) {
            $invited = $row['name'];       // <- Este es el otro usuario
            $date = $row['crea_date'];     // <- Fecha de creación del chat
            $chat = $row['id_chat'];
        } else {
            $invited = "Usuario desconocido";
            $date = "Fecha no disponible";
        }

        $stmt->close();
      ?>

      <!-- LISTA CHATS -->
      <div class="lista col-5 mx-2"> 
          <ul class="list-group list-group-flush">
            <?php if ($resultado->num_rows > 0): ?>
              <div class="list-group-item rounded-4" onclick="location.href='chats.php?id_chat=<?php echo $chat ?>'">

                <h3><strong><?php echo htmlspecialchars($invited); ?></strong></h3>
                <p><strong>Creado el:</strong> <?php echo htmlspecialchars($date); ?></p>
              </div>
            <?php else: ?>
              <div class="no-chats">

                  <p>No hay chats por el momento. Da clic en Nuevo Chat</p>
              </div>
            <?php endif;  ?>
          </ul>
      </div>

        <!-- CONTENEDOR CHAT y TAREAS-->
        <div class="chat col-7" id="contenedorChat">
          <div class="chat-header">
              <div class="chat-header-user">
                  <div class="h-left">
                    <?php if($id_chat > 0): ?>
                        
                      <img id="maestriaHader" src="Imagenes/LOGROS/carta.png" class="rounded-circle">
                      <label><?php echo htmlspecialchars($invited); ?></label>
                    <?php else: ?>
                      <div class="no-chats">

                        <p>Selecciona un chat</p>
                      </div>
                    <?php endif; ?>
                  </div>
                  <div class="h-right">
                    <a name="videocat" href="llamada.html" class="btn chat-privado">
                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                        <path d="M360-320h80v-120h120v-80H440v-120h-80v120H240v80h120v120ZM160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h480q33 0 56.5 23.5T720-720v180l160-160v440L720-420v180q0 33-23.5 56.5T640-160H160Zm0-80h480v-480H160v480Zm0 0v-480 480Z"/>
                      </svg>
                    </a>  
                  </div>
              </div>
          </div>

          <div class="chat-messages overflow-auto" id="contenidoChat">
            <div id="chat-contenido">
              <?php
                // Consulta para traer mensajes del chat 1, ordenados por fecha ascendente
                $sql = "SELECT id_sender, content, sndng_date 
                    FROM messages 
                    WHERE id_chat = ? 
                    ORDER BY sndng_date ASC";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id_chat);
                $stmt->execute();
                $resultado = $stmt->get_result();

                if ($resultado && $resultado->num_rows > 0):
                  while ($mensaje = $resultado->fetch_assoc()):
                    $esMio = ($mensaje['id_sender'] != $id_user); // Comparamos el id del remitente con el id del usuario logueado

                    // Aplicamos diferentes clases para que se alineen a la izquierda o derecha
                    $claseMensaje = $esMio ? 'message-usuario-1' : 'message-usuario-2';
              ?>
                <div class="mensaje <?php echo $claseMensaje; ?> p-4">
                  <div class="contenido-mensaje">
                    <p><?php echo htmlspecialchars($mensaje['content']); ?></p>
                    <span class="hora"><?php echo htmlspecialchars(date('H:i', strtotime($mensaje['sndng_date']))); ?></span>
                  </div>
                </div>
              <?php
                  endwhile;
                else:
              ?>
                <p class="sin-mensajes">No hay mensajes en este chat.</p>
              <?php
                endif;
              ?>
            </div>
            
            <!-- TAREAS -->
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
          <form method="POST" action="../PHP/send_message.php" class="chat-input" enctype="multipart/form-data"> 

            <!-- Botón para abrir el explorador de archivos -->
            <label for="archivoAdjunto" class="btn">
              <!-- Puedes poner aquí tu ícono SVG o texto -->
              📎
            </label>
            <!-- Input de tipo file oculto -->
            <input type="file" name="archivoAdjunto" id="archivoAdjunto" style="display: none;">

            <!-- Campo para escribir el mensaje -->
            <input type="text" placeholder="Escribe tu mensaje..." id="mensajeInput" name="mensajeInput" required>

            <!-- ID del emisor -->
            <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']; ?>">

            <!-- ID del chat actual -->
            <input type="hidden" name="id_chat" value="<?php echo $id_chat; ?>">

            <!-- Botón para enviar -->
            <button type="submit" id="btnEnviar" class="btn" value="Enviar">Enviar</button>
          </form>

        </div>
      </div>
    </div>
    <?php
      // Cerramos todo
      $stmt->close();
      $conn->close();
    ?>
  </main>

  <!-- SCRIPTS -->
  <script src="JS/tareas.js"></script>
  <script src="JS/navbar.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="JS/jquery-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function cargarMensajes() {
      $.ajax({
        url: 'cargar_mensajes.php',
        method: 'GET',
        success: function(respuesta) {
          $('#chat-contenido').html(respuesta);
        },
        error: function() {
          console.error('Error al cargar los mensajes.');
        }
      });
    }

    // Cargar mensajes cada 5 segundos
    setInterval(cargarMensajes, 3000);

    // También cargarlos al inicio
    cargarMensajes();
  </script>
  <script>
    window.onload = function () {
      const contenedor = document.getElementById('contenidoChat');
      contenedor.scrollTop = contenedor.scrollHeight;
    };
  </script>
</body>
</html>