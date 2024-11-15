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
            $fecha_formateada = $fecha_nacimiento->format('d-m-Y');

            $dompdf = new Dompdf();
            $html = "
            <!DOCTYPE html>
            <html lang='es'>
            <head>
                <meta charset='UTF-8'>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        color: #333;
                        background-color: #f4f4f4;
                        text-align: center;
                        padding: 0;
                        margin: 0;
                    }
                    .container {
                        background-color: #fff;
                        width: 80%;
                        margin: 20px auto;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                        border: 2px solid #ff9900;
                    }
                    .header {
                        font-size: 28px;
                        color: #ff9900;
                        margin-top: 20px;
                        font-weight: bold;
                    }
                    .subheader {
                        font-size: 18px;
                        color: #333;
                        margin-top: 10px;
                    }
                    .image-container {
                        margin-top: 20px;
                    }
                    .image-container img {
                        width: 250px;
                        height: auto;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }
                    .footer {
                        font-size: 14px;
                        color: #555;
                        margin-top: 30px;
                    }
                    .birthday-date {
                        font-size: 48px;
                        color: #1E90FF;
                        margin-top: 40px;
                        font-weight: bold;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>¡Felicidades, $nombre!</div>
                    <div class='subheader'>Todo el equipo de BrillaUDG celebra tus logros en tu cumpleaños.</div>
                    
                    <!-- Contenedor de Imagen -->
                    <div class='image-container'>
                    <img src='" . realpath("/Images2/gg.png") . "' alt='Imagen de Felicitación'>

                    </div>

                    <!-- Fecha de Nacimiento en Grande -->
                    <div class='birthday-date'>$fecha_formateada</div>

                    <div class='footer'>Gracias por ser parte de la comunidad BrillaUDG</div>
                </div>
            </body>
            </html>
            ";

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $pdfOutput = $dompdf->output();

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
                $mail->Body    = "Hola $nombre,<br><br>¡Felicidades! Adjuntamos un PDF especial en tu honor.";

                $mail->addStringAttachment($pdfOutput, "felicitacion_$nombre.pdf");

                $mail->send();
                echo "<script>alert('Correo de felicitación enviado correctamente.'); window.location.href = 'adminsite.php';</script>";
            } catch (Exception $e) {
                echo "<script>alert('Error al enviar el correo: {$mail->ErrorInfo}'); window.location.href = 'adminsite.php';</script>";
            }
        } else {
            echo "<script>alert('Hoy no es el cumpleaños de este profesor.'); window.location.href = 'adminsite.php';</script>";
        }
    }
}
?>
