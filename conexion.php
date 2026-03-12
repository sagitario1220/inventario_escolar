<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "Inventario";

// Creamos la conexión
$conexion = mysqli_connect($host, $user, $pass, $db);

// Comprobamos si funciona
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
} 
// echo "¡Conexión exitosa! El puente está listo."; 
?>