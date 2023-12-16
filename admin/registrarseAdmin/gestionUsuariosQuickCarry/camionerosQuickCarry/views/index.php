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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>Registros Choferes QuickCarry</title>
</head>

<body>


    <header>

        <a href="../../../views/index.php">
            <img class="userImg" src="img/atras.png" width="30px">
        </a>
        <h1>Usuarios Choferes</h1>
        <div onclick="mostrarMenu()" class="miPefil">
            <img class="userImg" src="img/miPerfil.png" width="30px">

        </div>
    </header>


    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilChoferes">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="../../../views/editarPerfilUsuarioAdmin.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesionChoferes">
            <img src="img/apagado.png" width="18px">
            <a href="../../../controllers/cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>

    <?php


    require('../controllers/claseDatosUsuario.php');
    $claseDatosUsuario = new datosUsuario();

    $registros = $claseDatosUsuario->traerDatos();


    ?>
    <div id="containerTable">
        <br>


        <div id="containerBuscador">
            <input type="text" id="buscador" placeholder="Buscar...">
        </div>

        <div id="imgBuscar">
            <img src="img/lupa.png">
        </div>
        
        <a href="agregarCamioneroQuick.php"><button id="agregar">Agregar Chofer QuickCarry</button></a>
        <br><br>
        <hr>
        <?php

        if ($registros->fetch_array() != null) {
        ?>

            <table id="tableChoferes">

            <thead>
                <tr id="headTable">
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Opciones</th>
                <tr>
                </thead>

                    <?php
                    $usuarios = $claseDatosUsuario->traerDatos();
                    foreach ($usuarios->fetch_all(MYSQLI_ASSOC) as $usuario) {

                    ?>
                    <tbody>
                <tr>
                    <td><?php echo $usuario['id'] ?><img src="img/usuario.png" width="20px"></td>
                    <td><?php echo $usuario['nombre'] ?></td>
                    <td><?php echo $usuario['apellido'] ?></td>


                    <td>
                        <div id="eliminar"><a href="borrarCamioneroQuick.php?id=<?php echo $usuario['id'] ?>">Eliminar</a>
                        </div>
                        <div id="modificar"><a href="modificarCamioneroQuick.php?id=<?php echo $usuario['id'] ?>">Modificar</a></div>
                        <div id="masInfo"><a href="datosCamioneroQuick.php?id=<?php echo $usuario['id'] ?>">Mas Info</a></div>
                    </td>
                <tr>

                </tbody>
                <?php

                    }


                ?>
                <br>

            <?php
        } else {

            ?>
                <div class="advertenciaPedidos">

                    <img src="img/advertenciaPedidos.png">
                    <br>
                    <br>
                    <h2>No hay choferes registrados aun </h2>
                    <br>
                </div>

            <?php

        }

            ?>
            </table>
    </div>




</body>



<script>
    var menuPerfil = document.getElementById('menuPerfilChoferes');



    function mostrarMenu() {

        menuPerfil.style.visibility = 'visible';
        menuPerfil.classList.add('active');

    }


    function ocultarMenu() {


        menuPerfil.style.visibility = 'hidden';
        menuPerfil.classList.remove('active');

    }

    
    
    $(document).ready(function() {
        $("#buscador").keyup(function() {
            _this = this;
          
            $.each($("#tableChoferes tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
</script>

</html>