<?php
include 'conexion.php';
$id_aula = $_POST['id_aula'];
$nuevo_nombre = $_POST['nombre_aula'];

$sql = "UPDATE aulas SET nombre_aula = '$nuevo_nombre' WHERE id_aula = $id_aula";
if(mysqli_query($conexion, $sql)){
    header("Location: index.php");
} else {
    echo "Error: " . mysqli_error($conexion);
}
?>