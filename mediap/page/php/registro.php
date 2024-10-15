<?php
// Conexión a la base de datos
$host = 'localhost'; // Servidor de MySQL
$dbname = 'institucion_carlos_perez_mejia'; // Nombre de la base de datos
$username = 'root'; // Usuario de MySQL
$password = ''; // Contraseña de MySQL

try {
    // Establecer conexión usando PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Verificar si se envió el formulario por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
    $role = $_POST['role'];
    $code = $_POST['code'] ?? null;

    // Verificar si el rol seleccionado requiere un código
    if (in_array($role, ['docente', 'administrador', 'directiva']) && empty($code)) {
        echo "<script>alert('Error: El código es obligatorio para el rol seleccionado.'); window.location.href='registro.php';</script>";
        exit();
    }

    // Verificar si el usuario ya existe
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Error: El usuario ya existe.'); window.location.href='registro.php';</script>";
    } else {
        // Insertar el nuevo usuario
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password, role, code) VALUES (:nombre, :email, :password, :role, :code)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':code', $code);

        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso.'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error al registrar. Inténtalo de nuevo.'); window.location.href='registro.php';</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Institución Educativa Carlos Pérez Mejía</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">
                <img src="../images/logo.png" width="30" height="30" alt="">
                EDUCA
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <div class="dropdown-menu" aria-labelledby="otrosDropdown">
                            <a class="dropdown-item" href="../html/contacto.html">Contacto</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="../php/login.php">Iniciar Sesión</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Main Content -->
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-danger text-white text-center">
                            <h4>Registro</h4>
                        </div>
                        <div class="card-body">
                        <form id="userForm" method="POST" action="registro.php">
    <div class="form-group">
        <label for="nombre">Nombre Completo</label>
        <input type="text" id="nombre" name="nombre" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="confirm_password">Confirmar Contraseña</label>
        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="role">Rol</label>
        <select class="form-control" id="role" name="role" required>
            <option value="" disabled selected>Selecciona tu rol</option>
            <option value="estudiante">Estudiante</option>
            <option value="docente">Docente</option>
            <option value="administrador">Administrador</option>
            <option value="directiva">Directiva</option>
            <option value="otro">Otro</option>
        </select>
    </div>
    <div class="form-group d-none" id="code-group">
        <label for="code">Código</label>
        <input type="text" class="form-control" id="code" name="code">
    </div>
    <button type="submit" class="btn btn-danger btn-block">Registrarse</button>
</form>
                            <div class="text-center mt-3">
                                <a href="inicio.php" class="text-danger">¿Ya tienes una cuenta? Inicia Sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br>
        <!-- Footer -->
        <footer class="footer bg-danger text-white text-center mt-auto">
            <div class="container py-2">
                <p>&copy; 2024 - Institución Educativa Carlos Pérez Mejía - <a href="#" class="text-white">Política de Privacidad</a></p>
                <div class="social-icons mt-2">
                    <a href="http://facebook.com/iecarlosperezmejia/" target="_blank" class="text-white mx-2">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com" target="_blank" class="text-white mx-2">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="text-white mx-2">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </footer>
    </div>

    <!-- FontAwesome for social media icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/registro.js"></script>
</body>
</html>
