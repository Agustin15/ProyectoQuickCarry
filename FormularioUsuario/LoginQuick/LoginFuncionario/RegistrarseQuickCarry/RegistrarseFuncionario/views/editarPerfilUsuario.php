<?php

session_id("sessionFuncioQuick");
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
    <br>


    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilEditar">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="editarPerfilUsuario.php"><button>Editar perfil</button></a>
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

            <br>

                <label class="lblUsuario">Usuario</label>
                <br>
                <input class="inputUsuarioEditar" name="usuario" id="inputUsuario" type="text" value="<?php echo $_SESSION['usuario'] ?>">


                <div class="inputIzqEditar">
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
                    <label class="lblApellidoEditar">Apellido</label>
                    <br>

                    <input type="text" name="apellido" value="<?php echo $_SESSION['apellido'] ?>">

                    <br><br>

                    <label class="lblCI">C.I</label>
                    <br>

                    <input type="text" name="cedula" maxlength="8" value="<?php echo $_SESSION['cedula'] ?>">
                </div>
            </div>
            <br><br>

            <label class="lblNumFuncio">N° Funcionario</label>
            <br>

            <input type="number" class="inputFuncio" name="numFuncio" min="1" value="<?php echo $_SESSION['numFuncio'] ?>">
            <br>
            <br>
            <input class="guardarCambios" id="guardarCambios" type="submit" value="Guardar cambios">
        </form>

        <div class="containerUsuario">

            <img src="img/miPerfil.png">
            <br>
            <br>
            <a>Puesto:<br>Funcionario Quick Carry</a>
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
    $numFuncio = $_POST['numFuncio'];
    $cedula = $_POST['cedula'];




    $repetidoUsuarioCrecom = $claseEditarPerfil->usuarioRepetidoCrecom($usuario);
    $repetidoUsuarioFuncioQuick = $claseEditarPerfil->comprobarUsuarioActualizado($usuario, $_SESSION['id']);
    $repetidoUsuarioChofer = $claseEditarPerfil->usuarioRepetidoChofer($usuario);
    $repetidoClienteEnCrecom = $claseEditarPerfil->comprobarUsuarioRepetidoClienteCrecom($usuario);
    $repetidoUsuarioAdmin = $claseEditarPerfil->usuarioRepetidoAdmin($usuario);

    $repetidoCorreoCrecom = $claseEditarPerfil->comprobarCorreoRepetidoCrecom($correo);
    $repetidoCorreoFuncioQuick = $claseEditarPerfil->comprobarCorreoActualizado($correo, $_SESSION['id']);
    $repetidoCorreoChofer = $claseEditarPerfil->comprobarCorreoRepetidoChofer($correo);
    $repetidoCorreoEnClienteCrecom = $claseEditarPerfil->comprobarCorreoRepetidoClienteCrecom($correo);
    $repetidoCorreoAdmin = $claseEditarPerfil->comprobarCorreoRepetidoAdmin($correo);


    $repetidoCedulaCrecom = $claseEditarPerfil->comprobarCedulaRepetidoCrecom($cedula);
    $repetidoCedulaFuncioQuick = $claseEditarPerfil->comprobarCedulaActualizado($cedula, $_SESSION['id']);
    $repetidoCedulaChofer = $claseEditarPerfil->comprobarCedulaRepetidoChofer($cedula);



    $repetidoNumFuncio = $claseEditarPerfil->comprobarNumFuncioActualizado($numFuncio, $_SESSION['id']);

    if ($repetidoNumFuncio == true) {
?>
        <script>
            document.getElementById("avisoDatosExistentes").style.visibility = "visible";
            document.getElementById("msjAviso").innerHTML = 'N° funcionario ya en uso';
        </script>
        <?php
    } else {

        if (
            $repetidoCorreoAdmin > 0 || $repetidoCorreoCrecom > 0
            || $repetidoCorreoChofer > 0 || $repetidoCorreoFuncioQuick == true
            || $repetidoCorreoEnClienteCrecom > 0
        ) {

        ?>
            <script>
                document.getElementById("avisoDatosExistentes").style.visibility = "visible";
                document.getElementById("msjAviso").innerHTML = 'Correo ya en uso';
            </script>
            <?php
        } else {


            if ($repetidoCedulaChofer > 0 || $repetidoCedulaCrecom > 0 || $repetidoCedulaFuncioQuick == true) {

            ?>
                <script>
                    document.getElementById("avisoDatosExistentes").style.visibility = "visible";
                    document.getElementById("msjAviso").innerHTML = 'Cedula ya en uso';
                </script>
                <?php
            } else {


                if (
                    $repetidoUsuarioCrecom > 0  || $repetidoUsuarioAdmin > 0
                    || $repetidoUsuarioChofer > 0 || $repetidoUsuarioFuncioQuick == true
                    ||  $repetidoClienteEnCrecom > 0
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
                        $numFuncio,
                        $cedula,
                        $correo,
                        $_SESSION['id']
                    );

                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['apellido'] = $apellido;
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['correo'] = $correo;
                    $_SESSION['numFuncio'] = $numFuncio;
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
    var menuPerfil = document.getElementById('menuPerfilEditar');



    function mostrarMenu() {



        menuPerfil.classList.add('active');

    }



    function ocultarMenu() {



        menuPerfil.classList.remove('active');

    }


    function cerrarAviso() {

        document.getElementById('perfilDatosGuardados').classList.remove("active");

    }
</script>

</html>