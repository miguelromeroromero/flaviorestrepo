<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];


function validarCampos($nombres, $apellidos, $tipo_documento, $documento, $direccion, $telefono, $email, $asunto, $message, $acepta_terminos) {
    $errores = array();

 // Validar nombres
if (empty($_POST['nombres'])) {
    $errores['nombres'] = "El campo nombres es obligatorio.";
} elseif (!preg_match("/^[a-zA-Z\s]+$/", $_POST['nombres'])) {
    $errores['nombres'] = "El campo nombres solo puede contener letras y espacios.";
}

// Validar apellidos
if (empty($_POST['apellidos'])) {
    $errores['apellidos'] = "El campo apellidos es obligatorio.";
} elseif (!preg_match("/^[a-zA-Z\s]+$/", $_POST['apellidos'])) {
    $errores['apellidos'] = "El campo apellidos solo puede contener letras y espacios.";
}

// Validar tipo_documento
if (empty($_POST['tipo_documento'])) {
    $errores['tipo_documento'] = "El campo tipo de documento es obligatorio.";
} elseif (!in_array($_POST['tipo_documento'], array('RC', 'CC', 'CE', 'PPT', 'TI', 'ADS'))) {
    $errores['tipo_documento'] = "El tipo de documento debe ser uno de los siguientes: RC, CC, CE, PPT, TI, ADS.";
}

// Validar documento
if (empty($_POST['documento'])) {
    $errores['documento'] = "El campo documento es obligatorio.";
} elseif (!preg_match("/^[0-9]+$/", $_POST['documento'])) {
    $errores['documento'] = "El campo documento solo puede contener números.";
}

// Validar dirección
if (empty($_POST['direccion'])) {
    $errores['direccion'] = "El campo dirección es obligatorio.";
} elseif (!preg_match('/^[a-zA-Z0-9\s\.,\-_\/]+$/u', $_POST['direccion'])) {
    $errores['direccion'] = "La dirección solo puede contener letras, números, espacios, puntos, comas, guiones, underscores y barras.";
}

// Validar teléfono
if (empty($_POST['telefono'])) {
    $errores['telefono'] = "El campo teléfono es obligatorio.";
} elseif (!preg_match("/^[0-9]+$/", $_POST['telefono'])) {
    $errores['telefono'] = "El campo teléfono solo puede contener números.";
}

// Validar email
	if (empty($_POST['email'])) {
    $errores['email'] = "El campo email es obligatorio.";
} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) || strpos($_POST['email'], '@') === false) {
    $errores['email'] = "El campo email debe ser una dirección válida y contener un símbolo @.";
}

	// Validar asunto
if (empty($_POST['asunto'])) {
    $errores['asunto'] = "El campo asunto es obligatorio.";
} elseif (!preg_match('/^[a-zA-Z0-9\s\.,\-_\/\(\)\[\]\{\}\/]+$/u', $_POST['asunto'])) {
    $errores['asunto'] = "El campo asunto solo puede contener letras, números, espacios, puntos, comas, guiones, underscores, paréntesis, corchetes, llaves y barras.";
}

	// Validar mensaje
if (empty($_POST['message'])) {
    $errores['message'] = "El campo mensaje es obligatorio.";
} elseif (!preg_match('/^[a-zA-Z0-9\s\.,\-_\/\(\)\[\]\{\}\n\r\t\f\v]+$/u', $_POST['message'])) {
    $errores['message'] = "El campo mensaje solo puede contener letras, números, espacios, puntos, comas, guiones, underscores, paréntesis, corchetes, llaves, barras y saltos de línea.";
}

	// Validar aceptación de términos
if (!isset($_POST['acepta_terminos']) || $_POST['acepta_terminos'] != 'on') {
    $errores['acepta_terminos'] = "Debe aceptar los términos y condiciones.";
}

    return $errores;
}

// Ejemplo de uso
$nombres = "";
$apellidos = "";
$tipo_documento = "";
$documento = "";
$direccion = "";
$telefono = "";
$email = "";
$asunto = "";
$message = "";
$acepta_terminos = false;

$errores = validarCampos($nombres, $apellidos, $tipo_documento, $documento, $direccion, $telefono, $email, $asunto, $message, $acepta_terminos);

if (count($errores) > 0) {
    echo "Se encontraron errores en la validación:";
    foreach ($errores as $error) {
        echo "<br>$error";
    }
} else {
    echo "Todos los campos son válidos.";
}
	
	}


if($_SERVER['REQUEST_METHOD'] != 'POST' ){
    header("Location: contactenos.html" );


}


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

	//Load Composer's autoloader
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$tipo_documento = $_POST['tipo_documento'];
$documento = $_POST['documento'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$asunto = $_POST['asunto'];
$message = $_POST['message'];
$acepta_terminos = $_POST['acepta_terminos'];

if (empty(trim($nombres))) $nombres = '';
if (empty(trim($apellidos))) $apellidos = '';
if (empty(trim($tipo_documento))) $tipo_documento = '';
if (empty(trim($documento))) $documento = '';
if (empty(trim($direccion))) $direccion = '';
if (empty(trim($telefono))) $telefono = '';
if (empty(trim($email))) $email = '';
if (empty(trim($asunto))) $asunto = '';
if (empty(trim($message))) $message = '';
if (empty($acepta_terminos)) $acepta_terminos = '';

$body = <<<HTML
    <h1>Contacto desde la web</h1>
    <p>De: $nombres $apellidos / $email</p>
    <p>Tipo de documento: $tipo_documento</p>
    <p>Número de documento: $documento</p>
    <p>Dirección: $direccion</p>
    <p>Teléfono: $telefono</p>
    <h2>Asunto: $asunto</h2>
    <h2>Mensaje</h2>
    $message
    <p>Acepta términos: {if ($acepta_terminos) echo 'Sí'; else echo 'No';}</p>
HTML;

$mailer = new PHPMailer();
$mailer->setFrom( $email, "$nombres $apellidos" );
$mailer->addAddress('clinicaflaviorestrepoladorada@gmail.com','Sitio web Clínica Flavio Restrepo');
$mailer->Subject = "Mensaje web: $asunto";
$mailer->msgHTML($body);
$mailer->AltBody = strip_tags($body);
$mailer->CharSet = 'UTF-8';
$mailer->Body = "Nombre: $nombres\nApellidos: $apellidos\nTipo de Documento: $tipo_documento\nDocumento: $documento\nDirección: $direccion\nTeléfono: $telefono\nMensaje: $message\nAcepta términos: " . ($acepta_terminos ? 'Sí' : 'No');

    // Send the email
  $rta = $mailer->send();

if ($rta) {
    echo "Mensaje enviado con éxito.";
    header("Location: contactenos.html");
} else {
    echo "Error al enviar el mensaje: " . $mailer->ErrorInfo;
}
//var_dump($rta);
header("Location: contactenos.html" );

   exit;
?>