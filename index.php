<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión Administrador</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 600px;
            margin-top: 100px;
        }

        .admin-login {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1>Inicio de Sesión de Administrador</h1>
        <form action="php/login.php" method="POST">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- Mostrar mensaje de error si existe -->
            <?php
            session_start();
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger" role="alert">';
                echo $_SESSION['error'];
                echo '</div>';
                unset($_SESSION['error']);  // Limpiamos el mensaje después de mostrarlo
            }
            ?>

            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>