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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <title>Datos del camionero QuickCarry</title>
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


    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilDatosChofer">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="../../../views/editarPerfilUsuarioAdmin.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesionDatosChofer"">
<img src=" img/apagado.png" width="18px">
            <a href="../../controllers/cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>

    <?php

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $reg = $claseDatosUsuario->masInfoUsuario($id);


    ?>
        <div id="containerTable">

            <br>
            <center>
                <img src="img/usuario.png" width="40px">
                <br>
                <a id="nomUsuario"><?php echo $reg['nombre'] . " " . $reg['apellido'] ?></a>
                <center>

                    <br>
                    <hr>
                    <table id="tableDetallesChofer">
                        <tr id="headTable">
                            <th>Usuario</th>
                            <th>N° Chofer</th>
                            <th>Camion a cargo</th>
                            <th>Cedula</th>
                            <th>Correo</th>

                        </tr>

                        <tr>
                            <td><?php echo $reg['usuario'] ?></td>
                            <td><?php echo $reg['numChoferCamion'] ?></td>
                            <td><?php echo $reg['matriculaCamion'] ?></td>
                            <td><?php echo $reg['cedula'] ?></td>
                            <td><?php echo $reg['correo'] ?></td>


                        </tr>

                    </table>
        </div>

    <?php
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



</body>

<script>
    function volver() {

        location.href = "index.php";

    }


    var menuPerfil = document.getElementById('menuPerfilDatosChofer');

    function mostrarMenu() {


        menuPerfil.style.visibility = 'visible';
        menuPerfil.classList.add('active');

    }


    function ocultarMenu() {


        menuPerfil.style.visibility = 'hidden';
        menuPerfil.classList.remove('active');

    }
</script>

</html>