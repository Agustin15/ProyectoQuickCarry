<?php

session_id("sessionChofer");
session_start();

$idChoferCamion = $_SESSION['id'];
$matricula = $_SESSION['matriculaCamion'];

require("../controller/claseDatosPaquetes.php");
$claseDatosPaquetes = new datosPaquete();

if (empty($_SESSION['id'])) {

?>
  <?php

  header('Location:../controller/login.html');
  ?>
<?php
}

$datosJsonEnvio = $_SESSION['datosEnvio'];

$enviosJsonDecodificado = json_decode($datosJsonEnvio, true);

?>

<!DOCTYPE html>

<html>

<head>

  <title>Destino Almacen</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="img/LogoQuickCarry.png" type="image/x-icon">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />


  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.79.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>

  <script src="leaflet-routing-machine-3.2.12/dist/leaflet-routing-machine.js"></script>
  <link rel="stylesheet" href="leaflet-routing-machine-3.2.12/dist/leaflet-routing-machine.css">


</head>

<body bgcolor="#F9F9F9">



  <header class="headerAlmacenCrecom">


    <a href="index.php">
      <img class="userImg" src="img/atras.png" width="30px">
    </a>

    <h1>Chofer Quick Carry</h1>


  </header>

  <div>
    <div id="map"></div>




    <div onclick="ocultarMenu()" id="menu">

      <img class="imgMenu" src="img/menu.png">

    </div>

    <div id="containerDatosPaquete">

      <br>
      <img id="iconoCamionDatosPaquete" src="img/camionReparto.png">
      <ul>

        <br>
        <label>Paquetes</label>

        <br>
        <form method="POST">
          <select name="idPaquete[]" id="idPaquete" multiple>

            <?php


            foreach ($enviosJsonDecodificado as $envios => $paquete) {

              $paquetes = $claseDatosPaquetes->detallesPaquete($paquete['idPaquete']);
              $datosPaquete = $paquetes->fetch_array();
              $almacenPaquete = $claseDatosPaquetes->buscarAlmacen($paquete['numAlmacen']);


              if ($datosPaquete['estado'] == "Armado") {
            ?>

                <option value="<?php echo $paquete['idPaquete'] ?>">
                  <?php

                  echo $paquete['idPaquete'] . "," . $almacenPaquete['departamento'] ?></option>
            <?php
              }
            }

            ?>

          </select>

          <br>
          <button title="Subir paquete al camion" id="btnSubir">

            Subir paquete al camion
            <img src="img/subir.png">


          </button>


        </form>


        <div id="opcionSubir">

          <br>

          <form method="POST">

            <label>Cargados(Seleccionar)</label>
            <br>
            <select name="idPaquetesCargados[]" id="selectDepositar" multiple>

              <?php

              $paquetesCargados = 0;
              foreach ($enviosJsonDecodificado as $envios => $paquete) {

                $paquetes = $claseDatosPaquetes->detallesPaquete($paquete['idPaquete']);
                $datosPaquete = $paquetes->fetch_array();
                $almacenPaquete = $claseDatosPaquetes->buscarAlmacen($paquete['numAlmacen']);


                if ($datosPaquete['estado'] == "En el camion") {
              ?>


                  <option value="<?php echo $paquete['idPaquete'] ?>">
                    <?php
                    echo $paquete['idPaquete'] . "," . $almacenPaquete['departamento'] ?></option>
              <?php
                  $paquetesCargados++;
                }
              }

              ?>

            </select>

            <br>
            <button title="Depositar paquetes en Quick Carry" id="btnDejarEnQuick">

              <br>
              <a>Depositar en Quick carry</a>
              <img src="img/depositar.png">


            </button>



          </form>
          <br>
        </div>
    </div>
    <br>

    <script>
      var map = L.map('map', {
        trackResize: true,

      }).setView([-34.8996361, -56.1340242], 13);

      // Añadir un layer de mapa (puedes usar otros proveedores de mapas)
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19
      }).addTo(map);



      var iconoAlmacenCrecom = L.icon({

        iconUrl: "img/almacen.png",
        iconSize: [38, 38]

      });

      var iconoAlmacenQuick = L.icon({

        iconUrl: "img/almacenQuick.png",
        iconSize: [38, 38]

      });


      var iconoCamion = L.icon({

        iconUrl: "img/camion.png",
        iconSize: [38, 38]

      });

      var miUbicacion = L.control.locate(

        {
          drawCircle: false

        }
      ).addTo(map);


      var longitudUbiChofer=null;
      var latitudUbiChofer=null;

      // empieza la busqueda de la ubicación
      miUbicacion.start();

      map.on('locationfound', function(e) {
        latitudUbiChofer = e.latlng.lat; // tomar la latitud
        longitudUbiChofer= e.latlng.lng; // tomar la longitud


        // Crea un marcador en la ubicación del chofer
        var marker = L.marker([latitudUbiChofer,longitudUbiChofer], {
          icon: iconoCamion

        }).addTo(map);
        marker.bindPopup("Mi ubicacion").openPopup();

        // Centra el mapa en la ubicación del chofer
        map.setView([latitud, longitud], 13);


      });

      //almacen Quick Carry

      <?php
      if ($paquetesCargados == count($enviosJsonDecodificado)) {

        $almacenQuickCarry = $claseDatosPaquetes->buscarAlmacen(20);

      ?>

        var urlDestino = 'https://nominatim.openstreetmap.org/search?format=json&q=' +
          encodeURIComponent("<?php echo $almacenQuickCarry['direccion'] ?>");

        fetch(urlDestino)
          .then(function(response) {
            return response.json();
          })
          .then(function(data) {
            if (data.length > 0) {
              var lat = parseFloat(data[0].lat);
              var lon = parseFloat(data[0].lon);
              var marker = L.marker([lat, lon], {
                icon: iconoAlmacenQuick
              }).addTo(map);
              marker.bindPopup("Almacen Quick Carry:<?php $almacenQuickCarry['direccion'] . "," . $almacenQuickCarry['departamento'] ?>").openPopup();

              map.setView([lat, lon], 15);


              if (latitudUbiChofer != null && longitudUbiChofer != null) {

                var routing = L.Routing.control({
                  waypoints: [
                    L.latLng(latitudUbiChofer, longitudUbiChofer), // Punto de inicio (ubicacion chofer)
                    L.latLng(lat, lon) // Punto de destino del almacen quick carry

                  ],
                  routeWhileDragging: true,


                  language: 'es'

                }).addTo(map);

              }



            } else {
              alert('No se encontro el almacen Quick Carry');
            }

          })

      <?php
      }

      ?>




      //almacenes crecom
      <?php
      foreach ($enviosJsonDecodificado as $envios => $paquete) {

        $paquetes = $claseDatosPaquetes->detallesPaquete($paquete['idPaquete']);
        $datosPaquete = $paquetes->fetch_array();
        if ($datosPaquete['estado'] == "Armado") {

      ?>
          var urlDestino = 'https://nominatim.openstreetmap.org/search?format=json&q=' +
            encodeURIComponent("<?php echo $paquete['direccionAlmacen'] ?>");

          fetch(urlDestino)
            .then(function(response) {
              return response.json();
            })
            .then(function(data) {
              if (data.length > 0) {
                var lat = parseFloat(data[0].lat);
                var lon = parseFloat(data[0].lon);
                var marker = L.marker([lat, lon], {
                  icon: iconoAlmacenCrecom
                }).addTo(map);

                map.setView([lat, lon], 15);
                marker.bindPopup("Almacen:<?php echo $paquete['numAlmacen'] . "," . $paquete['direccionAlmacen'] . "," . $paquete['departamentoAlmacen'] ?>").openPopup();

                if (latitudUbiChofer != null && longitudUbiChofer != null) {
                  var routing = L.Routing.control({
                    waypoints: [
                      L.latLng(latitudUbiChofer, longitudUbiChofer), // Punto de inicio(ubicacion chofer)
                      L.latLng(lat, lon) // Punto de destino de cada almacen crecom

                    ],
                    routeWhileDragging: true,
                    language: 'es'

                  }).addTo(map);

                }


              } else {
                alert('No se encontró la dirección');
              }



            })
            .catch(function(error) {
              console.error('Error:', error);
            });
      <?php }
      } ?>
    </script>



</body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['idPaquete'])) {




    $idPaquetes = $_POST['idPaquete'];
    $fechaActual = date("Y-m-d H:i:s");
    $fechaActualSinHora = date("Y-m-d");


    foreach ($idPaquetes as $idPaquete) {



      $claseDatosPaquetes->choferPaquete($matricula, $idPaquete);


      $paquete = $claseDatosPaquetes->detallesPaquete($idPaquete);
      $datosPaquete = $paquete->fetch_array();
      $datosAlmacen = $claseDatosPaquetes->buscarAlmacen($datosPaquete['numAlmacen']);
      $departamentoAlmacen = $datosAlmacen['departamento'];


      $resultado = $claseDatosPaquetes->actualizarEstadoPaquete("En el camion", $idPaquete);


      $claseDatosPaquetes->insertarDatosTareaCamion(
        $matricula,
        "Subiendo Paquete " . $idPaquete . " del almacen de " . $departamentoAlmacen . " al camion",
        $fechaActual,
        $fechaActual
      );

      $trayectos = $claseDatosPaquetes->getTrayecto($matricula);
      if ($trayectos->fetch_all(MYSQLI_ASSOC) == null) {


        $claseDatosPaquetes->setTrayecto($matricula, $datosPaquete['numAlmacen'], 0, $fechaActual);
      } else {


        $trayectosPorFechayAlmacen = $claseDatosPaquetes->getTrayectoPorNumAlmacenYFecha(
          $fechaActualSinHora,
          $datosPaquete['numAlmacen']
        );

        if ($trayectosPorFechayAlmacen == null) {

          $claseDatosPaquetes->setTrayecto($matricula, $datosPaquete['numAlmacen'], 0, $fechaActual);
        }
      }

      switch ($datosPaquete['numAlmacen']) {

        case 1:

          $ruta = 30;


          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;


        case 2:

          $ruta = 5;

          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);
          break;


        case 3:

          $ruta = 7;

          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);
          break;


        case 4:

          $ruta = 1;

          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);
          break;


        case 5:

          $ruta = 5;

          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;


        case 6:

          $ruta = 5;

          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;


        case 7:

          $ruta = 3;
          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;


        case 8:

          $ruta = 8;
          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);


          break;


        case 9:

          $ruta = 8;
          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;


        case 10:

          $ruta = 1;

          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;


        case 11:

          $ruta = 3;
          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;



        case 12:

          $ruta = 3;
          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;


        case 13:

          $ruta = 8;
          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;

        case 14:

          $ruta = 9;

          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;

        case 15:

          $ruta = 3;
          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;


        case 16:

          $ruta = 1;
          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;


        case 17:

          $ruta = 2;
          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;


        case 18:

          $ruta = 5;
          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;


        case 19:

          $ruta = 8;

          $claseDatosPaquetes->updateRuta($ruta, $datosPaquete['numAlmacen']);

          break;
      }



      $visitas = $claseDatosPaquetes->getVisita($matricula);
      if ($visitas->fetch_all(MYSQLI_ASSOC) == null) {


        $claseDatosPaquetes->agregarVisita($matricula, $datosPaquete['numAlmacen'], $fechaActual);
      } else {


        $visitasPorFechayAlmacen = $claseDatosPaquetes->getVisitasPorNumAlmacenYFecha(
          $fechaActualSinHora,
          $datosPaquete['numAlmacen']
        );

        if ($visitasPorFechayAlmacen == null) {

          $claseDatosPaquetes->agregarVisita($matricula, $datosPaquete['numAlmacen'], $fechaActual);
        }
      }
    }



    if ($resultado) {

?>


      <div class="imgGif">
        <label>Paquete N° <?php echo $idPaquete ?> cargado</label>
        <br>
        <img src="img/repartidorPaquete.gif" width="100px">
      </div>
    <?php

    }
  }

  if (isset($_POST['idPaquetesCargados'])) {

    $idPaquetesCargados = $_POST['idPaquetesCargados'];

    foreach ($idPaquetesCargados as $idPaqueteCargado) {

      $claseDatosPaquetes->actualizarEstadoPaquete("En almacen Quick Carry", $idPaqueteCargado);
    }
    ?>
    <div class="imgGif2">
      <label>Paquetes depositados en QuickCarry</label>
      <br>
      <img src="img/camionLlegado.gif" width="160px">
    </div>
  <?php

    $fechaActual = date("Y-m-d H:i:s");

    $claseDatosPaquetes->insertarDatosTareaCamion(
      $matricula,
      "Despositando los paquetes en el almacen de Quick Carry",
      $fechaActual,
      $fechaActual
    );

    $almacenQuickCarry = $claseDatosPaquetes->buscarAlmacen(20);

    $ruta = 1;
    $claseDatosPaquetes->agregarVisita($matricula, $almacenQuickCarry['numAlmacen'], $fechaActual);
    $claseDatosPaquetes->setTrayecto($matricula, $almacenQuickCarry['numAlmacen'], $ruta, $fechaActual);
  }

  ?>

  <script>
    setTimeout(() => {
      location.href = "mapa.php"
    }, 2000);
  </script>

<?php
}

?>


<script>
  var cont = 0;

  function ocultarMenu() {


    cont++;


    $('#containerDatosPaquete').css("visibility", "hidden");
    $('#map').css("marginLeft", "0%");
    $('#map').css("width", "100%");
    $('#menu').css("marginLeft", "50px");
    $('.imgMenu').attr("src", "img/menuCerrado.png");




    if (cont % 2 == 0) {


      $('#containerDatosPaquete').css("visibility", "visible");
      $('#map').css("marginLeft", "29%");
      $('#map').css("width", "71%");
      $('#menu').css("marginLeft", "5px");
      $('.imgMenu').attr("src", "img/menu.png");

    }

  }
</script>

</html>