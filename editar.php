PHP
<?php 
include 'conexion.php'; 
$id = $_GET['id'];
$res = mysqli_query($conexion, "SELECT * FROM aulas WHERE id_aula = $id");
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
        <h3 class="text-center fw-bold">✏️ Renombrar Aula</h3>
        <hr>
        <form action="actualizar_aula.php" method="POST">
            <input type="hidden" name="id_aula" value="<?php echo $reg['id_aula']; ?>">
            
            <label class="form-label">Nombre del Aula</label>
            <input type="text" name="nuevo_nombre" class="form-control" value="<?php echo $reg['nombre_aula']; ?>" required>
            
            <button type="submit" class="btn btn-warning w-100 mt-4 fw-bold shadow-sm">Guardar Cambios</button>
            <a href="index.php" class="btn btn-link w-100 text-secondary mt-2">Cancelar</a>
        </form>
    </div>
</body>
</html>