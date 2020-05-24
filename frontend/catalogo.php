<?php
session_start();
if (!isset($_SESSION["token"])) {
  header("Location: 401.html");
}

if (!isset($_COOKIE["token"])) {
  header("Location: 401.html");
}

if ($_SESSION["token"] != $_COOKIE["token"]) {
  header("Location: 401.html");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catálogo</title>
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/estilos.css">
  <link rel="stylesheet" href="bootstrap/font-awesome.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Catálogo de <span> <?php echo $_COOKIE["name"] ?> </span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" id="perfil" href="visualizarPerfilEmpresa.php" style="color: #1B6DC1;">Perfil <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="img/empresaSinFondo.png" width="25px" alt="">
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="actualizarPerfilEmpresa.php">Actualizar perfil</a>
            <a class="dropdown-item" href="visualizarPerfilEmpresa.php">Visualizar perfil</a>
            <a class="dropdown-item" href="dash.php">Dashboard administrativo</a>
            <a class="dropdown-item" href="#">Imprimir</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logoutE.php">Cerrar sesión</a>
          </div>
        </li>
      </ul>


    </div>
  </nav>

  <div class="container" style="padding: 30px;">
    <div id="aqui-van-los-productos" class="row">
      <!-- <div class="col-lg-4 col-md-4 col-sm-6-col-xs-12">
        <div class="card" style="width: 18rem;">
          <img src="img/pruebaproducto1.jpg" class="card-img-top" alt="..." style="width: 200px;">
          <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <h3>Sucursal</h3>
            <h2><b>PRECIO</b></h2>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam aliquid quidem
              mollitia atque rerum deserunt provident omnis quos illo expedita!</p>
            <a href="#" class="btn btn-primary" onclick="abrirModal(0)">Eliminar</a>
            <br><br>
            <a href="#" class="btn btn-primary" onclick="abrirModal(1)">Incrementar</a>
          </div>
        </div>
      </div> -->
    </div>
  </div>


  <!-- MODAL PARA INCREMENTAR PRODUCTO -->
  <div class="modal fade" id="exampleModalIncrementar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="contenedor" style="padding: 30px;">
            <form>
              <div class="form-group">
                <div class="row">
                  <div class="col-6">
                    <div id="qrcode" class="card" style="width: 100px; height: 100px; border: .5px solid white;">
                    </div>
                  </div>
                  <div class="col-6">
                    <div id="imagen-aqui" style="width: 100px; height: 100px; border: .5px solid white;"></div>
                  </div>
                </div>
              </div>
            </form>
            <form>
              <div class="form-group">
                <select name="" id="num"></select>
                <label for="num">Seleccione una cantidad <span id="depende"></span></label>
                <!-- <input type="number" class="form-control" id="producto-incrementar" aria-describedby="incremento-r" value=""> -->
              </div>
            </form>
          </div>
          <div id="botones-modal" class="modal-footer">
            <!-- <div class="row">
              <div class="col-md-6 col-xs-6"><button type="button" onclick="vaciar()" class="btn btn-secondary" data-dismiss="modal">Cerrar</button></div>
              <div class="col-md-6 col-xs-6"><button type="button" class="btn btn-primary" data-dismiss="modal">Aplicar</button></div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN DE MODAL PARA INCREMENTAR PRODUCTOS -->


  <footer class="container">
    <hr style="border-color: #1B6DC1;">
    <p>&copy; BUSE 2020 - Todos los derechos reservados</p>
  </footer>

  <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
  <script src="bootstrap/jquery-3.2.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="jss/qrcodejs-master/qrcode.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
  <script src="jss/contenedorCatalogo.js"></script>
</body>

</html>