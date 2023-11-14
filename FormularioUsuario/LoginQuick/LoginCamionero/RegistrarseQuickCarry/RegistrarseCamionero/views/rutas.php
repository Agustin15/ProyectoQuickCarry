<?php



session_id("sessionChofer");
session_start();

require("../controller/claseDatosPaquetes.php");
$claseDatosPaquetes = new datosPaquete();

$matricula = $_SESSION['matriculaCamion'];


if (empty($_SESSION['id'])) {

?>
    <?php

    header('Location:../controller/login.html');
    ?>
<?php
}



?>

<!DOCTYPE html>

<html>

<head>

    <title>Panel Chofer</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


</head>



<body bgcolor="#F9F9F9">



    <header class="headerAlmacenCrecom">

        <h1>Chofer Quick Carry</h1>
        <div onclick="mostrarMenu()" class="miPefil">
            <img class="userImg" src="img/miPerfil.png" width="30px">

        </div>

    </header>

    <div class=".active" onmouseleave="ocultarMenu()" id="menuPerfil">

        <img src="img/miPerfil.png" width="60px">
        <h4><?php echo $_SESSION['usuario'] ?></h4>
        <a href="editarPerfilUsuario.php"><button>Editar perfil</button></a>
        <br>
        <br>
        <hr>

        <div class="cerrarSesion">
            <img src="img/apagado.png" width="18px">
            <a href="../controller/cerrarSesion.php">Cerrar Sesion</a>
        </div>

    </div>


    <div class="menuOpcionesPaquete">
        <nav>


            <a href="index.php">
                <li>
                    <img src="img/subir.png" width="40px">
                    <br>
                    Paquetes

                </li>
            </a>

            <a href="">
                <li>
                    <img src="img/rutas.png " width="40px">
                    <br>
                    Rutas

                </li>
            </a>


        </nav>
    </div>




    <div id="containerTableRutas">


        <div id="containerBuscador">
            <input type="text" id="buscador" placeholder="Buscar...">
        </div>

        <div id="imgBuscar">
            <img src="img/lupa.png">
        </div>
        <br>

        <table id="tableRutas">


            <h1>Rutas recorridas</h1>

            <img id="logoTableTrayectos" src="img/mapa.png">
            <br>


            <hr>

            <?php
            $trayectos = $claseDatosPaquetes->getTrayecto($matricula);



            ?>

            <thead>
                <tr id="headerTableRutas">

                    <th>

                        <img src="img/camionTrayecto.png" width="30px">
                        <br>
                        Camion
                    </th>

                    <th>
                        <img src="img/almacen.png" width="30px">
                        <br>
                        Almacen


                    </th>


                    <th>
                        <img src="img/rutas.png" width="30px">
                        <br>
                        Ruta
                    </th>


                    <th>
                        <img src="img/fechaVisita.png" width="30px">
                        <br>
                        Fecha
                    </th>

                </tr>
            </thead>

            <?php

            foreach ($trayectos->fetch_all(MYSQLI_ASSOC) as $trayecto) {

                $almacen = $claseDatosPaquetes->buscarAlmacen($trayecto['numAlmacen']);
                $departamento = $almacen['departamento'];

            ?>

                    <tbody>


                        <tr>
                            <?php

                            $date = date_create($trayecto['fechaTrayecto']);
                            $fechaVisita = date_format($date, 'd/M H:i');
                            str_replace("/", "de", $fechaVisita)
                            ?>
                            <td><?php echo $trayecto['matriculaCamion'] ?></td>
                            <td><?php echo $trayecto['numAlmacen'] . ',' . $departamento ?></td>
                            <td><?php echo $trayecto['ruta'] ?></td>
                            <td><?php echo $fechaVisita ?></td>
                        </tr>

                    </tbody>

            <?php

                }
            

            ?>

        </table>


    </div>
</body>


<script>
    var menuPerfil = document.getElementById('menuPerfil');


    function volver() {

        location.href = "index.php";

    }


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

            $.each($("#tableRutas tbody tr"), function() {
                if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                    $(this).hide();
                else
                    $(this).show();
            });
        });
    });
</script>

</html>