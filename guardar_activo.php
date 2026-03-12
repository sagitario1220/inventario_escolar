<?php
include 'conexion.php';

// Recogemos los datos del POST
$id_aula = $_POST['id_aula'];
$nombre  = $_POST['nombre'];
$marca   = $_POST['marca'];
$serie   = $_POST['serie'];
$estado  = $_POST['estado'];

// Insertar en la tabla activos
$sql = "INSERT INTO activos (nombre_equipo, marca, serie, estado, id_aula_fk) 
        VALUES ('$nombre', '$marca', '$serie', '$estado', '$id_aula')";

if(mysqli_query($conexion, $sql)){
    // Si funciona, volvemos a la tabla del aula
    header("Location: ver_aula.php?id=$id_aula");
} else {
    echo "Error al guardar: " . mysqli_error($conexion);
}
?>