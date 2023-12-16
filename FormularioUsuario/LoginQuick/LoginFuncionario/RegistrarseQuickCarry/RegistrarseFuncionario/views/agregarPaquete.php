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
    <link rel="stylesheet" href="style.css">
    <title>Agregar Paquete a un lote</title>
</head>

<header class="headerAlmacenCrecom">



    <a href="index.php">
        <img class="userImg" src="img/atras.png" width="30px">
    </a>
    <h1>Agregar Lote</h1>


    <div onclick="mostrarMenu()">
        <img class="userImg" src="img/miPerfil.png" width="30px">

    </div>
</header>



<div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilAgregarLote">

    <img src="img/miPerfil.png" width="60px">
    <h4><?php echo $_SESSION['usuario'] ?></h4>
    <a href="editarPerfilUsuario.php"><button>Editar perfil</button></a>
    <br>
    <br>
    <hr>

    <div class="cerrarSesionAgregarLote">
        <img src="img/apagado.png" width="18px">
        <a href="../controllers/cerrarSesion.php">Cerrar Sesion</a>
    </div>

</div>

<body>


    <?php
    if (isset($_GET['idPaquete'])) {


        $idPaquete = $_GET['idPaquete'];

        require('../controllers/claseAlmacen.php');
        $claseAlmacen = new almacen();

    ?>



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


        <form method="POST" action="../controllers/opcionLote.php" id="formModificar">

            <div class="titulo">
                <h2>Agregar Paquete </h2>
                <img src="img/agregarLote.png" width="40px">
            </div>
            <br>
            <input type="hidden" name="opcion" value="agregarPaquete">
            
            <input type="hidden" name="idPaquete" value="<?php echo $idPaquete?>">

            <label>N° Paquete</label>
            <br>
            <label><?php echo $idPaquete?></label>
            <br><br>

            <label>N° Lote</label>
            <br>
            <?php
            
           $lotes= $claseAlmacen->traerLotes();
            ?>
           <select name="numLote">
             
           <?php
              
              foreach($lotes->fetch_all(MYSQLI_ASSOC) as $lote){

                 ?>
               <option value="<?php echo $lote['numLote']?>"><?php echo $lote['numLote']?></option>
              
                 <?php
                
              }

               ?>
        

           </select>
          
            <br><br>

            <input type="submit" value="Agregar">

        </form>

    <?php
    } else {

        ?>
        <br><br>
        <div class="msjEliminar">
        <img class="iconoMsj" src="img/advertencia.png" width="40px"><br><br>
        <a class="msj">Paquete no seleccionado</a><br><br>
        <button onclick="volver()" class="volverError">Volver</button>
        </div>


        <?php
    }

    ?>
</body>



<script>
    var menuPerfil = document.getElementById('menuPerfilAgregarLote');


    function volver() {

        location.href = 'listaPedidos.php';

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