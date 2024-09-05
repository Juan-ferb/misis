<?php
$server = "localhost";
$dbname = "cpm";
$user = "root";
$pass = "";
$port = 3306;

$conn = mysqli_connect($server, $user, $pass, $dbname, $port);

if(!$conn){
    echo("Error al conectarse");
}

?>