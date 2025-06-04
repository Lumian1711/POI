<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $tipo = $_POST['tipoChat']; 
    $nombre = $_POST['txtUsuario']; 
    $id_user = intval($_SESSION['id_user']); 

    
    $tipo_chat = ($tipo === 'privado') ? 1 : 2;

    // 3. Insertar en tabla chats
    $sql = "INSERT INTO chats (name, tipo, crea_date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error al preparar consulta: " . $conn->error);
    }

    $stmt->bind_param('si', $nombre, $tipo_chat);

    if ($stmt->execute()) {
        $id_chat = $stmt->insert_id; // ID del chat recién creado
        $stmt->close();

        // 4. Insertar al usuario actual en user_group
        $sql2 = "INSERT INTO user_group (id_user, id_group, join_date) VALUES (?, ?, NOW())";
        $stmt2 = $conn->prepare($sql2);
        if (!$stmt2) {
            die("Error al preparar segunda consulta: " . $conn->error);
        }

        $stmt2->bind_param('ii', $id_user, $id_chat);

        if ($stmt2->execute()) {
            echo "✅ Chat creado exitosamente y el usuario fue agregado al grupo.";
            // Aquí puedes redirigir, por ejemplo:
            header("Location: chats.php?id_chat=$id_chat");
        } else {
            echo "❌ Error al insertar en user_group: " . $stmt2->error;
        }

        $stmt2->close();
    } else {
        echo "❌ Error al crear el chat: " . $stmt->error;
        $stmt->close();
    }

    $conn->close();
}
?>
