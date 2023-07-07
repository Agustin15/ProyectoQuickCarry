
<?php

//recibe los datos del array
$id=($_POST['id']);
$nombre=($_POST['nombre']);
$apellido=($_POST['apellido']);
$usuario=($_POST['usuario']);
$numCamionero=($_POST['numCamionero']);
$matricula=($_POST['matricula']);
$cedula=($_POST['cedula']);
$correo=($_POST['correo']);
$contrasenia=($_POST['contrasenia']);

/*si la id es nula entonces vuelve al login ya que no hay acceso autorizado*/
if(empty($id)){

    ?>
    <?php

header('Location:http://localhost/dashboard/proyecto/programacionWeb/ejMysql/FormularioUsuario/LoginCrecom/RegistrarseCrecom/login.html')
?>

<?php
    
}else{

    //inicia la session y le asigna  los datos de session con la variables recibidas
session_start();


$_SESSION['id']=$id;
$_SESSION['nombre']=$nombre;
$_SESSION['apellido']=$apellido;
$_SESSION['usuario']=$usuario;
$_SESSION['$numCamionero']=$numCamionero;
$_SESSION['matricula']=$matricula;
$_SESSION['cedula']=$cedula;
$_SESSION['correo']=$correo;
$_SESSION['contrasenia']=$contrasenia;

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