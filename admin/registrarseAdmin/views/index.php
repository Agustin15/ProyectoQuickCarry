<?php
session_id("sessionAdmin");
session_start();

if (isset($_POST['datosJson'])) {

    $datosUsuario = $_POST['datosJson'];

    $datosDecodificadosUsuario = json_decode($datosUsuario, true);

    $_SESSION['id'] = $datosDecodificadosUsuario['id'];
    $_SESSION['nombre'] = $datosDecodificadosUsuario['nombre'];
    $_SESSION['apellido'] = $datosDecodificadosUsuario['apellido'];
    $_SESSION['usuario'] = $datosDecodificadosUsuario['usuario'];
    $_SESSION['correo'] = $datosDecodificadosUsuario['correo'];

?>

    <script>
        window.location.href = "../views/index.php";
    </script>
<?php

}



if (empty($_SESSION['id'])) {

?>
    <?php

    header('Location:../controllers/login.html');
    ?>
<?php
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

    <br>

    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfil">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="editarPerfilUsuarioAdmin.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesion">
            <img src="img/apagado.png" width="18px">
            <a href="../controllers/cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>

    <br>
    <br>

    <br>

    <br>
    <div id="containerQuick">
        <h2>DATOS</h2>


        <br>

        <div id="opciones1">

            <button onclick="choferes()" class="image-button"><a>Choferes</a>
                <img src="img/usuario.png" style="width:20px;">

            </button>
            </a>
            <br>
            <br>

            <div id="btnFuncionarios">
                <button onmouseenter="mostrarNav()" class="image-button"><a>Funcionarios</a>
                    <img src="img/usuario.png" style="width:20px;">
                </button>
            </div>
            <nav id="navFuncionarios" onmouseleave="ocultarNav()">
                <a href="../gestionUsuariosCrecom/funcionariosCrecom/views/index.php">
                    <li>Crecom</li>
                </a>

                <a onmouseleave="ocultarNav()" href="../gestionUsuariosQuickCarry/funcionariosQuickCarry/views/index.php">
                    <li>
                        Quick Carry
                    </li>
                </a>

            </nav>


            <br>
            <br>


            <div id="btnClientes" class=".active">

                <button onclick="clientes()" class="image-button"><a>Clientes</a>
                    <img src="img/usuario.png" style="width:20px;">
                </button>

            </div>
        </div>


        <div id="opciones2">
            <div id="btnCamiones">

                <button onclick="camiones()" class="image-button"><a>Camiones</a>
                    <img src="img/camion.png" style="width:24px;">
                </button>

            </div>

            <br>

            <div id="btnCamionetas">

                <button onclick="camionetas()" class="image-button"><a>Camionetas</a>
                    <img src="img/camioneta.png" style="width:28px;">
                </button>

            </div>

            <br>
            <div id="btnAlmacenes">

                <button onclick="almacenes()" class="image-button"><a>Almacen</a>
                    <img src="img/almacen.png" style="width:24px;">
                </button>

            </div>

        </div>

    </div>




    <script>
        var navFuncionarios = document.getElementById('navFuncionarios');
        var menuPerfil = document.getElementById('menuPerfil');



        function choferes() {

            location.href = "../gestionUsuariosQuickCarry/camionerosQuickCarry/views/index.php";

        }


        function clientes() {

            location.href = "../gestionUsuariosCrecom/clientesCrecom/views/index.php";

        }



        function camiones() {

            location.href = "../gestionCamiones/views/index.php";

        }


        function camionetas() {


            location.href = "../gestionCamionetas/views/index.php";

        }


        function almacenes() {


            location.href ="listaAlmacenes.php"

        }

        function mostrarNav() {

            navFuncionarios.style.visibility = 'visible';

        }



        function ocultarNav() {


            navFuncionarios.style.visibility = 'hidden';



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