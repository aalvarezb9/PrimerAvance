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
    <title>Control de ventas</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/estilosInicioEmpresa.css">
  <link rel="stylesheet" href="bootstrap/estilos.css">
  <link rel="stylesheet" href="bootstrap/estilosDash.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Hola, <span id="nombre-inicio-cliente"> <?php echo $_COOKIE["name"] ?> </span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" id="perfil" href="visualizarPerfilEmpresa.php" style="color: #1B6DC1;">Perfil <span class="sr-only">(current)</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="img/empresaSinFondo.png" width="25px" alt="">
              </a>
              <div class="dropdown-menu"aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="actualizarPerfilEmpresa.php">Actualizar perfil</a>
                <a class="dropdown-item" href="visualizarPerfilEmpresa.php">Visualizar perfil</a>
                <a class="dropdown-item" href="dash.php">Dashboard administrativo</a>
                <a class="dropdown-item" href="#">Imprimir</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logoutE.php">Cerrar sesión</a>
              </div>
            </li>

            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" style="color: #1B6DC1;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Sucursales
              </a>
              <div class="dropdown-menu"aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Principal</a>
                <a class="dropdown-item" href="#">Sucursal 1</a>
                <a class="dropdown-item" href="#">etc</a>
            </li> -->
          </ul>
          <!-- <form class="form-inline my-2 my-lg-0" id="busqueda">
            <input class="form-control mr-sm-2" type="search" placeholder="Busca algo..." aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="button">Buscar</button>
          </form> -->
          
        </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="chart-wrap horizontal graficas"> <!-- quitar el estilo "horizontal" para visualizar verticalmente -->

            <div class="title">Gráfico de las ventas en el último mes</div>          
            <div class="grid">
        
                <div class="bar" style="--bar-value:85%;" data-name="Producto1" title="Producto1 85%"></div>
          
                <div class="bar" style="--bar-value:23%;" data-name="P2" title="P2 23%"></div>
          
                <div class="bar" style="--bar-value:7%;" data-name="P3" title="P3 7%"></div>
          
                <div class="bar" style="--bar-value:38%;" data-name="P4" title="P4 38%"></div>
          
                <div class="bar" style="--bar-value:35%;" data-name="P5" title="P5 35%"></div>
          
                <div class="bar" style="--bar-value:30%;" data-name="P6" title="P6 30%"></div>
          
                <div class="bar" style="--bar-value:5%;" data-name="P7" title="P7 5%"></div>
          
                <div class="bar" style="--bar-value:20%;" data-name="P7" title="P7 20%"></div>
          
            </div>
          
          </div>
        </div>
      </div>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="display: none;">
      <ol class="carousel-indicators" style="position: absolute;">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active" style="background-color: #1B6DC1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1" style="background-color: #1B6DC1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2" style="background-color: #1B6DC1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="img/prueba1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="img/prueba2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="img/prueba3.jpg" class="d-block w-100" alt="...">
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
   

    <footer class="container">
      <hr style="border-color: #1B6DC1;">
    <p>&copy; BUSE 2020 - Todos los derechos reservados</p>
  </footer>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <script src="bootstrap/jquery-3.2.1.min.js"></script>
    <script src="jss/contenedorInicioEmpresa.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>