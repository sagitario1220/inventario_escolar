<?php
include 'conexion.php';

if ($_POST) {
    $id = $_POST['id_aula'];
    $nombre = $_POST['nuevo_nombre'];

    // Cambiamos el nombre en la tabla 'aulas'
    $sql = "UPDATE aulas SET nombre_aula = '$nombre' WHERE id_aula = $id";

    if(mysqli_query($conexion, $sql)){
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar: " . mysqli_error($conexion);
    }
}
?>