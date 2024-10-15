<?php
// Iniciar la sesión para poder guardar el estado del usuario
session_start();

// Configurar la conexión a la base de datos
$servername = "localhost";  // Cambia esto si tu servidor tiene otro nombre
$username = "root";         // Cambia si tu usuario es diferente
$password = "";             // Contraseña de tu base de datos
$dbname = "institucion_carlos_perez_mejia"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Inicializar mensajes de error y éxito
$error = "";
$success = "";

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validar que los campos no estén vacíos
    if (empty($email) || empty($password) || empty($role)) {
        $error = "Por favor, complete todos los campos.";
    } else {
        // Buscar el usuario en la base de datos
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ? AND role = ?");
        $stmt->bind_param("ss", $email, $role);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // El usuario existe, ahora verificar la contraseña
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                // Contraseña correcta, iniciar la sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['user_name'] = $user['nombre'];
                
                $success = "Inicio de sesión exitoso. Redirigiendo...";

                // Verifica el rol del usuario y cambia la redirección según el rol
                if ($role == 'administrador') {
                    $redirectUrl = 'dashboard_admin.php'; // Redirección para admin
                } elseif ($role == 'docente') {
                    $redirectUrl = 'dashboard_docente.php'; // Redirección para profesor
                } elseif ($role == 'estudiante') { // Asegúrate de que el rol se verifique en minúsculas
                    $redirectUrl = 'dashboard_estudiante.php'; // Redirección para estudiante
                } elseif ($role == 'directiva') { // Asegúrate de que el rol se verifique en minúsculas
                    $redirectUrl = 'dashboard_directiva.php'; // Redirección para directiva
                } else {
                    // Si no tiene un rol válido, redirige a la página de error o inicio
                    $redirectUrl = 'error.php';
                }

                // Mostrar el mensaje y redirigir usando JavaScript
                echo "<script>
                        alert('$success'); // Mostrar el mensaje de éxito
                        setTimeout(function(){
                            window.location.href = '$redirectUrl';
                        }, 2000); // Redirige después de 2 segundos
                      </script>";

            } else {
                // Contraseña incorrecta
                $error = "La contraseña es incorrecta.";
                echo "<script>
                        alert('$error'); // Mostrar el mensaje de error
                        setTimeout(function(){
                            window.location.href = 'login.php';
                        }, 2000); // Redirige después de 2 segundos
                      </script>";
            }
        } else {
            // Si el correo o el rol no existen
            $error = "El usuario con ese rol no existe.";
            echo "<script>
                    alert('$error'); // Mostrar el mensaje de error
                    setTimeout(function(){
                        window.location.href = 'login.php';
                    }, 2000); // Redirige después de 2 segundos
                  </script>";
        }
        // Cerrar la sentencia preparada
        $stmt->close();
    }
}
// Cerrar la conexión a la base de datos
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Institución Educativa Carlos Pérez Mejía</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="../index.php">
                <img src="../images/logo.png" width="30" height="30" alt="">
                EDUCA
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger text-white" href="../php/registro.php">Registrarse</a>
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
                            <h4>Iniciar Sesión</h4>
                        </div>
                        <div class="card-body">
                            <!-- Mostrar mensaje de error o éxito -->
                            <?php if (!empty($error)): ?>
                                <div class="alert alert-danger">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($success)): ?>
                                <div class="alert alert-success">
                                    <?php echo $success; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Formulario de inicio de sesión -->
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="role">Seleccione su rol</label>
                                    <select id="role" name="role" class="form-control" required>
                                        <option value="">Seleccione su rol</option>
                                        <option value="estudiante">Estudiante</option>
                                        <option value="docente">Docente</option>
                                        <option value="administrador">Administrador</option>
                                        <option value="directiva">Directiva</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-danger btn-block">Ingresar</button>
                            </form>
                            <div class="text-center mt-3">
                                <a href="../php/registro.php" class="text-danger">¿No tienes una cuenta? Regístrate</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>