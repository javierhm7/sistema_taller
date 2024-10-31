<?php
$host = 'localhost';
$db = 'taller_automotriz';
$user = 'root';
$pass = '';  // Cambia la contraseña si es necesario

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>