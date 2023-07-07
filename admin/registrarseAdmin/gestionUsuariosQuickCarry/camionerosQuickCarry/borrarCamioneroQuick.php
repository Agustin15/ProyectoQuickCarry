<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <title>Borrar camionero QuickCarry</title>
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
        <h4>Usuario</h4>
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

    $id = $_GET['id'];

    $conexion = new mysqli("localhost", "root", "", "php");

    $sentencia = "select * from camionerosQuickCarry where id='$id'";

    $registro = $conexion->query($sentencia);

    echo '<div class="msjEliminar">';
    echo '<img src="img/eliminar.png" width="30px">';
    echo '<br><br>';
    if ($reg = mysqli_fetch_array($registro)) {

        $sentencia2 = "delete from camionerosQuickCarry where id=$id";

        $registro2 = $conexion->query($sentencia2);


        echo '<a class="msj">Registro de ' . $reg['nombre'] . ' eliminado</a>';
    } else {

        echo '<a class="msj">Datos no encontrados</a>';
    }

    echo '<br><br>';
    echo '<button onclick="volver()" class="volverError">Volver</button>';
    echo '</div>';
    $conexion->close();
    ?>




    <script>
        function volver() {

            javascript: history.back();

        }


        var menuPerfil = document.getElementById('menuPerfilBorrarChofer');


        var v = 1;

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