<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividades</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/actividad.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">   
        <a class="navbar-brand" href="dashboard_estudiante.php">
            <img src="../images/logo.png" width="30" height="30" alt="">
            EDUCA
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="actividades.php">Actividades</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="calificacion.php">Calificaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="citas.php">Citas</a>
                </li>
                <li class="nav-item dropdown"></li>
                    <a class="nav-link dropdown-toggle" href="#" id="otrosDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Otros
                    </a>
                    <div class="dropdown-menu" aria-labelledby="otrosDropdown">
                        <a class="dropdown-item" href="contacto.php">Contacto</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container text-center mt-5 pt-5">
        <h2 class="animated-title">Actividades</h2>
        <div class="my-4">
            <div class="malla-curricular">
                MALLA CURRICULAR
            </div>
        </div>
        <p class="info-text">Acá podrás encontrar información sobre los temas a tratar en los periodos escolares</p>
        <br>
        <div class="row my-4">
            <!-- Periodo I -->
            <div class="col-md-4">
                <div class="card period-card d-flex flex-column align-items-center">
                    <h5>Periodo I</h5>
                    <button class="btn btn-danger btn-periodo" data-toggle="collapse" data-target="#periodo1">MÁS</button>
                    <div id="periodo1" class="collapse">
                        <div class="d-flex flex-column">
                            <a href="../html/español1.html" class="materias-button">Español</a>
                            <a href="../html/ingles1.html" class="materias-button">Inglés</a>
                            <a href="../html/matematicas1.html" class="materias-button">Matemáticas</a>
                            <a href="../html/fisica1.html" class="materias-button">Física</a>
                            <a href="../html/quimica1.html" class="materias-button">Química</a>
                            <a href="../html/sociales1.html" class="materias-button">Sociales</a>
                            <a href="../html/filosofia1.html" class="materias-button">Filosofía</a>
                            <a href="../html/tecnologia1.html" class="materias-button">Tecnología</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Periodo II -->
            <div class="col-md-4">
                <div class="card period-card d-flex flex-column align-items-center">
                    <h5>Periodo II</h5>
                    <button class="btn btn-danger btn-periodo" data-toggle="collapse" data-target="#periodo2">MÁS</button>
                    <div id="periodo2" class="collapse">
                        <div class="d-flex flex-column">
                            <a href="../html/español2.html" class="materias-button">Español</a>
                            <a href="../html/ingles2.html" class="materias-button">Inglés</a>
                            <a href="../html/matematicas2.html" class="materias-button">Matemáticas</a>
                            <a href="../html/fisica2.html" class="materias-button">Física</a>
                            <a href="../html/quimica2.html" class="materias-button">Química</a>
                            <a href="../html/sociales2.html" class="materias-button">Sociales</a>
                            <a href="../html/filosofia2.html" class="materias-button">Filosofía</a>
                            <a href="../html/tecnologia2.html" class="materias-button">Tecnología</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Periodo III -->
            <div class="col-md-4">
                <div class="card period-card d-flex flex-column align-items-center">
                    <h5>Periodo III</h5>
                    <button class="btn btn-danger btn-periodo" data-toggle="collapse" data-target="#periodo3">MÁS</button>
                    <div id="periodo3" class="collapse">
                        <div class="d-flex flex-column">
                            <a href="../html/español3.html" class="materias-button">Español</a>
                            <a href="../html/ingles3.html" class="materias-button">Inglés</a>
                            <a href="../html/matematicas3.html" class="materias-button">Matemáticas</a>
                            <a href="../html/fisica3.html" class="materias-button">Física</a>
                            <a href="../html/quimica3.html" class="materias-button">Química</a>
                            <a href="../html/sociales3.html" class="materias-button">Sociales</a>
                            <a href="../html/filosofia3.html" class="materias-button">Filosofía</a>
                            <a href="..//html/tecnologia3.html" class="materias-button">Tecnología</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/periodos.js"></script>
</body>
</html>