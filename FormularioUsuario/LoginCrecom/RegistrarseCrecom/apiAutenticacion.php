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

 
$opcion=$_POST['opcion'];

$conexion = new mysqli("localhost", "root","", "php");

switch($opcion){

   
case "registrarse":


    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $numFuncio = $_POST['numFuncio'];
    $cedula=$_POST['cedula'];
    $correo = $_POST['correo'];
    $contrasenia = $_POST['contrasenia'];
    
    
    if(empty($numFuncio) || empty($cedula) || empty($nombre) || empty($apellido) || empty($usuario) || empty($correo) || empty($contrasenia)){
    
        
        ?>
        <?php
    
    include("registrarse.html");
    ?>
    <div class="avisoCamposRegistrarse" >
    
    <h4>Complete todos los campos</h4>
    </div>
    
    <?php
    
    }else{
    
    $sentencia="select * from funcionariosCrecom where usuario='$usuario'";
    $sentencia2="select * from camionerosQuickCarry where usuario='$usuario'";
    $sentencia3="select * from  funcionariosCrecom where numFuncio='$numFuncio'";
    $sentencia4="select * from admin where usuario='$usuario'";
    
    $registro=$conexion->query($sentencia);
    $registro2=$conexion->query($sentencia2);
    $registro3=$conexion->query($sentencia3);
    $registro4=$conexion->query($sentencia4);
    $reg=mysqli_fetch_array($registro);
    $reg2=mysqli_fetch_array($registro2);
    $reg3=mysqli_fetch_array($registro3);
    $reg4=mysqli_fetch_array($registro4);
    
    
    if($reg2>0 ||$reg3>0 || $reg>0 || $reg4>0){
    
        ?>
        <?php
    
    include("registrarse.html");
    ?>
    <div class="avisoCamposRegistrarse" >
    
    <h4>Nombre de usuario o N° funcionario ya existentes</h4>
    </div>
    
    <?php
    
    }else{
        $sentencia = "insert into  funcionariosCrecom (nombre,apellido,usuario,numFuncio,cedula,correo,contrasenia) 
        values('$nombre','$apellido','$usuario','$numFuncio','$cedula','$correo','$contrasenia')";
    
        $registro = $conexion->query($sentencia);
    
        if($registro == true) {
    
           
            $datos=array(
       
                'mensaje'=>'Registrado Correctamente'
                
                );
                
                
                $jsonDatos=json_encode($datos);

                $jsonDatosCodificado=urlencode($jsonDatos);

                header("Location: usuarioRegistradoCrecom?datos=" . $jsonDatosCodificado);
          
        }
    }
    
    }
   



    break;


    case "login":

        echo '<title>Iniciar sesion-Crecom</title>';

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
       
       $sentencia = "select * from funcionariosCrecom where usuario='$usuario' and contrasenia='$contrasenia'";
       
       $registros = $conexion->query($sentencia);
       
       $filas = mysqli_num_rows($registros);
       
       $reg=mysqli_fetch_array($registros);
       
       
       if ($filas > 0) {   
       
       
       $datos=array(
       
       'id'=>$reg['id'],'nombre'=>$reg['nombre'],
       'apellido'=>$reg['apellido'],'usuario'=>$reg['usuario'],
       'numFuncio'=>$reg['numFuncio'],'cedula'=>$reg['cedula'],
       'correo'=>$reg['correo'],'contrasenia'=>$reg['contrasenia']
       
       );
       
       
       $jsonDatos=json_encode($datos);

       $jsonDatosCodificado=urlencode($jsonDatos);

       header("Location: listaLotes.php?datos=" . $jsonDatosCodificado);
       
       
        } else {
       
       ?>
       
       <?php
       include('login.html');
       
       ?>
       
       <div class="avisoCamposLogin" >
       
       
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