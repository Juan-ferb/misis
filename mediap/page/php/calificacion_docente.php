<?php
session_start(); // Inicia la sesión

// Configuración de la conexión a la base de datos
$host = 'localhost';
$dbname = 'sistema_calificaciones';
$user = 'root';
$password = '';

// Crear la conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Si el formulario es enviado, procesar los datos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_estudiante = $_POST['nombre_estudiante'];
    $grado = $_POST['grado'];
    $materia = $_POST['materia'];
    $procedimental = $_POST['procedimental'];
    $actitudinal = $_POST['actitudinal'];
    $prueba_periodo = $_POST['prueba_periodo'];
    $autoevaluacion = $_POST['autoevaluacion'];

    // Calcular la nota final
    $nota_final = ($procedimental * 0.35) + ($actitudinal * 0.35) + ($prueba_periodo * 0.20) + ($autoevaluacion * 0.10);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO calificaciones (nombre_estudiante, grado, materia, procedimental, actitudinal, prueba_periodo, autoevaluacion, nota_final)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssidddd", $nombre_estudiante, $grado, $materia, $procedimental, $actitudinal, $prueba_periodo, $autoevaluacion, $nota_final);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>¡Calificación registrada exitosamente!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error al registrar la calificación: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institución Educativa Carlos Pérez Mejía - Calificaciones Docente</title>
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
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Registro de Calificaciones</h1>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <form action="calificacion_docente.php" method="POST">
                    <div class="form-group">
                        <label for="nombreEstudiante">Nombre Completo del Estudiante</label>
                        <input type="text" class="form-control" id="nombreEstudiante" name="nombre_estudiante" placeholder="Ingresa el nombre completo del estudiante" required>
                    </div>
                    <div class="form-group">
                        <label for="grado">Grado</label>
                        <input type="text" class="form-control" id="grado" name="grado" placeholder="Ingresa el grado del estudiante" required>
                    </div>
                    <div class="form-group">
                        <label for="materia">Materia</label>
                        <select class="form-control" id="materia" name="materia" required>
                            <option value="Matemáticas">Matemáticas</option>
                            <option value="Ciencias">Ciencias</option>
                            <option value="Historia">Historia</option>
                            <option value="Lengua">Lengua</option>
                            <option value="Arte">Arte</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="procedimental">Nota Procedimental (35%)</label>
                        <input type="number" class="form-control" id="procedimental" name="procedimental" min="0" max="100" step="0.01" placeholder="Ingresa la nota procedimental" required>
                    </div>
                    <div class="form-group">
                        <label for="actitudinal">Nota Actitudinal (35%)</label>
                        <input type="number" class="form-control" id="actitudinal" name="actitudinal" min="0" max="100" step="0.01" placeholder="Ingresa la nota actitudinal" required>
                    </div>
                    <div class="form-group">
                        <label for="pruebaPeriodo">Prueba del Período (20%)</label>
                        <input type="number" class="form-control" id="pruebaPeriodo" name="prueba_periodo" min="0" max="100" step="0.01" placeholder="Ingresa la nota de la prueba" required>
                    </div>
                    <div class="form-group">
                        <label for="autoevaluacion">Autoevaluación (10%)</label>
                        <input type="number" class="form-control" id="autoevaluacion" name="autoevaluacion" min="0" max="100" step="0.01" placeholder="Ingresa la autoevaluación del estudiante" required>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block">Registrar Calificación</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
