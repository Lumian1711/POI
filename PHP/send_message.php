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

    // 2. Enviar archivo (si se cargó uno)
    if (isset($_FILES['archivoAdjunto']) && $_FILES['archivoAdjunto']['error'] === UPLOAD_ERR_OK) {
        $nombreOriginal = $_FILES['archivoAdjunto']['name'];
        $archivoTmp = $_FILES['archivoAdjunto']['tmp_name'];
        $rutaDestino = 'uploads/' . basename($nombreOriginal);

        // Crear carpeta si no existe
        if (!file_exists('uploads')) {
            mkdir('uploads', 0755, true);
        }

        if (move_uploaded_file($archivoTmp, $rutaDestino)) {
            // Guardar el archivo como mensaje
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

    $conn->close();

    echo "<script>
    window.location = document.referrer;
    </script>";
    exit();

}
?>
