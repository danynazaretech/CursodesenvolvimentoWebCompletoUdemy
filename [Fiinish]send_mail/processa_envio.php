<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/OAuthTokenProvider.php';
    require './PHPMailer/src/OAuth.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';
    require './PHPMailer/src/POP3.php';


    class Mensagem{
        private $para = null;
        private $assunto = null;
        private $mensagem = null;
        public $status = array('codigo_status'=>null, 'descricao_status'=>'');
    
        public function __get($atributo){
            return $this->$atributo;
        }
        public function __set($atributo, $valor){
            $this->$atributo = $valor;
        }

        public function mensagemValida(){
            if(empty($this->para) || 
               empty($this->assunto) || 
               empty($this->mensagem)){

                return false;
            }
            return true;
        }
    }

    $mensagem = new Mensagem();

    $mensagem->__set('para', $_POST['para']);
    $mensagem->__set('assunto', $_POST['assunto']);
    $mensagem->__set('mensagem', $_POST['mensagem']);

    if(!$mensagem->mensagemValida()){
        echo 'mensagem InValida';
        header('location: index.php');
    }

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'ssl://smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true; 
        $mail->SMTPSecure =  'ssl';                            //Enable SMTP authentication
        $mail->Username   = 'mail@gmail.com';                     //SMTP username
        $mail->Password   = 'senha';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('dany.nt.14@gmail.com', 'dany');
        $mail->addAddress($mensagem->__get('para'));     //Add a recipient
        
        //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $mensagem->__get('assunto');
        $mail->Body    = $mensagem->__get('mensagem');
        $mail->AltBody = 'aqui';

        $mail->send();
        $mensagem->status['codigo_status']=1;
        $mensagem->status['Descricao_status']='Email  Enviado com sucesso!';
        
    } catch (Exception $e) {
        $mensagem->status['codigo_status']=2;
        $mensagem->status['Descricao_status']='Não foi possível enviae esse email';
        
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <title>Enviar Email</title>
</head>
<body>
    <div class="container">
            <div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php
               if($mensagem->status['codigo_status']==1){
              ?>
              <div class="container">
                  <h1 class="display-4 text-success">
                      Sucess0
                  </h1>
                  <p>
                    <?php $mensagem->status['descricao_status']?>
                  </p>
                  <a href="index.php" class="btn btn-success btn-lg mt-5 text-white">Voltar</a>
              </div>
            <?php }?>
            <?php
               if($mensagem->status['codigo_status']==2){
              ?>
                 <div class="container">
                  <h1 class="display-4 text-success text-center">
                      ERRO
                  </h1>
                  <p>
                    <?php $mensagem->status['descricao_status']?>
                  </p>
                  <a href="index.php" class="text-center btn btn-success btn-lg mt-5 text-white">Voltar</a>
              </div>
            <?php }?>
        </div>
    </div>
</body>
</html>