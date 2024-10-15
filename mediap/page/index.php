<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EDUCA - Bienvenido</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> <!-- Bootstrap para estilos -->
    <style>
        body {
            background-color: #f8f9fa; /* Color de fondo claro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
        }
        .logo-container {
            width: 150px;
            height: 150px;
            background-color: white; /* Círculo blanco */
            border-radius: 50%; /* Hace que sea un círculo */
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 30px auto; /* Centra el logo horizontalmente */
        }
        .logo {
            max-width: 80%;
            max-height: 80%;
        }
        h1 {
            color: #343a40; /* Color del título */
            margin-bottom: 40px;
        }
        .btn-custom {
            width: 150px;
            margin: 10px;
            background-color: #dc3545; /* Color personalizado para los botones */
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #c82333; /* Color más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Logo dentro de un círculo blanco centrado -->
        <div class="logo-container">
            <img src="images/logo.png" alt="Logo de EDUCA" class="logo">
        </div>

        <!-- Título de la página -->
        <h1>Bienvenido a EDUCA</h1>

        <!-- Botones de navegación -->
        <div>
            <a href="php/login.php" class="btn btn-custom">Iniciar Sesión</a>
            <a href="php/registro.php" class="btn btn-custom">Registrarse</a>
        </div>
    </div>

</body>
</html>