<?php

session_id("sessionFuncioQuick");
session_start();


if (empty($_SESSION['id'])) {

?>
    <?php

    header('Location:../controllers/login.html');
    ?>
<?php
}

require('../controllers/claseAlmacen.php');
$claseAlmacen = new almacen();

$numLote = $_GET['numLote'];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Detalles Lote</title>

</head>

<body>

    <header class="headerAlmacenCrecom">


        <a href="javascript:history.back()">
            <img class="userImg" src="img/atras.png" width="30px">
        </a>
        <h1>Detalles Lote</h1>

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

            <a href="listaPedidos.php">
                <li>
                    <img src="img/listaPaquetes.png " width="30px">
                    <br>
                    Paquetes
                </li>
            </a>

            <a href="listaLotes.php">
                <li>
                    <img src="img/lotes.png " width="30px">
                    <br>
                    Lotes

                </li>
            </a>


        </nav>
    </div>
    <?php

    $paquetes = $claseAlmacen->paquetesDelLote($numLote);


    ?>
    <div id="containerTableLote">


    <div id="containerBuscador">
        <input type="text" id="buscador" placeholder="Buscar...">
        </div>
     
        <div id="imgBuscarLote">
            <img src="img/lupa.png">
        </div>

    

    <h1>Paquetes</h1>
    <br>
    <img id="iconoTableDetalles" src="img/paquete.png" width="40px">
  
    <br>
    <br>
    <hr>
    <table id="tablePaquetes">
        <thead>
    <tr id="headTable">
    <th>N° Paquete</th>
    <th>Producto</th>
    <th>Almacen</th>
    <th>Destino</th>
    </tr>
    </thead>

    <?php
    foreach ($paquetes->fetch_all(MYSQLI_ASSOC) as $paquete) {
     
     ?>

     <tbody>
        <tr>

        <td><?php echo $paquete['idPaquete']?></td>

        <td><?php echo $paquete['nombre']?></td>

        <?php
        $almacen = $claseAlmacen->datosAlmacenPaquete($paquete['numAlmacen']);
        $datosAlmacen = $almacen->fetch_array();

        ?>
        <td><?php echo $paquete['numAlmacen'] . "," . $datosAlmacen['departamento']?></td>



        <td><?php echo $paquete['destino']?></td>

        </tr>

        </tbody>
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
       
            $.each($("#tablePaquetes tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
</script>


</html>