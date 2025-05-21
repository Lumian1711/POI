<?php session_start(); ?>
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
    <?php include('nav_bar.php'); ?>

    <!--MAIN-->
    <!--MAIN-->
  <main> 
    <div class="lista-chat">
      <?php

        $id_user = intval($_SESSION['id_user']);
        $id_group = $_GET['id_group']; // ID del chat que se está viendo

        $sql = "SELECT ug.id_group, ug.id_user, c.crea_date, c.name, c.tipo
              FROM user_group ug
              JOIN user u ON ug.id_user = u.id_user
              JOIN chats c ON ug.id_group = c.id_chat
              WHERE ug.id_user = ? AND c.tipo = 2";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id_user); // 3 veces el mismo ID
        $stmt->execute();
        $resultado = $stmt->get_result();
        $stmt->close();

        if ($row = $resultado->fetch_assoc()) {
          $group = $row['name'];
          $date = $row['crea_date']; 
        }
      ?>

      <div class="lista col-5 mx-2"> <!-- LISTA CHATS -->
          <ul class="list-group list-group-flush">
            <?php if ($resultado->num_rows > 0): ?>
              <div class="list-group-item rounded-4" onclick="location.href='grupos.php?id_group=<?php echo $row['id_group']; ?>'">

                <h3><strong><?php echo htmlspecialchars($group); ?></strong></h3>
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
                    <?php if($id_group > 0): ?>
                        
                      <img id="maestriaHader" src="Imagenes/LOGROS/carta.png" class="rounded-circle">
                      <label><?php echo htmlspecialchars($group); ?></label>
                    <?php else: ?>
                      <div class="no-chats">

                        <p>Selecciona un chat</p>
                      </div>
                    <?php endif; ?>
                  </div>
                  <div class="h-right">
                      <a id="opciones-usuario" class="btn chat-privado"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff"><path d="M222-200 80-342l56-56 85 85 170-170 56 57-225 226Zm0-320L80-662l56-56 85 85 170-170 56 57-225 226Zm298 240v-80h360v80H520Zm0-320v-80h360v80H520Z"/></svg></a>
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
                $stmt->bind_param("i", $id_group);
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
              <form id="formTarea" class="mb-3" method="POST" action="PHP/crear_tarea.php">
                <label class="form-label">Nueva Tarea</label>
                <input id="inputTarea" name="contenido" class="form-control" type="text" placeholder="Escribe una tarea..." required>

                <!-- Campos ocultos necesarios -->
                <input type="hidden" name="id_group" value="<?php echo $id_chat; ?>">
                <input type="hidden" name="id_creator" value="<?php echo $_SESSION['id_user']; ?>">

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
            <input type="hidden" name="id_chat" value="<?php echo $id_group; ?>">

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