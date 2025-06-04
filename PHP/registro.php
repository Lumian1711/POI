<?php
include ('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['txtUsuario'];
    $correo = $_POST['txtCorreo'];
    $password = $_POST['txtPassword'];

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (name, mail, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $usuario, $correo, $passwordHash);

    if ($stmt->execute()) {
        $id_usuario = $conn->insert_id;

        // Buscar ID del logro "Carta"
        $sqlLogro = "SELECT id_logro FROM logros WHERE nombre = 'Carta' AND es_avanzado = 0 LIMIT 1";
        $resLogro = $conn->query($sqlLogro);

        if ($resLogro && $resLogro->num_rows > 0) {
            $rowLogro = $resLogro->fetch_assoc();
            $id_logro = $rowLogro['id_logro'];

            // Insertar en logros_usuario
            $sqlInsertLogro = "INSERT INTO logros_usuario (id_user, id_logro) VALUES (?, ?)";
            $stmtLogro = $conn->prepare($sqlInsertLogro);
            $stmtLogro->bind_param("ii", $id_usuario, $id_logro);
            $stmtLogro->execute();
            $stmtLogro->close();
        }

        header("Location: ../chats.php");
        exit();
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
