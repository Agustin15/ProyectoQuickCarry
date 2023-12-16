<?php

session_id("sessionAdmin");
session_start();

if (empty($_SESSION['id'])) {

?>
    <?php

    header('Location:../../controllers/login.html');
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
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Actualizacion de datos del cliente Crecom</title>
</head>

<body>

    <header>


        <a href="index.php">
            <img src="img/atras.png" width="30px">
        </a>
        <h1>Panel administrador</h1>
        <div onclick="mostrarMenu()" class="miPefil">
            <img class="userImg" src="img/miPerfil.png" width="30px">

        </div>
    </header>

    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilBorrarFuncionario">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="../../../views/editarPerfilUsuarioAdmin.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesionBorrarFuncionario">
            <img src="img/apagado.png" width="18px">
            <a href="../../../controllers/cerrarSesion.php">Cerrar Sesion</a>
        </div>
    </div>

    <?php


    if (
        isset($_POST['id']) &&
        isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['usuario'])
        && isset($_POST['direccion']) && isset($_POST['correo'])
    ) {

        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $usuario = $_POST['usuario'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];




        $repetidoUsuarioEnClienteCrecom = $claseDatosUsuario->comprobarUsuarioActualizado($usuario, $id);
        $repetidoUsuarioEnFuncioCrecom = $claseDatosUsuario->comprobarUsuarioRepetidoFuncioCrecom($usuario);
        $repetidoUsuarioEnAdmin = $claseDatosUsuario->comprobarUsuarioRepetidoAdmin($usuario);
        $repetidoUsuarioEnChofer = $claseDatosUsuario->comprobarUsuarioRepetidoChofer($usuario);
        $repetidoUsuarioEnFuncioQuick = $claseDatosUsuario->comprobarUsuarioRepetidoFuncioQuick($usuario);


        $repetidoCorreoEnClienteCrecom = $claseDatosUsuario->comprobarCorreoActualizado($correo, $id);
        $repetidoCorreoEnFuncioCrecom = $claseDatosUsuario->comprobarCorreoRepetidoFuncioCrecom($correo);
        $repetidoCorreoEnAdmin = $claseDatosUsuario->comprobarCorreoRepetidoAdmin($correo);
        $repetidoCorreoEnFuncioQuick = $claseDatosUsuario->comprobarCorreoRepetidoFuncioQuick($correo);
        $repetidoCorreoEnChofer = $claseDatosUsuario->comprobarCorreoRepetidoChofer($correo);


        if (
            $repetidoCorreoEnAdmin > 0 || $repetidoCorreoEnChofer > 0
            || $repetidoCorreoEnFuncioQuick > 0 || $repetidoCorreoEnClienteCrecom == true
            ||  $repetidoCorreoEnFuncioCrecom > 0

        ) {


    ?>

            <div class="msjEliminar">

                <br>
                <img class="iconoMsj" src="img/advertencia.png" width="40px">

                <br><br>

                Correo ingresado ya en uso
                <br><br>

                <button onclick="volver()" class="volverError">Volver</button>
                <div>

                    <?php
                } else {

                    if (
                        $repetidoUsuarioEnClienteCrecom == true  || $repetidoUsuarioEnAdmin > 0
                        || $repetidoUsuarioEnChofer > 0 || $repetidoUsuarioEnFuncioQuick > 0
                        || $repetidoUsuarioEnFuncioCrecom > 0
                    ) {

                    ?>

                        <div class="msjEliminar">

                            <br>
                            <img class="iconoMsj" src="img/advertencia.png" width="40px">

                            <br><br>

                            Usuario ya existente
                            <br><br>

                            <button onclick="volver()" class="volverError">Volver</button>
                            <div>

                                <?php
                            } else {

                                $sentencia = $claseDatosUsuario->modificarUsuario(
                                    $nombre,
                                    $apellido,
                                    $usuario,
                                    $correo,
                                    $direccion,
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
                                        <div>

                                <?php
                                }
                            }
                        }
                    } else {

                                ?>

                                <div class="msjEliminar">

                                    <br>
                                    <img class="iconoMsj" src="img/advertencia.png" width="40px">

                                    <br><br>

                                    Datos no encontrados
                                    <br><br>

                                    <button onclick="volver()" class="volverError">Volver</button>
                                    <div>

                                    <?php
                                }


                                    ?>



                                    <script>
                                        function volver() {

                                            location.href = "modificarClienteCrecom.php?id=<?php echo $id?>";

                                        }


                                        var menuPerfil = document.getElementById('menuPerfilBorrarFuncionario');




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