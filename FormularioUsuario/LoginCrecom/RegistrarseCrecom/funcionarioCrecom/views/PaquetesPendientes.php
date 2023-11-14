<?php



session_id("sessionCrecom");
session_start();


if (empty($_SESSION['id'])) {

?>
    <?php

    header('Location:../controllers/login.html');
    ?>
<?php
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Paquetes Pendientes</title>
</head>

<body>


    <header class="headerAlmacenCrecom">


        <a href="index.php">
            <img class="userImg" src="img/atras.png" width="30px">
        </a>
        <h1>Paquetes</h1>


        <div onclick="mostrarMenu()">
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

    <div class="menuOpcionesPaquete">
        <nav>

            <a href="listaPaquetes.php">
                <li>
                    <img src="img/listaPaquetes.png " width="30px">
                    <br>
                    Lista
                </li>
            </a>


            <a href="">
                <li>
                    <img src="img/paquetesPendientes.png " width="30px">
                    <br>
                    Pendientes

                </li>
            </a>

            <a href="borrarPaquete.php">
                <li>
                    <img src="img/eliminarPaquete.png " width="30px">
                    <br>
                    Eliminar
                </li>
            </a>


            <a href="modificarPaquete.php">
                <li>
                    <img src="img/actualizarPaquete.png " width="30px">
                    <br>
                    Actualizar
                </li>
            </a>
        </nav>
    </div>

    <?php


    require('../controllers/claseAlmacen.php');
    $claseAlmacen = new almacen();


    $estado = "Pedido";
    $registros = $claseAlmacen->getPaquetesPendientes($estado);

    ?>
    <div id="containerTable">
        <br>

      
    <div id="containerBuscador">
        <input type="text" id="buscador" placeholder="Buscar...">
        </div>
     
        <div id="imgBuscar">
            <img src="img/lupa.png">
        </div>


        <br><br>

        <h1>Pendientes</h1>
        <br>
        <img src="img/paquetesPendientes.png"><br>
        <hr>

        
        <?php
        if ($registros->fetch_all(MYSQLI_ASSOC) != null) {

        ?>
            <table id="tablePaquetesPendientes">
                <thead>
                    <tr id="headTable">
                        <th>Numero Paquete</th>
                        <th>Producto</th>
                        <th>Estado</th>
                        <th>Destino</th>
                        <th>Opciones</th>

                    </tr>
                </thead>

                <?php
                $paquetes = $claseAlmacen->getPaquetesPendientes($estado);
                foreach ($paquetes->fetch_all(MYSQLI_ASSOC) as $paquete) {

                ?>
                <tbody>
                    <tr>
                        <td><?php echo $paquete['idPaquete'] ?></td>
                        <td><?php echo $paquete['nombre'] ?></td>
                        <td><?php echo $paquete['estado'] ?></td>
                        <td><?php echo $paquete['destino'] ?></td>
                        <td><a href="nuevoPaquete.php?idPaquete=<?php 
                        echo $paquete['idPaquete'] ?>"><button id="armar">+</button></a></td>
                    </tr>

                </tbody>
                <?php
                }


                ?>
                <br>


            <?php
        } else {

            ?>
                <div class="advertenciaPedidos">

                    <img src="img/advertenciaPedidos.png">
                    <h2>No hay pedidos aun </h2>
                    <br>
                </div>

            <?php
        }
            ?>
            </table>
    </div>




</body>


<script>
    var menuPerfil = document.getElementById('menuPerfilAlmacen');



    function mostrarMenu() {


        menuPerfil.style.visibility = 'visible';
        menuPerfil.classList.add('active');

    }



    function ocultarMenu() {


        menuPerfil.style.visibility = 'hidden';
        menuPerfil.classList.remove('active');

    }

    
   
    $(document).ready(function() {
        $("#buscador").keyup(function() {
            _this = this;
           
            $.each($("#tablePaquetesPendientes tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
</script>


</html>