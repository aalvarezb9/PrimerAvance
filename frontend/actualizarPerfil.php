<?php
session_start();
if (!isset($_SESSION["token"]))
  header("Location: 401.html");

if (!isset($_COOKIE["token"]))
  header("Location: 401.html");

if ($_SESSION["token"] != $_COOKIE["token"])
  header("Location: 401.html")
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Actualiza tu perfil</title>
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/estilosInicioCliente.css">
  <link rel="stylesheet" href="bootstrap/estilos.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Hola, <span id="nombre-inicio-cliente"> <?php echo $_COOKIE["user"] ?> </span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" id="inicio" href="inicioCliente.php" style="color: #1B6DC1;">Inicio <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="perfil" href="#" style="color: #1B6DC1;">Perfil</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="img/clienteSinFondo.png" width="25px" alt="">
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="verCarrito.php"><img src="img/carrito.png" alt="" width="23px;">&nbsp; Ver carrito</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalEmpresasFavoritas">Empresas favoritas</a>
            <a class="dropdown-item" href="mapa.html">Mapa de promociones</a>
            <a class="dropdown-item" href="actualizarPerfil.php">Actualizar perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logout.php">Cerrar sesión</a>
          </div>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" id="busqueda">
        <input class="form-control mr-sm-2" type="search" placeholder="Busca promociones" aria-label="Search">
        <button id="btn-buscar" class="btn btn-outline-success my-2 my-sm-0" type="button">Buscar</button>
      </form>

    </div>
  </nav>

  <div class="container-fluid" style="margin-bottom: 100px;">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding: 30px;">
        <div class="form-group">
          <label for="nuevo-email-registro-cliente">Nuevo correo </label>
          <input type="email" class="form-control" id="nuevo-email-registro-cliente" aria-describedby="n-email-empresa-r">
          <small id="emailHelp" class="form-text text-muted">Tu correo está a salvo con nosotros.</small>
        </div>

        <div class="form-group">
          <label for="nuevo-nombre-registro-cliente">Nuevo nombre de usuario </label>
          <input type="text" class="form-control" id="nuevo-nombre-registro-cliente" aria-describedby="n-nombre-empresa-r">
        </div>

        <div class="form-group">
          <label for="nueva-password-registro-cliente">Nueva contraseña </label>
          <input type="password" class="form-control" id="nueva-password-registro-cliente" aria-describedby="p-nombre-empresa-r">
        </div>

        <div class="form-group">
          <label for="nueva-password-repetir-registro-cliente">Repita su nueva contraseña </label>
          <input type="password" class="form-control" id="nueva-password-repetir-registro-cliente" aria-describedby="n-nombre-empresa-r">
        </div>

      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding: 30px;">
        <div class="form-group">
          <div class="checkbox">
            <h2>Cambia de gustos</h2>
            <input type="checkbox" id="deporte" name="deporte" value="deporte">
            <label for="deporte">Deporte</label><br>


            <input type="checkbox" id="ropa" name="ropa" value="ropa">
            <label for="ropa">Ropa</label><br>


            <input type="checkbox" id="electronica" name="electronica" value="electronica">
            <label for="electronica">Electrónica</label><br>

            <input type="checkbox" id="electrodomesticos" name="electrodomesticos" value="electrodomesticos">
            <label for="electrodomesticos">Electrodomésticos</label><br>

            <input type="checkbox" id="otros" name="otros" value="otros">
            <label for="otros">Otros</label><br>

            <hr id="separador">
           
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding: 30px;">
        <div class="form-group">
          <div class="form-group">
            <img src="img/update.png" alt="" style="width: 300px;">
            <hr>
            <a id="ir-inicio"><button onclick="actualizar()" type="button" class="btn btn-primary" style="float: right;">Guardar cambios</button></a>
          </div>

        </div>
      </div>
    </div>


    <!-- MODAL PARA VER EMPRESAS FAVORITAS -->
    <div class="modal fade" id="exampleModalEmpresasFavoritas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Empresas favoritas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul class="list-unstyled">
              <li class="media">
                <img src="..." class="mr-3" alt="...">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">List-based media object</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </li>
              <li class="media my-4">
                <img src="..." class="mr-3" alt="...">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">List-based media object</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </li>
              <li class="media">
                <img src="..." class="mr-3" alt="...">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">List-based media object</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </li>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN DE MODAL PARA VER EMPRESAS FAVORITAS -->

    <!-- MODAL PARA VER PROMOCIONES FAVORITAS -->
    <div class="modal fade" id="exampleModalPromocionesFavoritas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Promociones favoritas</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <ul class="list-unstyled">
              <li class="media">
                <img src="..." class="mr-3" alt="...">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">List-based media object</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </li>
              <li class="media my-4">
                <img src="..." class="mr-3" alt="...">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">List-based media object</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </li>
              <li class="media">
                <img src="..." class="mr-3" alt="...">
                <div class="media-body">
                  <h5 class="mt-0 mb-1">List-based media object</h5>
                  Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
              </li>
            </ul>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN DE MODAL PARA VER PROMOCIONES FAVORITAS -->
    <footer class="container">
      <hr style="border-color: #1B6DC1;">
      <p>&copy; BUSE 2020 - Todos los derechos reservados</p>
    </footer>


    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <script src="bootstrap/jquery-3.2.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="jss/contenedorInicioCliente.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script src="jss/contenedorActualizarPerfil.js"></script>
</body>

</html>