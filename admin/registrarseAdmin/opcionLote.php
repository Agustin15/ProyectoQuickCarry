<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
</head>
<body>
    
<header>
 
<a href="javascript:history.back()">
<img class="userImg" src="img/atras.png" width="30px">
</a>
 <h1>Lotes del almacen</h1>
 
 <div onclick="mostrarMenu()" class="miPefil">
 <img  class="userImg" src="img/miPerfil.png" width="30px">
 
 </div>
 </header>


<?php


$opcion=$_GET['opcion'];

switch($opcion){

case 'eliminar':


    echo '<div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilLote2">';

    echo '<img src="img/miPerfil.png" width="60px">';  
    echo '<h4>Usuario</h4>';
    echo '<button>Editar perfil</button>';
    echo  '<br>';
     echo '<br>';
     echo '<hr>';
     
     echo '<div class="cerrarSesionLote2">';
     echo '<img src="img/apagado.png" width="18px">';
     echo '<a href="cerrarSesion.php">Cerrar Sesion</a>';
     echo '</div>';
     
     echo '</div>';


    $numLote=$_GET['numLote'];
    $datos=array('opcion'=>'eliminar','numLote'=>$numLote);

   
    $ch= curl_init();
                
    $options=array(
    
        CURLOPT_URL=>'http://localhost/dashboard/Proyecto%20Diseño/admin/registrarseAdmin/apiAlmacen.php',
        CURLOPT_POST=>1,
        CURLOPT_POSTFIELDS=>$datos,
        CURLOPT_RETURNTRANSFER=>1
    );
    
    curl_setopt_array($ch,$options);
    $result=curl_exec($ch);
    curl_close($ch);
    
    print_r($result);
    

    break;


case 'modificar':

    echo '<div class=".active"  onmouseleave="ocultarMenu()" id="menuPerfilLote2">';

    echo '<img src="img/miPerfil.png" width="60px">';  
    echo '<h4>Usuario</h4>';
    echo '<button>Editar perfil</button>';
    echo  '<br>';
     echo '<br>';
     echo '<hr>';
     
     echo '<div class="cerrarSesionLote2">';
     echo '<img src="img/apagado.png" width="18px">';
     echo '<a href="cerrarSesion.php">Cerrar Sesion</a>';
     echo '</div>';
     
     echo '</div>';


    $numLote=$_GET['numLote'];
    $nombre=$_GET['nombre'];
    $cantidadPaquetes=$_GET['cantidad'];
    $direccion=$_GET['direccion'];
    $camionMatricula=$_GET['camionMatricula'];

    $datos=array('opcion'=>'modificar','numLote'=>$numLote,'nombre'=>$nombre,
    'cantidadPaquetes'=>$cantidadPaquetes,'direccion'=>$direccion,'camionMatricula'=>$camionMatricula);


    $ch= curl_init();
                
    $options=array(
    
        CURLOPT_URL=>'http://localhost/dashboard/Proyecto%20Diseño/admin/registrarseAdmin/apiAlmacen.php',
        CURLOPT_POST=>1,
        CURLOPT_POSTFIELDS=>$datos,
        CURLOPT_RETURNTRANSFER=>1
    );
    
    curl_setopt_array($ch,$options);
    $result=curl_exec($ch);
    curl_close($ch);
    
    print_r($result);
    

    break;

    case 'agregar':

        echo '<div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilLote2">';

        echo '<img src="img/miPerfil.png" width="60px">';  
        echo '<h4>Usuario</h4>';
        echo '<button>Editar perfil</button>';
        echo  '<br>';
         echo '<br>';
         echo '<hr>';
         
         echo '<div class="cerrarSesionLote2">';
         echo '<img src="img/apagado.png" width="18px">';
         echo '<a href="cerrarSesion.php">Cerrar Sesion</a>';
         echo '</div>';
         
         echo '</div>';
    

    $nombre=$_GET['nombre'];    
    $cantidadPaquetes=$_GET['cantidad'];
    $camionMatricula=$_GET['camionMatricula'];
    $direccion=$_GET['direccion'];
    

        $datos=array('opcion'=>'agregar','nombre'=>$nombre,
        'cantidadPaquetes'=>$cantidadPaquetes,'direccion'=>$direccion,
        'camionMatricula'=>$camionMatricula);
    

        $ch= curl_init();
                
        $options=array(
        
            CURLOPT_URL=>'http://localhost/dashboard/Proyecto%20Diseño/admin/registrarseAdmin/apiAlmacen.php',
            CURLOPT_POST=>1,
            CURLOPT_POSTFIELDS=>$datos,
            CURLOPT_RETURNTRANSFER=>1
        );
        
        curl_setopt_array($ch,$options);
        $result=curl_exec($ch);
        curl_close($ch);
        
        print_r($result);
        
        
        
    
    
        break;
    

        case 'masInfo':

            echo '<div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilLote2">';

            echo '<img src="img/miPerfil.png" width="60px">';  
            echo '<h4>Usuario</h4>';
            echo '<button>Editar perfil</button>';
            echo  '<br>';
             echo '<br>';
             echo '<hr>';
             
             echo '<div class="cerrarSesionLote2">';
             echo '<img src="img/apagado.png" width="18px">';
             echo '<a href="cerrarSesion.php">Cerrar Sesion</a>';
             echo '</div>';
             
             echo '</div>';
        
            $numLote=$_GET['numLote'];
            $datos=array('opcion'=>'masInfo','numLote'=>$numLote);
        
       
            $ch= curl_init();
                
            $options=array(
            
                CURLOPT_URL=>'http://localhost/dashboard/Proyecto%20Diseño/admin/registrarseAdmin/apiAlmacen.php',
                CURLOPT_POST=>1,
                CURLOPT_POSTFIELDS=>$datos,
                CURLOPT_RETURNTRANSFER=>1
            );
            
            curl_setopt_array($ch,$options);
            $result=curl_exec($ch);
            curl_close($ch);
            
            print_r($result);
            
        
        
            break;
        

}


?>
</body>

<script>

   
    var menuPerfil = document.getElementById('menuPerfilLote2');

    
  

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