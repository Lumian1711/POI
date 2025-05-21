<?php session_start(); ?>
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
    <title>Logros</title>
</head>
<body>

    <?php include('PHP/conexion.php'); ?>
    <?php include('nav_bar.php'); ?>

    <!--MAIN-->
    <main>
      <div class="main-contenedor">
        <h2>MAESTRIAS</h2>
        <div class="logros">
          <div class="info-logro" onclick="window.location.href='infoLogro.html'">
            <img src="Imagenes/LOGROS/carta.png" alt="">
            <div class="nombre-descripcion">
              <h3 class="nombre">Carta</h3>
            </div>
          </div>
          <div class="info-logro">
            <img src="Imagenes/LOGROS/logro-des.png" alt="">
            <div class="nombre-descripcion">
              <h3 class="nombre">Pergamino</h3>
            </div>
          </div>
          <div class="info-logro">
            <img src="Imagenes/LOGROS/logro-des.png" alt="">
            <div class="nombre-descripcion">
              <h3 class="nombre">Códice</h3>
            </div>
          </div>
          <div class="info-logro">
            <img src="Imagenes/LOGROS/logro-des.png" alt="">
            <div class="nombre-descripcion">
              <h3 class="nombre">Manuscrito</h3>
            </div>
          </div>
          <div class="info-logro">
            <img src="Imagenes/LOGROS/logro-des.png" alt="">
            <div class="nombre-descripcion">
              <h3 class="nombre">Libro</h3>
            </div>
          </div>
          <div class="info-logro">
            <img src="Imagenes/LOGROS/logro-des.png" alt="">
            <div class="nombre-descripcion">
              <h3 class="nombre">Saga</h3>
            </div>
          </div>
          <div class="info-logro">
            <img src="Imagenes/LOGROS/logro-des.png" alt="">
            <div class="nombre-descripcion">
              <h3 class="nombre">Enciclopedia</h3>
            </div>
          </div>
          <div class="info-logro">
            <img src="Imagenes/LOGROS/logro-des.png" alt="">
            <div class="nombre-descripcion">
              <h3 class="nombre">Biblioteca</h3>
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