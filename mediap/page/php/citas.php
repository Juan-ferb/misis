<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "citas_db";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST["nombre"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $profesional = $conn->real_escape_string($_POST["professional"]);
    $fecha_hora = $conn->real_escape_string($_POST["appointment"]); // Recibe la fecha y hora seleccionada

    // Insertar la cita en la base de datos
    $sql = "INSERT INTO citas (nombre, email, profesional, fecha_hora) VALUES ('$nombre', '$email', '$profesional', '$fecha_hora')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cita agendada exitosamente.');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita - Institución Educativa Carlos Pérez Mejía</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="dashboard_estudiante.php">
                <img src="../images/logo.png" width="30" height="30" alt="">
                EDUCA
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="dashboard_estudiante.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="actividades.php">Actividades</a></li>
                    <li class="nav-item"><a class="nav-link" href="calificacion.php">Calificaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="citas.php">Citas</a></li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-danger text-white text-center">
                            <h4>Agendar Cita</h4>
                        </div>
                        <div class="card-body">
                            <form action="citas.php" method="POST">
                                <div class="form-group">
                                    <label for="nombre">Nombre Completo</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="professional">Profesional</label>
                                    <select class="form-control" id="professional" name="professional" required>
                                        <option value="" disabled selected>Selecciona el profesional</option>
                                        <option value="psicologo">Psicólogo</option>
                                        <option value="psicoorientador">Psicoorientador</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="appointment">Selecciona una Fecha y Hora</label>
                                    <input type="datetime-local" id="appointment" name="appointment" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-danger btn-block">Agendar Cita</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer bg-danger text-white text-center mt-auto">
            <div class="container py-2">
                <p>&copy; 2024 - Institución Educativa Carlos Pérez Mejía - <a href="#" class="text-white">Política de Privacidad</a></p>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
