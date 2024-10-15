<?php
session_start(); // Iniciar sesión

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "institucion_db"; // Cambia por tu base de datos correspondiente

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Agregar nueva estrategia
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar'])) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];

    $sql = "INSERT INTO estrategias (titulo, descripcion) VALUES ('$titulo', '$descripcion')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Estrategia agregada exitosamente!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Consulta para obtener todas las estrategias
$sql = "SELECT id, titulo, descripcion FROM estrategias";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Estrategias</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Gestión de Estrategias Educativas</h2>
        
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
                        <a class="nav-link" href="reportes_directiva.php">Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="estrategia.php">Estrategias</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Formulario para agregar nueva estrategia -->
        <form method="POST" class="mb-4">
            <div class="form-group">
                <label for="titulo">Título de la Estrategia</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>
            <button type="submit" name="agregar" class="btn btn-primary">Agregar Estrategia</button>
        </form>

        <!-- Tabla para mostrar estrategias -->
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Mostrar los datos de cada fila
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["titulo"] . "</td>
                                <td>" . $row["descripcion"] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>No hay estrategias disponibles</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
