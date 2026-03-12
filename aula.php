<?php 
include 'conexion.php'; 
// Obtenemos el ID del aula desde la URL
$id_aula = $_GET['id']; 

// Consultamos el nombre del aula
$sql_aula = "SELECT nombre_aula FROM aulas WHERE id_aula = $id_aula";
$res_aula = mysqli_query($conexion, $sql_aula);
$datos_aula = mysqli_fetch_assoc($res_aula);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Equipos - <?php echo $datos_aula['nombre_aula']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Inventario: <?php echo $datos_aula['nombre_aula']; ?></h2>
        <a href="index.php" class="btn btn-secondary">Volver al Menú</a>
    </div>

    <table class="table table-hover table-bordered bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Equipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Solo buscamos los equipos que pertenecen a esta aula específica
            $query = "SELECT * FROM activos WHERE id_aula_fk = $id_aula";
            $resultado = mysqli_query($conexion, $query);

            if(mysqli_num_rows($resultado) > 0){
                while($row = mysqli_fetch_assoc($resultado)) {
                    $color_estado = ($row['estado'] == 'Dañado') ? 'text-danger' : 'text-success';
                    echo "<tr>
                        <td>{$row['nombre_equipo']}</td>
                        <td>{$row['marca']}</td>
                        <td>{$row['modelo']}</td>
                        <td>{$row['serie']}</td>
                        <td class='fw-bold $color_estado'>{$row['estado']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No hay equipos registrados en esta aula aún.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>