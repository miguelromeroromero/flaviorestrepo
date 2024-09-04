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
?>
