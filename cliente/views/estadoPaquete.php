<?php

require "../controllers/clasePaquete.php";
$clasePaquetes = new paquete();

if(empty($_POST['codigoRastreo'])){

    header("Location:index.php");

}else{


    $codigoRastreo = $_POST['codigoRastreo']; 
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
        <a href="index.php">Rastrear Paquete</a>
    </nav>
    <br>
    <br>

    <div id="banner" >
        
    <img src="img/bannerRastreo.png" class="imgBanner">

    <div class="containerPaquetes">

      
        <?php

        $paquete = $clasePaquetes->getPaquetePorCodigo($codigoRastreo);
        if($paquete==null){

            ?>
            <div class="msjEliminar">
                <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
                <a class="msj">Codigo de rastreo no existente</a><br><br>
                <a href="index.php"><button class="volverError">Volver</button></a>
              
            </div>

            <br><br>

        <?php

        }else{

            ?>
            <br>
            <label id="lblProceso">Proceso</label>
            <br>
            <img id="proceso" src="img/proceso.png" width="200px">
            <br>
            <h1>Estado del paquete</h1>
            <br>


            <?php
        $date = date_create($paquete['fechaPedido']);


        $fechaPedido = date_format($date, "d/M H:i");
        $fechaPedidoTraducida = str_replace("/", " de ", $fechaPedido);
        ?>

        <div class="pedidos">

            <br>
            <?php

            switch ($paquete['estado']) {

                case "Armado";

            ?>
                    <img src="img/armadoGif.gif" width="90px">
                    <h3><?php echo $paquete['estado'] ?></h3>
                    <br>
                    <li class="fecha"><?php echo $fechaPedidoTraducida ?></li>
                    <script>
                        $('#proceso').attr("src", "img/procesoPaqueteListo.png")
                    </script>

                <?php
                    break;



                case "En el camion";

                ?>
                    <img src="img//camionGif.gif" width="90px">
                    <h3><?php echo $paquete['estado'] ?></h3>
                    <br>
                    <li class="fecha"><?php echo $fechaPedidoTraducida ?></li>
                    <script>
                        $('#proceso').attr("src", "img/procesoCamionListo.png")
                    </script>

                <?php
                    break;


                case "En almacen Quick Carry";

                ?>
                    <img src="img/almacenGif.gif" width="90px">
                    <h3><?php echo 'Quick Carry' ?></h3>
                    <br>
                    <li class="fecha"><?php echo $fechaPedidoTraducida ?></li>
                    <script>
                        $('#proceso').attr("src", "img/procesoAlmacenListo.png")
                    </script>

                <?php
                    break;


                case "En camino";

                ?>
                    <img src="img/enCaminoGif.gif" width="90px">
                    <h3><?php echo $paquete['estado'] ?></h3>
                    <br>
                    <li class="fecha"><?php echo $fechaPedidoTraducida ?></li>
                    <script>
                        $('#proceso').attr("src", "img/procesoEnCaminoListo.png")
                    </script>
                <?php
                    break;

                case "Entregado";

                ?>
                    <img src="img/paqueteEntregado.png" width="90px">
                    <h3><?php echo $paquete['estado'] ?></h3>
                    <br>
                    <li class="fecha"><?php echo $fechaPedidoTraducida ?></li>
                    <script>
                        $('#proceso').attr("src", "img/procesoEntregadoListo.png")
                    </script>

            <?php
                    break;
            }




            ?>

            <br>

            <label class="producto">Producto:</label>
            <br>
            <label class="producto"><?php echo $paquete['nombre'] ?></label>
            <div class="btnDetalles">
                <a href="detallesPedido.php?idPaquete=<?php echo $paquete['idPaquete'] ?>">
                    <button onclick="">Detalles</button></a>

            </div>

        </div>

        <?php

        }

            ?>
        </div>

        

</body>





</html>