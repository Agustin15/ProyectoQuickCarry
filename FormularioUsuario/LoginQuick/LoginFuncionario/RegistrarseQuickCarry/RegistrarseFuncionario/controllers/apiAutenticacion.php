<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>

<body>



    <?php


    $opcion = $_POST['opcion'];

    require('claseAutenticacionQuick.php');
    $claseAuten = new autenticacionCrecom();

    switch ($opcion) {


      
        case "login":

            echo '<title>Iniciar sesion-Funcionario Quick Carry</title>';

            $usuario = $_POST['usuario'];
            $contrasenia = $_POST['contrasenia'];

            if (empty($usuario) || empty($contrasenia)) {


                ?>
                <?php

                include('login.html');
                ?>
                <script>
                    document.getElementById("avisoCampoLogin").innerHTML = 'Complete todos los campos';
                </script>

                <?php
            } else {

                $regUsuario = $claseAuten->consultaPorUsuarioExistente($usuario);



                if ($regUsuario > 0) {
                    if (password_verify($contrasenia, $regUsuario['contrasenia'])) {

                        $datos = array(

                            'id' => $regUsuario['id'], 'nombre' => $regUsuario['nombre'],
                            'apellido' => $regUsuario['apellido'], 'usuario' => $regUsuario['usuario'],
                            'numFuncio' => $regUsuario['numFuncio'], 'cedula' => $regUsuario['cedula'],
                            'correo' => $regUsuario['correo'], 'contrasenia' => $regUsuario['contrasenia']

                        );


                  
                        $datosJson = json_encode($datos);
                        $ch=curl_init();
                       
                        curl_setopt($ch,CURLOPT_URL,"http://$_SERVER[HTTP_HOST]/CronosLogistics/FormularioUsuario/LoginQuick/LoginFuncionario/RegistrarseQuickCarry/RegistrarseFuncionario/views/index.php");
                        curl_setopt($ch,CURLOPT_POST,1);
                        curl_setopt($ch,CURLOPT_POSTFIELDS,array('datosJson'=>$datosJson));
                        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                        $resultado=curl_exec($ch);
                        echo $resultado;
                        curl_close($ch);

                    } else {

                ?>

                        <?php
                        include('login.html');

                        ?>
                        <script>
                            document.getElementById("avisoCampoLogin")
                                .innerHTML = 'Contrasenia incorrecta';
                        </script>
                    <?php
                    }
                } else {

                    ?>

                    <?php
                    include('login.html');

                    ?>

                    <script>
                        document.getElementById("avisoCampoLogin").innerHTML = 'Usuario incorrecto';
                    </script>
    <?php
                }
            }
            break;
    }




    ?>

</body>

</html>