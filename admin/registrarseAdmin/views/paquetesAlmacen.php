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



$numAlmacen = $_GET['numAlmacen'];


require('../controllers/claseAlmacen.php');
$claseAlmacen = new almacen();

$almacen = $claseAlmacen->almacenPorNumero($numAlmacen);
$datosAlmacen = $almacen->fetch_array();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>Almacen <?php echo $datosAlmacen['departamento'] ?></title>
</head>

<body>

    <header>

        <a href="listaAlmacenes.php">
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


    $registros = $claseAlmacen->paquetesDelAlmacen($numAlmacen);


    ?>
    <div id="containerTable">

    <div id="containerBuscador">
            <input type="text" id="buscador" placeholder="Buscar...">
        </div>

        <div id="imgBuscar">
            <img src="img/lupa.png">
        </div>
        <br><br>

        <h1>Paquetes de <?php echo $datosAlmacen['departamento'] ?></h1><br><br>
        <img src="img/listaPaquetes.png" width="60px">
        <br>
        <hr>
        <?php
        if ($registros->fetch_array() != null) {
        ?>
            <table id="tablePaquetesAlmacen">
                <thead>

                <tr id="headTable">
                    <th>N° Paquete</th>
                    <th>Producto</th>
                    <th>Estado</th>
                    <th>Fecha Entrega</th>
                    <th>Destino</th>
                    <th>Opciones</th>
        </tr>
                </thead>

                    <?php
                    $paquetes = $claseAlmacen->paquetesDelAlmacen($numAlmacen);
                    foreach ($paquetes->fetch_all(MYSQLI_ASSOC) as $paquete) {

                    ?>

                    <tbody>
                <tr>
                    <td><?php echo $paquete['idPaquete'] ?></td>
                    <td><?php echo $paquete['nombre'] ?></td>
                    <td><?php echo $paquete['estado'] ?></td>
                    <td><?php echo $paquete['fechaEntrega'] ?></td>
                    <td><?php echo $paquete['destino'] ?></td>
                    <td title="Más informacion">
                        <a href="detallesPaquete.php?idPaquete=<?php echo $paquete['idPaquete']?>">
                            <div id="verInfoPaquete"><img src="img/informacion.png">
                            </div>
                    </td>


                    </tr>
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
                    <h2>No hay paquetes armados aun </h2>
                    <br>
                </div>

            <?php

        }

            ?>
            </table>
    </div>





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
           
            $.each($("#tablePaquetesAlmacen tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
</script>



</html>