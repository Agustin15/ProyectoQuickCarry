<?php

session_id("sessionFuncioQuick");
session_start();
if (empty($_SESSION['id'])) {

?>
    <?php

    header('Location:login.html');
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
    <title>Almacen Quick Carry</title>
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">

</head>

<body>

    <header>

        <a href="index.php">
            <img class="userImg" src="img/atras.png" width="30px">
        </a>
        <h1>Lotes del almacen</h1>

        <div onclick="mostrarMenu()" class="miPefil">
            <img class="userImg" src="img/miPerfil.png" width="30px">

        </div>
    </header>


    

    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilAlmacen">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="editarPerfilUsuario.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesionAlmacen">
            <img src="img/apagado.png" width="18px">
            <a href="../controllers/cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>

    <?php


    if (isset($_POST['opcion'])) {

        $opcion = $_POST['opcion'];


        //switch con los valor de opcion recibido
        switch ($opcion) {

            case 'agregar':


                if (isset($_POST['numLote']) && isset($_POST['matricula']) && isset($_POST['paquetes'])) {
                    $numLote = $_POST['numLote'];
                    $matricula = $_POST['matricula'];
                    $paquetes = $_POST['paquetes'];

                    $datos = array(

                        'numLote' => $numLote,
                        'matricula' => $matricula,
                        'paquetes' => $paquetes
                    );



                    $jsonDatosPaquete = json_encode($datos);

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, "$_SERVER[HTTP_HOST]/CronosLogistics/FormularioUsuario/LoginQuick/LoginFuncionario/RegistrarseQuickCarry/RegistrarseFuncionario/controllers/apiAlmacen.php");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, array("jsonDatosPaquete" => $jsonDatosPaquete));

                    $resultado = curl_exec($ch);

                    curl_close($ch);

                    echo $resultado;
                } else {

    ?>
                    <div class="msjEliminar">
                        <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
                        <a class="msj">Datos del lote incompletos</a><br><br>
                        <button onclick="volver()" class="volverError">Volver</button>
                    </div>

                <?php
                }

                break;



            case 'agregarPaquete':


                if (isset($_POST['numLote']) && isset($_POST['idPaquete'])) {

                    $numLote = $_POST['numLote'];
                    $idPaquete = $_POST['idPaquete'];

                    $datos = array(

                        'numLote' => $numLote,
                        'idPaquete' => $idPaquete
                    );



                    $jsonDatosPaquete = json_encode($datos);

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, "$_SERVER[HTTP_HOST]/CronosLogistics/FormularioUsuario/LoginQuick/LoginFuncionario/RegistrarseQuickCarry/RegistrarseFuncionario/controllers/apiAlmacen.php");
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
                        <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
                        <a class="msj">Datos del lote incompletos</a><br><br>
                        <button onclick="volver()" class="volverError">Volver</button>
                    </div>

        <?php
                }

                break;
        }
    } else {

        ?>
        <br><br><br><br>';

        <div class="msjEliminar">
            <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
            <a class="msj">Datos no encontrados</a><br><br>
            <button onclick="volver()" class="volverError">Volver</button>
        </div>

    <?php
    }


    ?>


</body>


<script>
    var menuPerfil = document.getElementById('menuPerfilAlmacen');

    function volver() {

        location.href = '../views/listaPedidos.php';

    }

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