<?php
include_once 'global.php';
$alertaUsr = '';
$nombreCliente =   isset($_POST['name']) ? htmlentities( strip_tags( $_POST['name'])):null;
$emailCliente  =   isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL):null;
$message    =      isset($_POST['message']) ? htmlentities( strip_tags( $_POST['message'])):null;
$subject    =      isset($_POST['subject']) ? htmlentities( strip_tags( $_POST['subject'])):null;
$proccess = isset($_GET['proccess']) ? $_GET['proccess'] : null;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$r = __DIR_MAIN__  . 'src/PHPMailer-master/src';

is_readable( $a = realpath( $r.'/Exception.php' ) ) ? require_once( $a ) : die("No existe .");
is_readable( $a = realpath( $r.'/PHPMailer.php' ) ) ? require_once( $a ) : die("No existe .");
is_readable( $a = realpath( $r.'/SMTP.php' ) ) ? require_once( $a ) : die("No existe .");

if ($proccess === 'contactproccess') {
    if ($nombreCliente != null && $nombreCliente != null && $message != null && $subject != null) {
        $paraCliente    = $emailCliente;
        $tituloCliente  = $subject;
        $mensajeCliente = "<html>".
            "<head><PISHY BAKES></title>".
            "<style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-size: 16px;
                font-weight: 300;
                color: #888;
                background-color:rgba(230, 225, 225, 0.5);
                line-height: 30px;
                text-align: center;
            }
            .contenedor{
                width: 80%;
                min-height:auto;
                text-align: center;
                margin: 0 auto;
                padding: 40px;
                background: #ececec;
                border-top: 3px solid #E64A19;
            }
            .bold{
                color:#333;
                font-size:25px;
                font-weight:bold;
            }
            img{
                margin-left: auto;
                margin-right: auto;
                display: block;
                padding:0px 0px 20px 0px;
            }
            </style>
        </head>".
            "<body>" .
                "<div class='contenedor'>".
                    "<p>&nbsp;</p>" .
                    "<p>&nbsp;</p>" .
                        "<span>Felicitaciones <strong class='bold'>".$nombreCliente.'['.$emailCliente.']'." . . .!</strong></span>" .
                        "<p><strong>Mensaje: </strong> " . $message . " </p>" .
                        "<p>&nbsp;</p>" .
                "<p><span class='bold'> Pashybakes! </span></p>" .
                "<p>&nbsp;</p>" .
                "<p>".
                "</p>" .
            "</div>" .
            "</body>" .
        "</html>";
        
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        
        $emisor = [
            'email'     =>      'store@pishybakes.online',
            'clave'     =>      'Pishybakes1234!',
            'nombre'    =>      'store@pishybakes.online'
        ];
        
        try {
            //Server settings
            $mail->SMTPDebug =  0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                   //Set the SMTP server to send through
            $mail->SMTPAuth   = TRUE;                                   //Enable SMTP authentication
            $mail->Username   = $emisor['email'];                       //SMTP username
            $mail->Password   = $emisor['clave'];                       //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable explicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom($emisor['email'], $emisor['nombre']);
            //  $mail->addAddress($emailCliente, $nombreCliente);     //Add a recipient
        
        
            $mail->addAddress($emailCliente);               //Name is optional
            //  $mail->addBCC('bcc@example.com');
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $mensajeCliente;
            $mail->AltBody = strip_tags( $mensajeCliente );
        
            $mail->send();
        
            $alertaUsr = "Mensaje enviado correctamente.";
        } catch (Exception $e) {
            echo $e . "\n";
            $alertaUsr = "A ocurrido un problema.";
        }
    }else {
        $alertaUsr = "Todos los campos son obligatorios";
    }  
}

// echo $alertaUsr;
?>