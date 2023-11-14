
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Rastrear Paquete</title>
</head>

<body>

<header>
        <h1>Rastrear Paquete</h1>

    </header>

    <nav>
        <a href="../../views/Index.html">Inicio</a>
        <a href="../../views/Index.html#IniciarSesion">Iniciar Sesion</a>
        <a href="../../views/Contacto.html">Contacto</a>
        <a href="../../views/SobreNosotros.html">Sobre Nosotros</a>
          <a href="index.php">Rastrear Paquete</a>
    </nav>
    <br>
    <br>
    <div id="banner" >

        <img src="img/bannerRastreo.png" class="imgBanner">
    </div>
<div id="containerRastrear">

<h2>¡Siga el paquete que a ordenado!</h2>

<img id="imgLogoRastrear" src="img/rastrear.png" width="60px">
<form action="estadoPaquete.php" method="POST">

<label>Ingresa codigo de rastreo</label>
<br>
<img id="imgPaqueteCodigo" src="img/paqueteCodigo.png" width="30px">

<input type="text" name="codigoRastreo" minlength="13" maxlength="13" placeholder="Código">
<br>

<input type="submit" value="Buscar">
</form>
</div>


</body>


<script>
   
</script>


</html>