<?php
// Incluir archivo de conexión
include ('conexion.php'); // Asegúrate de que el archivo esté bien hecho

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $usuario = $_POST['txtUsuario'];
    $correo = $_POST['txtCorreo'];
    $password = $_POST['txtPassword'];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);  // Encriptar la contraseña (muy importante)

    $sql = "INSERT INTO user (name, mail, password) VALUES (?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $usuario, $correo, $passwordHash);

    if ($stmt->execute()) {
        echo "¡Registro exitoso!";
        header("Location: ../chats.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar conexión
    $stmt->close();
    $conn->close();
}
?>
