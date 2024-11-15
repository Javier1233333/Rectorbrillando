<?php
require 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Conexión a la base de datos
$db = mysqli_connect('localhost', 'root', '12345678', 'brillaudg');
if (!$db) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Consultar información de los profesores
$query = "SELECT nombre, email, dob, estatus FROM profesores";
$result = mysqli_query($db, $query);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($db));
}

// Ruta del logo (ajusta según tu estructura de proyecto)
$logoPath = __DIR__ . '/Images2/brillalogo.png';

// Verificar que el archivo exista
if (file_exists($logoPath)) {
    $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
} else {
    die("No se encuentra el logo en la ruta especificada.");
}

// Crear el HTML para el PDF
$html = "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Reporte de Profesores</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        h1 { text-align: center; color: #333; margin-top: 200px; }
        .logo {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            height: auto;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 40px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; font-weight: bold; }
    </style>
</head>
<body>
    <img src='$logoBase64' alt='Logo' class='logo'/>
    <h1>Reporte de Profesores</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Fecha de Nacimiento</th>
            <th>Status</th>
        </tr>";

// Agregar cada fila de profesor a la tabla
while ($profesor = mysqli_fetch_assoc($result)) {
    $nombre = $profesor['nombre'];
    $email = $profesor['email'];
    $dob = (new DateTime($profesor['dob']))->format('d-m-Y');  // Formato de fecha
    $estatus = $profesor ['estatus'];
    $html .= "
        <tr>
            <td>$nombre</td>
            <td>$email</td>
            <td>$dob</td>
            <td>$estatus</td>

        </tr>";
}

$html .= "
    </table>
</body>
</html>";

// Inicializar Dompdf y configurar opciones
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Cargar el HTML y generar el PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Mostrar el PDF en el navegador
$dompdf->stream("reporte_profesores.pdf", ["Attachment" => false]);

// Cerrar la conexión a la base de datos
mysqli_close($db);
?>