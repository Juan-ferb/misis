<?php
session_start(); // Inicia la sesión

// Configuración de la conexión a la base de datos
$host = 'localhost';
$dbname = 'citas_db';
$user = 'root';
$password = '';

// Crear la conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consultar las citas en la base de datos
$sql = "SELECT id, nombre, email, profesional, fecha_hora FROM citas";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institución Educativa Carlos Pérez Mejía - Citas Docente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="dashboard_docente.php">
            <img src="../images/logo.png" width="30" height="30" alt="">
            EDUCA
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard_docente.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calificacion_docente.php">Calificaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="citas_docente.php">Citas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reportes.php">Reportes</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="otrosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Otros
                    </a>
                    <div class="dropdown-menu" aria-labelledby="otrosDropdown">
                        <a class="dropdown-item" href="contacto.php">Contacto</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Citas con Padres de Familia</h1>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Profesional</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['profesional']; ?></td>
                            <td><?php echo $row['fecha_hora']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info text-center">No hay citas programadas.</div>
        <?php endif; ?>

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
