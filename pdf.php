<?php
// Obtener los datos de nombre y fecha desde la URL
$nombre = isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : 'Nombre del Academico';
$fecha = isset($_GET['fecha']) ? htmlspecialchars($_GET['fecha']) : 'Fecha de Cumpleanos';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset='UTF-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarjeta de Felicitacion</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Banbury&display=swap" rel="stylesheet">
</head>
<body>
    <div class="card">
        <h2><?= $nombre ?>!</h2>
        <p><?= $fecha ?>.</p>
    </div>
</body>
</html>

