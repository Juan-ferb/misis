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

// Manejo de la actualización de configuración
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_settings'])) {
    // Obtener los datos del formulario
    $parametro = $_POST['parametro'];
    $valor = $_POST['valor'];

    // Actualizar la configuración en la base de datos
    $sql = "UPDATE configuraciones SET valor='$valor' WHERE parametro='$parametro'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Configuración actualizada correctamente.');</script>";
    } else {
        echo "<script>alert('Error al actualizar configuración: " . $conn->error . "');</script>";
    }
}

// Manejo de la actualización de la contraseña
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $nueva_contrasena = $_POST['nueva_contrasena'];

    // Actualizar la contraseña en la base de datos (asumiendo que hay un usuario admin)
    $sql = "UPDATE usuarios SET password='$nueva_contrasena' WHERE role='admin' LIMIT 1";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Contraseña cambiada correctamente.');</script>";
    } else {
        echo "<script>alert('Error al cambiar la contraseña: " . $conn->error . "');</script>";
    }
}

// Consulta para obtener la configuración
$sql = "SELECT * FROM configuraciones";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuraciones</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Configuraciones del Sistema</h2>

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
                        <a class="nav-link" href="reportes_administrador.php">Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="gestión_institucional.php">Gestión Institucional</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Formulario para actualizar configuración -->
        <h4>Actualizar Configuración</h4>
        <form action="configuraciones.php" method="POST" class="mb-4">
            <div class="form-group">
                <label for="parametro">Parámetro</label>
                <input type="text" class="form-control" id="parametro" name="parametro" required>
            </div>
            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="text" class="form-control" id="valor" name="valor" required>
            </div>
            <button type="submit" name="update_settings" class="btn btn-primary">Actualizar Configuración</button>
        </form>

        <!-- Formulario para cambiar la contraseña -->
        <h4>Cambiar Contraseña de Administrador</h4>
        <form action="configuraciones.php" method="POST">
            <div class="form-group">
                <label for="nueva_contrasena">Nueva Contraseña</label>
                <input type="password" class="form-control" id="nueva_contrasena" name="nueva_contrasena" required>
            </div>
            <button type="submit" name="change_password" class="btn btn-primary">Cambiar Contraseña</button>
        </form>

        <!-- Tabla de configuraciones -->
        <h4>Configuraciones Actuales</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Parámetro</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['parametro']}</td>
                            <td>{$row['valor']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' class='text-center'>No hay configuraciones registradas.</td></tr>";
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
