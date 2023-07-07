<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">

</head>

<body>


    <?php


    $opcion = ($_POST['opcion']);




    $conexion = new mysqli("localhost", "root", "", "php");
    switch ($opcion) {

        case 'eliminar':

            $numLote = ($_POST['numLote']);


           //interfaz de lote eliminado con los datos recibidos del array 
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


        case 'modificar':

            echo '<title>Modificar</title>';

            //interfaz para modificar lote con los datos recibidos del array
            $numLote = ($_POST['numLote']);
            
            $nombre = ($_POST['nombre']);
            $cantidadPaquetes = ($_POST['cantidadPaquetes']);
            $direccion = ($_POST['direccion']);
            $camionMatricula = ($_POST['camionMatricula']);


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


        case 'masInfo':

            //interfaz con la informacion del lote en una tabla
            echo '<title>Datos sobre el lote</title>';

            $numLote = ($_POST['numLote']);
             
             //consulta para seleccionar los datos sobre el lote con el numLote
            $sentencia = "select * from lotes where numLote='$numLote'";

            $registros = $conexion->query($sentencia);

            $reg = mysqli_fetch_array($registros);
            
           
          
           
            echo '<div id="containerTableLote">';
            echo '<img class="iconoLote" src="img/paquete.png" width="40px">';
            echo '<center>';
            echo '<br>';
           
            echo '<a id="nomProducto">' . 'Producto:' . $reg['nombre'] . '</a>';
            echo '<br>';
           
            echo '<center>';

            echo '<hr>';
            echo '<table>';
            echo '<tr  id="headTableLote">';
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

        case 'agregar':



           
            echo '<title>Lote agregado</title>';

    
            $nombre = ($_POST['nombre']);
            $cantidadPaquetes = ($_POST['cantidadPaquetes']);
            $direccion = ($_POST['direccion']);
            $camionMatricula = ($_POST['camionMatricula']);


            //consulta para agregar un nuevo lote con los datos recibidos del array
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
    </script>


</body>

</html>