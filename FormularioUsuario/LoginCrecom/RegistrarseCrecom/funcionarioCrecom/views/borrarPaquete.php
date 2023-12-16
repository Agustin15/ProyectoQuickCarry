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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
  <title>Buscar paquete a eliminar</title>

</head>

<body>


  <header class="headerAlmacenCrecom">



    <a href="index.php">
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


  <div class="menuOpcionesPaquete">
    <nav>

      <a href="listaPaquetes.php">
        <li>
          <img src="img/listaPaquetes.png " width="30px">
          <br>
          Lista
        </li>
      </a>

      
      <a href="PaquetesPendientes.php">
                <li>
                    <img src="img/paquetesPendientes.png " width="30px">
                    <br>
                    Pendientes

                </li>
            </a>
      <a href="">
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



  <form class="buscarLoteBorrar" action="../controllers/opcionPaquete.php" method="POST">

    <br>
    <a>N° de paquete a borrar</a>
    <img src="img/lupa.png" width="30px" style="position: absolute; margin-top:-10px; margin-left:5px;">
    <br>
    <?php

    //select option con numero de paquete para buscar

    require('../controllers/claseAlmacen.php');
    $claseAlmacen = new almacen();


    $registro = $claseAlmacen->getHistorialPaquetes();


    ?>
    <input type="hidden" name="opcion" value="eliminar">
    <input type="hidden" name="estado" value="Pedido">

    
    <select name="idPaquete">
   
    <?php
    foreach ($registro->fetch_all(MYSQLI_ASSOC) as $reg) {

      if($reg['estado']=="Armado"){

        ?>
      <option value='<?php echo $reg['idPaquete']?>'><?php echo $reg['idPaquete']?></option>

      <?php
      }
    }
  

 ?>
    </select>

  
    <br><br>
    <input type="submit" value="Buscar">
  </form>




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