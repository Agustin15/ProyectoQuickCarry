<?php


if (empty($_GET['idPaquete'])) {

    header("Location:index.php");
} else {


    $idPaquete = $_GET['idPaquete'];
    require "../controllers/clasePaquete.php";
    $clasePaquetes = new paquete();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Rastrear Paquete</title>
</head>

<body>

    <header>
        <h1>Rastrear Paquete</h1>

    </header>

    <nav>
        <a href="../../views/Index.html">Inicio</a>
        <a href="../../views/#IniciarSesion">Iniciar Sesion</a>
        <a href="../../views/Contacto.html">Contacto</a>
        <a href="../../views/SobreNosotros.html">Sobre Nosotros</a>
        <a href=javascript:history.back()>Rastrear Paquete</a>
    </nav>
    <br>
    <br>

    <div id="banner">
        <img src="img/bannerRastreo.png" class="imgBanner">


        <div id="containerDetalles">

            <?php
            $paquete = $clasePaquetes->detallesPaquete($idPaquete);

            $datosPaquete = $paquete->fetch_array();
            ?>


            <br>
            <h2>Producto</h2>
            <div class="imgProducto"><img src="img/caja.png" width="30px"></div>
            <label><?php echo $datosPaquete['nombre'] ?></label>

            <br><br>

            <?php

            switch ($datosPaquete['estado']) {

                case "Armado";

            ?>

                    <h3><?php echo $datosPaquete['estado'] ?></h3>
                    <img class="imgEstado" src="img/armadoGif.gif" width="90px">


                <?php
                    break;

                case "Pedido";

                ?>

                    <h3><?php echo $datosPaquete['estado'] ?></h3>

                    <img class="imgEstado"  src="img//pedidoGif.gif" width="90px">
                <?php
                    break;

                case "En el camion";

                ?>

                    <h3><?php echo $datosPaquete['estado'] ?></h3>
                    <img class="imgEstado"  src="img//camionGif.gif" width="90px">


                <?php
                    break;


                case "En almacen Quick Carry";

                ?>

                    <h3><?php echo $datosPaquete['estado'] ?></h3>
                    <img class="imgEstado"  src="img/almacenGif.gif" width="90px">


                <?php
                    break;


                case "En camino";

                ?>

                    <h3><?php echo $datosPaquete['estado'] ?></h3>
                    <img class="imgEstado"  src="img/enCaminoGif.gif" width="90px">

                <?php
                    break;

                case "Entregado";

                ?>

                    <h3><?php echo $datosPaquete['estado'] ?></h3>
                    <img class="imgEstado"  src="img/paqueteEntregado.png" width="90px">

            <?php
                    break;
            }

            ?>

            <h2>Entrega estimada</h2>
            <div class="imgFecha"><img src="img/calendario.png" width="30px"></div>
            <br>

            <?php

            if ($datosPaquete['fechaEntrega'] != null) {
                $date = date_create($datosPaquete['fechaEntrega']);

                $fechaEntrega = date_format($date, "d/M H:m");

                $fechaEntregaTraducida = str_replace("/", " de ", $fechaEntrega);
                echo $fechaEntregaTraducida;
            } else {

                echo "-";
            }

            ?>
            <br><br>


            <h2>Almacen de Crecom</h2>
            <div class="imgAlmacen"><img src="img/almacenDetalle.png" width="30px"></div>
            <br>

            <?php
            if ($datosPaquete['numAlmacen'] != null) {


                $almacen = $clasePaquetes->almacen($datosPaquete['numAlmacen']);

                $datosAlmacen = $almacen->fetch_array();
            ?>

                <label><?php echo $datosPaquete['numAlmacen'] . ',' . $datosAlmacen['departamento'] ?></label>

            <?php
            } else {

                echo '-';
            }
            ?>


            <br>
            <br>
            <h2>Chofer del camion</h2>
            <div class="imgChofer"><img src="img/conductor.png" width="30px"></div>
            <br>
            <?php


            $chofer = $clasePaquetes->getChofer($datosPaquete['matriculaCamion']);

            if ($chofer != null) {

            ?>

                <label><?php echo $chofer['nombre']?></label>
            <?php
            }else{

                echo "-";
            }

            ?>


        </div>

    </div>
    <br>
  

</body>


<script>
</script>

</html>