<?php
include 'php/database.php';

// Consultar solo sugerencias
$query = $pdo->query("SELECT usuarios.username, quejas_sugerencias.mensaje, quejas_sugerencias.fecha 
                      FROM quejas_sugerencias 
                      JOIN usuarios ON quejas_sugerencias.usuario_id = usuarios.id 
                      WHERE quejas_sugerencias.tipo = 'sugerencia' 
                      ORDER BY quejas_sugerencias.fecha DESC");
$suggestions = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sugerencias Públicas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Sugerencias de Usuarios</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Sugerencia</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($suggestions as $suggestion): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($suggestion['username']); ?></td>
                        <td><?php echo htmlspecialchars($suggestion['mensaje']); ?></td>
                        <td><?php echo htmlspecialchars($suggestion['fecha']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>