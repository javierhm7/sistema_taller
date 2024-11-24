<?php
session_start();
include 'database.php';

// Verificar si el usuario ha iniciado sesión y si es administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

try {
    // Obtener las quejas
    $queryQuejas = $pdo->query("SELECT id, nombre, correo, mensaje, fecha FROM quejas_sugerencias WHERE tipo = 'Queja' ORDER BY fecha DESC");
    $quejas = $queryQuejas->fetchAll(PDO::FETCH_ASSOC);

    // Obtener las sugerencias
    $querySugerencias = $pdo->query("SELECT id, nombre, correo, mensaje, fecha FROM quejas_sugerencias WHERE tipo = 'Sugerencia' ORDER BY fecha DESC");
    $sugerencias = $querySugerencias->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener los datos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Quejas y Sugerencias</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Panel de Administración</h2>
        <h4 class="text-center mb-4">Quejas y Sugerencias</h4>

        <!-- Tabla de Quejas -->
        <h5 class="mt-4">Quejas</h5>
        <?php if (count($quejas) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Mensaje</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($quejas as $queja): ?>
                            <tr>
                                <td><?= htmlspecialchars($queja['id']) ?></td>
                                <td><?= htmlspecialchars($queja['nombre']) ?></td>
                                <td><?= htmlspecialchars($queja['correo']) ?></td>
                                <td><?= htmlspecialchars($queja['mensaje']) ?></td>
                                <td><?= htmlspecialchars($queja['fecha']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No hay quejas registradas.</p>
        <?php endif; ?>

        <!-- Tabla de Sugerencias -->
        <h5 class="mt-4">Sugerencias</h5>
        <?php if (count($sugerencias) > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Mensaje</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($sugerencias as $sugerencia): ?>
                            <tr>
                                <td><?= htmlspecialchars($sugerencia['id']) ?></td>
                                <td><?= htmlspecialchars($sugerencia['nombre']) ?></td>
                                <td><?= htmlspecialchars($sugerencia['correo']) ?></td>
                                <td><?= htmlspecialchars($sugerencia['mensaje']) ?></td>
                                <td><?= htmlspecialchars($sugerencia['fecha']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No hay sugerencias registradas.</p>
        <?php endif; ?>

        <!-- Botón para regresar al menú principal -->
        <div class="text-center mt-4">
            <a href="exportar.php" class="btn btn-secondary">Descargar en Excel</a>
            <a href="logout.php" class="btn btn-primary">Cerrar Sesión</a>
        </div>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
