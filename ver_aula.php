<?php 
include 'conexion.php'; 
$id_aula = $_GET['id']; 
$res_aula = mysqli_query($conexion, "SELECT nombre_aula FROM aulas WHERE id_aula = $id_aula");
$datos_aula = mysqli_fetch_assoc($res_aula);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>@media print { .no-print { display: none !important; } }</style>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-4">
        <h2>Aula: <?php echo $datos_aula['nombre_aula']; ?></h2>
        <div class="no-print">
<a href="agregar_activo.php?id_aula=<?php echo $id_aula; ?>" class="btn btn-success">+ Agregar Equipo</a>
            <button onclick="window.print()" class="btn btn-primary">🖨️ Imprimir</button>
            <a href="index.php" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <div class="table-responsive bg-white p-3 border rounded shadow-sm">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Equipo</th><th>Marca</th><th>Serie</th><th>Estado</th><th class="no-print">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $resultado = mysqli_query($conexion, "SELECT * FROM activos WHERE id_aula_fk = $id_aula");
                while($row = mysqli_fetch_assoc($resultado)) {
                    $id_act = $row['id_activo'];
                    $est = $row['estado'];
                    $color = ($est=='Excelente') ? 'bg-primary' : (($est=='Bueno') ? 'bg-info' : 'bg-danger');
                ?>
                <tr>
                    <td><strong><?php echo $row['nombre_equipo']; ?></strong></td>
                    <td><?php echo $row['marca']; ?></td>
                    <td><code><?php echo $row['serie']; ?></code></td>
                    <td><span class="badge <?php echo $color; ?>"><?php echo $est; ?></span></td>
                    <td class="no-print">
                        <a href="ficha_activo.php?id=<?php echo $id_act; ?>" class="btn btn-sm btn-dark" title="Ver QR">📄</a>
<a href="ficha_activo.php?id=<?php echo $id_act; ?>" class="btn btn-sm btn-dark" title="Ver Ficha">📄</a>
                        
                        <a href="editar_activo.php?id=<?php echo $id_act; ?>" class="btn btn-sm btn-info text-white" title="Editar Equipo">✏️</a>
                        
                        <a href="eliminar.php?id=<?php echo $id_act; ?>&aula=<?php echo $id_aula; ?>" 
                           class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Borrar?')">🗑️</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>