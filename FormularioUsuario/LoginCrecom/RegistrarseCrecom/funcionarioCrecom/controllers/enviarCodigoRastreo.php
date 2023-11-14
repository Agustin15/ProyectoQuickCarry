<?php


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class correo{


    private $mail;
    
public function __construct()
{

    
    $this->mail = new PHPMailer(true);


}

   public function  enviarCorreo($destinoCorreo,$nombreDestino,$codigoRastreo){

try {


   $this->mail->isSMTP();
   $this->mail->Host = 'smtp.gmail.com';
   $this->mail->SMTPAuth = true;
   $this->mail->SMTPSecure = 'tls';
   $this->mail->Port = 587;

   $this->mail->setFrom('quickCarry99@gmail.com', 'Quick Carry');
   $this->mail->addAddress($destinoCorreo, $nombreDestino);
   

    //Content
    $this->mail->isHTML(true);                                 
    $this->mail->Subject = 'Codigo de rastreo de su paquete';
    $this->mail->Body    = 'Buenas '.$nombreDestino.', el código de rastreo de su paquete es '.$codigoRastreo;
  
    $this->mail->Username='quickCarry99@gmail.com';
    $this->mail->Password='xthg gxin ftan tjco';


   $resultado=$this->mail->send();


   
} catch (Exception $e) {
   
}


return $resultado;
   }

 
}
