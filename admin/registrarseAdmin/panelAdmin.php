<?php


//el archivo recibe los datos de la api de autenticacion del switch login y con el post los guarda en las variables

$datosUsuario = $_GET['datos'];

$datosDecodificadosJson = urldecode($datosUsuario);

$datosDecodificadosUsuario = json_decode($datosDecodificadosJson, true);



// si el parametro de la id es vacio entonces regresa al login
if (empty($datosDecodificadosUsuario['id'])) {

?>
    <?php

    header('Location:login.html')
    ?>

<?php
}else{
    session_start();

    $_SESSION['id'] = $datosDecodificadosUsuario['id'];
    $_SESSION['nombre'] =  $datosDecodificadosUsuario['nombre'];
    $_SESSION['apellido'] =  $datosDecodificadosUsuario['apellido'];
    $_SESSION['usuario'] =  $datosDecodificadosUsuario['usuario'];
    $_SESSION['correo'] =  $datosDecodificadosUsuario['correo'];
    $_SESSION['contrasenia'] =  $datosDecodificadosUsuario['contrasenia'];

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <title>Gestion de Usuarios</title>
</head>

<body>



    <header>

        <h2>Panel administrador</h2>

        <div onclick="mostrarMenu()" class="miPefil">
            <img class="userImg" src="img/miPerfil.png" width="30px">

        </div>
    </header>


    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfil">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <button>Editar perfil</button>
        <br>
        <br>
        <hr>

        <div class="cerrarSesion">
            <img src="img/apagado.png" width="18px">
            <a href="cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>

    <br>
    <br>

    <br>

    <br>
    <div id="containerQuick">
        <h2>Editar</h2>


        <br>
        <a href="gestionUsuariosQuickCarry/camionerosQuickCarry/index.php">
            <button class="image-button">Choferes
                <img src="img/usuario.png" style="width:20px;">

            </button>
        </a>

        <br>
        <br>


        <button onmouseenter="mostrarNav()" class="image-button">Funcionarios
            <img src="img/usuario.png" style="width:20px;">
        </button>
        <nav id="navFuncionarios" onmouseleave="ocultarNav()">
            <li onmouseleave="ocultarNav()"><a href="http://localhost/dashboard/Proyecto%20Diseño/admin/registrarseAdmin/gestionUsuariosCrecom/index.php">Crecom</a></li>

        </nav>


        <br>
        <br>
        <div id="btnAlmacen" class=".active">
            <a href="listaLotes.php">
                <button class="image-button">Almacen
                    <img src="img/almacen.png" style="width:24px;">
                </button>
            </a>
        </div>
    </div>




    <script>
        var navFuncionarios = document.getElementById('navFuncionarios');
        var menuPerfil = document.getElementById('menuPerfil');

        var btnAlmacen = document.getElementById('btnAlmacen');



        function mostrarNav() {



            navFuncionarios.style.visibility = 'visible';
            btnAlmacen.classList.add('active');


        }


        function ocultarNav() {


            navFuncionarios.style.visibility = 'hidden';
            btnAlmacen.classList.remove('active');


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