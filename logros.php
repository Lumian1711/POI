<?php
session_start();
include('PHP/conexion.php');

$id_user = $_SESSION['id_user'] ?? 0;  // Cambia según cómo guardes el ID
if ($id_user <= 0) {
    // No está logueado o no tienes ID, redirigir o mostrar mensaje
    header("Location: login.php");
    exit();
}

$sql = "SELECT 
            l1.id_logro AS id,
            l1.nombre AS nombre,
            l1.descripcion AS descripcion,
            l1.imagen_ruta AS imagen_ruta,
            l2.nombre AS nombre_avanzado,
            l2.descripcion AS descripcion_avanzada,
            l2.imagen_ruta AS imagen_avanzada_ruta,
            lu.id_logro AS tiene_logro
        FROM logros l1
        LEFT JOIN logros l2 ON l2.logro_padre = l1.id_logro AND l2.es_avanzado = 1
        LEFT JOIN logros_usuario lu ON lu.id_logro = l1.id_logro AND lu.id_user = ?
        WHERE l1.es_avanzado = 0";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_user);
$stmt->execute();
$consulta = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/logros.css">
    <link rel="stylesheet" href="CSS/nav.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100&icon_names=favorite,home,search,settings" rel="stylesheet" />    
    <link rel="icon" href="Imagenes/LOGO/Color-ico.ico" type="image/x-icon">
    <style>
      .modal-content{
        background-color: var(--cafe);
      }
      .modalInfo{
        display: flex;
      }
      .logro{
        width: 50%;
        background-color: var(--azul);
        border-radius: 10px;
        border: solid 5px var(--marron);
        padding: 10px;
        color: aliceblue;
      }
      .info-logro.pendiente {
  opacity: 0.5;
  filter: grayscale(80%);
  cursor: default;
}

.info-logro.desbloqueado {
  border: 3px solid var(--celeste);
  cursor: pointer;
  transition: transform 0.2s;
}

.info-logro.desbloqueado:hover {
  transform: scale(1.05);
}

    </style>
    <title>Logros</title>
</head>
<body>

    <?php include('nav_bar.php'); ?>

    <!--MAIN-->
    <main>
      <div class="main-contenedor logros">
        <?php while ($logro = $consulta->fetch_assoc()): 
    $desbloqueado = $logro['tiene_logro'] ? true : false;
?>
<div class="info-logro <?= $desbloqueado ? 'desbloqueado' : 'pendiente' ?>"
     data-nombre="<?= htmlspecialchars($logro['nombre']) ?>"
     data-img="<?= htmlspecialchars($logro['imagen_ruta']) ?>"
     data-img-av="<?= htmlspecialchars($logro['imagen_avanzada_ruta']) ?>"
     data-desc="<?= htmlspecialchars($logro['descripcion']) ?>"
     data-desc-av="<?= htmlspecialchars($logro['descripcion_avanzada']) ?>">
  <img src="<?= htmlspecialchars($logro['imagen_ruta']) ?>" alt="">
  <div class="nombre-descripcion">
    <h3 class="nombre"><?= htmlspecialchars($logro['nombre']) ?></h3>
    <?php if ($desbloqueado): ?>
      <p style="color:white; font-weight:bold;">Desbloqueado</p>
    <?php else: ?>
      <p style="color:#ccc;">Pendiente</p>
    <?php endif; ?>
  </div>
</div>
<?php endwhile; ?>


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
    </div>
    </main>
    <!-- Modal -->
     <div class="modal fade" id="modalLogro" tabindex="-1" aria-labelledby="modalLogroLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLogroLabel">Información del Logro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="row text-center modalInfo">
          <div class=" logro">
            <h3>Logro</h3>
            <img id="imgLogro" src="" class="img-fluid " style="max-height: 250px;">
            <h5 id="descLogro"></h5>
          </div>
          <div class=" logro">
            <h3>Logro Avanzado</h3>
            <img id="imgLogroAv" src="" class="img-fluid " style="max-height: 250px;">
            <h5 id="descLogroAv"></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
<script src="JS/navbar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="JS/jquery-3.7.1.min.js"></script>
<script>
  document.querySelectorAll('.info-logro').forEach(function(el) {
    el.addEventListener('click', function() {
      document.getElementById('modalLogroLabel').textContent = el.dataset.nombre;
      document.getElementById('imgLogro').src = el.dataset.img;
      document.getElementById('descLogro').textContent = el.dataset.desc;

      document.getElementById('imgLogroAv').src = el.dataset.imgAv;
      document.getElementById('descLogroAv').textContent = el.dataset.descAv;

      new bootstrap.Modal(document.getElementById('modalLogro')).show();
    });
  });
</script>
</html>