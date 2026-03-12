<?php 
include 'conexion.php'; 

// 1. Obtener el ID del activo
if(!isset($_GET['id'])) { echo "ID no encontrado"; exit; }
$id = $_GET['id'];

// 2. Consultar datos del equipo y a qué aula pertenece
$sql = "SELECT a.*, au.nombre_aula 
        FROM activos a 
        INNER JOIN aulas au ON a.id_aula_fk = au.id_aula 
        WHERE a.id_activo = $id";
$res = mysqli_query($conexion, $sql);
$reg = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ficha Técnica - <?php echo $reg['serie']; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .ticket {
            width: 400px;
            background: white;
            border: 2px dashed #333;
            padding: 20px;
            margin: 50px auto;
            border-radius: 10px;
        }
        .qr-placeholder {
            width: 120px;
            height: 120px;
            background: #eee;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #666;
            margin: 0 auto;
        }
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .ticket { margin: 0; border: 1px solid #000; }
        }
    </style>
</head>
<body>

<div class="no-print text-center mt-4">
    <button onclick="window.print()" class="btn btn-dark">🖨️ Imprimir Ficha</button>
    <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
</div>

<div class="ticket shadow">
    <div class="text-center">
        <h5 class="fw-bold mb-0">INSTITUCIÓN EDUCATIVA</h5>
        <small class="text-muted">Control de Activos Fijos</small>
        <hr>
    </div>

    <div class="row">
        <div class="col-7">
            <p class="mb-1"><strong>Equipo:</strong> <br><?php echo $reg['nombre_equipo']; ?></p>
            <p class="mb-1"><strong>Marca:</strong> <?php echo $reg['marca']; ?></p>
            <p class="mb-1"><strong>S/N:</strong> <code><?php echo $reg['serie']; ?></code></p>
            <p class="mb-0"><strong>Ubicación:</strong> <?php echo $reg['nombre_aula']; ?></p>
        </div>
        <div class="col-5 text-center">
            <div class="qr-placeholder">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=ID:<?php echo $id; ?>-SERIE:<?php echo $reg['serie']; ?>" alt="QR Code" style="width:100%">
            </div>
            <small style="font-size: 9px;">Escanear para inventario</small>
        </div>
    </div>
    
    <hr>
    <div class="text-center">
        <span class="badge bg-dark">ID: <?php echo $reg['id_activo']; ?></span>
        <p class="mt-2 mb-0" style="font-size: 10px;">Fecha de impresión: <?php echo date("d/m/Y"); ?></p>
    </div>
</div>

</body>
</html>