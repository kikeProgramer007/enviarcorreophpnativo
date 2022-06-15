<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if(isset($_POST['submit'])){

//Create an instance; passing `true` enables exceptions
//$mail = new PHPMailer(true);

  try {

    /* PARA EL FEDORA CORREO SERVE
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'correo.panaderia.com';
    $mail->SMTPAuth = true;
    $mail->Port = 25;
    $mail->Username = 'contacto@correo.panaderia.com';
    $mail->Password = 'contacto123';*/

    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;    
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = 'ef75a0bb555828';
    $mail->Password = 'd0e4366fa321a5';
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  
    $mail->Port = 2525;

    $mail->setFrom($_POST['email'],$_POST['nombre']);//REMITENTE
    $mail->addAddress('administrador@correo.panaderia.com', 'administrador');//DISTINATARIO
    $mail->addReplyTo($_POST['email'],$_POST['nombre']);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $_POST['asunto'];
    
    $mail->Body = '<P><strong>Nombre: </strong>'.$_POST['nombre'].'</P>
                   <P><strong>Correo: </strong>'.$_POST['email'].'</P>
                   <P><strong>Mensaje: </strong>'.$_POST['mensaje'].'</P>';
    $mail->AltBody = 'Correo de prueba con PHPMailer';

    if(!$mail->send()){
      $error="Algo esta mal, por favor inténtelo de nuevo.";
    }
    else{
      $result= $_POST['nombre']." gracias por contactarnos, espera tu respuesta!";
    }

  } catch (Exception $e) {
    $error= "Error al enviar Correo. Mailer Error: {$mail->ErrorInfo}";
  }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enviar Correo</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font oweson CSS iconos-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

<div class="container py-4">
  <div class="row justify-content-md-center">
    <div class="col-md-8">

      <header>
        <h1 class="text-center text-success">Contactanos</h1><br>
      </header>

      <section>

      <div class="card border-success mb-3">
        <div class="card-header border-success text-center text-success"><b>Dejanos tu mensaje:</b></div>
        <div class="card-body"> 

          <form action="" method="POST" class="needs-validation" novalidate>

            <div class="mb-3">
              <label for="asunto" class="form-label fw-bold text-success">Asunto:</label>
              <input class="form-control" type="text" name="asunto"id="asunto" placeholder="Ingrese el Asunto" required>
              <div class="invalid-feedback">
                Porfavor ingrese el asunto.
              </div>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label fw-bold text-success">Nombre:</label>
                <input class="form-control" type="text" name="nombre"id="nombre" placeholder="Ingrese su nombre" required>
                <div class="invalid-feedback">
                  Porfavor ingrese su nombre.
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-bold text-success">Correo:</label>
                <input class="form-control" type="email" name="email"id="email" placeholder="Ingrese su correo" required>
                <div class="invalid-feedback">
                    Porfavor ingrese su correo.
                </div>
            </div>

            <div class="mb-3">
                <label for="mensaje" class="form-label fw-bold text-success">Mensaje:</label>
                <textarea class="form-control" id="mensaje" type="text" name="mensaje" placeholder="Ingrese su Mensaje."rows="3" required></textarea>
  
                <div class="invalid-feedback">
                    Introduzca un mensaje en el área de texto.
                </div>
            </div>

            <div class="d-grid gap-2 col-6 mx-auto">
              <button class="btn btn-success" onclick=""name="submit" type="submit">Enviar Mensaje</button>
            </div>
          </form>
        <?php if(isset($result)){
          echo '<div class="alert alert-success my-3 mb-2 alert-dismissible fade show" role="alert">
            <strong><i class="fa-solid fa-envelope-circle-check"></i> Enviado!</strong> '.$result.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';}
          if(isset($error)){
            echo '<div class="alert alert-danger my-3 mb-2 alert-dismissible fade show" role="alert">
              <strong>ERROR!</strong> '.$error.'
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';}
          ?>
        </div><!--card-body-->
      </div><!--card-->
      </section>

      <footer>
        <h5 class="fst-italic">Gracias por visitar mi página web. </h5>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script  type= "text/javascript"src="js/evitar_reenvio.js"></script>
      </footer>

      </div>
    </div>
  </div>
  
</body>



</html>
