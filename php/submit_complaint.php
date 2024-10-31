<?php
session_start();
include('database.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.html");
    exit();
}

$mensaje = $_POST['message'];
$usuario_id = $_SESSION['usuario_id'];

$query = $pdo->prepare("INSERT INTO quejas_sugerencias (usuario_id, mensaje) VALUES (:usuario_id, :mensaje)");
$query->bindParam("usuario_id", $usuario_id, PDO::PARAM_INT);
$query->bindParam("mensaje", $mensaje, PDO::PARAM_STR);

if ($query->execute()) {
    header("Location: ../complaints.html");
} else {
    echo "Error al enviar";
}
?>