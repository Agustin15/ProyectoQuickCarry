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
    <title>Actualizacion de datos del camionero</title>
</head>

<body>


<header>
 
<a href="javascript:history.back()">
<img  class="userImg" src="img/atras.png" width="30px">
</a>
 <h1>Usuarios Choferes</h1>
 <div onclick="mostrarMenu()" class="miPefil">
 <img class="userImg" src="img/miPerfil.png" width="30px">
 
 </div>
 </header>

 <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilBorrarChofer">

<img src="img/miPerfil.png" width="60px">  
<h4><?php echo $_SESSION['usuario']?></h4>
<button>Editar perfil</button>
<br>
<br>
<hr>

<div class="cerrarSesionBorrarChofer">
<img src="img/apagado.png" width="18px">
<a href="cerrarSesion.php">Cerrar Sesion</a>
</div>

</div>

    <?php

$conexion = new mysqli("localhost", "root","", "php");

    $id=$_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $numCamionero = $_POST['numCamionero'];
    $cedula = $_POST['cedula'];
    $matricula = $_POST['matricula'];
    $contrasenia = $_POST['contrasenia'];




        $sentencia = "update camionerosQuickCarry set nombre='$nombre',apellido='$apellido',usuario='$usuario'
,numCamionero='$numCamionero',cedula='$cedula',matricula='$matricula',contrasenia='$contrasenia' where id='$id'";

        $registro = $conexion->query($sentencia);


        if ($registro==true) {

            echo '<div class="msjActualizacion">';

            echo '<img class="iconoMsj" src="img/actualizado.png" width="40px">';

            echo '<br><br>';

            echo "Usuario actualizado";
            echo '<br><br>';

            echo '<button onclick="volver()" class="volverCorrecto">Volver</button>';
            echo '</div>';
        }



    ?>

<br>


<script>

function volver(){

    javascript:history.back();

}   


var menuPerfil = document.getElementById('menuPerfilBorrarChofer');

   
function mostrarMenu(){


menuPerfil.style.visibility = 'visible';
menuPerfil.classList.add('active');

}


function ocultarMenu(){


menuPerfil.style.visibility = 'hidden';
menuPerfil.classList.remove('active');

}
</script>
</body>

</html>