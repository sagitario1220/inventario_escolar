<?php 
include 'conexion.php'; 
// Recibimos el ID del aula para saber a dónde pertenece el equipo
$id_aula = $_GET['id_aula']; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Nuevo Equipo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-5">
    <div class="card shadow p-4 mx-auto" style="max-width: 500px; border-radius: 15px;">
        <h3 class="text-center fw-bold text-success">➕ Nuevo Equipo</h3>
        <p class="text-muted text-center">Registrando en el aula ID: <?php echo $id_aula; ?></p>
        <hr>
        <form action="guardar_activo.php" method="POST">
            <input type="hidden" name="id_aula" value="<?php echo $id_aula; ?>">
            
            <div class="mb-3">
                <label class="form-label">Nombre del Equipo</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ej: Laptop HP" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Marca</label>
                <input type="text" name="marca" class="form-control" placeholder="Ej: Hewlett-Packard" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Número de Serie</label>
                <input type="text" name="serie" class="form-control" placeholder="Ej: ABC12345" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Estado Inicial</label>
                <select name="estado" class="form-select">
                    <option value="Excelente">Excelente</option>
                    <option value="Bueno">Bueno</option>
                    <option value="Regular">Regular</option>
                    <option value="Malo">Malo</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-success w-100 fw-bold shadow">Guardar Equipo</button>
            <a href="ver_aula.php?id=<?php echo $id_aula; ?>" class="btn btn-link w-100 mt-2 text-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>