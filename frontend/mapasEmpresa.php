<?php
  session_start();
  if (!isset($_SESSION["token"]))
    {header("Location: 401.html");}

  if (!isset($_COOKIE["token"]))
    {header("Location: 401.html");}

  if ($_SESSION["token"] != $_COOKIE["token"]){
    header("Location: 401.html");
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mapa</title>
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="bootstrap/estilos.css">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="APImaps/v6.2.1-dist/ol.css">
  <script type="text/javascript" src="http://www.openlayers.org/api/OpenLayers.js">
  </script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"> <?php echo $_COOKIE["name"] ?> <span id="nombre-empresa"></span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" id="perfil" href="visualizarPerfilEmpresa.php" style="color: #1B6DC1;">Perfil</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="img/empresaSinFondo.png" width="25px" alt="">
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="actualizarPerfilEmpresa.php">Actualizar perfil</a>
            <a class="dropdown-item" href="visualizarPerfilEmpresa.php">Visualizar perfil</a>
            <a class="dropdown-item" href="dash.php">Dashboard administrativo</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logoutE.php">Cerrar sesión</a>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: #1B6DC1;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sucursales
          </a>
          <div class="dropdown-menu" id="menu-desplegable-de-promociones" aria-labelledby="navbarDropdown">
            <!-- <a class="dropdown-item" href="#">Principal</a>
            <a class="dropdown-item" href="#">Sucursal 1</a>
            <a class="dropdown-item" href="#">etc</a> -->
        </li>
      </ul>


    </div>
  </nav>
  <div id="map" class="map"></div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
  <script src="jss/ol.js"></script>
  <script>
    const nombreEmpresa = leerCookie("name");
    var dir = [-0.12755, 51.507222];

    function cargarMapa() {
      var layer;
      var london;
      var view;
      var map;

      layer = new ol.layer.Tile({
        source: new ol.source.OSM(),
        noWrap: true,
        wrapX: false
      });
      london = ol.proj.transform(
        [dir[0], dir[1]],
        'EPSG:4326',
        'EPSG:3857'
      );
      view = new ol.View({
        center: london,
        zoom: 12
      });
      map = new ol.Map({
        renderer: 'canvas',
        target: 'map',
        layers: [layer],
        view: view
      });
    }
    cargarMapa();

    function leerCookie(namee) {
      let name = namee + "=";
      let ca = document.cookie.split(';');
      for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return unescape(c.substring(name.length, c.length));
      }
      return "";
    }

    function obtenerNombreSucursales() {
      // console.log(nombreEmpresa);
      axios({
        method: 'GET',
        url: '../backend/api/empresas.php' + '?nSuc=' + nombreEmpresa,
        responseType: 'json'
      }).then(res => {
        if (res.data.estado == "exito") {
          console.log(res.data);
          console.log(res);
          console.log(res.data.nombreSucursales);
          if (res.data.nombreSucursales.length == 0) {
            document.getElementById('menu-desplegable-de-promociones').innerHTML = "<a class='dropdown-item' href='#'>No tiene sucursales registradas</a>";
          } else {
            for (let i = 0; i < res.data.nombreSucursales.length; i++) {
              document.getElementById('menu-desplegable-de-promociones').innerHTML += `<a class='dropdown-item' id='${res.data.nombreSucursales[i].replace(" ", "-")}' href='#' onclick='verEnMapa(${i})'>${res.data.nombreSucursales[i]}</a>`;
            }
          }
        } else {
          alert("Error");
        }
      }).catch(err => {
        alert("Error al obtener sucursales: " + err);
      });
    }
    obtenerNombreSucursales();

    function verEnMapa(indice) {
      axios({
        url: '../backend/api/empresas.php' + '?vSuc=' + nombreEmpresa,
        method: 'POST',
        responseType: 'json',
        data: {
          id: indice
        }
      }).then(res => {
        if (res.data.estado == "exito") {
          dir[0] = parseFloat(res.data.sucursal.latitud);
          dir[1] = parseFloat(res.data.sucursal.longitud);
          // cargarMapa();
          posicionar();
          console.log(dir);
          console.log(parseFloat(res.data.sucursal.latitud));
          console.log(parseFloat(res.data.sucursal.longitud));
        } else {
          alert("Error");
        }
      }).catch(err => {
        alert("Error al ver sucursal: " + error);
      });

    }

    function posicionar() {
      var layer = new ol.layer.Tile({
        source: new ol.source.OSM(),
        noWrap: true,
        wrapX: false
      });

      var centrar = ol.proj.transform(
        [dir[0], dir[1]],
        'EPSG:4326',
        'EPSG:3857'
      );

      var view = new ol.View({
        center: centrar,
        zoom: 12
      });

      var map = new ol.Map({
        renderer: 'canvas',
        target: 'map',
        layers: [layer],
        view: view
      });
    }
  </script>





  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- <script src="jss/contenedorMapa.js"></script>
    <script src="APImaps/v6.2.1-dist/ol.js"></script> -->
</body>

</html>