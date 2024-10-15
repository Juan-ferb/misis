<?php
session_start(); // Inicia la sesión

// Configuración de la conexión a la base de datos
$host = 'localhost';
$dbname = 'reportes_db';
$user = 'root';
$password = '';

// Crear la conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_estudiante = $_POST['nombre_estudiante'];
    $grado = $_POST['grado'];
    $materia = $_POST['materia'];
    $tipo_reporte = $_POST['tipo_reporte'];
    $detalle = $_POST['detalle'];
    $fecha = date('Y-m-d'); // Captura la fecha actual

    // Insertar el reporte en la base de datos
    $sql = "INSERT INTO reportes (nombre_estudiante, grado, materia, tipo_reporte, detalle, fecha) 
            VALUES ('$nombre_estudiante', '$grado', '$materia', '$tipo_reporte', '$detalle', '$fecha')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Reporte guardado correctamente.</div>";
    } else {
        echo "<div class='alert alert-danger'>Error al guardar el reporte: " . $conn->error . "</div>";
    }
}

// Consultar los reportes de la base de datos
$sql = "SELECT id, nombre_estudiante, grado, materia, tipo_reporte, detalle, fecha FROM reportes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institución Educativa Carlos Pérez Mejía - Reportes Docente</title>
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
        <h1 class="text-center mb-4">Reportes de Estudiantes</h1>

        <!-- Formulario para agregar un reporte -->
        <form method="POST" action="reportes.php" class="mb-4">
            <div class="form-group">
                <label for="nombre_estudiante">Nombre del Estudiante:</label>
                <input type="text" class="form-control" id="nombre_estudiante" name="nombre_estudiante" required>
            </div>
            <div class="form-group">
                <label for="grado">Grado:</label>
                <input type="text" class="form-control" id="grado" name="grado" required>
            </div>
            <div class="form-group">
                <label for="materia">Materia:</label>
                <input type="text" class="form-control" id="materia" name="materia" required>
            </div>
            <div class="form-group">
                <label for="tipo_reporte">Tipo de Reporte:</label>
                <select class="form-control" id="tipo_reporte" name="tipo_reporte" required>
                    <option value="Nota">Nota</option>
                    <option value="Queja">Queja</option>
                    <option value="Reseña">Reseña</option>
                    <option value="Observación">Observación</option>
                </select>
            </div>
            <div class="form-group">
                <label for="detalle">Detalle:</label>
                <textarea class="form-control" id="detalle" name="detalle" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Reporte</button>
        </form>

        <!-- Mostrar los reportes almacenados -->
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre Estudiante</th>
                        <th>Grado</th>
                        <th>Materia</th>
                        <th>Tipo de Reporte</th>
                        <th>Detalle</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nombre_estudiante']; ?></td>
                            <td><?php echo $row['grado']; ?></td>
                            <td><?php echo $row['materia']; ?></td>
                            <td><?php echo $row['tipo_reporte']; ?></td>
                            <td><?php echo $row['detalle']; ?></td>
                            <td><?php echo $row['fecha']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info text-center">No hay reportes disponibles.</div>
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
