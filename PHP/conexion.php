<?php
    // Datos de conexión
    $servername = "localhost";
    $username = "root";
    $password = "";     
    $database = "poi_bd_pv";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
?>
