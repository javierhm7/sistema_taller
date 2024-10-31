<?php
session_start();
include 'database.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.html");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$mensaje = $_POST['mensaje'];
$tipo = $_POST['tipo']; // Obtener el tipo de mensaje

// Insertar el mensaje en la base de datos
$query = $pdo->prepare("INSERT INTO quejas_sugerencias (usuario_id, mensaje, tipo) VALUES (:usuario_id, :mensaje, :tipo)");
$query->bindParam(":usuario_id", $usuario_id);
$query->bindParam(":mensaje", $mensaje);
$query->bindParam(":tipo", $tipo);
$query->execute();

header("Location: ../complaints.html");
exit();
?>