<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


    if(isset($_POST['email'])){
 
    $nombres = $_POST["nombres"];
	$apellidos = $_POST["apellidos"];
	$tipo_documento = $_POST["tipo_documento"];
	$documento = $_POST["documento"];
	$direccion = $_POST["direccion"];
	$telefono = $_POST["telefono"];
    $email = $_POST["email"]; #correo de la persona que escribe el mensaje
	$asunto = $_POST["asunto"];
    $message = $_POST["message"];
	$acepta_terminos = $_POST["acepta_terminos"];

		
		//Load Composer's autoloader
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

    $mail = new PHPMailer(true);           // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
       //$mail->isSMTP();                          // Set mailer to use SMTP

    /*-----------------*/
        $mail->isMail();
    /*-----------------*/

  //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'miguelangelromeroromerouchiha@gmail.com';                     //SMTP username
    $mail->Password   = 'nnxrpvbvcomhgtao';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('miguelangelromeroromerouchiha@gmail.com', 'Mailer');
    $mail->addAddress('angelromerouchiha06@gmail.com', 'Joe User');     //Add a recipient
		
		
$select_html = '<select  name="tipo_documento">';
$select_html .= '<option value="1">RC</option>';
$select_html .= '<option value="2">TI</option>';
$select_html .= '<option value="3">CC</option>';
$select_html .= '<option value="4">CE</option>';
$select_html .= '<option value="5">PA</option>';
$select_html .= '<option value="6">MS</option>';
$select_html .= '<option value="7">AS</option>';
$select_html .= '<option value="8">PE</option>';
$select_html .= '<option value="9">CN</option>';
$select_html .= '<option value="10">CD</option>';
$select_html .= '<option value="11">SC</option>';
$select_html .= '<option value="12">SD</option>';
$select_html .= '<option value="13">PT</option>';
$select_html .= '</select>';
		
		
		
$tipo_documento = '
 <select name="tipo_documento">
  <option selected disabled value="">Selecciona Tipo Documento</option>
  <option value="1">RC</option>
  <option value="2">TI</option>
  <option value="3">CC</option>
  <option value="4">CE</option>
  <option value="5">PA</option>
  <option value="6">MS</option>
  <option value="7">AS</option>
  <option value="8">PE</option>
  <option value="9">CN</option>
  <option value="10">CD</option>
  <option value="11">SC</option>
  <option value="12">SD</option>
  <option value="13">PT</option>
 </select>
';
		
		
$mail->isHTML(true);
$mail->Subject = $asunto;
$mail->Body = '
<h1>Formulario de contacto</h1>

<table>
    <tr>
        <th>Nombres</th>
        <td>' . $nombres . '</td>
    </tr>
    <tr>
        <th>Apellidos</th>
        <td>' . $apellidos . '</td>
    </tr>
    <tr>
        <th>Tipo de documento</th>
        <td>' . $tipo_documento . $select_html . '</td>
    </tr>
    <tr>
        <th>Documento</th>
        <td>' . $documento . '</td>
    </tr>
    <tr>
        <th>Dirección</th>
        <td>' . $direccion . '</td>
    </tr>
    <tr>
        <th>Teléfono</th>
        <td>' . $telefono . '</td>
    </tr>
    <tr>
        <th>Correo electrónico</th>
        <td>' . $email . '</td>
    </tr>
    <tr>
        <th>Asunto</th>
        <td>' . $asunto . '</td>
    </tr>
    <tr>
        <th>Mensaje</th>
        <td>' . $message . '</td>
    </tr>
	 <tr>
        <th>Acepto los Terminos y Condiciones</th>
        <td>' . $acepta_terminos . '</td>
    </tr>
</table>
';

	


        $mail->send();
        echo 'El mensaje se envio de manera exitosa';
		 header('Location: contactenos.html');
    } catch (Exception $e) {
        echo 'No se pudo enviar el correo: ', $mail->ErrorInfo;
    }}

    else
    {
        echo "mensaje no enviado";
    }
?>