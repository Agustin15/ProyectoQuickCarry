<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Actualizacion de datos del usuario Crecom</title>
</head>

<body>
    
<header>
 

<a href="javascript:history.back()">
<img src="img/atras.png" width="30px">
</a>
 <h1>Panel administrador</h1>
 <div onclick="mostrarMenu()" class="miPefil">
 <img class="userImg" src="img/miPerfil.png" width="30px">
 
 </div>
 </header>

 <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilBorrarFuncionario">

<img src="img/miPerfil.png" width="60px">  
<h4><?php echo $_SESSION['usuario']?></h4>
<button>Editar perfil</button>
<br>
<br>
<hr>

<div class="cerrarSesionBorrarFuncionario">
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
    $numFuncio = $_POST['numFuncio'];
    $cedula = $_POST['cedula'];
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
   


        $sentencia = "update funcionariosCrecom set nombre='$nombre',apellido='$apellido',usuario='$usuario'
,numFuncio='$numFuncio',cedula='$cedula',correo='$correo',contrasenia='$contrasenia'where id='$id'";

        $registro = $conexion->query($sentencia);


        if ($registro==true) {

            echo '<div class="msjActualizacion">';

            echo '<img class="iconoMsj" src="img/actualizado.png" width="40px">';

            echo '<br><br>';

            echo "Usuario actualizado";
            echo '<br><br>';

            echo '<button onclick="volver()" class="volverCorrecto">Volver</button>';
            echo '<div>';
        }

    ?>



    <script>
        function volver() {

            javascript:history.back();

        }


        var menuPerfil = document.getElementById('menuPerfilBorrarFuncionario');

    


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