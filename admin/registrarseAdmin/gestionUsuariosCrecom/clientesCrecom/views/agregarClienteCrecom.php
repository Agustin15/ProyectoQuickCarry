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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <title>Agregar cliente Crecom</title>
</head>

<body>

    <header>

        <a href="index.php">
            <img class="userImg" src="img/atras.png" width="30px">
        </a>
        <h1>Panel administrador</h1>
        <div onclick="mostrarMenu()" class="miPefil">
            <img class="userImg" src="img/miPerfil.png" width="30px">

        </div>
    </header>


    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilAgregarFuncionario">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="../../../views/editarPerfilUsuarioAdmin.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesionAgregarFuncionario">
            <img src="img/apagado.png" width="18px">
            <a href="../../../controllers/cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>


    <form method="POST" action="clienteAgregadoCrecom.php" id="formAgregar">
        <img src="img/agregarusuario.png" width="50px">
        <br>
        <br>
        <h2>Cliente Crecom</h2>
        <br><br>
        <input placeholder="Nombre" required="true" type="text" name="nombre">
        <input placeholder="Apellido" required="true" type="text" name="apellido">
        <br>
        <br>
        <br>
        <input placeholder="Usuario" required="true" type="text" name="usuario">
        <input placeholder="Correo" required="true" type="email" name="correo">
        <br>
        <br>
        <br>
        <input placeholder="Direccion" required="true" type="text" name="direccion">

        <input placeholder="Contraseña" id="contrasenia" required="true" type="password" name="contrasenia">

        <img src="img/ocultar.png" id="estadoPassword" onclick="password()">
        <br>
      
        <br>
        <input type="submit" value="Agregar">

    </form>



    <script>
        //ver y ocultar contraseña
        document.getElementById("estadoPassword").style.width = "22px";

        function password() {

            if (document.getElementById("contrasenia").type === "password") {

                document.getElementById("estadoPassword").src = "img/ver.png";
                document.getElementById("contrasenia").type = "text";

            } else {

                document.getElementById("contrasenia").type = "password";
                document.getElementById("estadoPassword").src = "img/ocultar.png";


            }

        }


        var menuPerfil = document.getElementById('menuPerfilAgregarFuncionario');



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