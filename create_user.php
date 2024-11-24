<?php
// Conexión a la base de datos
$host = 'localhost';
$db = 'taller_automotriz';
$user = 'root';  // Cambia 'root' por tu usuario si es necesario
$pass = '';      // Cambia por tu contraseña si es necesario

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Credenciales del nuevo usuario
    $username = 'admin';           // Nombre de usuario
    $password = 'admin123';        // Contraseña

    // Hash de la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Inserta el nuevo usuario en la base de datos
    $query = $pdo->prepare("INSERT INTO admin (username, password) VALUES (:username, :password)");
    $query->bindParam(":username", $username);
    $query->bindParam(":password", $hashedPassword);
    $query->execute();

    echo "Usuario creado correctamente. Ahora puedes iniciar sesión con las credenciales:";
    echo "<br>Usuario: " . $username;
    echo "<br>Contraseña: " . $password;
} catch (PDOException $e) {
    echo "Error en la conexión o en la creación del usuario: " . $e->getMessage();
}
?>