<?php
  session_start();
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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

//switch con los valor de opcion recibido
switch($opcion){

    case 'eliminar':


        $numLote=$_GET['numLote'];
        $datos=array('numLote'=>$numLote);
    
        $jsonDatos=json_encode($datos);
    
        $jsonDatosEliminarCodificado=urlencode($jsonDatos);
    
        header("Location: apiAlmacen.php?opcion=eliminar&datos=$jsonDatosEliminarCodificado");
        
    
        break;
    
    
    case 'modificar':
    
       
        $numLote=$_GET['numLote'];
        $nombre=$_GET['nombre'];
        $cantidadPaquetes=$_GET['cantidad'];
        $direccion=$_GET['direccion'];
        $camionMatricula=$_GET['camionMatricula'];
    
        $datos=array('numLote'=>$numLote,'nombre'=>$nombre,
        'cantidadPaquetes'=>$cantidadPaquetes,'direccion'=>$direccion,'camionMatricula'=>$camionMatricula);
    
        $jsonDatos=json_encode($datos);
    
        $jsonDatosModificarCodificado=urlencode($jsonDatos);
    
        header("Location: apiAlmacen.php?opcion=modificar&datos=$jsonDatosModificarCodificado");
        
    
        break;
    
        case 'agregar':
    
    
    
        $nombre=$_GET['nombre'];    
        $cantidadPaquetes=$_GET['cantidad'];
        $camionMatricula=$_GET['camionMatricula'];
        $direccion=$_GET['direccion'];
        
    
            $datos=array('nombre'=>$nombre,
            'cantidadPaquetes'=>$cantidadPaquetes,'direccion'=>$direccion,
            'camionMatricula'=>$camionMatricula);
        
    
            $jsonDatos=json_encode($datos);
    
            $jsonDatosAgregarCodificado=urlencode($jsonDatos);
        
            header("Location: apiAlmacen.php?opcion=agregar&datos=$jsonDatosAgregarCodificado");
            
        
            break;
        
    
            case 'masInfo':
    
          
            
                $numLote=$_GET['numLote'];
                $datos=array('numLote'=>$numLote);
            
           
                $jsonDatos=json_encode($datos);
    
                $jsonDatosMasInfoCodificado=urlencode($jsonDatos);
            
                header("Location: apiAlmacen.php?opcion=masInfo&datos=$jsonDatosMasInfoCodificado");
                
    
            
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