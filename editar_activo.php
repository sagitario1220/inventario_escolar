<?php 
include 'conexion.php'; 
$id = $_GET['id'];
$res = mysqli_query($conexion, "SELECT * FROM activos WHERE id_activo = $id");
$reg = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-5">
    <div class="card shadow p-4 mx-auto" style="max-width: 450px; border-radius: 15px;">
        <h3 class="text-center fw-bold">✏️ Editar Equipo</h3>
        <hr>
        <form action="actualizar_activo.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $reg['id_activo']; ?>">
            <input type="hidden" name="id_aula" value="<?php echo $reg['id_aula_fk']; ?>">
            
            <label class="form-label mt-2">Nombre del Equipo</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $reg['nombre_equipo']; ?>" required>
            
            <label class="form-label mt-3">Estado</label>
            <select name="estado" class="form-select">
                <option value="Excelente" <?php if($reg['estado']=='Excelente') echo 'selected'; ?>>Excelente</option>
                <option value="Bueno" <?php if($reg['estado']=='Bueno') echo 'selected'; ?>>Bueno</option>
                <option value="Regular" <?php if($reg['estado']=='Regular') echo 'selected'; ?>>Regular</option>
                <option value="Malo" <?php if($reg['estado']=='Malo') echo 'selected'; ?>>Malo</option>
            </select>
            
            <button type="submit" class="btn btn-primary w-100 mt-4 fw-bold">Guardar Cambios</button>
            <a href="ver_aula.php?id=<?php echo $reg['id_aula_fk']; ?>" class="btn btn-link w-100 text-secondary mt-2">Cancelar</a>
        </form>
    </div>
</body>
</html>