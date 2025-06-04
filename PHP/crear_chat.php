<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipoChat'];
    $usuario1 = trim($_POST['txtUsuario']);
    $usuario2 = isset($_POST['txtUsuario2']) ? trim($_POST['txtUsuario2']) : null;
    $txtnombre = ($tipo === 'grupal' && isset($_POST['txtnombre'])) ? trim($_POST['txtnombre']) : null;
    $id_user_sesion = $_SESSION['id_user'];

    $tipo_formato = ucfirst(strtolower($tipo));
    if (empty($usuario1)) {
        die("❌ Usuario principal no válido.");
    }

    $usuarios = [$usuario1];
    if ($usuario2) {
        $usuarios[] = $usuario2;
    }

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

    foreach ($usuarios as $nombre) {
        if (!isset($ids[$nombre])) {
            die("❌ No se encontró al usuario: $nombre");
        }
    }

    $nombre_chat = ($tipo === 'grupal') ? $txtnombre : "$usuario1 y tú";

    // Crear chat
    $sql = "INSERT INTO chats (name, Tipo, crea_date, id_creador) VALUES (?, ?, NOW(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $nombre_chat, $tipo_formato, $id_user_sesion);
    $stmt->execute();
    $id_chat_creado = $stmt->insert_id;

    // Insertar creador y demás usuarios
    $sql = "INSERT INTO user_group (id_user, id_group, join_date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param('ii', $id_user_sesion, $id_chat_creado);
    $stmt->execute();

    foreach ($usuarios as $nombre) {
        $id_user = $ids[$nombre];
        if ($id_user != $id_user_sesion) {
            $stmt->bind_param('ii', $id_user, $id_chat_creado);
            $stmt->execute();
        }
    }
    // VERIFICACIÓN DE LOGROS
$sql = "SELECT COUNT(*) AS total FROM chats 
        WHERE Tipo = 'Privado' AND id_creador = ?";
$stmtLogros = $conn->prepare($sql);
$stmtLogros->bind_param('i', $id_user_sesion);
$stmtLogros->execute();
$stmtLogros->bind_result($total_chats);
$stmtLogros->fetch();
$stmtLogros->close();


// Logros
// Primer chat privado creado
if ($total_chats == 1) {
    $conn->query("INSERT IGNORE INTO logros_usuario (id_user, id_logro, fecha_otorgado) VALUES ($id_user_sesion, 2, NOW())");
}
if ($total_chats == 3) {
    $conn->query("INSERT IGNORE INTO logros_usuario (id_user, id_logro, fecha_otorgado) VALUES ($id_user_sesion, 3, NOW())");
}

if (strtolower($tipo) === 'grupal') {
    $conn->query("INSERT IGNORE INTO logros_usuario (id_user, id_logro, fecha_otorgado) VALUES ($id_user_sesion, 9, NOW())");
}

$conn->close();


    if ($tipo === 'grupal') {
        header("Location: ../grupos.php?id_group=$id_chat_creado");
    } else {
        header("Location: ../chats.php?id_chat=$id_chat_creado");
    }
    exit();
}
?>
