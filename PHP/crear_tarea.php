<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contenido = trim($_POST['contenido']);
    $id_group = isset($_POST['id_group']) ? intval($_POST['id_group']) : 0;
    $id_creator = isset($_POST['id_creator']) ? intval($_POST['id_creator']) : 0;
    $status = 'pendiente';

    if ($id_group <= 0 || $id_creator <= 0 || empty($contenido)) {
        echo "❌ Datos inválidos.";
        exit();
    }

    // Verifica que el grupo (chat) exista
    $verif = $conn->prepare("SELECT id_chat FROM chats WHERE id_chat = ?");
    $verif->bind_param("i", $id_group);
    $verif->execute();
    $verif->store_result();

    if ($verif->num_rows === 0) {
        echo "❌ Grupo no encontrado.";
        $verif->close();
        exit();
    }
    $verif->close();

    // Inserta la tarea
    $sql = "INSERT INTO tasks (id_group, id_creator, content, stat) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiss', $id_group, $id_creator, $contenido, $status);

    if ($stmt->execute()) {
        header("Location: ../grupos.php?id_group=$id_group");
        exit();
    } else {
        echo "❌ Error en DB: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
