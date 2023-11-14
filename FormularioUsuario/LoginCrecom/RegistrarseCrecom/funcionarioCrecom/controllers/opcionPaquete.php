<?php





session_id("sessionCrecom");
session_start();

if (empty($_SESSION['id'])) {

?>
    <?php

    header('Location:login.html')
    ?>
<?php
}


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

        <a href="../views/index.php">
            <img class="userImg" src="img/atras.png" width="30px">
        </a>
        <h1>Paquetes</h1>

        <div onclick="mostrarMenu()" class="miPefil">
            <img class="userImg" src="img/miPerfil.png" width="30px">

        </div>
    </header>




    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilModificarLote">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="editarPerfilUsuario.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesionModificarLote">
            <img src="img/apagado.png" width="18px">
            <a href="../controllers/cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>

    <?php



    if (isset($_POST['opcion'])) {

        $opcion = $_POST['opcion'];
        //switch con los valor de opcion recibido
        switch ($opcion) {

            case 'eliminar':

                if (isset($_POST['idPaquete'])) {
                    $idPaquete = $_POST['idPaquete'];
                    $estado = $_POST['estado'];
                    $opcion = "eliminar";

                    $datos = array(
                        'idPaquete' => $idPaquete, 'opcion' => $opcion,
                        'estado' => $estado
                    );

                    $jsonDatosPaquete = json_encode($datos);


                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, "http://$_SERVER[HTTP_HOST]/CronosLogistics/FormularioUsuario/LoginCrecom/RegistrarseCrecom/funcionarioCrecom/controllers/apiAlmacen.php");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDatosPaquete);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($jsonDatosPaquete)
                    ));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $resultado = curl_exec($ch);
                    echo $resultado;
                    curl_close($ch);
                } else {
    ?>
                    <div class="msjEliminar">

                        <img class="iconoMsj" src="img/advertencia.png" width="40px">

                        <br><br>

                        No hay paquete para borrar
                        <br><br>

                        <button onclick="volver()" class="volverError">Volver</button>
                    </div>

                <?php
                }


                ?>
                <script>
                    function volver() {

                        location.href = '../views/borrarPaquete.php';

                    }
                </script>

                <?php
                break;




            case 'agregar':


                if (
                    isset($_POST['idPaquete']) && isset($_POST['nombre']) && isset($_POST['numAlmacen'])
                    && isset($_POST['estado']) && isset($_POST['destino']) && isset($_POST['codigoRastreo'])
                    && isset($_POST['fechaEntrega']) && isset($_POST['matriculaCamion'])
                ) {

                    $idPaquete = $_POST['idPaquete'];
                    $nombre = $_POST['nombre'];
                    $numAlmacen = $_POST['numAlmacen'];
                    $estado = $_POST['estado'];
                    $destino = $_POST['destino'];
                    $fechaEntrega = $_POST['fechaEntrega'];
                    $opcion = "agregar";
                    $codigoRastreo = $_POST['codigoRastreo'];
                    $matriculaCamion = $_POST['matriculaCamion'];


                    $datos = array(
                        'idPaquete' => $idPaquete,  'estado' => $estado,
                        'nombre' => $nombre, 'numAlmacen' => $numAlmacen,
                        'destino' => $destino, 'fechaEntrega' => $fechaEntrega,
                        'codigoRastreo' => $codigoRastreo, 'matriculaCamion' => $matriculaCamion


                    );
                    $jsonDatosPaquete = json_encode($datos);


                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, "http://$_SERVER[HTTP_HOST]/CronosLogistics/FormularioUsuario/LoginCrecom/RegistrarseCrecom/funcionarioCrecom/controllers/apiAlmacen.php");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, array("jsonDatosPaquete" => $jsonDatosPaquete));

                    $resultado = curl_exec($ch);

                    curl_close($ch);

                    echo $resultado;
                } else {

                ?>
                    <div class="msjEliminar">

                        <img class="iconoMsj" src="img/advertencia.png" width="40px">

                        <br><br>

                        No hay paquete para armar
                        <br><br>

                        <button onclick="volver()" class="volverError">Volver</button>
                    </div>

                <?php
                }

                ?>
                <script>
                    function volver() {

                        location.href = '../views/PaquetesPendientes.php';

                    }
                </script>

                <?php
                break;


            case 'modificar':


                if (
                    isset($_POST['idPaquete']) && isset($_POST['nombre']) && isset($_POST['numAlmacen'])
                    && isset($_POST['estado']) && isset($_POST['destino'])  && isset($_POST['fechaEntrega'])
                    && isset($_POST['matriculaCamion'])
                ) {


                    $idPaquete = $_POST['idPaquete'];
                    $nombre = $_POST['nombre'];
                    $numAlmacen = $_POST['numAlmacen'];
                    $estado = $_POST['estado'];
                    $destino = $_POST['destino'];
                    $fechaEntrega = $_POST['fechaEntrega'];
                    $matriculaCamion = $_POST['matriculaCamion'];




                    $datos = array(
                        'idPaquete' => $idPaquete,  'estado' => $estado,
                        'nombre' => $nombre, 'numAlmacen' => $numAlmacen,
                        'destino' => $destino, 'fechaEntrega' => $fechaEntrega,
                        'matriculaCamion' => $matriculaCamion


                    );
                    $jsonDatosPaquete = json_encode($datos);

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, "http://$_SERVER[HTTP_HOST]/CronosLogistics/FormularioUsuario/LoginCrecom/RegistrarseCrecom/funcionarioCrecom/controllers/apiAlmacen.php");
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDatosPaquete);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($jsonDatosPaquete)
                    ));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $resultado = curl_exec($ch);
                    echo $resultado;
                    curl_close($ch);
                } else {
                ?>
                    <div class="msjEliminar">

                        <img class="iconoMsj" src="img/advertencia.png" width="40px">

                        <br><br>

                        No hay paquete para modificar"
                        <br><br>

                        <button onclick="volver()" class="volverError">Volver</button>
                    </div>

                <?php
                }


                ?>
                <script>
                    function volver() {

                        location.href = "../views/modificarPaquete.php";

                    }
                </script>

        <?php

                break;
        }
    } else {

        ?>
        <br><br><br>
        <div class="msjEliminar">

            <img class="iconoMsj" src="img/advertencia.png" width="40px">

            <br><br>
            Datos no encontrados
            <br><br>

            <button onclick="volver()" class="volverError">Volver</button>
        </div>

    <?php
    }

    ?>


</body>


<script>
    var menuPerfil = document.getElementById('menuPerfilModificarLote');

    function mostrarMenu() {


        menuPerfil.style.visibility = 'visible';
        menuPerfil.classList.add('active');

    }



    function ocultarMenu() {


        menuPerfil.style.visibility = 'hidden';
        menuPerfil.classList.remove('active');

    }
</script>

</html>