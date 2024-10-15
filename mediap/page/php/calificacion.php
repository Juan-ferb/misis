<?php
session_start(); // Inicia la sesión

// Verificar que el usuario esté conectado
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php"); // Redirige al login si no está conectado
    exit();
}

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_calificaciones"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el nombre del estudiante de la sesión
$nombre_estudiante = $_SESSION['user_name'];

// Consulta para obtener las calificaciones del estudiante
$sql = "SELECT * FROM calificaciones WHERE nombre_estudiante = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre_estudiante);
$stmt->execute();
$result = $stmt->get_result();

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificaciones - <?php echo $nombre_estudiante; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="dashboard_estudiante.php">Institución Educativa Carlos Pérez Mejía</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="dashboard_estudiante.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="citas_estudiante.php">Citas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="reportes_estudiante.php">Reportes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">Calificaciones de <?php echo $nombre_estudiante; ?></h2>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Materia</th>
                        <th>Procedimental (35%)</th>
                        <th>Actitudinal (35%)</th>
                        <th>Prueba de Período (20%)</th>
                        <th>Autoevaluación (10%)</th>
                        <th>Promedio Final</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['materia']; ?></td>
                            <td><?php echo $row['procedimental']; ?></td>
                            <td><?php echo $row['actitudinal']; ?></td>
                            <td><?php echo $row['prueba_periodo']; ?></td>
                            <td><?php echo $row['autoevaluacion']; ?></td>
                            <td>
                                <?php 
                                    // Calcular el promedio final
                                    $promedio = ($row['procedimental'] * 0.35) + ($row['actitudinal'] * 0.35) + ($row['prueba_periodo'] * 0.2) + ($row['autoevaluacion'] * 0.1);
                                    echo number_format($promedio, 2);
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning">No tienes calificaciones registradas.</div>
        <?php endif; ?>

        <a href="dashboard_estudiante.php" class="btn btn-secondary">Volver al Dashboard</a>
    </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>