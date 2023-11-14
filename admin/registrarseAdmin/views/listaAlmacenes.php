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
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Almacen</title>
</head>

<body>

    <header>

        <a href="index.php">
            <img src="img/atras.png" width="30px">
        </a>
        <h1>Panel Administrador</h1>
        <div onclick="mostrarMenu()">
            <img class="userImg" src="img/miPerfil.png" width="30px">

        </div>

    </header>



    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilAlmacen">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="editarPerfilUsuarioAdmin.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesionAlmacen">
            <img src="img/apagado.png" width="18px">
            <a href="../controllers/cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>

    <?php


    require('../controllers/claseAlmacen.php');
    $claseAlmacen = new almacen();

    $registros = $claseAlmacen->traerAlmacenes();


    ?>
    <div id="containerTable">

    <div id="containerBuscador">
            <input type="text" id="buscador" placeholder="Buscar...">
        </div>

        <div id="imgBuscar">
            <img src="img/lupa.png">
        </div>

        <br><br>
        <h1>Paquetes</h1><br><br>
        <img src="img/almacen.png" width="70px">
        <hr>
        <?php
        if ($registros->fetch_array() != null) {
        ?>

            <table id="tableAlmacen">
                <thead>
                    <tr id="headTable">
                        <th>N° Paquete</th>
                        <th>Departamento</th>
                        <th>Direccion</th>
                        <th>Opciones</th>
        </tr>
                </thead>

                <?php
                $almcenes = $claseAlmacen->traerAlmacenes();
                foreach ($almcenes->fetch_all(MYSQLI_ASSOC) as $almacen) {

                    if($almacen['numAlmacen']!=20){
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $almacen['numAlmacen'] ?></td>
                            <td><?php echo $almacen['departamento'] ?></td>
                            <td><?php echo $almacen['direccion'] ?></td>
                            <td title="Ver paquetes"><a href="paquetesAlmacen.php?numAlmacen=<?php echo $almacen['numAlmacen'] ?>">
                                    <div id="verPaquetes"><img src="img/buscar.png"></div>
                                </a> </td>


                </tr>
                    </tbody>
                <?php
                    }
                }

                ?>
                <br>

            <?php
        } else {
            ?>
                <div class="advertenciaPedidos">

                    <img src="img/advertenciaPedidos.png">
                    <br>
                    <h2>No hay almacenes registrados aun </h2>
                    <br>
                </div>

            <?php

        }

            ?>
            </table>
    </div>




    ?>



</body>

<script>
    var menuPerfil = document.getElementById('menuPerfilAlmacen');

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
           
            $.each($("#tableAlmacen tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
</script>
</script>


</script>

</html>