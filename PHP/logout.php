<?php
    session_start(); 
    session_unset();  // 2. Limpia todas las variables de sesión
    session_destroy();  // 3. Destruye la sesión por completo
    header("Location: ../login.php");
    exit();
?>