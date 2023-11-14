<?php


$opcion = $_POST['opcion'];

require('../controllers/claseAutenticacionAdmin.php');
$claseAuten = new autenticacionAdmin();


switch ($opcion) {

    case "login":


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

                if ($contrasenia==$regUsuario['contrasenia']) {


                    $datos = array(


                        'id' => $regUsuario['id'], 'nombre' => $regUsuario['nombre'],
                        'apellido' => $regUsuario['apellido'], 'usuario' => $regUsuario['usuario'],
                        'correo' => $regUsuario['correo'], 'contrasenia' => $regUsuario['contrasenia']

                    );

  
                    $datosJson = json_encode($datos);
                    $ch=curl_init();
                   
                    curl_setopt($ch,CURLOPT_URL,"http://$_SERVER[HTTP_HOST]/CronosLogistics/admin/registrarseAdmin/views/index.php");
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
                        document.getElementById("avisoCampoLogin").innerHTML = 'Contraseña incorrecta';
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