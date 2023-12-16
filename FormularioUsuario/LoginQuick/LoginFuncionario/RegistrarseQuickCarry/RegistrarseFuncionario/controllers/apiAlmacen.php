<?php
require('claseAlmacen.php');
$claseAlmacen = new almacen();


switch ($_SERVER['REQUEST_METHOD']) {



    case 'PUT':

        echo '<title>Agregar Paquete</title>';


        $datosJsonPaquete = file_get_contents("php://input", true);

        $datosPaquete = json_decode($datosJsonPaquete, true);


        $numLote = $datosPaquete['numLote'];
        $idPaquete = $datosPaquete['idPaquete'];

        $sentencia = $claseAlmacen->modificarNumLotePaquete($numLote, $idPaquete);
        $estado = "En camino";
        $sentenciaPaquete = $claseAlmacen->modificarEstadoPaquete($estado, $idPaquete);

        if ($sentencia) {

            ?>
            <div class="msjActualizacion">

                <img class="iconoMsj" src="img/agregarLote.png" width="40px">

                <br><br>

                Paquete agregado al lote
                <?php echo $numLote ?>
                <br><br>

                <button onclick="volver()" class="volverCorrecto">Volver</button>
                <div>

                    <?php
        } else {

            ?>
                    <div class="msjEliminar">
                        <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
                        <a class="msj">No se pudo agregar al lote</a><br><br>
                        <button onclick="volver()" class="volverError">Volver</button>
                    </div>

                    <?php
        }
        break;




    case 'POST':

        echo '<title>Lote agregado</title>';


        $datosJsonPaquete = $_POST['jsonDatosPaquete'];

        $datosPaquete = json_decode($datosJsonPaquete, true);



        $numLote = $datosPaquete['numLote'];
        $paquetes = $datosPaquete['paquetes'];
        $matricula = $datosPaquete['matricula'];
        $datosVehiculoCamioneta = $claseAlmacen->traerDatosVehiculo($matricula);
        $capacidadMaxima = $datosVehiculoCamioneta['capacidadCarga'];

        $sentenciaLoteRepetido = $claseAlmacen->comprobarLoteRepetido($numLote);


        if ($sentenciaLoteRepetido) {

            ?>
                    <div class="msjEliminar">
                        <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
                        <a class="msj">N° de lote ya existente</a><br><br>
                        <button onclick="volver()" class="volverError">Volver</button>
                    </div>

                    <?php
        } else {

            if (count($paquetes) > $capacidadMaxima) {

                ?>
                        <div class="msjEliminar">
                            <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
                            <a class="msj">Capacidad maxima de la camioneta:
                                <?php echo $capacidadMaxima ?>
                            </a><br><br>
                            <button onclick="volver()" class="volverError">Volver</button>';
                        </div>
                        <?php
            } else {
                $sentencia = $claseAlmacen->agregarLote(
                    $numLote,
                    $matricula
                );
                foreach ($paquetes as $paquete) {

                    if ($sentencia) {
                        $estado = "En camino";
                        $claseAlmacen->modificarEstadoPaquete($estado, $paquete);
                        $claseAlmacen->modificarNumLotePaquete($numLote, $paquete);
                    }
                }

                if ($sentencia) {

                    ?>
                            <div class="msjActualizacion">
                                <img class="iconoMsj" src="img/paquete.png" width="40px"><br><br>
                                <a class="msj">Lote Armado</a><br><br>
                                <button onclick="volver()" class="volverCorrecto">Volver</button>

                            </div>
                            <?php
                } else {

                    ?>
                            <div class="msjEliminar">
                                <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
                                <a class="msj">No se pudo armar el lote</a><br><br>
                                <button onclick="volver()" class="volverError">Volver</button>
                            </div>

                            <?php
                }
            }

            break;
        }
}


?>

        <script>
            function volver() {

                location.href = '../views/listaPedidos.php';

            }

            var menuPerfil = document.getElementById('menuPerfilLote2');




            function mostrarMenu() {

                menuPerfil.style.visibility = 'visible';
                menuPerfil.classList.add('active');

            }


            function ocultarMenu() {


                menuPerfil.style.visibility = 'hidden';
                menuPerfil.classList.remove('active');

            }
        </script>


        </body>

        </html>