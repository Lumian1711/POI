<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_task = intval($_POST['id_task']);
    $id_group = intval($_POST['id_group']);
    $id_user = $_SESSION['id_user'] ?? 0;

    if ($id_task > 0) {
        $sql = "UPDATE tasks SET stat = 'completada' WHERE id_task = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_task);
        $stmt->execute();
        $stmt->close();

        // Obtener creador de la tarea y grupo
        $sqlInfo = "SELECT id_creator, id_group FROM tasks WHERE id_task = ?";
        $stmt = $conn->prepare($sqlInfo);
        $stmt->bind_param("i", $id_task);
        $stmt->execute();
        $stmt->bind_result($id_creator, $grupo_tarea);
        $stmt->fetch();
        $stmt->close();

        // Logro 11: completar tarea creada por uno mismo
        if ($id_user == $id_creator) {
            $sql = "SELECT COUNT(*) FROM tasks WHERE id_creator = ? AND stat = 'completada'";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_user);
            $stmt->execute();
            $stmt->bind_result($completadas_propias);
            $stmt->fetch();
            $stmt->close();

            if ($completadas_propias >= 1) {
                $conn->query("INSERT IGNORE INTO logros_usuario (id_user, id_logro, fecha_otorgado) VALUES ($id_user, 11, NOW())");
            }
        }

        // Logro 12: completar tareas en al menos 2 grupos distintos
        $sql = "SELECT COUNT(DISTINCT id_group) FROM tasks WHERE stat = 'completada' AND id_creator = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $stmt->bind_result($grupos_distintos);
        $stmt->fetch();
        $stmt->close();

        if ($grupos_distintos >= 2) {
            $conn->query("INSERT IGNORE INTO logros_usuario (id_user, id_logro, fecha_otorgado) VALUES ($id_user, 12, NOW())");
        }
    }

    header("Location: ../grupos.php?id_group=$id_group");
    exit();
}
