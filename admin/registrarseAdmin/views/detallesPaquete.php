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



$idPaquete = $_GET['idPaquete'];


require('../controllers/claseAlmacen.php');
$claseAlmacen = new almacen();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Paquete <?php echo $idPaquete ?></title>
</head>

<body>

    <header>

        <a href="javascript:history.back();">
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

                 
    

    <div id="containerDetalles">

<?php
$paquete = $claseAlmacen->detallesPaquete($idPaquete);

$datosPaquete = $paquete->fetch_array();
?>
<br>
<h2>Paquete</h2>
<div class="imgPaquete"><img src="img/paquete.png" width="30px"></div>

<?php echo $idPaquete;?>
<br><br>
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


<br>
<br>
<h2>Cliente</h2>
<div class="imgCliente"><img src="img/usuario.png" width="30px"></div>
<br>


<?php
$cliente = $claseAlmacen->cliente($datosPaquete['idCliente']);

$datosCliente= $cliente->fetch_array();
?>

<?php

if ($datosCliente['usuario'] != null) {


 ?>

    <label><?php echo $datosCliente['usuario'] ?></label>

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
if ($datosPaquete['matriculaCamion'] != null) {


    $choferCamion = $claseAlmacen->choferCamion($datosPaquete['matriculaCamion']);

?>

    <label><?php echo $choferCamion['nombre'] ?></label>

<?php
} else {

    echo '-';
}
?>


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
</script>


</html>