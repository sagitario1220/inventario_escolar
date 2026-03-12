PHP
<?php 
include 'conexion.php'; 
$busqueda = "";
if(isset($_POST['termino'])) {
    $busqueda = $_POST['termino'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscador de Equipos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm p-4 mb-4">
        <h2 class="fw-bold text-primary">🔍 Localizador de Equipos</h2>
        <p class="text-muted">Busca por número de serie, nombre o marca en todo el plantel.</p>
        
        <form action="buscar.php" method="POST" class="d-flex gap-2">
            <input type="text" name="termino" class="form-control form-control-lg" 
                   placeholder="Escribe la serie o nombre..." value="<?php echo $busqueda; ?>" required>
            <button type="submit" class="btn btn-primary btn-lg">Buscar</button>
            <a href="index.php" class="btn btn-outline-secondary btn-lg">Volver</a>
        </form>
    </div>

    <?php if($busqueda != ""): ?>
    <div class="bg-white shadow-sm p-3 rounded border">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Equipo</th>
                    <th>Serie</th>
                    <th>Ubicación (Aula)</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // SQL que une Activos con Aulas para saber dónde están
                $sql = "SELECT a.*, au.nombre_aula 
                        FROM activos a 
                        INNER JOIN aulas au ON a.id_aula_fk = au.id_aula
                        WHERE a.serie LIKE '%$busqueda%' 
                        OR a.nombre_equipo LIKE '%$busqueda%'
                        OR a.marca LIKE '%$busqueda%'";
                
                $res = mysqli_query($conexion, $sql);
                if(mysqli_num_rows($res) > 0):
                    while($row = mysqli_fetch_assoc($res)):
                        $est = $row['estado'];
                        $color = ($est == 'Excelente') ? 'bg-primary' : (($est == 'Malo') ? 'bg-danger' : 'bg-warning text-dark');
                ?>
                <tr>
                    <td><strong><?php echo $row['nombre_equipo']; ?></strong><br><small><?php echo $row['marca']; ?></small></td>
                    <td><code><?php echo $row['serie']; ?></code></td>
                    <td><span class="badge bg-secondary">📍 <?php echo $row['nombre_aula']; ?></span></td>
                    <td><span class="badge <?php echo $color; ?>"><?php echo $est; ?></span></td>
                    <td>
                        <a href="ficha_activo.php?id=<?php echo $row['id_activo']; ?>" class="btn btn-sm btn-dark">📄 Ver Ficha</a>
                        <a href="editar_activo.php?id=<?php echo $row['id_activo']; ?>" class="btn btn-sm btn-info text-white">✏️</a>
                    </td>
                </tr>
                <?php endwhile; else: ?>
                <tr>
                    <td colspan="5" class="text-center p-4">No se encontraron equipos con "<strong><?php echo $busqueda; ?></strong>"</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
</body>
</html>