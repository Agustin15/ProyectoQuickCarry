<?php


 
$opcion=$_POST['opcion'];

$conexion = new mysqli("localhost", "root","", "php");


//switch con el valor de la opcion recibida del login o del formulario de registrarse
switch($opcion){

    case "registrarse":
    
    
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $usuario = $_POST['usuario'];
        $correo = $_POST['correo'];
        $contrasenia = $_POST['contrasenia'];
        
        
        if(empty($nombre) || empty($apellido) || empty($usuario) || empty($correo) || empty($contrasenia)){
        
            
            ?>
            <?php
        
        include("registrarse.html");
        ?>
        <div class="avisoCamposRegistrarse" >
        
        <h4>Complete todos los campos</h4>
        </div>
        
        <?php
        
        }else{
        
       
        $sentencia2="select * from camionerosQuickCarry where usuario='$usuario'";
        $sentencia3="select * from funcionariosCrecom where usuario='$usuario'";
        $sentencia4="select * from admin where usuario='$usuario'";
        
        
        $registro2=$conexion->query($sentencia2);
        $registro3=$conexion->query($sentencia3);
        $registro4=$conexion->query($sentencia4);
       
        $reg2=mysqli_fetch_array($registro2);
        $reg3=mysqli_fetch_array($registro3);
        $reg4=mysqli_fetch_array($registro4);
        
        

        
        if($reg2>0 ||$reg3>0 || $reg4>0){
        
            ?>
            <?php
        
        include("registrarse.html");
        ?>
        <div class="avisoCamposRegistrarse" >
        
        <h4>Nombre de usuario ya existente</h4>
        </div>
        
        <?php
        
        }else{
            $sentencia = "insert into admin (nombre,apellido,usuario,correo,contrasenia) 
            values('$nombre','$apellido','$usuario','$correo','$contrasenia')";
        
            $registro = $conexion->query($sentencia);
        
            if($registro == true) {
        
               
                $datos=array(
           
                    'mensaje'=>'Registrado Correctamente'
                    
                    );
                    
                    //dependiendo si la consulta es correcta o no, a traves del comando curl se 
                    //transfiere el array con el mensaje al archivo usuarioRegistradoAdmin

                    $jsonDatos=json_encode($datos);

                    $jsonDatosCodificado=urlencode($jsonDatos);

                    header("Location: usuarioRegistradoAdmin.php?datos=" . $jsonDatosCodificado);
                    
              
            }
        }
        
        }
       
    break;
    
    
        case "login":
    
    
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
           
           $sentencia = "select * from admin where usuario='$usuario' and contrasenia='$contrasenia'";
           
           $registros = $conexion->query($sentencia);
           
           $filas = mysqli_num_rows($registros);
           
           $reg=mysqli_fetch_array($registros);
           
           
           if ($filas > 0) {   
           
           
           $datos=array(
           
           'id'=>$reg['id'],'nombre'=>$reg['nombre'],
           'apellido'=>$reg['apellido'],'usuario'=>$reg['usuario'],
           'correo'=>$reg['correo'],'contrasenia'=>$reg['contrasenia']
           
           );
           
           //dependiendo si la consulta es correcta o no, a traves del comando curl se 
                    //transfiere el array con los datos del login hacia el archivo de panel del admin
          
                    
                    $jsonDatos=json_encode($datos);

                    $jsonDatosCodificado=urlencode($jsonDatos);

                    header("Location: panelAdmin.php?datos=" . $jsonDatosCodificado);
                
           
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