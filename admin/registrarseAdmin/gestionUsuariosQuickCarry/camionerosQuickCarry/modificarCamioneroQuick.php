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
    <title>Modificar datos del camionero</title>
</head>
<body>


<header>
 
<a href="javascript:history.back()">
<img class="userImg" src="img/atras.png" width="30px">
</a>
 <h1>Usuarios Choferes</h1>
 <div onclick="mostrarMenu()" class="miPefil">
 <img class="userImg" src="img/miPerfil.png" width="30px">
 
 </div>
 </header>

 <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilModificarChoferes">

<img src="img/miPerfil.png" width="60px">  
<h4><?php echo $_SESSION['usuario']?></h4>
<button>Editar perfil</button>
<br>
<br>
<hr>

<div class="cerrarSesionAgregarChoferes">
<img src="img/apagado.png" width="18px">
<a href="cerrarSesion.php">Cerrar Sesion</a>
</div>

</div>



<?php

$id = $_GET['id'];

$conexion = new mysqli("localhost", "root","", "php");

$sentencia = "select * from camionerosQuickCarry where id='$id'";

$registro = $conexion->query($sentencia);

$reg=mysqli_fetch_array($registro);


?>



<form method="POST" action="nuevosDatosCamioneroQuick.php"  id="formModificar" >

<img src="img/actualizarUsuario.png" width="60px">
<br>
<br>
<h2>Actualizar Camionero QuickCarry</h2>
<br><br>

<input name="id" type="hidden" value="<?php echo $id?>">

<input placeholder="Nombre"  required="true" type="text" name="nombre" value="<?php echo $reg['nombre']?>">
<input  placeholder="Apellido"  required="true" type="text" name="apellido" value="<?php echo $reg['apellido']?>" >
<br>
<br>
<br>
<input  placeholder="Usuario"  required="true" type="text" name="usuario" value="<?php echo $reg['usuario']?>" >
<input  placeholder="N° Camionero"  required="true" type="number" min="1" name="numCamionero" value="<?php echo $reg['numCamionero']?>">
<br>
<br>
<br>
<input placeholder="Cedula" onkeypress="return event.charCode>=48 && event.charCode<=57" maxlength="8"  required="true" type="text" name="cedula" value="<?php echo $reg['cedula']?>" >
<input placeholder="Matricula" maxlength="7"   required="true" type="text" name="matricula" value="<?php echo $reg['matricula']?>" >

<br>
<br>
<br>
<input placeholder="Correo"  required="true" type="text" name="correo" value="<?php echo $reg['correo']?>" >
<input placeholder="Contraseña" id="contrasenia" required="true" type="password" name="contrasenia" value="<?php echo $reg['contrasenia']?>">
<img src="img/ocultar.png" id="estadoPassword" onclick="password()">
<br>

<input type="submit"  value="Actualizar">

</form>



<script>

document.getElementById("estadoPassword").style.width="22px";
function password(){


if(document.getElementById("contrasenia").type==="password"){

    document.getElementById("estadoPassword").src="img/ver.png";
    document.getElementById("contrasenia").type="text";

}else{

    document.getElementById("contrasenia").type="password";
    document.getElementById("estadoPassword").src="img/ocultar.png";


}

}


var menuPerfil = document.getElementById('menuPerfilModificarChoferes');

    
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