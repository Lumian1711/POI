<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contenido = trim($_POST['contenido'] ?? '');
    $id_group = intval($_POST['id_group'] ?? 0);
    $id_creator = intval($_POST['id_user'] ?? 0);
    $status = 'pendiente';

    if ($id_group <= 0 || $id_creator <= 0 || empty($contenido)) {
        echo "❌ Datos inválidos.";
        exit();
    }

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

    // **Antes de insertar, contar cuántas tareas tiene ya creadas este usuario**
    $sqlCount = "SELECT COUNT(*) FROM tasks WHERE id_creator = ?";
    $stmtCount = $conn->prepare($sqlCount);
    $stmtCount->bind_param("i", $id_creator);
    $stmtCount->execute();
    $stmtCount->bind_result($total_tareas_antes);
    $stmtCount->fetch();
    $stmtCount->close();

    $sql = "INSERT INTO tasks (id_group, id_creator, content, stat) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "❌ Error preparando la consulta: " . $conn->error;
        exit();
    }

    $stmt->bind_param('iiss', $id_group, $id_creator, $contenido, $status);

    if ($stmt->execute()) {
        // Si antes no tenía tareas, esta es la primera, otorgar logro 10
        if ($total_tareas_antes == 0) {
            $conn->query("INSERT IGNORE INTO logros_usuario (id_user, id_logro, fecha_otorgado) VALUES ($id_creator, 10, NOW())");
        }

        header("Location: ../grupos.php?id_group=$id_group");
        exit();
    } else {
        echo "❌ Error al guardar la tarea: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método no permitido.";
}
