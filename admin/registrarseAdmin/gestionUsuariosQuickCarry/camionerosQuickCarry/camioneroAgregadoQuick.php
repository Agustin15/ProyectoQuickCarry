<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <title>Estado camionero QuickCarry</title>
</head>

<body>

    <header>

        <a href="javascript:history.back()">
            <img class="userImg" src="img/atras.png" width="30px">
        </a>
        <h1>Usuarios Choferes</h1>
        <div onclick="mostrarMenu()" class="miPefil">
            <img class="userImg" src="img/miPerfil.png" width="30px">

        </div>
    </header>

    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilBorrarChofer">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario']?></h4>
        <button>Editar perfil</button>
        <br>
        <br>
        <hr>

        <div class="cerrarSesionBorrarChofer">
            <img src="img/apagado.png" width="18px">
            <a href="cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>



    <?php

    $conexion = new mysqli("localhost", "root", "", "php");

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $numCamionero = $_POST['numCamionero'];
    $matricula = $_POST['matricula'];
    $cedula = $_POST['cedula'];
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];

    $sentencia = "select * from funcionariosCrecom where usuario='$usuario'";
    $sentencia2 = "select * from camionerosQuickCarry where usuario='$usuario'";
    $sentencia3 = "select * from camionerosQuickCarry where numCamionero='$numCamionero'";
    $sentencia4 = "select * from admin where usuario='$usuario'";


    $registro = $conexion->query($sentencia);
    $registro2 = $conexion->query($sentencia2);
    $registro3 = $conexion->query($sentencia3);
    $registro4 = $conexion->query($sentencia4);

    $reg = mysqli_fetch_array($registro);
    $reg2 = mysqli_fetch_array($registro2);
    $reg3 = mysqli_fetch_array($registro3);
    $reg4 = mysqli_fetch_array($registro4);


    if ($reg > 0 || $reg2 > 0 || $reg3 > 0 || $reg4 > 0) {



        echo '<div class="msjEliminar">';
        echo '<br>';
        echo '<img class="iconoMsj" src="img/advertencia.png" width="30px"><br>';
        echo '<a class="msj">nombre de usuario o N° de chofer ya existentes</a><br>';
        echo '<button onclick="volver()" class="volverError">Volver</button>';
        echo '</div>';
    } else {
        $sentencia = "insert into camionerosQuickCarry 
    (nombre,apellido,usuario,numCamionero,cedula,correo,matricula,contrasenia) 
    values('$nombre','$apellido','$usuario','$numCamionero','$cedula','$correo','$matricula','$contrasenia')";

        $registro = $conexion->query($sentencia);

        if ($registro == true) {


            echo '<div class="msjActualizacion">';
            echo '<img class="iconoMsj" src="img/actualizado.png" width="30px"><br>';
            echo '<a class="msj">Usuario Agregado</a><br>';
            echo '<button onclick="volver()" class="volverCorrecto">Volver</button>';
            echo '</div>';
        }
    }

    $conexion->close();

    ?>




    <script>
        function volver() {

            javascript: history.back();

        }


        var menuPerfil = document.getElementById('menuPerfilBorrarChofer');


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