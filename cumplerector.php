<?php
// Importar PHPMailer
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar los datos del formulario
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Cambiar según tu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'rectorcito.udg@gmail.com'; // Tu correo
        $mail->Password = 'hukm pgzp xoel zapl'; // Contraseña o password de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurar el remitente
        $mail->setFrom('rectorcito.udg@gmail.com', 'Tu Nombre');

        // Configurar el receptor (el correo ingresado en el formulario)
        $mail->addAddress($email);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Enviar correo
        $mail->send();
        echo "<script>alert('Correo enviado correctamente.'); window.location.href = 'email_form.html';</script>";

    } catch (Exception $e) {
        echo "<script>alert('Error al enviar el correo: {$mail->ErrorInfo}'); window.location.href = 'email_form.html';</script>";
    }
}
?>
?>