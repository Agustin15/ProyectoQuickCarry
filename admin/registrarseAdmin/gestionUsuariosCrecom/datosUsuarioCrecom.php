<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">  
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <title>Datos del usuario Crecom</title>
</head>
<body>
   

    
<header>
 

<a href="javascript:history.back()">
<img class="userImg" src="img/atras.png" width="30px">
</a>
 <h1>Panel administrador</h1>
 <div onclick="mostrarMenu()" class="miPefil">
 <img class="userImg" src="img/miPerfil.png" width="30px">
 
 </div>
 </header>


 <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilBorrarFuncionario">

<img src="img/miPerfil.png" width="60px">  
<h4>Usuario</h4>
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

$id=$_GET['id'];

$conexion = new mysqli("localhost", "root","", "php");

$sentencia = "select * from funcionariosCrecom where id='$id'";

$registros = $conexion->query($sentencia);

$reg=mysqli_fetch_array($registros);


echo '<div id="containerTable">'; 
echo '<br>';

echo '<center>';
echo '<img src="img/usuario.png" width="40px">';
echo '<br>';
echo '<a id="nomUsuario">'.$reg['nombre']." ".$reg['apellido'].'</a>';
echo '<center>';

echo '<hr>';
echo '<table>';
echo '<tr  id="headTable">';
echo '<th>Usuario</th>';
echo '<th>Cedula</th>';
echo '<th>Correo</th>';
echo '<th>Contraseña</th>';
echo '</tr>';

echo '<tr>';
echo '<td>'.$reg['usuario'].'</td>';
echo '<td>'.$reg['cedula'].'</td>';
echo '<td>'.$reg['correo'].'</td>';
echo '<td>'.$reg['contrasenia'].'</td>';
echo '</tr>';

echo '</table>';
echo '</div>';


          
          ?>



</body>

<script>
      

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
</html>