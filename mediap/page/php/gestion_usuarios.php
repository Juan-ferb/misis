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

// Manejo de la eliminación de usuario
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM usuarios WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Usuario eliminado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al eliminar usuario: " . $conn->error . "');</script>";
    }
}

// Manejo de la creación de usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "INSERT INTO usuarios (nombre, email, role) VALUES ('$nombre', '$email', '$role')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Usuario agregado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al agregar usuario: " . $conn->error . "');</script>";
    }
}

// Manejo de la actualización de usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $id = $_POST['user_id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $sql = "UPDATE usuarios SET nombre='$nombre', email='$email', role='$role' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Usuario actualizado correctamente.');</script>";
    } else {
        echo "<script>alert('Error al actualizar usuario: " . $conn->error . "');</script>";
    }
}

// Consulta para obtener la lista de usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Gestión de Usuarios</h2>

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

        <!-- Formulario para agregar nuevo usuario -->
        <form action="gestion_usuarios.php" method="POST" class="mb-4">
            <h4>Agregar Nuevo Usuario</h4>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="role">Rol</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="Docente">Docente</option>
                    <option value="Administrativo">Administrativo</option>
                    <option value="Directiva">Directiva</option>
                </select>
            </div>
            <button type="submit" name="add_user" class="btn btn-primary">Agregar Usuario</button>
        </form>

        <!-- Tabla de usuarios -->
        <h4>Lista de Usuarios</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['role']}</td>
                            <td>
                                <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#updateModal{$row['id']}'>Modificar</button>
                                <a href='gestion_usuarios.php?delete={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este usuario?\");'>Eliminar</a>
                            </td>
                        </tr>";

                        // Modal para actualizar usuario
                        echo "
                        <div class='modal fade' id='updateModal{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title'>Modificar Usuario</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <form action='gestion_usuarios.php' method='POST'>
                                        <div class='modal-body'>
                                            <input type='hidden' name='user_id' value='{$row['id']}'>
                                            <div class='form-group'>
                                                <label for='nombre'>Nombre</label>
                                                <input type='text' class='form-control' name='nombre' value='{$row['nombre']}' required>
                                            </div>
                                            <div class='form-group'>
                                                <label for='email'>Email</label>
                                                <input type='email' class='form-control' name='email' value='{$row['email']}' required>
                                            </div>
                                            <div class='form-group'>
                                                <label for='role'>Rol</label>
                                                <select class='form-control' name='role' required>
                                                    <option value='Docente' " . ($row['role'] == 'Docente' ? 'selected' : '') . ">Docente</option>
                                                    <option value='Administrativo' " . ($row['role'] == 'Administrativo' ? 'selected' : '') . ">Administrativo</option>
                                                    <option value='Directiva' " . ($row['role'] == 'Directiva' ? 'selected' : '') . ">Directiva</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                                            <button type='submit' name='update_user' class='btn btn-primary'>Actualizar Usuario</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No hay usuarios registrados.</td></tr>";
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
