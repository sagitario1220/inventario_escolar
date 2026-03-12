<?php
include 'conexion.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $aula = $_GET['aula'];
    mysqli_query($conexion, "DELETE FROM activos WHERE id_activo = $id");
    header("Location: ver_aula.php?id=$aula");
}
?>