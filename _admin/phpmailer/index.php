<?php
include('class.phpmailer.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "c1481582.ferozo.com"; // SMTP a utilizar. Por ej. smtp.elserver.com
$mail->Username = "comunicacion@amgba.org.ar"; // Correo completo a utilizar
$mail->Password = "Casa4552"; // Contraseña
$mail->Port = 25; // Puerto a utilizar
$mail->From = "comunicacion@amgba.org.ar"; // Desde donde enviamos (Para mostrar)
$mail->FromName = "Inscripcion";
$mail->AddAddress("matutecolado@gmail.com"); // Esta es la dirección a donde enviamos
//$mail->AddCC("cuenta@dominio.com"); // Copia
//$mail->AddBCC("cuenta@dominio.com"); // Copia oculta
$mail->IsHTML(true); // El correo se envía como HTML
$mail->Subject = "Titulo"; // Este es el titulo del email.

ob_start();
include('email_contenido.php');
$mesage = ob_get_contents();
ob_end_clean();

$body = $mesage;
$mail->Body = $body; // Mensaje a enviar
$mail->AltBody = "Hola mundo. Esta es la primer línean Acá continuo el mensaje"; // Texto sin html
//$mail->AddAttachment("imagenes/imagen.jpg", "imagen.jpg");
$exito = $mail->Send(); // Envía el correo.

if($exito){
echo "El correo fue enviado correctamentetetete.";
}else{
echo "Huvo un inconveniente. Contacta a un administrador.";
}
?>
