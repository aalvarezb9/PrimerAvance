<?php 
  session_start();
  if(!isset($_SESSION["token"]))
      header("Location: 401.html");

  if(!isset($_COOKIE["token"]))
      header("Location: 401.html");

  if($_SESSION["token"] != $_COOKIE["token"])
      header("Location: 401.html")
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ver perfil</title>
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/estilos.css">
  <link rel="stylesheet" href="bootstrap/estilosVisualizarPerfilEmpresa.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Hola, <?php echo $_COOKIE['name'] ?></span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" id="inicio" href="inicioEmpresa.html" style="color: #1B6DC1;">Inicio <span
              class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="perfil" href="visualizarPerfilEmpresa.html" style="color: #1B6DC1;">Perfil</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img src="img/empresaSinFondo.png" width="25px" alt="">
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="actualizarPerfilEmpresa.html">Actualizar perfil</a>
            <a class="dropdown-item" href="visualizarPerfilEmpresa.html">Visualizar perfil</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Registro de sucursales</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalRegistroProductos">Registro de productos</a>
            <!-- <a class="dropdown-item" href="#" data-toggle="modal"
              data-target="#exampleModalRegistroPromociones">Registro de promociones</a> -->
            <a class="dropdown-item" href="#">Dashboard administrativo</a>
            <a class="dropdown-item" href="#">Imprimir</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logoutE.php">Cerrar sesión</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: #1B6DC1;" href="#" id="navbarDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sucursales
          </a>
          <div id="menu-desplegable-de-promociones" class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php 
              if(isset($_COOKIE["sucursal"])){
                // foreach($_COOKIE["sucursal"] as $nambe => $value){
                //   $value = htmlspecialchars($value);
                //   echo "<a class='dropdown-item' href='#'>$value</a>";
                // }
                for($i = 0; $i < sizeof($_COOKIE["sucursal"]); $i++){
                  $value = $_COOKIE["sucursal"]["nombre"][strval($i + 1)];
                  echo "<a class='dropdown-item' href='#' onclick='verSucursal($i)'>$value</a>";
                  if($i == 3){
                    echo "<a class='dropdown-item' href='#' onclick='verMas()'>Ver más</a>";
                    $i = sizeof($_COOKIE["sucursal"]);
                  }
                  // echo `<a class="dropdown-item" href="#" value="$value" onclick="verSucursal($value)"`;                 
                }
              }else{
                echo "<a class='dropdown-item' href='#'>No tiene sucursales registradas</a>";
              }
            ?>
            <!-- <a class="dropdown-item" href="#">Principal</a>
            <a class="dropdown-item" href="#">Sucursal 1</a>
            <a class="dropdown-item" href="#">etc</a> -->
        </li>
      </ul>


    </div>
  </nav>

  <!-- Modal para ver sucursales -->
  
  <!-- Fin de modal para ver sucursales -->
  <div class="modal fade" id="ver-sucursal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><span id="nombre-de-la-sucursal"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="contenedor" style="padding: 30px;">
            <form>
              <h5 id="longitud-de-la-sucursal"></h5>
              <h5 id="latitud-de-la-sucursal"></h5>
              <h5 id="codigo-postal-de-lasucursal"></h5>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Modal para registrar una sucursal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registra tu sucursal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="contenedor" style="padding: 30px;">
            <form id="form-img-imagen-empresa" name="form-img-imagen-empresa" method="post"
                enctype="multipart/form-data">
              <div class="form-group">
                <label for="sucursal-registro-nombre">Nombre de la sucursal</label>
                <input type="text" class="form-control" id="sucursal-registro-nombre" aria-describedby="sucursal-r-n">
                <small id="sucursal-r-nombre" class="form-text text-muted">Preferiblemente ingresar como nombre el lugar
                  de la sucursal</small>
              </div>
              <div class="form-group">
                <label for="sucursal-registro-latitud">Latitud de la nueva sucursal</label>
                <input type="text" class="form-control" id="sucursal-registro-latitud" aria-describedby="sucursal-r-la">
              </div>
              <div class="form-group">
                <label for="sucursal-registro-longitud">Longitud de la nueva sucursal</label>
                <input type="text" class="form-control" id="sucursal-registro-longitud" aria-describedby="sucursal-r-lo">
              </div>
              <div class="form-group">
                <label for="postal-registro">Código postal</label>
                <input type="text" class="form-control" id="postal-registro" aria-describedby="postal-r">
                <!-- <small id="nombre-empresa" class="form-text text-muted">Tu correo está a salvo con nosotros.</small> -->
              </div>
              <hr id="separador">
              <!-- <div class="form-group">
                <p>¡Pon una imagen que identifique la sucursal!</p>
                <div id="div_file">
                  <p id="texto">Agregar</p>
                  <input type="file" id="btn_enviar_imagen" name="btn_enviar_imagen"
                      accept="image/x-png, image/gif, image/jpeg">
                </div>
              </div> -->
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button onclick="validarRegistroSucursales(); limpiarCamposSucursal()" id="guardar-sucursal" type="button"
            class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Fin de modal para registrar una sucursal -->

  <!-- Modal para subir imagen de producto -->

  
  <!-- Fin de modal para subir imagen de producto -->

  <div class="container" style="height: 350px;">
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators" style="position: absolute;">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"
              style="background-color: #1B6DC1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1" style="background-color: #1B6DC1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2" style="background-color: #1B6DC1"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="img/prueba1.jpg" style="height: 345px;" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="img/prueba2.jpg" style="height: 345px;" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="img/prueba3.jpg" style="height: 345px;" class="d-block w-100" alt="...">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>


  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2><img src="img/mapa.png" alt=""></h2>
        <p>Mira todas las sucursales de tu empresa y lleva el control geográfico </p>
        <p><a class="btn btn-secondary" href="mapasEmpresa.html" role="button">Ver sucursales &raquo;</a></p>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2><img src="img/catalogo.png" alt=""></h2>
        <p>Mira los productos que tienes para ofrecer a los clientes </p>
        <p><a class="btn btn-secondary" href="catalogo.html" role="button">Ver catálogo &raquo;</a></p>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
        <h2><img src="img/estadistica.png" alt=""></h2>
        <p>Lleva un control de las ventas que hacen los compradores en tu empresa </p>
        <p><a class="btn btn-secondary" href="dash.html" role="button">Ver ventas &raquo;</a></p>
      </div>
    </div>
  </div>

  <!-- Modal que muestra un producto ya registrado  -->
  <div class="modal fade" id="exampleModalProductoRegistrado" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¡Producto registrado con éxito!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="pr">
          <div class="contenedor" style="padding: 30px;">
            <form id="aqui-va-el-producto">
              <div class="form-group">
                <div id="qrcode" class="card" style="width: 100px; height: 100px; border: .5px solid white;">
                </div>              
              </div>
              <!-- <div class="form-group">
                <div class="card" style="width: 18rem;">
                  <img class="card-img-top" src="img/pruebaproducto2.jpg" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">Nombre del producto</h5>
                    <p class="card-text">Descripción del producto</p>
                     <a href="#" class="btn btn-primary">Go somewhere</a> -->
                  <!-- </div>
                </div>
                 <label for="producto-registro">Nombre del producto</label>
                <input type="text" class="form-control" id="producto-registro" aria-describedby="sucursal-r">
              </div> --> 
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin de modal que muestra un producto ya registrado -->

  <!-- MODAL PARA REGISTRAR PRODUCTO -->
  <div class="modal fade" id="exampleModalRegistroProductos" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registra tu producto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="contenedor" style="padding: 30px;">
            <form id="form-subir-producto" name="form-subir-producto" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="producto-registro">Nombre del producto</label>
                <input type="text" class="form-control" id="producto-registro" aria-describedby="sucursal-r">
              </div>
              <div class="form-group">
                <label for="precio-registro">Precio del producto</label>
                <input type="text" class="form-control" id="precio-registro" aria-describedby="precio-r">
                <small id="precio-producto" class="form-text text-muted">Precio en promoción.</small>
              </div>
              <div class="form-group">
                <label for="categoria-producto-registro">Categoría del producto</label>
                <input type="text" class="form-control" id="categoria-producto-registro" aria-describedby="producto-r">
              </div>
              <div class="form-group">
                <label for="cantidad">Cantidad de productos</label>
                <input type="number" class="form-control" id="cantidad" aria-describedby="cantidad-r">
              </div>
              <hr id="separador">
              <div class="form-group">
                <!-- <label for="imagen">Agregar imagen</label>
                    <input id="imagen" type="file" src="" alt=""> -->
                <p>¡Pon una imagen que identifique tu producto!</p>
                <div id="div_file">
                  <p id="texto">Agregar</p>
                  <input type="file" id="btn_enviar" name="imagen-producto" accept="image/x-png, image/gif, image/jpeg">
                </div>
              </div>
              <div class="form-group">
                <label for="descripcion-producto-registro">Breve descripcion del producto</label>
                <textarea id="comentario-del-producto" name="textarea" rows="6" cols="40"></textarea>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button onclick="subirProducto()" id="siguiente-producto" type="button" class="btn btn-primary">Siguiente</button>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN DE MODAL PARA REGISTRAR PRODUCTOS -->

  <!-- MODAL 2 PARA REGISTRAR PRODUCTO -->
  <!-- <div class="modal fade" id="exampleModalRegistroProductos2" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¡Dale al cliente una buena percepción de tu producto!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="contenedor" style="padding: 30px;">
            <form>
              <div class="form-group"> -->
                <!-- <div id="sucursalesDisponibles" class="checkbox">

                  <input type="checkbox" id="sucursal1" name="sucursal1" value="sucursal1">
                  <label for="sucursal1">Principal</label><br>

                </div>
              </div> -->
              <!-- <div class="form-group">
                <label for="descripcion-producto-registro">Breve descripcion del producto</label>
                <textarea id="comentario-del-producto" name="textarea" rows="6" cols="40"></textarea>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-toggle="modal"
            data-target="#exampleModalRegistroProductos" data-dismiss="modal">Atrás</button>
          <button onclick="validarRegistroProductos2()" id="guardar-producto" type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div> -->
  </div>
  <!-- FIN DE MODAL 2 PARA REGISTRAR PRODUCTOS -->

  <!-- INICIO DE MODAL PARA REGISTRAR PROMOCIONES -->
  <!-- <div class="modal fade" id="exampleModalRegistroPromociones" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Selecciona las sucursales donde ese aplicará la promoción</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="contenedor" style="padding: 30px;">
            <form>
              <div class="form-group">
                <label for="nombre-p">Ingrese el código/nombre del producto</label>
                <input type="text" class="form-control" name="nombre-p" id="nombre-p" aria-describedby="nombre-p">
              </div>
              <div class="form-group">
                <label for="cb">Sucursales donde estará disponible la promoción</label>
                <div id="cb" class="checkbox">

                  <input type="checkbox" id="sucursal1" name="sucursal1" value="sucursal1">
                  <label for="sucursal1">Sucursal 1</label><br>


                  <input type="checkbox" id="sucursal2" name="sucursal2" value="sucursal2">
                  <label for="sucursal2">Sucursal 2</label><br>


                  <input type="checkbox" id="etc" name="etc" value="etc">
                  <label for="etc">etc</label><br>

                </div>
              </div>  
              <div class="form-group">
                <label for="precio-p">Ingrese el precio en promoción</label>
                <input type="text" class="form-control" name="precio-p" id="precio-p" aria-describedby="precio-p">
              </div>
              <div class="form-group">
                <label for="cantidad-promocion">Cantidad de productos a los que se aplicará la promoción</label>
                <input type="number" class="form-control" id="cantidad-promocion" aria-describedby="cantidad-p">
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-toggle="modal"
            data-target="#exampleModalRegistroProductos" data-dismiss="modal">Atrás</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
        </div>
      </div>
    </div>
  </div> -->
  <!-- FIN MODAL PARA REGISTRAR PROMOCIONES -->

  <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
  <script src="bootstrap/jquery-3.2.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="jss/qrcodejs-master/qrcode.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
  <script src="jss/contenedorPerfilEmpresa.js"></script>
</body>

</html>