<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = intval($_POST['id_user']);
    $id_chat = intval($_POST['id_chat']);
    $mensaje = trim($_POST['mensajeInput']);

    if (!empty($mensaje)) {
        $sql = "INSERT INTO messages (id_chat, id_sender, content, mssg_type, sndng_date, coded) 
                VALUES (?, ?, ?, 'text', NOW(), 1)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $id_chat, $id_user, $mensaje);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_FILES['archivoAdjunto']) && $_FILES['archivoAdjunto']['error'] === UPLOAD_ERR_OK) {
        $nombreOriginal = $_FILES['archivoAdjunto']['name'];
        $archivoTmp = $_FILES['archivoAdjunto']['tmp_name'];
        $rutaDestino = 'uploads/' . basename($nombreOriginal);

        if (!file_exists('uploads')) {
            mkdir('uploads', 0755, true);
        }

        if (move_uploaded_file($archivoTmp, $rutaDestino)) {
            $sql = "INSERT INTO messages (id_chat, id_sender, content, mssg_type, sndng_date, coded) 
                    VALUES (?, ?, ?, 'file', NOW(), 1)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iis", $id_chat, $id_user, $rutaDestino);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "❌ Error al subir el archivo.";
        }
    }

    // Aquí verificamos si el usuario tiene mensajes en al menos 3 chats distintos para otorgar el logro 4
    $sqlChats = "SELECT COUNT(DISTINCT id_chat) FROM messages WHERE id_sender = ?";
    $stmtChats = $conn->prepare($sqlChats);
    $stmtChats->bind_param("i", $id_user);
    $stmtChats->execute();
    $stmtChats->bind_result($cantidadChats);
    $stmtChats->fetch();
    $stmtChats->close();

    if ($cantidadChats >= 3) {
        // Insertar logro 4 si no existe (usar INSERT IGNORE para evitar duplicados)
        $conn->query("INSERT IGNORE INTO logros_usuario (id_user, id_logro, fecha_otorgado) VALUES ($id_user, 4, NOW())");
    }

    $conn->close();

    echo "<script>
    window.location = document.referrer;
    </script>";
    exit();
}
?>
