<?php


session_id("sessionCrecom");
session_start();

if(isset($_POST['datosJson'])){


    $datosUsuario=$_POST['datosJson'];

    $datosDecodificadosUsuario = json_decode($datosUsuario,true);

    $_SESSION['id'] = $datosDecodificadosUsuario['id'];
    $_SESSION['nombre'] = $datosDecodificadosUsuario['nombre'];
    $_SESSION['apellido'] = $datosDecodificadosUsuario['apellido'];
    $_SESSION['usuario'] = $datosDecodificadosUsuario['usuario'];
    $_SESSION['numFuncio'] = $datosDecodificadosUsuario['numFuncio'];
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Panel</title>
</head>

<body>


    <header class="headerAlmacenCrecom">

        <h1>Panel Funcionario Crecom</h1>



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

    <div class="containerOpciones">


        <div class="boxOpciones" id="boxArmados">

            <h2>Paquetes Armados</h2>

            <img src="img/listaPaquetes.png">
            <br>
            <a href="listaPaquetes.php"><button>Ver</button></a>
        </div>

        <div class="boxOpciones" id="boxPendientes">

            <h2>Paquetes Pendientes</h2>

            <img src="img/paquetesPendientes.png">
            <br>
            <a href="PaquetesPendientes.php"><button>Ver</button></a>
        </div>

        <div class="boxOpciones" id="boxEliminar">


            <h2>Eliminar Paquete</h2>

            <img src="img/eliminarPaquete.png">
            <br>
            <a href="borrarPaquete.php"><button>Ver</button></a>
        </div>

        <div class="boxOpciones" id="boxModificar">

            <h2>Modificar Paquete</h2>

            <img src="img/actualizarPaquete.png">
            <br>
            <a href="modificarPaquete.php"><button>Ver</button></a>
        </div>
    </div>


    </div>



</body>


<script>
    var menuPerfil = document.getElementById('menuPerfilAlmacen');



    function mostrarMenu() {


        menuPerfil.style.visibility = 'visible';
        menuPerfil.classList.add('active');
        $(".containerOpciones").css("margin-top", "28%");
        $(".containerOpciones").css("transition", "0.6s");


    }



    function ocultarMenu() {


        menuPerfil.style.visibility = 'hidden';
        menuPerfil.classList.remove('active');
        $(".containerOpciones").css("margin-top", "8%");
        $(".containerOpciones").css("transition", "0.6s");


    }
</script>


</html>