<?php

require('claseAlmacen.php');
require('enviarCodigoRastreo.php');

$claseCorreo = new correo();
$claseAlmacen = new almacen();



//switch con el valor de la peticion

switch ($_SERVER['REQUEST_METHOD']) {

    case 'DELETE': //opcion de eliminar


        $datosJsonPaquete = file_get_contents("php://input", true);

        $datosPaquete = json_decode($datosJsonPaquete, true);

        $idPaquete = $datosPaquete['idPaquete'];
        $estado = $datosPaquete['estado'];


        echo '<title>Eliminar Pedido</title>';



        echo '<div class="msjEliminar">';
        echo '<img src="img/eliminar.png" width="30px">';
        echo '<br><br>';

        $sentencia = $claseAlmacen->eliminarPaquete($idPaquete, $estado);

        if ($sentencia) {

            echo '<a class="msj">Paquete eliminado</a>';
        } else {

            echo '<a class="msj">Error al eliminar el paquete</a>';
        }

        echo '<br><br>';
        echo '<button onclick="volver()" class="volverError">Volver</button>';
        echo '</div>';

        break;


    case 'POST':

        echo '<title>Agregar</title>';

        $datosJsonPaquete = $_POST['jsonDatosPaquete'];

        $datosPaquete = json_decode($datosJsonPaquete, true);

        $idPaquete = $datosPaquete['idPaquete'];
        $nombre = $datosPaquete['nombre'];
        $estado = $datosPaquete['estado'];
        $numAlmacen = $datosPaquete['numAlmacen'];
        $destino = $datosPaquete['destino'];
        $fechaEntrega = $datosPaquete['fechaEntrega'];
        $codigoRastreo = $datosPaquete['codigoRastreo'];
        $matriculaCamion = $datosPaquete['matriculaCamion'];


        $paqueteRastreo = $claseAlmacen->codigoRastreoRepetido($codigoRastreo);


        if ($paqueteRastreo > 0) {

?>
            <div class="msjEliminar">

                <img class="iconoMsj" src="img/advertencia.png" width="40px">

                <br><br>

                Codigo de rastreo ya en uso
                <br><br>

                <button onclick="volver()" class="volverError">Volver</button>
            </div>

            <?php

        } else {

            $paquete = $claseAlmacen->getDatosPaquete($idPaquete);
            $cliente = $claseAlmacen->getDatosCliente($paquete['idCliente']);

            $enviado = $claseCorreo->enviarCorreo($cliente['correo'], $cliente['nombre'], $codigoRastreo);

            if ($enviado) {

                $sentencia = $claseAlmacen->agregarPaquete(
                    $nombre,
                    $estado,
                    $numAlmacen,
                    $matriculaCamion,
                    $destino,
                    $fechaEntrega,
                    $codigoRastreo,
                    $idPaquete,
                );

                if ($sentencia) {
            ?>

                    <div class="msjActualizacion">

                        <img class="iconoMsj" src="img/agregar-producto.png" width="40px">

                        <br><br>

                        Paquete armado
                        <br><br>

                        <button onclick="volver()" class="volverCorrecto">Volver</button>
                    </div>

                <?php
                } else {

                ?>
                    <div class="msjEliminar">

                        <img class="iconoMsj" src="img/advertencia.png" width="40px">

                        <br><br>

                        Error al armar el paquete
                        <br><br>

                        <button onclick="volver()" class="volverError">Volver</button>
                    </div>

                <?php

                }
            } else {
                ?>
                <div class="msjEliminar">

                    <img class="iconoMsj" src="img/advertencia.png" width="40px">

                    <br><br>
                    No se pudo enviar el codigo de rastreo del paquete
                    <br><br>

                    <button onclick="volver()" class="volverError">Volver</button>
                </div>

            <?php
            }
        }

        break;


    case 'PUT':

        echo '<title>Modificar</title>';


        $datosJsonPaquete = file_get_contents('php://input', true);


        $datosPaquete = json_decode($datosJsonPaquete, true);

        $idPaquete = $datosPaquete['idPaquete'];
        $nombre = $datosPaquete['nombre'];
        $estado = $datosPaquete['estado'];
        $numAlmacen = $datosPaquete['numAlmacen'];
        $destino = $datosPaquete['destino'];
        $fechaEntrega = $datosPaquete['fechaEntrega'];
        $matriculaCamion = $datosPaquete['matriculaCamion'];




        $sentencia = $claseAlmacen->modificarPaquete(
            $nombre,
            $estado,
            $numAlmacen,
            $matriculaCamion,
            $destino,
            $fechaEntrega,
            $idPaquete,
        );

        if ($sentencia == true) {


            ?>

            <div class="msjActualizacion">

                <img class="iconoMsj" src="img/actualizarLote.png" width="40px">

                <br><br>

                Paquete actualizado
                <br><br>

                <button onclick="volver()" class="volverCorrecto">Volver</button>
            </div>

        <?php
        } else {


        ?>
            <div class="msjEliminar">

                <img class="iconoMsj" src="img/advertencia.png" width="40px">

                <br><br>

                Error al actualizar el paquete"
                <br><br>

                <button onclick="volver()" class="volverError">Volver</button>
            </div>

<?php
        }


        break;
}


?>