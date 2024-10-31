<?php
session_start();
include('database.php');

$username = $_POST['username'];
$password = $_POST['password'];

$query = $pdo->prepare("SELECT * FROM usuarios WHERE username = :username");
$query->bindParam("username", $username, PDO::PARAM_STR);
$query->execute();
$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['usuario_id'] = $user['id'];
    header("Location: ../complaints.html");
} else {
    echo "Usuario o contraseña incorrectos";
}
?>