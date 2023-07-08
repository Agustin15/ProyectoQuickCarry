<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
   <link rel="stylesheet" href="style.css">

</head>
<body>
    
<?php

//switch con la opcion elegida de registrarse o logearse
$opcion=$_POST['opcion'];

$conexion = new mysqli("localhost", "root","", "php");

switch($opcion){

case "registrarse":


    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $numCamionero = $_POST['numCamionero'];
    $matricula= $_POST['matricula'];
    $cedula= $_POST['cedula'];
    $correo= $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
    
    //si los campos estan vacios me ponga un aviso
    if(empty($matricula)  || empty($numCamionero) || empty($cedula) || empty($nombre) || empty($apellido) || empty($usuario) || empty($correo) || empty($contrasenia)){
    
        
        ?>
        <?php
    
    include("registrarse.html");
    ?>
    <div class="avisoCamposRegistrarse" >
    
    <h4>Complete todos los campos</h4>
    </div>
    
    <?php
    
    }else{
    
        //las consultas para ver si el usuario o numero de chofer no estan repetidos
    $sentencia1="select * from funcionariosCrecom where usuario='$usuario'";
    $sentencia2="select * from camionerosQuickCarry where usuario='$usuario'";
    $sentencia3="select * from camionerosQuickCarry where numCamionero='$numCamionero'";
    $sentencia4="select * from admin where usuario='$usuario'";
    
    $registro1=$conexion->query($sentencia1);
    $registro2=$conexion->query($sentencia2);
    $registro3=$conexion->query($sentencia3);
    $registro4=$conexion->query($sentencia4);
    $reg1=mysqli_fetch_array($registro1);
    $reg2=mysqli_fetch_array($registro2);
    $reg3=mysqli_fetch_array($registro3);
    $reg4=mysqli_fetch_array($registro4);
    
    
    
    if($reg1>0 || $reg2>0 || $reg3>0 || $reg4>0){
    
    
        ?>
        <?php
    
    include("registrarse.html");
    ?>
    <div class="avisoCamposRegistrarse" >
    
    <h4>Nombre de usuario o N° de chofer ya existentes</h4>
    </div>
    
    <?php
    
    }else{
    
    
        $sentencia = "insert into camionerosQuickCarry 
        (nombre,apellido,usuario,numCamionero,cedula,correo,matricula,contrasenia) 
        values('$nombre','$apellido','$usuario','$numCamionero','$cedula','$correo','$matricula','$contrasenia')";
    
        $registro = $conexion->query($sentencia);
    
        if($registro == true) {

        
            $datos=array(
       
                'mensaje'=>'Registrado Correctamente'
                
                );
                
                   //si se logra la consulta con exito se envia una array con un mensaje al archivo usuarioCamioneroRegistado 
            
                   $msjJson=json_encode($datos);
                   $msjJsonCodificado=urlencode($msjJson);
                   header("Location: usuarioCamioneroRegistrado.php?datos=$msjJsonCodificado");
          
        }
    }
    }

    break;

    case "login":

        echo '<title>Iniciar sesion-Chofer Quick Carry</title>';
        $usuario=$_POST['usuario'];
        $contrasenia=$_POST['contrasenia'];
       
if(empty($usuario) || empty($contrasenia)){


    ?>
    <?php

include("login.html");
?>
<div class="avisoCamposLogin" >

<h4>Complete todos los campos</h4>
</div>

<?php
}else{

//comprueba con la consulta si existe el usuario y contraseña ingresadas
$sentencia="select * from camionerosQuickCarry where usuario='$usuario' and contrasenia='$contrasenia'";

$registros=$conexion->query($sentencia);

$reg=mysqli_fetch_array($registros);

$filas=mysqli_num_rows($registros);

if($filas>0){


    $datos=array(
       
        'id'=>$reg['id'],'nombre'=>$reg['nombre'],
        'apellido'=>$reg['apellido'],'usuario'=>$reg['usuario'],
        'numCamionero'=>$reg['numCamionero'],'matricula'=>$reg['matricula'],'cedula'=>$reg['cedula'],
        'correo'=>$reg['correo'],'contrasenia'=>$reg['contrasenia']
        
        );


        //envia el array con los datos encontrados del usuario logeado al archivo panel camionero
  
        $jsonDatos=json_encode($datos);

        $jsonDatosCodificado=urlencode($jsonDatos);

        header("Location: panelCamionero.php?datos=" . $jsonDatosCodificado);
    

}else{
 

?>
<?php

include("login.html");
?>
<div class="avisoCamposLogin">
<h4>Usuario o contraseña incorrectos</h4>
</div>
<?php
    
}
}

break;
}
?>
</body>
</html>