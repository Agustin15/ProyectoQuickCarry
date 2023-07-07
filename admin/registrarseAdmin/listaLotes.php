

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
        <link rel="stylesheet" href="style.css">  
        <title>Almacen</title>
</head>
<body>

<header>
 
<a href="javascript:history.back()">
<img src="img/atras.png" width="30px">
</a>
 <h1>Lotes del almacen</h1>
 <div onclick="mostrarMenu()">
 <img class="userImg" src="img/miPerfil.png" width="30px">
 
 </div>
 </header>

 

<div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilAlmacen">

<img src="img/miPerfil.png" width="60px">  
<h4>Usuario</h4>
<button>Editar perfil</button>
<br>
<br>
<hr>

<div class="cerrarSesionAlmacen">
<img src="img/apagado.png" width="18px">
<a href="cerrarSesion.php">Cerrar Sesion</a>
</div>

</div>

<?php




$conexion = new mysqli("localhost", "root","", "php");

$sentencia = "select * from lotes";


$registros = $conexion->query($sentencia);


$sentencia = "select * from lotes";


echo '<div id="containerTable">'; 
echo '<a href="agregarLote.php"><button id="agregar">Agregar Lote </button></a>';
echo '<img src="img/almacen.png" width="70px">';
echo '<hr>';
echo '<table>';
echo '<tr id="headTable">';
        echo '<th>Numero de Lote</th>';
        echo '<th>Producto</th>';
        echo '<th>Opciones</th>';
        echo '<tr>';

 foreach($registros->fetch_all(MYSQLI_ASSOC) as $reg){

        echo '<tr>';
        echo '<td>'.$reg['numLote'].'</td>';
        echo '<td>'.$reg['nombre'].'</td>';
        
        
        echo '<td><div id="eliminar"><a href="opcionLote.php?opcion=eliminar&numLote='.$reg['numLote'].'">Eliminar</a></div>
        </div><div id="modificar"><a href="modificarLote.php?numLote='.$reg['numLote'].'">Modificar</a></div>
        <div id="masInfo"><a href="opcionLote.php?opcion=masInfo&numLote='.$reg['numLote'].'">Mas Info</a></div>  </td>';
        echo '<tr>';
 }


 echo '<br>';
 echo '</table>';
 echo '</div>';


 

?>



</body>

<script>

var menuPerfil = document.getElementById('menuPerfilAlmacen');       

function mostrarMenu(){


menuPerfil.style.visibility = 'visible';
menuPerfil.classList.add('active');

}


function ocultarMenu(){


menuPerfil.style.visibility = 'hidden';
menuPerfil.classList.remove('active');

}
</script>


</script>
</html>



