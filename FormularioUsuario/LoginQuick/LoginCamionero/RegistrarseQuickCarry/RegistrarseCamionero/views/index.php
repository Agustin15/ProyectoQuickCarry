<?php


session_id("sessionChofer");
session_start();



if(isset($_POST['datosJson'])){


    $datosUsuario=$_POST['datosJson'];

    $datosDecodificadosUsuario = json_decode($datosUsuario,true);

    $_SESSION['id'] = $datosDecodificadosUsuario['id'];
    $_SESSION['nombre'] = $datosDecodificadosUsuario['nombre'];
    $_SESSION['apellido'] = $datosDecodificadosUsuario['apellido'];
    $_SESSION['usuario'] = $datosDecodificadosUsuario['usuario'];
    $_SESSION['numChoferCamion'] = $datosDecodificadosUsuario['numChoferCamion'];
    $_SESSION['matriculaCamion'] = $datosDecodificadosUsuario['matriculaCamion'];
    $_SESSION['cedula'] = $datosDecodificadosUsuario['cedula'];
    $_SESSION['correo'] = $datosDecodificadosUsuario['correo'];

    
 ?>

 <script>
 
 window.location.href="../views/index.php";
 
 </script>
 <?php

}



if (empty($_SESSION['id'])) {

    ?>
      <?php
    
      header('Location:../controllers/login.html');
      ?>
    <?php
    }


?>

<!DOCTYPE html>

<html>

<head>

    <title>Panel Chofer</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>



</head>



<body bgcolor="#F9F9F9">



    <header class="headerAlmacenCrecom">

        <h1>Chofer Quick Carry</h1>
        <div onclick="mostrarMenu()" class="miPefil">
            <img class="userImg" src="img/miPerfil.png" width="30px">

        </div>

    </header>

    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfil">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="editarPerfilUsuario.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesion">
            <img src="img/apagado.png" width="18px">
            <a href="../controller/cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>


    <div class="menuOpcionesPaquete">
        <nav>

    

         
        <a href="">
                <li>
                    <img src="img/subir.png" width="40px">
                    <br>
                    Paquetes

                </li>
            </a>

            <a href="rutas.php">
                <li>
                    <img src="img/rutas.png " width="40px">
                    <br>
                    Rutas

                </li>
            </a>

        </nav>
    </div>


<br>


    
    <div class="containerChofer">

        <img id="imgContainerChofer" src="../views/img/logomapa.png" width="240px">

        <?php

        require("../controller/claseDatosPaquetes.php");
        $claseDatosPaquetes = new datosPaquete();

        $matriculaCamion=$_SESSION['matriculaCamion'];

        $estado="Armado";

        $paquetes=$claseDatosPaquetes->mostrarDatosPaquete($matriculaCamion, $estado);


        if ($paquetes->fetch_all(MYSQLI_ASSOC) != null) {

        ?>
            <h2>Paquetes listos para buscar</h2>

            <?php


            $envio = array();


            $paquetesListos=$claseDatosPaquetes->mostrarDatosPaquete($matriculaCamion, $estado);

        
            foreach ($paquetesListos->fetch_all(MYSQLI_ASSOC) as $paqueteListo) {


                $idPaquete = $paqueteListo['idPaquete'];
                $numAlmacen = $paqueteListo['numAlmacen'];


                $almacen=$claseDatosPaquetes->buscarAlmacen($paqueteListo['numAlmacen']);

                $departamentoAlmacen = $almacen['departamento'];
                $direccionAlmacen = $almacen['direccion'];




                $paquetes = array(
                    "idPaquete" => $idPaquete, "numAlmacen" => $numAlmacen,
                    "direccionAlmacen" => $direccionAlmacen,
                    "departamentoAlmacen" => $departamentoAlmacen
                );

                array_push($envio, $paquetes);

            ?>
                <br>
                <br>
                <ul>
                    <li>

                        <img src="../views/img/paqueteChofer.png" width="30px">
                        <br>
                        <label>N° Paquete:</label>
                        <br>
                        <?php echo $idPaquete ?>

                    </li>
                    <li>
                        <img src="../views/img/almacenChofer.png" width="30px">
                        <br>
                        <label>N° Almacen:</label><br>

                        <?php echo $numAlmacen ?>

                    </li>
                    <li>

                        <img src="../views/img/direccion.png" width="25px">
                        <br>
                        <label>Direccion:</label><br>

                        <a id="direccion"><?php echo $direccionAlmacen ?></a>

                    </li>
                    <li id="liDepartamento">

                        <img src="../views/img/departamento.png" width="25px">
                        <br>
                        <label>Departamento:</label><br>

                        <?php echo $departamentoAlmacen ?>

                    </li>


                    <br>
                    <br>
                    <hr>
                </ul>
                <br><br>




            <?php
            }


            $jsonEnvios = json_encode($envio);

            $_SESSION['datosEnvio'] = $jsonEnvios;

            ?>

            <br>
            <a href="mapa.php"><button>ACEPTAR</button></a>
            <br>
            <br>

        <?php

        } else {

        ?>

            <div class="advertenciaPedidos">

                <img src="../views/img/advertenciaPedidos.png">
                <br>
                <h2>No hay pedidos</h2>
                <br>
            </div>
        <?php



        }
        ?>
    </div>
    <br>



</body>

<script>
  var menuPerfil = document.getElementById('menuPerfil');

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