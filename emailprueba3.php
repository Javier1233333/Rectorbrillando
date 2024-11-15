<?php
require 'dompdf/autoload.inc.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use Dompdf\Dompdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Conexión a la base de datos
$db = mysqli_connect('localhost', 'root', '12345678', 'brillaudg');
if (!$db) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Verificar si el formulario fue enviado
if (isset($_POST['idprofesores'])) {
    $idprofesores = $_POST['idprofesores'];

    // Obtener los datos del profesor de la base de datos
    $query = "SELECT * FROM profesores WHERE idprofesores = '$idprofesores'";
    $result = mysqli_query($db, $query);
    $profesor = mysqli_fetch_assoc($result);

    if ($profesor) {
        // Verificar si es el cumpleaños
        $fecha_nacimiento = new DateTime($profesor['dob']);
        $hoy = new DateTime();

        if ($fecha_nacimiento->format('m-d') == $hoy->format('m-d')) {
            // Generar el PDF
            $nombre = $profesor['nombre'];
            $email = $profesor['email'];
            $fecha_formateada = $fecha_nacimiento->format('d-m');

            $dompdf = new Dompdf();
            $dompdf->set_option('isRemoteEnabled', true);

            // Load the image and encode in base64
            $imagePath = __DIR__ . "/Images2/fondo.jpg";
            if (file_exists($imagePath)) {
                $imageData = file_get_contents($imagePath);
                if ($imageData !== false) {
                    $imageBase64 = "data:image/jpeg;base64," . base64_encode($imageData);
                } else {
                    echo "<script>alert('Error al leer la imagen. Verifique el archivo.'); window.location.href = 'adminsite.php';</script>";
                    exit;
                }
            } else {
                echo "<script>alert('La imagen de fondo no se encuentra en el servidor.'); window.location.href = 'adminsite.php';</script>";
                exit;
            }

            // Estilos
            $html = "
            <!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link href='https://fonts.googleapis.com/css2?family=Banbury&display=swap' rel='stylesheet'>
                <title>Tarjeta de Felicitacion</title>
                <style>
                    body {
                        margin: 0;
                        padding: 0;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        background-color: #e9ecef;
                    }

                    .card {
                        position: relative;
                        width: 50vw;
                        height: 50vw;
                        max-width: 800px;
                        max-height: 800px;
                        border: 1px solid #ddd;
                        padding: 20px;
                        text-align: center;
                        margin: auto;
                        border-radius: 10px;
                        background-image: url('$imageBase64');
                        background-size: cover;
                        background-position: center;
                        font-family: Arial, sans-serif;
                        color: white;
                        overflow: hidden;
                    }

                    h2 {
                        font-family: 'Banbury', sans-serif;
                        color: #fff;
                        text-align: center;
                        margin-top: 580px;
                        background-color: #ffb44b;
                        padding: 10px 15px;
                        display: inline-block;
                        border-radius: 15px;
                    }
                    h3 {
                        font-family: 'Banbury', sans-serif;
                        color: #fff;
                        text-align: center;
                        margin-top: 600px;
                        background-color: #ffb44b;
                        padding: 5px 10px;
                        display: inline-block;
                        border-radius: 10px;
                    }
                </style>
            </head>
            <body>
                <div class='card'>
                    <h2>$nombre</h2>
                    <h3>$fecha_formateada</h3>
                </div>
                <div class='footer'>Gracias por ser parte de la comunidad BrillaUDG</div>
            </body>
            </html>
            ";

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $pdfOutput = $dompdf->output();

            // Guardar el PDF LOCAL
            $localPath = __DIR__ . "/Images2/felicitaciones/felicitacion_$nombre.pdf";
            file_put_contents($localPath, $pdfOutput);

            // Crear el correo
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'rectorcito.udg@gmail.com';
                $mail->Password = 'hukm pgzp xoel zapl';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('rectorcito.udg@gmail.com', 'BrillaUDG');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = "Felicitaciones de BrillaUDG";
                $mail->Body = "Hola $nombre,<br><br>¡Felicidades! Adjuntamos un PDF especial en tu honor.";

                // Agrega el PDF de manera local
                $mail->addAttachment($localPath);

                $mail->send();
                echo "<script>alert('Correo de felicitación enviado correctamente.'); window.location.href = 'adminsite.php'; </script>";
            } catch (Exception $e) {
                echo "<script>alert('Error al enviar el correo: {$mail->ErrorInfo}'); window.location.href = 'adminsite.php';</script>";
            }
        } else {
            echo "<script>alert('Hoy no es el cumpleaños de este profesor.'); window.location.href = 'adminsite.php';</script>";
        }
    }
}
?>
