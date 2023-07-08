
<?php

//recibe los datos del array

$datosUsuario=$_GET['datos'];

$datosDecodificadosJson=urldecode($datosUsuario);

$datosDecodificadosUsuario=json_decode($datosDecodificadosJson,true);



/*si la id es nula entonces vuelve al login ya que no hay acceso autorizado*/
if(empty($datosDecodificadosUsuario['id'])){

    ?>
    <?php

header('Location:login.html')
?>

<?php
    
}else{

   
session_start();

$_SESSION['id'] = $datosDecodificadosUsuario['id'];
$_SESSION['nombre']=  $datosDecodificadosUsuario['nombre'];
$_SESSION['apellido'] =  $datosDecodificadosUsuario['apellido'];
$_SESSION['usuario'] =  $datosDecodificadosUsuario['usuario'];
$_SESSION['correo'] =  $datosDecodificadosUsuario['correo'];
$_SESSION['contrasenia'] =  $datosDecodificadosUsuario['contrasenia']; 
$_SESSION['cedula'] =  $datosDecodificadosUsuario['cedula']; 
$_SESSION['numCamionero'] =  $datosDecodificadosUsuario['numCamionero']; 
$_SESSION['matricula'] =  $datosDecodificadosUsuario['matricula']; 


}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <title>Chofer Quick Carry</title>
</head>

<body>


        
    <header>
 
    <h2>Chofer Quick Carry</h2>
    <div onclick="mostrarMenu()" class="miPefil">
    <img class="userImg" src="img/miPerfil.png" width="30px">
    
    </div>
    </header>




    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfil">

  <img src="img/miPerfil.png" width="60px">  
  <!--muestra  el nombre de usuario de la session en el menu del usuario--> 
<h4><?php echo $_SESSION['usuario']?></h4>
<button>Editar perfil</button>
<br>
<br>
<hr>

<div class="cerrarSesion">
<img src="img/apagado.png" width="18px">
<a href="cerrarSesion.php">Cerrar Sesion</a>
</div>

</div>

<script>

    
    var menuPerfil = document.getElementById('menuPerfil');

   


    

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