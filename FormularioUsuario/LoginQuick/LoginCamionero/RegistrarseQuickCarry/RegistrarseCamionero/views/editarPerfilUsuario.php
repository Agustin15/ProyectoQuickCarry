<?php

session_id("sessionChofer");
session_start();

if (empty($_SESSION['id'])) {

?>
    <?php

    header('Location:../controller/login.html');
    ?>
<?php
}

require("../controller/claseEditarPerfil.php");
$claseEditarPerfil = new editarPerfil();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Editar Perfil</title>
</head>

<body>
    <header>

        <a href="index.php">
            <img src="img/atras.png" width="30px">
        </a>
        <h1>Editar Perfil</h1>

        <div onclick="mostrarMenu()" class="miPefil">
            <img class="userImg" src="img/miPerfil.png" width="30px">

        </div>
    </header>


    <br>

    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfil">

        <img src="img/miPerfil.png" width="60px">
        <!--muestra  el nombre de usuario de la session en el menu del usuario-->
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="editarPerfilUsuario.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesion">
            <img src="img/apagado.png" width="18px">
            <a href="../controller/cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>

    <br>

    <div class="containerDatosPerfil">

        <div id="avisoDatosExistentes">

            <div class="containerInfo">
                <img src="img/exclamacion.png" width="17px">
                <a>Error</a>
            </div>
            <h2 id="msjAviso"></h2>

        </div>

        <form id="formEditarPerfil" method="POST">

            <div class="tituloEditar">
                <h1>Datos del Perfil</h1>
            </div>


            <div class="containerInputsEditar">





                <div class="inputIzqEditar">



                    <label class="lblUsuario">Usuario</label>
                    <br>
                    <input class="inputUsuarioEditar" name="usuario" type="text" value="<?php echo $_SESSION['usuario'] ?>">

                    <br><br>
                    <label class="lblNombreEditar">Nombre</label>
                    <br>

                    <input type="text" name="nombre" value="<?php echo $_SESSION['nombre'] ?>">

                    <br><br>
                    <label class="lblCorreoEditar">Correo</label>
                    <br>

                    <input  type="email"  name="correo" value="<?php echo $_SESSION['correo'] ?>">

                    <br><br>

                </div>


                <div class="inputDerEditar">


                    <label class="lblCedulaEditar">C.I</label>
                    <br>

                    <input type="text" name="cedula" maxlength="8" value="<?php echo $_SESSION['cedula'] ?>">
                    <br><br>

                    <label class="lblApellidoEditar">Apellido</label>
                    <br>

                    <input type="text" name="apellido" value="<?php echo $_SESSION['apellido'] ?>">

                    <br><br>
                    <label class="lblContraseniaEditar">N° Camionero</label>
                    <br>

                    <input type="text" name="numCamionero" value="<?php echo $_SESSION['numChoferCamion'] ?>">

                    <br>
                </div>
            </div>
            <br><br>
            <input class="guardarCambios" id="guardarCambios" type="submit" value="Guardar cambios">

        </form>

        <div class="containerUsuario">

            <img src="img/miPerfil.png">
            <br>
            <br>
            <a>Puesto: Chofer</a>
            <br>

            <?php 

           if(isset($_SESSION['matriculaCamion'])){

            ?>
            <a>Camion: <?php echo $_SESSION['matriculaCamion'] ?></a>

            <?php
           }else{

            ?>
            <a>Camion: no elegido</a>

            <?php
           }

            ?>
           
        </div>
    </div>
</body>

<?php

?>
<script>



</script>


<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $numCamionero = $_POST['numCamionero'];
    $cedula = $_POST['cedula'];


    $repetidoUsuarioChofer = $claseEditarPerfil->comprobarUsuarioActualizado($usuario, $_SESSION['id']);
    $repetidoUsuarioFuncioQuick = $claseEditarPerfil->UsuarioRepetidoFuncioQuick($usuario);
    $repetidoUsuarioCrecom = $claseEditarPerfil->UsuarioRepetidoCrecom($usuario);
    $repetidoClienteEnCrecom = $claseEditarPerfil->comprobarUsuarioRepetidoClienteCrecom($usuario);
    $repetidoUsuarioAdmin = $claseEditarPerfil->usuarioRepetidoAdmin($usuario);

    $repetidoCorreoChofer = $claseEditarPerfil->comprobarCorreoActualizado($correo, $_SESSION['id']);
    $repetidoCorreoFuncioQuick = $claseEditarPerfil->comprobarCorreoRepetidoFuncioQuick($correo);
    $repetidoCorreoCrecom = $claseEditarPerfil->comprobarCorreoRepetidoCrecom($correo);
    $repetidoCorreoAdmin = $claseEditarPerfil->comprobarCorreoRepetidoAdmin($correo);
    $repetidoCorreoEnClienteCrecom = $claseEditarPerfil->comprobarCorreoRepetidoClienteCrecom($correo);


    $repetidoCedulaChofer = $claseEditarPerfil->comprobarCedulaActualizado($cedula, $_SESSION['id']);
    $repetidoCedulaFuncioQuick = $claseEditarPerfil->comprobarCedulaRepetidoFuncioQuick($cedula);
    $repetidoCedulaCrecom = $claseEditarPerfil->comprobarCedulaRepetidoCrecom($cedula);


    $repetidoNumCamionero = $claseEditarPerfil->comprobarNumCamioneroActualizado($numCamionero, $_SESSION['id']);


    if ($repetidoNumCamionero == true) {

?>
        <script>
            document.getElementById("avisoDatosExistentes").style.visibility = "visible";
            document.getElementById("msjAviso").innerHTML = 'N° chofer ya en uso';
        </script>
        <?php
    } else {

        if (
            $repetidoCorreoAdmin > 0 || $repetidoCorreoCrecom > 0
            || $repetidoCorreoChofer == true || $repetidoCorreoFuncioQuick > 0
            ||  $repetidoCorreoEnClienteCrecom > 0
        ) {

        ?>
            <script>
                document.getElementById("avisoDatosExistentes").style.visibility = "visible";
                document.getElementById("msjAviso").innerHTML = 'Correo ya en uso';
            </script>
            <?php
        } else {


            if ($repetidoCedulaChofer == true || $repetidoCedulaCrecom > 0 || $repetidoCedulaFuncioQuick > 0) {

            ?>
                <script>
                    document.getElementById("avisoDatosExistentes").style.visibility = "visible";
                    document.getElementById("msjAviso").innerHTML = 'Cedula ya en uso';
                </script>
                <?php
            } else {


                if (
                    $repetidoUsuarioCrecom > 0  || $repetidoUsuarioAdmin > 0
                    || $repetidoUsuarioChofer == true || $repetidoUsuarioFuncioQuick > 0
                    || $repetidoClienteEnCrecom > 0
                ) {
                ?>
                    <script>
                        document.getElementById("avisoDatosExistentes").style.visibility = "visible";
                        document.getElementById("msjAviso").innerHTML = 'Usuario ya en uso';
                    </script>
                <?php
                } else {


                    $sentencia = $claseEditarPerfil->modificarUsuario(
                        $nombre,
                        $apellido,
                        $usuario,
                        $numCamionero,
                        $cedula,
                        $correo,
                        $_SESSION['id']
                    );
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['apellido'] = $apellido;
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['correo'] = $correo;
                    $_SESSION['numCamionero'] = $numCamionero;
                    $_SESSION['cedula'] = $cedula;

                ?>

                    <script>
                        location.href = "editarPerfilUsuario.php";
                    </script>

<?php
                }
            }
        }
    }
}

?>


<script>
    
    var menuPerfil = document.getElementById('menuPerfil');




    function mostrarMenu() {



        menuPerfil.classList.add('active');

    }



    function ocultarMenu() {



        menuPerfil.classList.remove('active');

    }


  
</script>

</html>