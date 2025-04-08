<?php
session_start();
include('conexion.php');

$id_user = intval($_SESSION['id_user']);
$id_chat = 1; // El chat fijo que estás pidiendo

// Consulta para traer mensajes del chat 1, ordenados por fecha ascendente
$sql = "SELECT id_sender, content, sndng_date 
        FROM messages 
        WHERE id_chat = ? 
        ORDER BY sndng_date ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_chat);
$stmt->execute();
$resultado = $stmt->get_result();

?>

<div id="chat-contenido">
<?php
if ($resultado && $resultado->num_rows > 0):
    while ($mensaje = $resultado->fetch_assoc()):
        $esMio = ($mensaje['id_sender'] == $id_user); // Comparamos el id del remitente con el id del usuario logueado

        // Aplicamos diferentes clases para que se alineen a la izquierda o derecha
        $claseMensaje = $esMio ? 'mensaje-derecha' : 'mensaje-izquierda';
?>
    <div class="mensaje <?php echo $claseMensaje; ?>">
        <div class="contenido-mensaje">
            <p><?php echo htmlspecialchars($mensaje['content']); ?></p>
            <span class="hora"><?php echo htmlspecialchars(date('H:i', strtotime($mensaje['sndng_date']))); ?></span>
        </div>
    </div>
<?php
    endwhile;
else:
?>
    <p class="sin-mensajes">No hay mensajes en este chat.</p>
<?php
endif;

// Cerramos todo
$stmt->close();
$conn->close();
?>
</div>
