<?php
session_start(); // Inicia la sesión

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "institucion_db"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener la información de la institución
$sql = "SELECT * FROM informacion_institucional LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener los datos actuales
    $row = $result->fetch_assoc();
    $nombre_institucion = $row['nombre_institucion'];
    $direccion = $row['direccion'];
    $telefono = $row['telefono'];
    $mision = $row['mision'];
    $vision = $row['vision'];
} else {
    $nombre_institucion = $direccion = $telefono = $mision = $vision = "";
}

// Actualizar la información cuando el formulario es enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_institucion = $_POST['nombre_institucion'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $mision = $_POST['mision'];
    $vision = $_POST['vision'];

    // Actualizar la información en la base de datos
    $sql = "UPDATE informacion_institucional SET 
            nombre_institucion='$nombre_institucion', 
            direccion='$direccion', 
            telefono='$telefono', 
            mision='$mision', 
            vision='$vision'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Información actualizada correctamente.');</script>";
    } else {
        echo "<script>alert('Error al actualizar la información: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Institucional</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Gestión Institucional</h2>
        
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <a class="navbar-brand" href="dashboard_directiva.php">
                <img src="../images/logo.png" width="30" height="30" alt="Logo">
                EDUCA
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="gestion_institucional.php">Gestión Institucional</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="estrategias.php">Estrategias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reportes_directiva.php">Reportes</a>
                    </li>
                </ul>
            </div>
        </nav>

        <form action="gestion_institucional.php" method="POST">
            <div class="form-group">
                <label for="nombre_institucion">Nombre de la Institución</label>
                <input type="text" class="form-control" id="nombre_institucion" name="nombre_institucion" value="<?php echo $nombre_institucion; ?>" required>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required>
            </div>
            <div class="form-group">
                <label for="mision">Misión</label>
                <textarea class="form-control" id="mision" name="mision" rows="3" required><?php echo $mision; ?></textarea>
            </div>
            <div class="form-group">
                <label for="vision">Visión</label>
                <textarea class="form-control" id="vision" name="vision" rows="3" required><?php echo $vision; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Información</button>
        </form>
        <br>
        <a href="dashboard_directiva.php" class="btn btn-secondary">Volver al Dashboard</a>
    </div>

    <!-- Bootstrap and FontAwesome scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
