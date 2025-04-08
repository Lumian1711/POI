<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $sender = $_SESSION['id_user'];
    $content = $_POST['mensajeInput'];
    $id_chat = 1;
    $id_group = NULL; 
    $mssg_type = 'text';
    $coded = 1;

    $sql = "INSERT INTO messages (id_chat, id_group, id_sender, content, mssg_type, sndng_date, coded) 
            VALUES (?, ?, ?, ?, ?, NOW(), ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error al preparar la consulta: ' . $conn->error);
    }

    // b: integer (id_chat)
    // i: integer (id_group) -> puede ser null
    // i: integer (id_sender)
    // s: string (content)
    // s: string (mssg_type)
    // i: integer (coded)
    $stmt->bind_param("iiissi", $id_chat, $id_group, $sender, $content, $mssg_type, $coded);

    if ($stmt->execute()) {
        header("Location: ../chats.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar conexión
    $stmt->close();
    $conn->close();
}
?>
