<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $code = $_POST["code"];

    $sql = "INSERT INTO registro (nombre, email, pass, rol, code) VALUE ('$nombre', '$email', '$password', '$role', '$code')";

    if (mysqli_query($conn, $sql)) {
        echo "Usuario resgistrado correctamente. ";
    } else {
        echo "Error: ". $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn)
?>