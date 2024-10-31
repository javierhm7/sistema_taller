<?php
session_start();
include 'php/database.php';

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.html");
    exit();
}

// Filtrar los comentarios por tipo
$filtro = isset($_GET['filtro']) ? $_GET['filtro'] : 'todos';
$sql = "SELECT quejas_sugerencias.id, usuarios.username, quejas_sugerencias.mensaje, quejas_sugerencias.tipo, quejas_sugerencias.fecha
        FROM quejas_sugerencias
        JOIN usuarios ON quejas_sugerencias.usuario_id = usuarios.id";

if ($filtro == 'quejas') {
    $sql .= " WHERE quejas_sugerencias.tipo = 'queja'";
} elseif ($filtro == 'sugerencias') {
    $sql .= " WHERE quejas_sugerencias.tipo = 'sugerencia'";
}

$sql .= " ORDER BY quejas_sugerencias.fecha DESC";
$query = $pdo->query($sql);
$comments = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Comentarios de Usuarios</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Comentarios de Usuarios</h2>

        <!-- Filtros de tipo de comentario -->
        <form method="GET" action="view_comments.php" class="mb-3">
            <label for="filtro">Filtrar por tipo:</label>
            <select name="filtro" id="filtro" onchange="this.form.submit()">
                <option value="todos" <?= $filtro == 'todos' ? 'selected' : '' ?>>Todos</option>
                <option value="quejas" <?= $filtro == 'quejas' ? 'selected' : '' ?>>Quejas</option>
                <option value="sugerencias" <?= $filtro == 'sugerencias' ? 'selected' : '' ?>>Sugerencias</option>
            </select>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Comentario</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($comment['id']); ?></td>
                        <td><?php echo htmlspecialchars($comment['username']); ?></td>
                        <td><?php echo htmlspecialchars($comment['mensaje']); ?></td>
                        <td><?php echo htmlspecialchars($comment['tipo']); ?></td>
                        <td><?php echo htmlspecialchars($comment['fecha']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>