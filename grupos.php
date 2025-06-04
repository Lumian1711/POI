<?php session_start(); ?>
<?php include('PHP/conexion.php'); ?>

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

<main> 
  <div class="lista-chat d-flex">

    <!-- LISTA DE GRUPOS -->
    <?php
      $id_user = intval($_SESSION['id_user']);
      $id_group = isset($_GET['id_group']) ? intval($_GET['id_group']) : 0;

      $sql = "SELECT ug.id_group, c.name, c.crea_date
              FROM user_group ug
              JOIN chats c ON ug.id_group = c.id_chat
              WHERE ug.id_user = ? AND c.tipo = 2";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param('i', $id_user);
      $stmt->execute();
      $resultado = $stmt->get_result();
    ?>

    <div class="lista col-5 mx-2">
      <ul class="list-group list-group-flush">
        <?php if ($resultado->num_rows > 0): ?>
          <?php while ($row = $resultado->fetch_assoc()): ?>
            <li class="list-group-item rounded-4 mb-2" style="cursor:pointer;" onclick="location.href='grupos.php?id_group=<?php echo $row['id_group']; ?>'">
              <h5 class="mb-1"><?php echo htmlspecialchars($row['name']); ?></h5>
              <small>Creado el: <?php echo htmlspecialchars(date('d/m/Y', strtotime($row['crea_date']))); ?></small>
            </li>
          <?php endwhile; ?>
        <?php else: ?>
          <li class="list-group-item">No hay chats grupales. Crea uno para comenzar.</li>
        <?php endif; ?>
      </ul>
    </div>

    <!-- CHAT Y TAREAS -->
    <div class="chat col-7" id="contenedorChat">
      <?php
        $groupName = '';
        if ($id_group > 0) {
          $stmtNombre = $conn->prepare("SELECT name FROM chats WHERE id_chat = ?");
          $stmtNombre->bind_param("i", $id_group);
          $stmtNombre->execute();
          $stmtNombre->bind_result($groupName);
          $stmtNombre->fetch();
          $stmtNombre->close();
        }
      ?>

      <div class="chat-header">
        <div class="chat-header-user">
          <div class="h-left">
            <?php if($id_group > 0): ?>
              <img id="maestriaHader" src="Imagenes/LOGROS/carta.png" class="rounded-circle">
              <label><?php echo htmlspecialchars($groupName); ?></label>
            <?php else: ?>
              <p>Selecciona un chat</p>
            <?php endif; ?>
          </div>
          <div class="h-right">
            <a id="opciones-usuario" class="btn chat-privado">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fff"><path d="M222-200 80-342l56-56 85 85 170-170 56 57-225 226Zm0-320L80-662l56-56 85 85 170-170 56 57-225 226Zm298 240v-80h360v80H520Zm0-320v-80h360v80H520Z"/></svg>
            </a>
          </div>
        </div>
      </div>

      <div class="chat-messages overflow-auto" id="contenidoChat">
        <div id="chat-contenido">
          <?php
            if ($id_group > 0) {
              $sql = "SELECT id_sender, content, sndng_date 
                      FROM messages 
                      WHERE id_chat = ? 
                      ORDER BY sndng_date ASC";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("i", $id_group);
              $stmt->execute();
              $resultado = $stmt->get_result();

              if ($resultado->num_rows > 0):
                while ($mensaje = $resultado->fetch_assoc()):
                  $esMio = ($mensaje['id_sender'] != $id_user);
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
                echo '<p class="sin-mensajes">No hay mensajes en este chat.</p>';
              endif;
              $stmt->close();
            }
          ?>
        </div>

        <!-- TAREAS -->
        <?php if ($id_group > 0): ?>
        <div id="tareas-contenido" class="d-none">
          <form id="formTarea" class="mb-3" method="POST" action="PHP/crear_tarea.php">
            <label class="form-label">Nueva Tarea</label>
            <input id="inputTarea" name="contenido" class="form-control" type="text" placeholder="Escribe una tarea..." required>
            <input type="hidden" name="id_group" value="<?php echo $id_group; ?>">
            <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
            <button type="submit" class="btn mt-2">Agregar</button>
          </form>

          <div class="tareas-lista">
  <h4>Tareas</h4>
  <ul id="listaTareas" class="list-group">
    <?php
    $sqlTareas = "SELECT id_task, content, stat FROM tasks WHERE id_group = ? AND stat != 'completada'";
    $stmtTareas = $conn->prepare($sqlTareas);
    $stmtTareas->bind_param("i", $id_group);
    $stmtTareas->execute();
    $resultadoTareas = $stmtTareas->get_result();

    if ($resultadoTareas->num_rows > 0):
      while ($tarea = $resultadoTareas->fetch_assoc()):
    ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <input type="checkbox" class="form-check-input me-2" disabled>
            <label><?php echo htmlspecialchars($tarea['content']); ?></label>
            <span class="badge bg-warning text-dark ms-2"><?php echo ucfirst($tarea['stat']); ?></span>
          </div>
          <form method="POST" action="PHP/completar_tarea.php" style="margin: 0;">
            <input type="hidden" name="id_task" value="<?php echo $tarea['id_task']; ?>">
            <input type="hidden" name="id_group" value="<?php echo $id_group; ?>">
            <button type="submit" class="btn btn-success btn-sm">Completar</button>
          </form>
        </li>
    <?php
      endwhile;
    else:
      echo '<li class="list-group-item">No hay tareas pendientes.</li>';
    endif;
    $stmtTareas->close();
    ?>
  </ul>
</div>
        <?php endif; ?>
      </div>

      <!-- FORM DE ENVIAR MENSAJES -->
      <?php if ($id_group > 0): ?>
      <form method="POST" action="PHP/send_message.php" class="chat-input" enctype="multipart/form-data">
        <label for="archivoAdjunto" class="btn">📎</label>
        <input type="file" name="archivoAdjunto" id="archivoAdjunto" style="display: none;">
        <input type="text" placeholder="Escribe tu mensaje..." id="mensajeInput" name="mensajeInput" required>
        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
        <input type="hidden" name="id_chat" value="<?php echo $id_group; ?>">
        <button type="submit" id="btnEnviar" class="btn" value="Enviar">Enviar</button>
      </form>
      <?php endif; ?>
    </div>
  </div>
</main>
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
                  <a href="PHP/logout.php" class="btn">Cerrar Sesión</a>
              </div>
          </div>
      </div>
    </div>
<!-- SCRIPTS -->
<script src="JS/tareas.js"></script>
<script src="JS/navbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="JS/jquery-3.7.1.min.js"></script>
<script>
  function cargarMensajes() {
    $.ajax({
      url: 'cargar_mensajes.php?id_group=<?php echo $id_group; ?>',
      method: 'GET',
      success: function(respuesta) {
        $('#chat-contenido').html(respuesta);
      },
      error: function() {
        console.error('Error al cargar los mensajes.');
      }
    });
  }

  setInterval(cargarMensajes, 3000);
  cargarMensajes();

  window.onload = function () {
    const contenedor = document.getElementById('contenidoChat');
    contenedor.scrollTop = contenedor.scrollHeight;
  };
</script>
</body>
</html>
