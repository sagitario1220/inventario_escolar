<?php 
include 'conexion.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario Escolar - Panel Principal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f4f7f6; }
        .card-aula { transition: transform 0.2s; border: none; border-radius: 15px; }
        .card-aula:hover { transform: translateY(-5px); }
        .btn-custom { border-radius: 10px; font-weight: bold; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark mb-4 shadow">
    <div class="container">
        <span class="navbar-brand mb-0 h1">🏫 Sistema de Inventario Escolar</span>
    </div>
</nav>

<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="fw-bold">Gestión de Aulas</h2>
            <p class="text-muted">Seleccione un aula para gestionar sus activos o utilice el buscador.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="buscar.php" class="btn btn-primary btn-lg btn-custom shadow-sm">
                🔍 Buscar Equipo por Serie
            </a>
        </div>
    </div>

    <hr>

    <div class="row mt-4">
        <?php
        // Consultamos todas las aulas de la base de datos
        $sql = "SELECT * FROM aulas ORDER BY nombre_aula ASC";
        $resultado = mysqli_query($conexion, $sql);

        if(mysqli_num_rows($resultado) > 0):
            while($row = mysqli_fetch_assoc($resultado)):
                $id_aula = $row['id_aula'];
                $nombre_aula = $row['nombre_aula'];
        ?>
        <div class="col-md-4 mb-4">
            <div class="card card-aula shadow-sm h-100">
                <div class="card-body text-center p-4">
                    <div class="display-5 mb-3">📁</div>
                    <h4 class="card-title fw-bold"><?php echo $nombre_aula; ?></h4>
                    <p class="text-secondary small">ID del Aula: #<?php echo $id_aula; ?></p>
                    
                    <div class="d-grid gap-2 mt-4">
                        <a href="ver_aula.php?id=<?php echo $id_aula; ?>" class="btn btn-dark btn-custom">
                            Ver Inventario
                        </a>
                        
                        <a href="editar_aula.php?id=<?php echo $id_aula; ?>" class="btn btn-outline-warning btn-sm btn-custom text-dark">
                            ✏️ Renombrar Aula
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            endwhile; 
        else: 
        ?>
        <div class="col-12 text-center py-5">
            <div class="alert alert-info">No hay aulas registradas todavía.</div>
        </div>
        <?php endif; ?>
    </div>
</div>

<footer class="text-center py-4 mt-5 text-muted border-top">
    <small>Sistema de Gestión de Activos &copy; <?php echo date("Y"); ?></small>
</footer>

</body>
</html>