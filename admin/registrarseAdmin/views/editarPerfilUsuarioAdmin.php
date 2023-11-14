<?php

session_id("sessionAdmin");
session_start();
if (empty($_SESSION['id'])) {

?>
    <?php

    header('Location:../controllers/login.html');
    ?>
<?php
}

require("../controllers/claseEditarPerfil.php");
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


    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilAlmacen">
        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <button>Editar perfil</button>
        <br>
        <br>
        <hr>

        <div class="cerrarSesionAlmacen">
            <img src="img/apagado.png" width="18px">
            <a href="../controllers/cerrarSesion.php">Cerrar Sesion</a>
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

        <br>
        <form id="formEditarPerfil" method="POST">

            <div class="tituloEditar">
                <h1>Datos del Perfil</h1>
            </div>


            <div class="containerInputsEditar">




                <div class="inputIzqEditar">
                    <label class="lblNombreEditar">Nombre</label>
                    <br>

                    <input type="text" name="nombre" value="<?php echo $_SESSION['nombre'] ?>">

                    <br><br>
                    <label class="lblCorreoEditar">Correo</label>
                    <br>

                    <input type="text" name="correo" value="<?php echo $_SESSION['correo'] ?>">
                </div>


                <div class="inputDerEditar">


                    <label class="lblUsuario">Usuario</label>
                    <br>
                    <input name="usuario" id="inputUsuario" type="text" value="<?php echo $_SESSION['usuario'] ?>">

                    <br><br>
                    <label class="lblApellidoEditar">Apellido</label>
                    <br>

                    <input type="text" name="apellido" value="<?php echo $_SESSION['apellido'] ?>">

                    <br><br>

                </div>
            </div>
            <br>
            <input class="guardarCambios" id="guardarCambios" type="submit" value="Guardar cambios">

        </form>

        <div class="containerUsuario">

            <img src="img/miPerfil.png">
            <br>
            <br>
            <a>Puesto:Admin</a>
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


    $repetidoUsuarioAdmin = $claseEditarPerfil->comprobarUsuarioActualizado($usuario, $_SESSION['id']);
    $repetidoUsuarioChofer = $claseEditarPerfil->usuarioRepetidoChofer($usuario);
    $repetidoUsuarioCrecom = $claseEditarPerfil->usuarioRepetidoCrecom($usuario);
    $repetidoClienteEnCrecom = $claseEditarPerfil->comprobarUsuarioRepetidoClienteCrecom($usuario);
    $repetidoUsuarioFuncioQuick = $claseEditarPerfil->usuarioRepetidoFuncioQuick($usuario);


    $repetidoCorreoAdmin = $claseEditarPerfil->comprobarCorreoActualizado($correo, $_SESSION['id']);
    $repetidoCorreoChofer = $claseEditarPerfil->comprobarCorreoRepetidoChofer($correo);
    $repetidoCorreoCrecom = $claseEditarPerfil->comprobarCorreoRepetidoCrecom($correo);
    $repetidoCorreoEnClienteCrecom = $claseEditarPerfil->comprobarCorreoRepetidoClienteCrecom($correo);
    $repetidoCorreoFuncioQuick = $claseEditarPerfil->ComprobarcorreoRepetidoFuncioQuick($correo);

    if (
        $repetidoCorreoAdmin == true || $repetidoCorreoChofer > 0 || $repetidoCorreoCrecom > 0
        || $repetidoCorreoFuncioQuick > 0 ||  $repetidoCorreoEnClienteCrecom > 0
    ) {

?>
        <script>
            document.getElementById("avisoDatosExistentes").style.visibility = "visible";
            document.getElementById("msjAviso").innerHTML = 'Correo ya en uso';
        </script>
        <?php
    } else {

        if (
            $repetidoUsuarioAdmin == true || $repetidoUsuarioChofer > 0 || $repetidoUsuarioCrecom > 0
            || $repetidoUsuarioFuncioQuick > 0 ||  $repetidoClienteEnCrecom > 0
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
                $correo,
                $_SESSION['id']
            );
            $_SESSION['nombre'] = $nombre;
            $_SESSION['apellido'] = $apellido;
            $_SESSION['usuario'] = $usuario;
            $_SESSION['correo'] = $correo;

        ?>

            <script>
                location.href = "editarPerfilUsuarioAdmin.php";
            </script>

<?php
        }
    }
}
?>



<script>
    var menuPerfil = document.getElementById('menuPerfilAlmacen');



    function mostrarMenu() { //mostrar menu

        menuPerfil.style.visibility = 'visible';
        menuPerfil.classList.add('active');


    }



    function ocultarMenu() { //ocultar menu


        menuPerfil.style.visibility = 'hidden';
        menuPerfil.classList.remove('active');

    }


    function cerrarAviso() {

        document.getElementById('perfilDatosGuardados').classList.remove("active");

    }
</script>

</html>