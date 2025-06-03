<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipoChat']; // "privado" o "grupal"
    $usuario1 = trim($_POST['txtUsuario']);
    $usuario2 = isset($_POST['txtUsuario2']) ? trim($_POST['txtUsuario2']) : null;
    $id_user_sesion = $_SESSION['id_user'];

    // Normaliza tipo (capitaliza la primera letra)
    $tipo_formato = ucfirst(strtolower($tipo));

    // Validación básica
    if (empty($usuario1)) {
        die("❌ Usuario principal no válido.");
    }

    // Buscar IDs de los usuarios por nombre
    $usuarios = [$usuario1];
    if ($usuario2) {
        $usuarios[] = $usuario2;
    }

    // Prepara placeholders para IN
    $placeholders = implode(',', array_fill(0, count($usuarios), '?'));
    $tipos = str_repeat('s', count($usuarios));

    $sql = "SELECT id_user, name FROM user WHERE name IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($tipos, ...$usuarios);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $ids = [];
    while ($row = $resultado->fetch_assoc()) {
        $ids[$row['name']] = $row['id_user'];
    }

    // Verifica que todos los usuarios fueron encontrados
    foreach ($usuarios as $nombre) {
        if (!isset($ids[$nombre])) {
            die("❌ No se encontró al usuario: $nombre");
        }
    }

    // Crear nombre de grupo dinámico
    $nombre_chat = ($tipo === 'grupal')
        ? implode(', ', array_merge([$usuario1], $usuario2 ? [$usuario2] : []))
        : "$usuario1 y tú";

    // Crear nuevo chat
    $sql = "INSERT INTO chats (name, Tipo, crea_date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $nombre_chat, $tipo_formato);
    $stmt->execute();
    $id_chat_creado = $stmt->insert_id;

    // Insertar en user_group
    $sql = "INSERT INTO user_group (id_user, id_group, join_date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    // Relacionar usuario en sesión
    $stmt->bind_param('ii', $id_user_sesion, $id_chat_creado);
    $stmt->execute();

    // Relacionar usuarios seleccionados
    foreach ($usuarios as $nombre) {
        $id_user = $ids[$nombre];

        // Evita insertar dos veces el mismo usuario (por si se selecciona a sí mismo)
        if ($id_user != $id_user_sesion) {
            $stmt->bind_param('ii', $id_user, $id_chat_creado);
            $stmt->execute();
        }
    }

    $stmt->close();
    $conn->close();

    // Redirige al chat creado
    if($tipo === 'grupal') {
        header("Location: ../grupos.php?id_group=$id_chat_creado");
        exit();
    } else {
        header("Location: ../chat.php?id_chat=$id_chat_creado");
        exit();
    }
}
?>
