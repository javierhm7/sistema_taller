<?php
session_start();
include 'database.php';

// Obtener los datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Verificar el usuario en la base de datos
$query = $pdo->prepare("SELECT id, password FROM usuarios WHERE username = :username");
$query->bindParam(":username", $username);
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    // Iniciar sesión y redirigir al administrador
    $_SESSION['usuario_id'] = $user['id'];
    header("Location: ../view_comments.php");
} else {
    // Redirigir a la página de inicio con un mensaje de error
    header("Location: ../index.html?error=1");
}
exit();
?>