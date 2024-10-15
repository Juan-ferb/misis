<?php
session_start(); // Inicia la sesión

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "institucion_db"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname   );

// Verificar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta para obtener los reportes
$sql = "SELECT * FROM reportes ORDER BY fecha DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Estudiantes - Directivas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
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

        <!-- Formulario para agregar nuevo reporte -->
        <form method="POST" class="mb-4">
            <div class="form-group">
                <label for="nombre_estudiante">Nombre del Estudiante</label>
                <input type="text" class="form-control" id="nombre_estudiante" name="nombre_estudiante" required>
            </div>
            <div class="form-group">
                <label for="reporte">Reporte</label>
                <textarea class="form-control" id="reporte" name="reporte" rows="3" required></textarea>
            </div>
            <button type="submit" name="agregar" class="btn btn-primary">Agregar Reporte</button>
        </form>

                    <?php
                    if ($result->num_rows > 0) {
                        // Mostrar los reportes
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['nombre_estudiante'] . "</td>";
                            echo "<td>" . $row['grado'] . "</td>";
                            echo "<td>" . $row['materia'] . "</td>";
                            echo "<td>" . $row['fecha'] . "</td>";
                            echo "<td>" . $row['descripcion'] . "</td>";
                            echo "<td><a href='detalles_reporte.php?id=" . $row['id'] . "' class='btn btn-info btn-sm'>Ver Detalles</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No hay reportes disponibles</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="dashboard_directiva.php" class="btn btn-secondary">Volver al Dashboard</a>
    </div>

    <!-- Bootstrap and FontAwesome scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
?>
