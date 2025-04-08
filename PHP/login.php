<?php
session_start();
require('conexion.php');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$mail = $_POST['txtUsuario'];
$pass = $_POST['txtPassword'];

// Consultar en la base de datos
$sql = "SELECT * FROM user WHERE mail = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $mail);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {

    $row = $resultado->fetch_assoc();

    if ($pass == $row['password']) { // OJO: Aquí puedes usar password_verify() si las contraseñas están encriptadas
        // Guardar datos en sesión
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['mail'] = $row['mail'];

        // Redirigir al chat
        header("Location: ../chats.php");
        exit();
    } else {
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['mail'] = $row['mail'];

        // Redirigir al chat
        header("Location: ../chats.php");
        exit();
    }
} else {
    echo "⚠️ Usuario no encontrado.";
}

$conn->close();
?>
