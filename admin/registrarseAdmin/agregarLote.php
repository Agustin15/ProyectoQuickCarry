<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Agregar Lote nuevo</title>
</head>



<body>

<header>
 
<a href="javascript:history.back()">
<img src="img/atras.png" width="30px">
</a>
 <h1>Lotes del almacen</h1>
 
 <div onclick="mostrarMenu()" class="miPefil">
 <img  class="userImg" src="img/miPerfil.png" width="30px">
 
 </div>
 </header>

 <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilAgregarLote">

<img src="img/miPerfil.png" width="60px">  
<h4>Usuario</h4>
<button>Editar perfil</button>
<br>
<br>
<hr>

<div class="cerrarSesionAgregarLote">
<img src="img/apagado.png" width="18px">
<a href="cerrarSesion.php">Cerrar Sesion</a>
</div>
</div>

    <form method="GET" action="opcionLote.php" id="formAgregar">

        <div class="titulo">
            <h2>Agregar Producto</h2>
            <img src="img/paquete.png" width="40px">
        </div>
        <br>
        <input type="hidden" name="opcion" value="agregar">
        <input placeholder="Nombre" required="true" type="text" name="nombre">
        <br>
        <br>
        <input placeholder="Cantidad de paquetes" max="15" required="true" type="number" name="cantidad" min="1">
        <br>
        <br>
        <input placeholder="Direccion" required="true" type="text" name="direccion">
        <br>
        <br>
        <br>
        <label>Camion a asignar lote</label>
        <br>

        
        <!--selecciona las matriculas del camionero y las muestra en el select para seleccionar-->
        <?php
        $conexion = new mysqli("localhost", "root", "", "php");
        $sentencia = "select * from camionerosQuickCarry";

        $registro = $conexion->query($sentencia);

        echo '<select required="true" name="camionMatricula">';
        foreach ($registro->fetch_all(MYSQLI_ASSOC) as $reg) {


            echo "<option value='$reg[matricula]'>" . $reg['matricula'] . "</option>";
        }

        echo '</select>';
        ?>
        <br>

        <input type="submit" value="Agregar">

    </form>



</body>



<script>

   
    var menuPerfil = document.getElementById('menuPerfilAgregarLote');

    
    var v = 1;

function mostrarMenu(){//mostrar menu

   menuPerfil.style.visibility = 'visible';
    menuPerfil.classList.add('active');


}



function ocultarMenu(){//ocultar menu


menuPerfil.style.visibility = 'hidden';
menuPerfil.classList.remove('active');

}
</script>

</html>