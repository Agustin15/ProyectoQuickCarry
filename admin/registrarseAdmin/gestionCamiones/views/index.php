<?php

session_id("sessionAdmin");
session_start();

if (empty($_SESSION['id'])) {

?>
    <?php

    header('Location:../../controllers/login.html');
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>Camiones </title>
</head>

<body>



    <header>

        <a href="../../views/index.php">
            <img class="userImg" src="img/atras.png" width="30px">
        </a>
        <h1>Panel administrador</h1>
        <div onclick="mostrarMenu()" class="miPefil">


            <img class="userImg" src="img/miPerfil.png" width="30px">

        </div>
    </header>

    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfilFuncionarios">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="../../views/editarPerfilUsuarioAdmin.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesionFuncionarios">
            <img src="img/apagado.png" width="18px">
            <a href="../../controllers/cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>

    <?php

    require('../controllers/claseDatosCamion.php');
    $claseDatosUsuario = new datosCamion();


    $registros = $claseDatosUsuario->traerDatosCamion();


    ?>
    <div id="containerTable">

          
            
    <div id="containerBuscador">
        <input type="text" id="buscador" placeholder="Buscar...">
        </div>
     
        <div id="imgBuscar">
            <img src="img/lupa.png">
        </div>

        <h1>Camiones</h1>

        <img src="img/camion.png" width="60px">
        <br><br>
        <hr>

        <?php
        if ($registros->fetch_array() != null) {

        ?>
            <table id="tableCamiones">
                <thead>
                    <tr id="headTable">
                        <th style="width:120px;">Matricula</th>
                        <th>Capacidad de paquetes</th>
                        <th>Altura</th>
                        <th>Peso</th>
                        <th>N° Ruedas</th>

        </tr>

                </thead>

                <?php
                $camiones = $claseDatosUsuario->traerDatosCamion();

                foreach ($camiones->fetch_all(MYSQLI_ASSOC) as $camion) {

                    $camionCarga = $claseDatosUsuario->traerDatosVehiculosPorMatricula($camion['matricula']);

                ?>

                    <tbody>
                        <tr>

                            <td><?php echo $camion['matricula'] ?></td>

                            <td><?php echo $camionCarga['capacidadCarga'] ?></td>

                            <td><?php echo $camion['altura'] . " metros" ?></td>

                            <td><?php echo $camion['peso'] . " Ton" ?></td>

                            <td><?php echo  $camion['numeroRuedas'] ?></td>

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
                            <br>
                            <br>
                            <h2>No hay camiones registrados aun </h2>
                            <br>
                        </div>

                    <?php
                }

                    ?>
            </table>
    </div>





</body>

<script>
    var menuPerfil = document.getElementById('menuPerfilFuncionarios');


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
           
            $.each($("#tableCamiones tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
</script>

</html>