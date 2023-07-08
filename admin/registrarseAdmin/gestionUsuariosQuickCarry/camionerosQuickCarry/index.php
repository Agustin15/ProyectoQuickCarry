<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">  
        <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
        <title>Registros camioneros QuickCarry</title>
</head>
<body>


<header>
 
<a href="javascript:history.back()">
<img class="userImg"  src="img/atras.png" width="30px">
</a>
 <h1>Usuarios Choferes</h1>
 <div onclick="mostrarMenu()" class="miPefil">
 <img class="userImg" src="img/miPerfil.png" width="30px">
 
 </div>
 </header>


 <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilChoferes">

<img src="img/miPerfil.png" width="60px">  
<h4><?php echo $_SESSION['usuario']?></h4>
<button>Editar perfil</button>
<br>
<br>
<hr>

<div class="cerrarSesionChoferes">
<img src="img/apagado.png" width="18px">
<a href="cerrarSesion.php">Cerrar Sesion</a>
</div>

</div>

<?php


$conexion = new mysqli("localhost", "root","", "php");

$sentencia = "select * from camionerosQuickCarry";

$registros = $conexion->query($sentencia);


echo '<div id="containerTable">'; 
echo '<br>';
echo '<a href="agregarCamioneroQuick.php"><button id="agregar">Agregar Camionero QuickCarry</button></a>';
echo '<br><br>';
echo '<hr>';
echo '<table>';
echo '<tr id="headTable">';
        echo '<th>id</th>';
        echo '<th>Nombre</th>';
        echo '<th>Apellido</th>';
        echo '<th>Opciones</th>';
        echo '<tr>';

 foreach($registros->fetch_all(MYSQLI_ASSOC) as $reg){

        echo '<tr>';
        echo '<td>'.$reg['id'].'<img src="img/usuario.png" width="20px">'.'</td>';
        echo '<td>'.$reg['nombre'].'</td>';
        echo '<td>'.$reg['apellido'].'</td>';
     

        echo '<td><div id="eliminar"><a href="borrarCamioneroQuick.php?id='.$reg['id'].'">Eliminar</a>
        </div><div id="modificar"><a href="modificarCamioneroQuick.php?id='.$reg['id'].'">Modificar</a></div>
        <div id="masInfo"><a href="datosCamioneroQuick.php?id='.$reg['id'].'">Mas Info</a></div>  </td>';
        echo '<tr>';
 }


 echo '<br>';
 echo '</table>';
 echo '</div>';

?>



</body>



<script>

   
    var menuPerfil = document.getElementById('menuPerfilChoferes');

    

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



