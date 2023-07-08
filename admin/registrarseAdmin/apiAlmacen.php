<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">

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


 <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilLote2">

<img src="img/miPerfil.png" width="60px">
<h4><?php echo $_SESSION["usuario"]?></h4>
<button>Editar perfil</button>
<br>
<br>
<hr>
 
 <div class="cerrarSesionLote2">
 <img src="img/apagado.png" width="18px">
 <a href="cerrarSesion.php">Cerrar Sesion</a>;
 </div>
 
 </div>

    <?php


    $opcion = $_GET['opcion'];
    


//switch con el valor de la opcion recibida de la tabla de almacen de lotes
    $conexion = new mysqli("localhost", "root", "", "php");
    switch ($opcion) {

        case 'eliminar'://opcion de eliminar

           
            


            $datosEliminar=$_GET['datos'];

            $datosEliminarDecodificado=urldecode($datosEliminar);
            $arrayEliminar=json_decode($datosEliminarDecodificado,true);
         
            $numLote=$arrayEliminar['numLote'];

            echo '<title>Eliminar lote</title>';

            $sentencia = "select * from lotes where numLote='$numLote'";

            $registro = $conexion->query($sentencia);



            echo '<div class="msjEliminar">';
            echo '<img src="img/eliminar.png" width="30px">';
            echo '<br><br>';
            if ($reg = mysqli_fetch_array($registro)) {

                $sentencia2 = "delete from lotes where numLote=$numLote";

                $registro2 = $conexion->query($sentencia2);


                echo '<a class="msj">Lote eliminado</a>';
            } else {

                echo '<a class="msj">Datos no encontrados</a>';
            }

            echo '<br><br>';
            echo '<button onclick="volver()" class="volverError">Volver</button>';
            echo '</div>';

            break;


        case 'modificar'://opcion modificar

            echo '<title>Modificar</title>';


            $datosModificar=$_GET['datos'];

            $datosModificarDecodificado=urldecode($datosModificar);
            $arrayModificar=json_decode($datosModificarDecodificado,true);
         
            $numLote=$arrayModificar['numLote'];
            $nombre = $arrayModificar['nombre'];
            $cantidadPaquetes = $arrayModificar['cantidadPaquetes'];
            $direccion = $arrayModificar['direccion'];
            $camionMatricula = $arrayModificar['camionMatricula'];


            $sentencia = "select * from camionerosQuickCarry where matricula='$camionMatricula'";

            $registro = $conexion->query($sentencia);

    

                $sentencia = "update lotes set nombre='$nombre',cantidadPaquetes='$cantidadPaquetes',direccion='$direccion',camionMatricula='$camionMatricula' where numLote='$numLote'";

                $registro = $conexion->query($sentencia);


                if ($registro == true) {

                    echo '<div class="msjActualizacion">';

                    echo '<img class="iconoMsj" src="img/actualizarLote.png" width="40px">';

                    echo '<br><br>';

                    echo "Lote actualizado";
                    echo '<br><br>';

                    echo '<button onclick="volver()" class="volverCorrecto">Volver</button>';
                    echo '<div>';
                }
            

            break;


        case 'masInfo'://opcion de ver mas datos sobre el lote

            echo '<title>Datos sobre el lote</title>';
            
           
            $datosMasInfo=$_GET['datos'];

            $datosMasInfoDecodificado=urldecode($datosMasInfo);
            $arrayMasInfo=json_decode($datosMasInfoDecodificado,true);
         
            $numLote=$arrayMasInfo['numLote'];
           


            $sentencia = "select * from lotes where numLote='$numLote'";

            $registros = $conexion->query($sentencia);

            $reg = mysqli_fetch_array($registros);
            
            
            echo '<div id="containerTableLote">';
            echo '<img  class="iconoLote" src="img/paquete.png" width="40px">';
            echo '<center>';
            echo '<br>';
           
            echo '<a id="nomProducto">' . 'Producto:' . $reg['nombre'] . '</a>';
            echo '<br>';
           
            echo '<center>';

            echo '<hr>';
            echo '<table>';
            echo '<tr  id="headTable">';
            echo '<th>Cantidad paquetes</th>';
            echo '<th>Direccion</th>';
            echo '<th>Matricula del camion a cargo</th>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>' . $reg['cantidadPaquetes'] . '</td>';
            echo '<td>' . $reg['direccion'] . '</td>';
            echo '<td>' . $reg['camionMatricula'] . '</td>';


            echo '</tr>';

            echo '</table>';
            echo '</div>';

            break;

        case 'agregar'://opcion de agregar lote

            echo '<title>Lote agregado</title>';


            $datosAgregar=$_GET['datos'];

            $datosAgregarDecodificado=urldecode($datosAgregar);
            $arrayDatosAgregar=json_decode($datosAgregarDecodificado,true);
         

            $nombre = $arrayDatosAgregar['nombre'];
            $cantidadPaquetes =$arrayDatosAgregar['cantidadPaquetes'];
            $direccion = $arrayDatosAgregar['direccion'];
            $camionMatricula = $arrayDatosAgregar['camionMatricula'];



            $sentencia = "select * from lotes where nombre='$nombre'";
            $sentencia2 = "select * from camionerosQuickCarry where matricula='$camionMatricula'";

            $registro = $conexion->query($sentencia);
            $registro2 = $conexion->query($sentencia2);

            $reg = mysqli_fetch_array($registro);

            $reg2 = mysqli_fetch_array($registro2);



            if ($reg > 0) {



                echo '<div class="msjEliminar">';
                echo '<br>';
                echo '<img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>';
                echo '<a class="msj">Lote ya existente</a><br><br>';
                echo '<button onclick="volver()" class="volverError">Volver</button>';
                echo '<div>';
            } else {

                $sentencia = "insert into lotes (nombre,cantidadPaquetes,direccion,camionMatricula) 
        values('$nombre','$cantidadPaquetes','$direccion','$camionMatricula')";

                $registro = $conexion->query($sentencia);

                if ($registro == true) {


                    echo '<div class="msjActualizacion">';
                    echo '<img class="iconoMsj" src="img/paquete.png" width="40px"><br><br>';
                    echo '<a class="msj">Lote Agregado</a><br><br>';
                    echo '<button onclick="volver()" class="volverCorrecto">Volver</button>';
                    echo '<div>';
                }
            }


            break;
    }


    ?>

    <script>
        function volver() {

            javascript:history.back();

        }

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


</body>

</html>