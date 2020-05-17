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
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Hola, <?php echo $_COOKIE['user'] ?></span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" id="inicio" href="inicioCliente.html" style="color: #1B6DC1;">Inicio <span
              class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="perfil" href="#" style="color: #1B6DC1;">Perfil</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img src="img/clienteSinFondo.png" width="25px" alt="">
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="verCarrito.html"><img src="img/carrito.png" alt="" width="23px;">&nbsp; Ver
              carrito</a>
            <a class="dropdown-item" href="#" data-toggle="modal"
              data-target="#exampleModalPromocionesFavoritas">Promociones favoritas</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalEmpresasFavoritas">Empresas
              favoritas</a>
            <a class="dropdown-item" href="mapa.html">Mapa de promociones</a>
            <a class="dropdown-item" href="actualizarPerfil.html">Actualizar perfil</a>
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
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card" style="width: 18rem;">
          <img src="img/pruebaproducto1.jpg" class="card-img-top" alt="..." style="width: 200px;">
          <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <a href="">
              <h3>Empresa</h3>
            </a>
            <h2><b><s>PRECIO</s></b></h2>
            <h1>Precio en oferta</h1>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam aliquid quidem
              mollitia atque rerum deserunt provident omnis quos illo expedita!</p>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" data-whatever="@mdo"
              data-dismiss="modal">Agregar al carrito</a>
          </div>
          <div class="container-fluid" style="padding: 5px;">
            <div class="row">
              <div class="col-4"><a href="#" class="btn btn-primary" data-toggle="modal"
                  data-target="#exampleModalCalificar" data-whatever="@mdo" data-dismiss="modal">Calificar</a></div>
              <div class="col-4"><a href="#" class="btn btn-primary" data-toggle="modal"
                  data-target="#exampleModalComentar" data-whatever="@mdo" data-dismiss="modal">Comentar</a></div>
              <div class="col-4">
                <input onclick="dejarAzul()" type="radio" name="estrellas" value="fav" style="background-color: grey;">
                <label id="radioEstrella" for="radioEstrella">★</label>

                <input onclick="dejarGris()" type="radio" name="estrellas" value="favG"
                  style="background-color: #1B6DC1; display: none;">
                <label id="radioEstrellaGris" style="display: none;" for="radioEstrellaGris">★</label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card" style="width: 18rem;">
          <img src="img/pruebaproducto1.jpg" class="card-img-top" alt="..." style="width: 200px;">
          <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <a href="">
              <h3>Empresa</h3>
            </a>
            <h2><b><s>PRECIO</s></b></h2>
            <h1>Precio en oferta</h1>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam aliquid quidem
              mollitia atque rerum deserunt provident omnis quos illo expedita!</p>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" data-whatever="@mdo"
              data-dismiss="modal">Agregar al carrito</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card" style="width: 18rem;">
          <img src="img/pruebaproducto1.jpg" class="card-img-top" alt="..." style="width: 200px;">
          <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <a href="">
              <h3>Empresa</h3>
            </a>
            <h2><b><s>PRECIO</s></b></h2>
            <h1>Precio en oferta</h1>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam aliquid quidem
              mollitia atque rerum deserunt provident omnis quos illo expedita!</p>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" data-whatever="@mdo"
              data-dismiss="modal">Agregar al carrito</a>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card" style="width: 18rem;">
          <img src="img/pruebaproducto1.jpg" class="card-img-top" alt="..." style="width: 200px;">
          <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <a href="">
              <h3>Empresa</h3>
            </a>
            <h2><b><s>PRECIO</s></b></h2>
            <h1>Precio en oferta</h1>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam aliquid quidem
              mollitia atque rerum deserunt provident omnis quos illo expedita!</p>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="exampleModal3" data-whatever="@mdo"
              data-dismiss="modal">Agregar al carrito</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card" style="width: 18rem;">
          <img src="img/pruebaproducto1.jpg" class="card-img-top" alt="..." style="width: 200px;">
          <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <h2><b><s>PRECIO</s></b></h2>
            <h1>Precio en oferta</h1>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam aliquid quidem
              mollitia atque rerum deserunt provident omnis quos illo expedita!</p>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" data-whatever="@mdo"
              data-dismiss="modal">Agregar al carrito</a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <div class="card" style="width: 18rem;">
          <img src="img/pruebaproducto1.jpg" class="card-img-top" alt="..." style="width: 200px;">
          <div class="card-body">
            <h5 class="card-title">Nombre</h5>
            <a href="">
              <h3>Empresa</h3>
            </a>
            <h2><b><s>PRECIO</s></b></h2>
            <h1>Precio en oferta</h1>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aperiam aliquid quidem
              mollitia atque rerum deserunt provident omnis quos illo expedita!</p>
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" data-whatever="@mdo"
              data-dismiss="modal">Agregar al carrito</a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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
            <img src="img/pruebaproducto1.jpg" class="card-img-top" alt="..." style="width: 200px;">
            <div class="card-body">
              <h5 class="card-title">Nombre</h5>
              <h2><b><s>PRECIO</s></b></h2>
              <h1>Precio en oferta</h1>
              <label for="cantidad">Seleccione la cantidad de elementos a comprar</label>
              <input type="number" name="cantidad" id="cantidad">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Agregar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL PARA CALIFICAR UN PRODUCTO -->
  <div class="modal fade" id="exampleModalCalificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Calificar <span id="nombre-producto"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="calificaion">
            <p class="clasificacion">
              <input id="radio1" type="radio" name="estrellas" value="5">
              <label for="radio1">★</label>
              <input id="radio2" type="radio" name="estrellas" value="4">
              <label for="radio2">★</label>
              <input id="radio3" type="radio" name="estrellas" value="3">
              <label for="radio3">★</label>
              <input id="radio4" type="radio" name="estrellas" value="2">
              <label for="radio4">★</label>
              <input id="radio5" type="radio" name="estrellas" value="1">
              <label for="radio5">★</label>
            </p>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="calificar-p" data-dismiss="modal">Calificar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN DE MODAL PARA CALIFICAR UN PRODUCTO -->

  <!-- MODAL PARA COMENTAR UN PRODUCTO -->
  <div class="modal fade" id="exampleModalComentar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Comentar <span id="nombre-producto"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="comentar-producto">Breve descripcion del producto</label>
            <textarea id="comentar-producto" name="textarea" rows="6" cols="40"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" id="comentar" data-dismiss="modal">Comentar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN DE MODAL PARA COMENTAR UN PRODUCTO -->

  <!-- MODAL PARA VER EMPRESAS FAVORITAS -->
  <div class="modal fade" id="exampleModalEmpresasFavoritas" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
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

  <!-- MODAL PARA VER PROMOCIONES FAVORITAS -->
  <div class="modal fade" id="exampleModalPromocionesFavoritas" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
  <script src="jss/contenedorInicioCliente.js"></script>
  <script src="jss/validaciones.js"></script>
</body>

</html>