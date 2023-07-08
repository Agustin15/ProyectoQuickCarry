<?php
  session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <title>Modificar Lote</title>

</head>

<body>

<header>
 
<a href="javascript:history.back()">
<img class="userImg" src="img/atras.png" width="30px">
</a>
 <h1>Lotes del almacen</h1>
 
 <div onclick="mostrarMenu()" class="miPefil">
 <img  class="userImg" src="img/miPerfil.png" width="30px">
 
 </div>
 </header>

 <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilModificarLote">

<img src="img/miPerfil.png" width="60px">  
<h4><?php echo $_SESSION['usuario']?></h4>
<button>Editar perfil</button>
<br>
<br>
<hr>

<div class="cerrarSesionModificarLote">
<img src="img/apagado.png" width="18px">
<a href="cerrarSesion.php">Cerrar Sesion</a>
</div>

</div>

    <?php

    $numLote = $_GET['numLote'];

    $conexion = new mysqli("localhost", "root", "", "php");

    $sentencia = "select * from lotes where numLote='$numLote'";

    $registro = $conexion->query($sentencia);

    $reg = mysqli_fetch_array($registro);
    ?>

    <form method="GET" action="opcionLote.php" id="formModificar">

        <h2>Actualizar Lote
            <img src="img/actualizarLote.png" width="50px">
        </h2>

        <input name="opcion" type="hidden" value="modificar">
        <input name="numLote" type="hidden" value="<?php echo $numLote ?>">
        <input placeholder="Nombre" required="true" type="text" name="nombre" value="<?php echo $reg['nombre'] ?>">
        <br>
        <br>
        <input placeholder="Cantidad" max="15" min="1" required="true" type="number" name="cantidad" value="<?php echo $reg['cantidadPaquetes'] ?>">
        <br>
        <br>
        <input placeholder="Direccion" type="text" name="direccion" value="<?php echo $reg['direccion'] ?>">
        <br>
        <br>
        <br>
        <label>Camion a asignar lote</label>
        <br>


        <?php
        $conexion = new mysqli("localhost", "root", "", "php");
        $sentencia = "select * from camionerosQuickCarry";

        $registro = $conexion->query($sentencia);

        echo '<select name="camionMatricula">';
        foreach ($registro->fetch_all(MYSQLI_ASSOC) as $reg) {


            echo "<option value='$reg[matricula]'>" . $reg['matricula'] . "</option>";
        }

        echo '</select>';
        ?>
        <br>

        <input type="submit" value="Actualizar">
    </form>

  

</body>


<script>

   
    var menuPerfil = document.getElementById('menuPerfilModificarLote');

    function mostrarMenu(){


menuPerfil.style.visibility = 'visible';
menuPerfil.classList.add('active');

}



function ocultarMenu(){


menuPerfil.style.visibility = 'hidden';
menuPerfil.classList.remove('active');

}

</script>


</html>