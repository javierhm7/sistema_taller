<?php
session_start();
include('database.php');

// Verifica si se recibieron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            // Consulta de verificación
            $query = $pdo->prepare("SELECT * FROM admin WHERE username = :username");
            $query->bindParam(":username", $username, PDO::PARAM_STR);
            $query->execute();

            $user = $query->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['rol'] = 'admin';  // Asignar el rol a la sesión
                header("Location: comments.php");  // Redirigir al dashboard o página de comentarios
                exit();
            } else {
                // Si las credenciales son incorrectas, mostramos el error
                $_SESSION['error'] = "Usuario o contraseña incorrectos";  // Guardamos el mensaje en la sesión
                header("Location: ../index.php");  // Redirigimos de vuelta a index.html
                exit();
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error en la base de datos: " . $e->getMessage();
            header("Location: ../index.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Por favor, completa todos los campos.";
        header("Location: ../index.php");
        exit();
    }
}


