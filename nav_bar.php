<?php include('PHP/conexion.php'); 
if (!isset($_SESSION['id_user'])) {
    header('Location: login.php');
    exit();
}

$id_user = intval($_SESSION['id_user']); 

$sql_logro = "SELECT l.imagen_ruta 
              FROM logros_usuario lu
              INNER JOIN logros l ON lu.id_logro = l.id_logro
              WHERE lu.id_user = ?
              ORDER BY lu.fecha_otorgado DESC
              LIMIT 1";

$stmt_logro = $conn->prepare($sql_logro);
$stmt_logro->bind_param("i", $id_user);
$stmt_logro->execute();
$resultado_logro = $stmt_logro->get_result();

if ($row_logro = $resultado_logro->fetch_assoc()) {
    $ruta_logro = $row_logro['imagen_ruta'];
} else {
    $ruta_logro = 'Imagenes/LOGROS/LOGRO/carta.png';
}
$stmt_logro->close();
?>
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
          <a id="chats" href="chats.php?id_chat=0">

            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M320-320h480v-120H698q-21 37-58 58.5T560-360q-42 0-79-21.5T422-440H320v120Zm240-120q34 0 57-23.5t23-56.5h160v-280H320v280h160q0 33 23.5 56.5T560-440ZM320-240q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm160-240h480-480Z"/></svg>
            <span>Chats</span>
          </a>
        </li>
        <li>
          <a id="grupos" href="grupos.php?id_group=0">

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
        <?php
          // Consulta para traer los chats del usuario
          if (!isset($_SESSION['id_user'])) {

            header('Location: login.php');
            exit();
          }
          
          $id_user = intval($_SESSION['id_user']);

          $sql = "SELECT * FROM user WHERE id_user = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param('i', $id_user);
          $stmt->execute();
          $resultado = $stmt->get_result();
          $stmt->close();

          if ($row = $resultado->fetch_assoc()) {
            $name = $row['name'];
            $mail = $row['mail']; 
          } else {
            $name = "Error de conexión";
            $mail = "correo@ejemplo.com";
          }
        ?>

        <img src="<?php echo htmlspecialchars($ruta_logro); ?>" alt="Último logro">

        <div class="info-usuario">
          <div class="nombre-correo">

            <span class="nombre"><?php echo htmlspecialchars($name) ?></span>
            <span class="correo"><?php echo htmlspecialchars($mail) ?></span>
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
                  <form method="POST" action="PHP/crear_chat.php">
                    <div class="mb-3">
                      <label class="form-label">Tipo de chat</label>
                      <select class="form-control" name="tipoChat" id="tipoChat" required>
                        <option value="Privado">Privado</option>
                        <option value="grupal">Grupal</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Nombre de usuario</label>
                      <input id="txtUsuario" name="txtUsuario" class="form-control" type="text" required placeholder="Nombre de usuario">
                    </div>
                    <div id="extraUsuario"></div>
                    <button type="submit" class="btn btn-primary">Crear chat</button>
                  </form>
                </div>
                
                <!-- Lista de usuarios -->
                <div class="w-50 border-start ps-3" style="max-height: 300px; overflow-y: auto;">
                  <h6>Usuarios existentes</h6>
                  <ul class="list-group" id="listaUsuarios">
                    <?php 
                      $sql = "SELECT name FROM user ORDER BY name ASC";
                      $resultado = $conn->query($sql);

                      if ($resultado && $resultado->num_rows > 0) {
                          while ($row = $resultado->fetch_assoc()) {
                              echo "<li class='list-group-item list-group-item-action' style='cursor:pointer;' onclick=\"seleccionarUsuario('" . htmlspecialchars($row['name'], ENT_QUOTES) . "')\">" . htmlspecialchars($row['name']) . "</li>";

                          }
                      } else {
                          echo "<li class='list-group-item text-muted'>No hay usuarios registrados.</li>";
                      }
                    ?>
                  </ul>
                </div>
              </div>

              <!-- Botones -->
              <div class="modal-footer">
                  <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#modalAlert">Crear chat</button>
              </div>
          </div>
      </div>
    </div>
    