<?php
include 'database.php';

// Capturar los datos del formulario
$nombre = isset($_POST['nombre']) && !empty(trim($_POST['nombre'])) ? trim($_POST['nombre']) : 'Anónimo';
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : null;
$mensaje = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : null;
$tipo = isset($_POST['tipo']) ? trim($_POST['tipo']) : null;

// Validar que los campos obligatorios no estén vacíos
if (empty($mensaje) || empty($tipo)) {
    header("Location: ../error.html"); // Redirigir a una página de error si faltan datos
    exit();
}

try {
    // Insertar los datos en la tabla quejas_sugerencias
    $query = $pdo->prepare("
        INSERT INTO quejas_sugerencias (nombre, correo, mensaje, tipo) 
        VALUES (:nombre, :correo, :mensaje, :tipo)
    ");
    $query->bindParam(":nombre", $nombre);
    $query->bindParam(":correo", $correo);
    $query->bindParam(":mensaje", $mensaje);
    $query->bindParam(":tipo", $tipo);
    $query->execute();

    // Redirigir al usuario a una página de confirmación
    header("Location: ../complaints.html");
    exit();
} catch (PDOException $e) {
    // Manejar errores de la base de datos
    error_log("Error en la inserción de datos: " . $e->getMessage());
    header("Location: ../error.html");
    exit();
}
?>
