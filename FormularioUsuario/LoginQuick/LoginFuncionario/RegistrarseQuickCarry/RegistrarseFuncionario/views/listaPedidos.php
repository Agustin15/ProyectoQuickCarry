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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Pedidos-Almacen Quick Carry</title>

</head>

<body>


    <header class="headerAlmacenCrecom">


        <a href="index.php">
            <img class="userImg" src="img/atras.png" width="30px">
        </a>
        <h1>Pedidos armados</h1>

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

            <a href="">
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


    require('../controllers/claseAlmacen.php');
    $claseAlmacen = new almacen();


    $registros = $claseAlmacen->traerPaquetes("En almacen Quick Carry",null);

    ?>
    <div id="containerTablePedidos">
    <form id="formPaquetes" method="POST" action="agregarLote.php">


        <div id="containerBuscador">
        <input type="text" id="buscador" placeholder="Buscar...">
        </div>
     
        <div id="imgBuscar">
            <img src="img/lupa.png">
        </div>

        <br><br>
    <br><h1>Lista Paquetes</h1>
    <br>
    <div id="imgTablePedidos">
    <img src="img/listaPaquetes.png"><br><br>
    </div>
    <hr>


    <?php

    if ($registros->fetch_all(MYSQLI_ASSOC) != null) {


        ?>
        <table id="tablePedidos">
            <thead>
        <tr id="headTablePedidos">
        <th>Numero Paquete</th>
        <th>Producto</th>
        <th>Destino</th>
        <th>Estado</th>
      <th>Seleccionar</th>
      <th>Opciones</th>
    </tr>
        </thead>

        <?php
        $paquetes = $claseAlmacen->traerPaquetes("En almacen Quick Carry");

        foreach ($paquetes->fetch_all(MYSQLI_ASSOC) as $paquete) {

            ?>
            <tbody>
            <tr>
            <td><?php echo $paquete['idPaquete']?></td>
            <td><?php echo $paquete['nombre']?></td>
            <td><?php echo $paquete['destino']?></td>
            <td><?php echo $paquete['estado']?></td>



            <td style="width:160px;">
        
        <input id="checkboxPaquete" name="paquete[]" value="<?php echo $paquete['idPaquete']?>" type="checkbox">
    </td>

    <td><a href="agregarPaquete.php?idPaquete=<?php echo $paquete['idPaquete']?>">
        
    <div title="Agregar a un lote existente" id="agregarPaqueteAlLote">
        <img src="img/agregarLote.png" width="20px"></div></a>
       

</td>
        <tr>

        </tbody>
     
        <?php
        }

        
        ?>
        <br>
        </table>
        <input type="submit" value="Armar Lote">
    </form>
    <?php
        
    } else {

    ?>
        <div class="advertenciaPedidos">

            <img src="img/advertenciaPedidos.png">
            <h2>No hay paquetes aun </h2>
            <br>
        </div>

    <?php
    }

    ?>
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
           
            $.each($("#tablePedidos tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
</script>


</html>