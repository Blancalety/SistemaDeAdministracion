<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Asegúrate de que el autoload de Composer esté presente

$nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
$telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
$correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
$texto = filter_var($_POST['texto'], FILTER_SANITIZE_STRING);

if (!empty($nombre) && !empty($telefono) && !empty($correo) && !empty($texto)) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'blancalety.r@gmail.com'; // Reemplaza con tu correo de Gmail
        $mail->Password = 'nqdtcxtpxjwuvvdz'; // Reemplaza con tu contraseña de Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Configuración del correo
        $mail->setFrom($correo, $nombre);
        $mail->addAddress('blancalety.r@gmail.com'); // Reemplaza con el correo destino
        $mail->isHTML(true);
        $mail->Subject = 'STAR correo';
        $mail->Body    = '
        <html>
            <head>
                <title>Correo tienda STAR</title>
            </head>
            <body>
                <h1>Email de: '. $nombre .' </h1>
                <p> '. $texto .' </p>
            </body>
        </html>';

        $mail->send();
        header("Location: contacto.php?status=success");
        exit(); // Asegúrate de terminar el script después de redirigir
    } catch (Exception $e) {
        header("Location: contacto.php?status=error");
        exit(); // Asegúrate de terminar el script después de redirigir
    }
} else {
    header("Location: contacto.php?status=invalid");
    exit(); // Asegúrate de terminar el script después de redirigir
}
?>
