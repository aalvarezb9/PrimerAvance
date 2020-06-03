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
  <title>Página de inicio - Comprador</title>
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/estilosInicioCliente.css">
  <link rel="stylesheet" href="bootstrap/estilos.css">
  <link rel="stylesheet" href="bootstrap/font-awesome.min.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Hola, <?php echo $_COOKIE['user'] ?></span></a>
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
            <a class="dropdown-item" href="verCarrito.php"><img src="img/carrito.png" alt="" width="23px;">&nbsp; Ver
              carrito</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalEmpresasFavoritas">Empresas
              favoritas</a>
            <a class="dropdown-item" href="#">Mapa de promociones</a>
            <a class="dropdown-item" href="actualizarPerfil.php">Actualizar perfil</a>
            <a class="dropdown-item" onclick="eliminarCuenta()" href="#">Eliminar cuenta</a>
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

  <div class="container" style="padding: 30px;">
    <div id="productos-de-empresas-a-mostrar" class="row">
      
    </div>
  </div>


  <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agrega al carrito</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card" style="width: 18rem;">
          <div id="imagen-carrito" style="margin-left: auto; margin-right: auto;"></div>
            <div class="card-body">
              <h5 class="card-title" id="nombre-producto-carrito"></h5>
              <h2><b><s id="precio-producto-carrito"></s> Lps</b></h2>
              <h3 id="comentario-carrito"></h3>
              <h2 id="categoria-carrito"></h2>
              <label for="cantidad-elementos-carrito">Seleccione la cantidad de elementos a comprar</label>
              <input type="number" name="cantidad" id="cantidad-elementos-carrito">
            </div>
          </div>
        </div>
        <div id="aqui-van-los-botones" class="modal-footer">
          <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button onclick="subirAlCarrito()" type="button" class="btn btn-primary" data-dismiss="modal">Agregar</button> -->
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL PARA CALIFICAR UN PRODUCTO -->
  <div class="modal fade" id="exampleModalCalificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Calificar <span id="nombre-producto-calificar"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="number" name="" id="calificacion">
        </div>
        <div id="botones-calificar" class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
  <!-- FIN DE MODAL PARA CALIFICAR UN PRODUCTO -->

  <!-- MODAL PARA COMENTAR UN PRODUCTO -->
  <div class="modal fade" id="exampleModalComentar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Comentar <span id="nombre-producto-comentar"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="comentar-producto">Breve comentario del producto</label>
            <textarea id="comentar-producto" name="textarea" rows="6" cols="40"></textarea>
          </div>
        </div>
        <div id="botones-comentario" class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="comentar" data-dismiss="modal">Comentar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN DE MODAL PARA COMENTAR UN PRODUCTO -->

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
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus
                odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </li>
            <li class="media my-4">
              <img src="..." class="mr-3" alt="...">
              <div class="media-body">
                <h5 class="mt-0 mb-1">List-based media object</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus
                odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </li>
            <li class="media">
              <img src="..." class="mr-3" alt="...">
              <div class="media-body">
                <h5 class="mt-0 mb-1">List-based media object</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus
                odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                fringilla. Donec lacinia congue felis in faucibus.
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

  <!-- MODAL PARA VER EMPRESAS FAVORITAS -->
  <div class="modal fade" id="exampleModalVerEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabelT"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul class="list-unstyled">
            <li class="media">
              <img class="mr-3" id="imagen-ve" alt="...">
              <div class="media-body">
                <h5 class="mt-0 mb-1"><b> Imagen de perfil</b></h5>
              </div>
            </li>
            <li class="media">
              <h5 id="dir"></h5>
              <div class="media-body">
                <h5 class="mt-0 mb-1"> <b>:Dirección</b></h5>
              </div>
            </li><br>
            <hr>
            <h3>Redes sociales</h3>
            <hr id="separar">
            <li class="media">
              <h5 id="fb"></h5>
              <div class="media-body">
                <h5 class="mt-0 mb-1"> <i class="fab fa-facebook"></i></h5>
              </div>
            </li>
            <hr>
            <li class="media">
              <h5 id="ig"></h5>
              <div class="media-body">
                <h5 class="mt-0 mb-1"> <i class="fab fa-instagram"></i></h5>
              </div>
            </li>
            <hr>
            <li class="media">
              <h5 id="sc"></h5>
              <div class="media-body">
                <h5 class="mt-0 mb-1"> <i class="fab fa-snapchat"></i></h5>
              </div>
            </li>
            <hr>
            <li class="media">
              <h5 id="yt"></h5>
              <div class="media-body">
                <i class="fab fa-youtube"></i>
              </div>
            </li>
            <hr>
            <h3>Comentarios de sus productos</h3>
            <hr id="separar">
            <div id="comments"></div>
            <hr>
            <h3>Calificaciones a sus productos</h3>
            <hr id="separar">
            <div id="calificaciones"></div>
            <hr>
            <div id="cal"></div>
            <hr>
          </ul>
        </div>
        <div id="botones-ver" class="modal-footer">
    
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
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus
                odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </li>
            <li class="media my-4">
              <img src="..." class="mr-3" alt="...">
              <div class="media-body">
                <h5 class="mt-0 mb-1">List-based media object</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus
                odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                fringilla. Donec lacinia congue felis in faucibus.
              </div>
            </li>
            <li class="media">
              <img src="..." class="mr-3" alt="...">
              <div class="media-body">
                <h5 class="mt-0 mb-1">List-based media object</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus
                odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                fringilla. Donec lacinia congue felis in faucibus.
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


  <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
  <script src="bootstrap/jquery-3.2.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
  <script src="jss/contenedorInicioCliente.js"></script>
  <!-- <script src="jss/validaciones.js"></script> -->
</body>

</html>