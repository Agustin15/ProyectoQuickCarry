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
    <title>Nuevo Paquete</title>

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

    $idPaquete = $_GET['idPaquete'];

    $conexion = new mysqli('localhost','root','','php');  
    $seleccion = $conexion->prepare("select * from paquete where idPaquete=?");
    $seleccion->bind_param("i", $idPaquete);
    $seleccion->execute();
    $registros = $seleccion->get_result();
    $regPaquete = $registros->fetch_array();

    ?>
    <form method="POST" action="../controllers/opcionPaquete.php" id="formAgregar">

  
        <h2>Armar Paquete
            <img  src="img/agregar-producto.png" >
        </h2>

        <div id="containerInputsAgregar">
        <input name="opcion" type="hidden" value="agregar">

        <input name="estado" type="hidden" value="Armado">

        <input name="idPaquete" type="hidden" value="<?php echo $idPaquete ?>">

        <br><br>
    
        
       
      
        <input placeholder="Nombre"  required="true" type="text" name="nombre" 
        value="<?php echo $regPaquete['nombre'] ?>">

        <?php
        $sentencia = "select * from almacenes";

        $registro = $conexion->query($sentencia);

        ?>

       
        <select name="numAlmacen">

        <?php
        foreach ($registro->fetch_all(MYSQLI_ASSOC) as $reg) {


            if($reg['numAlmacen']!=20){
                  ?>
            <option value="<?php echo $reg['numAlmacen']?>"> 
             <?php echo $reg['numAlmacen'] . "," . $reg['departamento']?></option>

             <?php
            }
        }

          ?>
    </select>
        
        <br>
        <br>

     
        <input type="text" required placeholder="Destino" 
        value="<?php echo $regPaquete['destino'] ?>" name="destino">
       
        <input type="datetime-local" value="Fecha Entrega" required name="fechaEntrega">

        <br><br>
        <input type="text" placeholder="Codigo de rastreo" minlength="13" required maxlength="13" name="codigoRastreo">

        
        <?php
        $sentencia = "select * from camiones";

        $camiones= $conexion->query($sentencia);

        echo '<select name="matriculaCamion">';
        foreach ($camiones->fetch_all(MYSQLI_ASSOC) as $camion) {


            echo "<option value='$camion[matricula]'>" .
             $camion['matricula'] . "</option>";
        }


        echo '</select>';
        ?>
        <br>
        <br>
        </div>
        <input type="submit" value="Agregar">
    </form>
    <br>
    <?php

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