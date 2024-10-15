<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Institución Educativa Carlos Pérez Mejía</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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
            <li class="nav-item">
                <a class="nav-link" href="actividades.php">Actividades</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="calificacion.php">Calificaciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="citas.php">Citas</a>
            </li>
            <li class="nav-item dropdown">
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

    <!-- Contact Section -->
    <section id="contacto" class="contacto">
        <div class="container">
            <h2>Contacto</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a enim nec nisl ullamcorper eleifend. Praesent risus leo, fringilla et nulla at, egestas euismod orci.</p>
            <p>Utiliza las siguientes vías de contacto, o rellena el formulario.</p>
            <div class="row">
                <div class="col-md-6">
                    <p>Vía E-mail</p>
                    <a href="mailto:hola@unsitiogenial.es" class="contact-link">iecarlosperezmejia@gmsil.com</a>
                    <p>En nuestras redes sociales</p>
                    <a href="#" class="contact-link">@CPM</a>
                    <p>Por teléfono</p>
                    <a href="tel:911234567" class="contact-link">91-1234-567</a>
                </div>
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <label for="nombre">Escribe tu nombre</label>
                            <input type="text" class="form-control" id="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Escribe tu e-mail</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Escribe tu teléfono (Opcional)</label>
                            <input type="text" class="form-control" id="telefono">
                        </div>
                        <div class="form-group">
                            <label for="mensaje">Escribe tu mensaje</label>
                            <textarea class="form-control" id="mensaje" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger">Enviar Mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <br>
<!-- Footer -->
<footer class="footer bg-danger text-white text-center">
    <div class="container py-2">
        <p>&copy; 2024 - Institución Educativa Carlos Pérez Mejía - <a href="#" class="text-white">Política de Privacidad</a></p>
        <div class="social-icons mt-2">
            <a href="https://facebook.com" target="_blank" class="text-white mx-2">
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

<!-- FontAwesome for social media icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>