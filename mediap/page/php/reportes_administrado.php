<?php
session_start(); // Inicia la sesión

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "institucion_carlos_perez_mejia"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Manejo de la eliminación de reporte
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM reportes WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Reporte eliminado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al eliminar reporte: " . $conn->error . "');</script>";
    }
}

// Manejo de la creación de reporte
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_report'])) {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

    $sql = "INSERT INTO reportes (titulo, contenido) VALUES ('$titulo', '$contenido')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Reporte agregado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al agregar reporte: " . $conn->error . "');</script>";
    }
}

// Consulta para obtener la lista de reportes
$sql = "SELECT * FROM reportes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Institucionales</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Reportes Institucionales</h2>

        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <a class="navbar-brand" href="dashboard_administrador.php">
                <img src="../images/logo.png" width="30" height="30" alt="Logo">
                EDUCA
            </a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="gestion_usuarios.php">Gestión de Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reportes_administrador.php">Reportes Institucionales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="configuraciones.php">Configuraciones</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Formulario para agregar nuevo reporte -->
        <form action="reportes_administrador.php" method="POST" class="mb-4">
            <h4>Agregar Nuevo Reporte</h4>
            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="contenido">Contenido</label>
                <textarea class="form-control" id="contenido" name="contenido" rows="3" required></textarea>
            </div>
            <button type="submit" name="add_report" class="btn btn-primary">Agregar Reporte</button>
        </form>

        <!-- Tabla de reportes -->
        <h4>Lista de Reportes</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Contenido</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['titulo']}</td>
                            <td>{$row['contenido']}</td>
                            <td>
                                <a href='reportes_administrador.php?delete={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este reporte?\");'>Eliminar</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No hay reportes registrados.</td></tr>";
                }
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
