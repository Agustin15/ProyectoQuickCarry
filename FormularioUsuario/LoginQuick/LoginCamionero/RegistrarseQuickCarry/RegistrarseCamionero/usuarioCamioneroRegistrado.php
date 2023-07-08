<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Chofer registrado QuickCarry</title>
</head>


<body>


<header class="headerFormChofer">
       
       <h1>Bienvenidos a Quick Carry </h1>

   </header>

   <nav>
       <a href="../../../../../Index.html">Inicio</a>
       <a href="../../../../../Index.html #IniciarSesion">Iniciar Sesion</a>
       <a href="../../../../../Contacto.html">Contacto</a>
       <a href="../../../../../SobreNosotros.html">Sobre Nosotros</a>
   </nav>

    <?php

//recibe el mensaje la api de autenticacion
    $msjJson = urldecode($_GET['datos']);
    $arrayMsj=json_decode($msjJson,true);

    echo '<div class="registrado">';
    echo '<img class="iconoMsj" src="img/actualizado.png" width="60px"><br><br>';
    echo '<a>' . $arrayMsj['mensaje'] . '</a><br>';
    echo '<button onclick="login()" class="botonRegistrado">Iniciar Sesion</button>';
    echo '<div>';


    ?>

    <script>
        function login() {
            location.href = "login.html";

        }
    </script>

</body>

</html>