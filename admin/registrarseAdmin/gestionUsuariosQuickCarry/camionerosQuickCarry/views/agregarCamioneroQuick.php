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

$conexion = new mysqli("localhost", "root", "", "php");
$seleccionCamiones = $conexion->prepare("select * from camiones");
$seleccionCamiones->execute();
$registrosCamiones = $seleccionCamiones->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <title>Agregar Chofer QuickCarry</title>
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
    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilAgregarChoferes">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="../../../views/editarPerfilUsuarioAdmin.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesionAgregarChoferes">
            <img src="img/apagado.png" width="18px">
            <a href="../../controllers/cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>


    <form method="POST" action="camioneroAgregadoQuick.php" id="formAgregar">

        <img src="img/agregarusuario.png" width="50px">
        <br>
        <br>
        <h2>Chofer QuickCarry</h2>
        <br>
        <input placeholder="Nombre" required="true" type="text" name="nombre">
        <input placeholder="Apellido" required="true" type="text" name="apellido">
        <br>
        <br>
        <br>
        <input placeholder="Usuario" required="true" type="text" name="usuario">
        <input placeholder="N° Chofer" required="true" type="number" min="1" name="numCamionero">
        <br>
        <br>
        <br>

        <input placeholder="Cedula" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="8" required="true" type="text" name="cedula">
        <input placeholder="Correo" required="true" type="email" name="correo">
        <br>
        <br>
        <br>

        <select name="matricula">

            <?php

            require('../controllers/claseDatosUsuario.php');
            $claseDatosUsuario = new datosUsuario();

            $camiones=$claseDatosUsuario->getCamiones();

            foreach($camiones->fetch_all(MYSQLI_ASSOC) as $camion){

                ?>
                <option value="<?php echo $camion['matricula']?>"><?php echo $camion['matricula']?></option>

                <?php
            }
          ?>
        </select>
        <input placeholder="Contraseña" id="contrasenia" required="true" type="password" name="contrasenia">


        <img src="img/ocultar.png" id="estadoPassword" onclick="password()">
        <br>
        <br>
        <input type="submit" value="Agregar">

    </form>


    <script>
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

        var menuPerfil = document.getElementById('menuPerfilAgregarChoferes');



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