<?php



require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['nombre']) && isset($_POST['correo']) && isset($_POST['comentario'])) {

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $comentario = $_POST['comentario'];




    
    try {


        $mail = new PHPMailer(true);
        $mail2 = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail2->isSMTP();
        $mail2->Host = 'smtp.gmail.com';
        $mail2->SMTPAuth = true;
        $mail2->SMTPSecure = 'tls';
        $mail2->Port = 587;


        $mail->setFrom('quickCarry99@gmail.com', 'Quick Carry');
        $mail->addAddress("quickCarry99@gmail.com", "Quick Carry Consultas");

        
        $mail2->setFrom('quickCarry99@gmail.com', 'Quick Carry');
        $mail2->addAddress($correo,$nombre);


        
        $mail->isHTML(true);
        $mail->Subject = 'Consulta de ' . $nombre;
        $mail->Body    = 'Correo: ' . $correo . '<br>' . $comentario;

        $mail->Username = 'quickCarry99@gmail.com';
        $mail->Password = 'xthg gxin ftan tjco';


        $mail2->isHTML(true);
        $mail2->Subject = 'Consulta recibida';
        $mail2->Body    = 'Hola '.$nombre.' su consulta a sido recibida, 
        le daremos nuestra respuesta lo mas pronto posible';

        $mail2->Username = 'quickCarry99@gmail.com';
        $mail2->Password = 'xthg gxin ftan tjco';


        $resultado = $mail->send();
        $resultado2 = $mail2->send();


        if ($resultado && $resultado2) {


            include("Contacto.html");
?>

            <script>
                document.getElementById("containerError").style.visibility = "visible";
                document.getElementById("containerError").style.backgroundColor = "#50F17C";
                document.getElementById("error").innerHTML = "Aviso";
                document.getElementById("msjAviso").innerHTML = "Consulta enviada";
                setTimeout(() => {
                    location.href = "Contacto.html"
                }, 2000);
            </script>
    <?php


        }
    } catch (Exception $e) {
    }
} else {

    include("Contacto.html");
    ?>

    <script>
        document.getElementById("containerError").style.visibility = "visible";
        document.getElementById("msjAviso").innerHTML = "Datos incompletos";
    </script>
<?php

}

?>