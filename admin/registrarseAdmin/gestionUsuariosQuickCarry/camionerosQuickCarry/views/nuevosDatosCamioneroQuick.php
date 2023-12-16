<?php

session_id("sessionAdmin");
session_start();

if (empty($_SESSION['id'])) {

?>
    <?php

    header('Location:../../../controllers/login.html');
    ?>
<?php
}

require('../controllers/claseDatosUsuario.php');
$claseDatosUsuario = new datosUsuario();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <title>Actualizacion de datos del camionero</title>
</head>

<body>


    <header>

        <a href="index.php">
            <img class="userImg" src="img/atras.png" width="30px">
        </a>
        <h1>Usuarios Choferes</h1>
        <div onclick="mostrarMenu()" class="miPefil">
            <img class="userImg" src="img/miPerfil.png" width="30px">

        </div>
    </header>

    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilBorrarChofer">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="../../../views/editarPerfilUsuarioAdmin.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesionBorrarChofer">
            <img src="img/apagado.png" width="18px">
            <a href="../../controllers/cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>

    <?php



    if (
        isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['usuario'])
        && isset($_POST['numCamionero']) && isset($_POST['cedula']) &&
        isset($_POST['correo']) && isset($_POST['matricula'])
    ) {

        $id = $_POST['id'];
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $numCamionero = $_POST['numCamionero'];
        $matricula = $_POST['matricula'];
        $cedula = $_POST['cedula'];
        $correo = $_POST['correo'];




        $repetidoUsuarioEnChofer = $claseDatosUsuario->comprobarUsuarioActualizado($usuario, $id);
        $repetidoUsuarioEnCrecom = $claseDatosUsuario->comprobarUsuarioRepetidoCrecom($usuario);
        $repetidoUsuarioEnClienteCrecom = $claseDatosUsuario->comprobarUsuarioRepetidoClienteCrecom($usuario);
        $repetidoUsuarioEnAdmin = $claseDatosUsuario->comprobarUsuarioRepetidoAdmin($usuario);
        $repetidoUsuarioEnFuncioQuick = $claseDatosUsuario->comprobarUsuarioRepetidoFuncioQuick($usuario);


        $repetidoNumCamionero = $claseDatosUsuario->comprobarNumCamioneroActualizado($numCamionero, $id);


        $repetidoCedulaEnChofer = $claseDatosUsuario->comprobarCedulaActualizado($cedula, $id);
        $repetidoCedulaEnCrecom = $claseDatosUsuario->comprobarCedulaRepetidoCrecom($cedula);
        $repetidoCedulaEnFuncioQuick = $claseDatosUsuario->comprobarCedulaRepetidoFuncioQuick($cedula);


        $repetidoCorreoEnChofer = $claseDatosUsuario->comprobarCorreoActualizado($correo, $id);
        $repetidoCorreoEnClienteCrecom = $claseDatosUsuario->comprobarCorreoRepetidoClienteCrecom($correo);
        $repetidoCorreoEnCrecom = $claseDatosUsuario->comprobarCorreoRepetidoCrecom($correo, $id);
        $repetidoCorreoEnAdmin = $claseDatosUsuario->comprobarCorreoRepetidoAdmin($correo);
        $repetidoCorreoEnFuncioQuick = $claseDatosUsuario->comprobarCorreoRepetidoFuncioQuick($correo);

        $repetidoMatriculaActualizado = $claseDatosUsuario->comprobarMatriculaActualizado($matricula, $id);
        



        if ($repetidoMatriculaActualizado == true) {


    ?>
            <div class="msjEliminar">
                <br>
                <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
                <a class="msj">Matricula ingresada ya en uso</a><br><br>
                <button onclick="volver()" class="volverError">Volver</button>
            </div>

        <?php

        }else{

        if (
            $repetidoCorreoEnAdmin > 0 || $repetidoCorreoEnChofer == true ||
            $repetidoCorreoEnFuncioQuick > 0 || $repetidoCorreoEnCrecom > 0 || $repetidoCorreoEnClienteCrecom > 0
        ) {


        ?>
            <div class="msjEliminar">
                <br>
                <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
                <a class="msj">Correo ingresado ya en uso</a><br><br>
                <button onclick="volver()" class="volverError">Volver</button>
            </div>

            <?php
        } else {


            if ($repetidoCedulaEnChofer == true || $repetidoCedulaEnCrecom > 0 || $repetidoCedulaEnFuncioQuick > 0) {

            ?>
                <div class="msjEliminar">
                    <br>
                    <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
                    <a class="msj">Cédula ingresada ya en uso</a><br><br>
                    <button onclick="volver()" class="volverError">Volver</button>
                </div>

                <?php
            } else {



                if (
                    $repetidoUsuarioEnChofer == true  || $repetidoUsuarioEnAdmin > 0
                    || $repetidoUsuarioEnCrecom > 0 || $repetidoUsuarioEnFuncioQuick > 0
                    || $repetidoUsuarioEnClienteCrecom > 0
                ) {

                ?>
                    <div class="msjEliminar">
                        <br>
                        <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
                        <a class="msj">Usuario ya existente</a><br><br>
                        <button onclick="volver()" class="volverError">Volver</button>
                    </div>

                    <?php
                } else {




                    if ($repetidoNumCamionero == true) {

                    ?>
                        <div class="msjEliminar">
                            <br>
                            <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
                            <a class="msj">N° Camionero ya en uso</a><br><br>
                            <button onclick="volver()" class="volverError">Volver</button>
                        </div>

                        <?php
                    } else {

                        $sentencia = $claseDatosUsuario->modificarUsuario(
                            $nombre,
                            $apellido,
                            $usuario,
                            $numCamionero,
                            $matricula,
                            $cedula,
                            $correo,
                            $id
                        );
                        if ($sentencia == true) {

                        ?>
                            <div class="msjActualizacion">

                                <img class="iconoMsj" src="img/actualizado.png" width="40px">

                                <br><br>

                                Usuario actualizado
                                <br><br>

                                <button onclick="volver()" class="volverCorrecto">Volver</button>
                            </div>

        <?php
                        }
                    }
                }
                }
            }
        }
    } else {

        ?>
        <div class="msjEliminar">
            <br>
            <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
            <a class="msj">Datos no encontrados</a><br><br>
            <button onclick="volver()" class="volverError">Volver</button>
        </div>

    <?php
    }
    ?>

    <br>



    <script>
        var menuPerfil = document.getElementById('menuPerfilBorrarChofer');



        function volver() {


            location.href = "modificarCamioneroQuick.php?id=<?php echo $id ?>";
        }

        function mostrarMenu() {


            menuPerfil.style.visibility = 'visible';
            menuPerfil.classList.add('active');

        }


        function ocultarMenu() {


            menuPerfil.style.visibility = 'hidden';
            menuPerfil.classList.remove('active');

        }
    </script>
</body>

</html>