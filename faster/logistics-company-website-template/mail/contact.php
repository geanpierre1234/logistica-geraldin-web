<?php

// Validar campos
if (
  empty($_POST['nombre']) ||
  empty($_POST['correo']) ||
  empty($_POST['telefono']) ||
  empty($_POST['mensaje']) ||
  !filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)
) {
  http_response_code(400);
  echo "Formulario inválido";
  exit;
}

// Obtener datos
$nombre   = strip_tags($_POST['nombre']);
$correo   = strip_tags($_POST['correo']);
$telefono = strip_tags($_POST['telefono']);
$mensaje  = strip_tags($_POST['mensaje']);


// CORREO DESTINO (TU EMPRESA)
$to = "contacto@geraldin.com.pe";


// ASUNTO
$subject = "Nueva cotización desde la web - Geraldin S.A.C";


// CONTENIDO DEL MENSAJE
$body = "Has recibido un nuevo mensaje desde tu página web:\n\n";

$body .= "Nombre: $nombre\n";
$body .= "Correo: $correo\n";
$body .= "Teléfono: $telefono\n\n";
$body .= "Mensaje:\n$mensaje\n";


// CABECERAS
$headers = "From: contacto@geraldin.com.pe\r\n";
$headers .= "Reply-To: $correo\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();


// Enviar correo
if (mail($to, $subject, $body, $headers)) {

  // Redirigir con éxito
  header("Location: ../contact.html?enviado=ok");
  exit;
} else {

  echo "Error al enviar correo";
}
