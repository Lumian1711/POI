<?php
    session_start(); 
    require('conexion.php');

    $query="UPDATE user SET conn_stat = 0 WHERE id_user = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $_SESSION['id_user']);
    $stmt->execute();

    session_unset();  // 2. Limpia todas las variables de sesión
    session_destroy();  // 3. Destruye la sesión por completo
    header("Location: ../login.php");
    exit();
?>