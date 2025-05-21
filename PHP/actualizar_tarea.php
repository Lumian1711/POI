<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_task = intval($_POST['id_task']);
    $status = isset($_POST['completada']) ? 'completada' : 'pendiente';

    if ($id_task <= 0) {
        echo "❌ ID de tarea inválido.";
        exit();
    }

    $sql = "UPDATE tasks SET stat = ? WHERE id_task = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $status, $id_task);

    if ($stmt->execute()) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "❌ Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
