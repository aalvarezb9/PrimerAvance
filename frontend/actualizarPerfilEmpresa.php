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
  <title>Actualizar perfil</title>
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap/estilos.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Actualizar datos: <span id="nombre-empresa"></span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" id="inicio" href="#" style="color: #1B6DC1;">Inicio <span
              class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="perfil" href="#" style="color: #1B6DC1;">Perfil</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img src="img/empresaSinFondo.png" width="25px" alt="">
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Actualizar perfil</a>
            <a class="dropdown-item" href="visualizarPerfilEmpresa.html">Visualizar perfil</a>
            <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalRegistroSucursales">Registro
              de sucursales</a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalRegistroProductos">Registro
              de productos</a>
            <a class="dropdown-item" href="#" data-toggle="modal"
              data-target="#exampleModalRegistroPromociones">Registro de promociones</a> -->
            <a class="dropdown-item" href="dash.html">Dashboard administrativo</a>
            <a class="dropdown-item" href="#">Imprimir</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="logoutE.php">Cerrar sesión</a>
          </div>
        </li>
        <li class="nav-item active">
          <a id="ayuda" class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">Ayuda <span
              class="sr-only">(current)</span></a>
        </li>

        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="color: #1B6DC1;" href="#" id="navbarDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Sucursales
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Principal</a>
            <a class="dropdown-item" href="#">Sucursal 1</a>
            <a class="dropdown-item" href="#">etc</a>
        </li> -->
      </ul>


    </div>
  </nav>
  <div class="container-fluid" style="margin-bottom: 100px;">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding: 30px;">
        <div class="form-group">
          <label for="nuevo-email-registro-empresa">Nuevo correo </label>
          <input type="email" class="form-control" id="nuevo-email-registro-empresa"
            aria-describedby="n-email-empresa-r">
          <small id="emailHelp" class="form-text text-muted">Tu correo está a salvo con nosotros.</small>
        </div>

        <div class="form-group">
          <label for="nuevo-nombre-registro-empresa">Nuevo nombre de empresa </label>
          <input type="text" class="form-control" id="nuevo-nombre-registro-empresa"
            aria-describedby="n-nombre-empresa-r">
        </div>

        <div class="form-group">
          <label for="nueva-password-registro-empresa">Nueva contraseña </label>
          <input type="password" class="form-control" id="nueva-password-registro-empresa"
            aria-describedby="p-nombre-empresa-r">
        </div>

        <div class="form-group">
          <label for="nueva-password-repetir-registro-empresa">Repita su nueva contraseña </label>
          <input type="email" class="form-control" id="nueva-password-repetir-registro-empresa"
            aria-describedby="n-nombre-empresa-r">
        </div>

      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding: 30px;">
        <div class="form-group">
          <div class="checkbox">
            <h2>Cambia de oferta</h2>
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
            <form id="agregar-imagen-a-empresa" name="agregar-imagen-a-empresa" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <p>¡Agrega otra imagen a tu empresa!</p>
                <div id="div_file">
                  <p id="texto">Agregar</p>
                  <input type="file" name="btn_enviar_imagen" id="btn_enviar_imagen"
                        accept="image/x-png, image/gif, image/jpeg">
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding: 30px;">
        <div class="form-group">
          <div class="form-group">
            <label for="direccion-registro-empresa">Nueva longitud - latitud</label>
            <input type="text" class="form-control" id="direccion-registro" aria-describedby="direccion-empresa-r">
            <small id="direcHelp" class="form-text text-muted">Con fines de facilitar su localización.</small>
          </div>
          <!-- <label for="usuario-registro">Nombre de empresa</label>
                    <input type="text" class="form-control" id="empresa-registro" aria-describedby="empresa-r"> -->
          <!-- <small id="nombre-empresa" class="form-text text-muted">Tu correo está a salvo con nosotros.</small> -->
          <div class="form-group">
            <!-- <label for="usuario-registro">Nombre de empresa</label>
                        <input type="text" class="form-control" id="empresa-registro" aria-describedby="empresa-r"> -->
            <!-- <small id="nombre-empresa" class="form-text text-muted">Tu correo está a salvo con nosotros.</small> -->
            <label for="pais">Escoja el nuevo país</label>
            <select id="pais" name="pais">
              <option value="AF">Afganistán</option>
              <option value="AL">Albania</option>
              <option value="DE">Alemania</option>
              <option value="AD">Andorra</option>
              <option value="AO">Angola</option>
              <option value="AI">Anguilla</option>
              <option value="AQ">Antártida</option>
              <option value="AG">Antigua y Barbuda</option>
              <option value="AN">Antillas Holandesas</option>
              <option value="SA">Arabia Saudí</option>
              <option value="DZ">Argelia</option>
              <option value="AR">Argentina</option>
              <option value="AM">Armenia</option>
              <option value="AW">Aruba</option>
              <option value="AU">Australia</option>
              <option value="AT">Austria</option>
              <option value="AZ">Azerbaiyán</option>
              <option value="BS">Bahamas</option>
              <option value="BH">Bahrein</option>
              <option value="BD">Bangladesh</option>
              <option value="BB">Barbados</option>
              <option value="BE">Bélgica</option>
              <option value="BZ">Belice</option>
              <option value="BJ">Benin</option>
              <option value="BM">Bermudas</option>
              <option value="BY">Bielorrusia</option>
              <option value="MM">Birmania</option>
              <option value="BO">Bolivia</option>
              <option value="BA">Bosnia y Herzegovina</option>
              <option value="BW">Botswana</option>
              <option value="BR">Brasil</option>
              <option value="BN">Brunei</option>
              <option value="BG">Bulgaria</option>
              <option value="BF">Burkina Faso</option>
              <option value="BI">Burundi</option>
              <option value="BT">Bután</option>
              <option value="CV">Cabo Verde</option>
              <option value="KH">Camboya</option>
              <option value="CM">Camerún</option>
              <option value="CA">Canadá</option>
              <option value="TD">Chad</option>
              <option value="CL">Chile</option>
              <option value="CN">China</option>
              <option value="CY">Chipre</option>
              <option value="VA">Ciudad del Vaticano (Santa Sede)</option>
              <option value="CO">Colombia</option>
              <option value="KM">Comores</option>
              <option value="CG">Congo</option>
              <option value="CD">Congo, República Democrática del</option>
              <option value="KR">Corea</option>
              <option value="KP">Corea del Norte</option>
              <option value="CI">Costa de Marfíl</option>
              <option value="CR">Costa Rica</option>
              <option value="HR">Croacia (Hrvatska)</option>
              <option value="CU">Cuba</option>
              <option value="DK">Dinamarca</option>
              <option value="DJ">Djibouti</option>
              <option value="DM">Dominica</option>
              <option value="EC">Ecuador</option>
              <option value="EG">Egipto</option>
              <option value="SV">El Salvador</option>
              <option value="AE">Emiratos Árabes Unidos</option>
              <option value="ER">Eritrea</option>
              <option value="SI">Eslovenia</option>
              <option value="ES" selected>España</option>
              <option value="US">Estados Unidos</option>
              <option value="EE">Estonia</option>
              <option value="ET">Etiopía</option>
              <option value="FJ">Fiji</option>
              <option value="PH">Filipinas</option>
              <option value="FI">Finlandia</option>
              <option value="FR">Francia</option>
              <option value="GA">Gabón</option>
              <option value="GM">Gambia</option>
              <option value="GE">Georgia</option>
              <option value="GH">Ghana</option>
              <option value="GI">Gibraltar</option>
              <option value="GD">Granada</option>
              <option value="GR">Grecia</option>
              <option value="GL">Groenlandia</option>
              <option value="GP">Guadalupe</option>
              <option value="GU">Guam</option>
              <option value="GT">Guatemala</option>
              <option value="GY">Guayana</option>
              <option value="GF">Guayana Francesa</option>
              <option value="GN">Guinea</option>
              <option value="GQ">Guinea Ecuatorial</option>
              <option value="GW">Guinea-Bissau</option>
              <option value="HT">Haití</option>
              <option value="HN">Honduras</option>
              <option value="HU">Hungría</option>
              <option value="IN">India</option>
              <option value="ID">Indonesia</option>
              <option value="IQ">Irak</option>
              <option value="IR">Irán</option>
              <option value="IE">Irlanda</option>
              <option value="BV">Isla Bouvet</option>
              <option value="CX">Isla de Christmas</option>
              <option value="IS">Islandia</option>
              <option value="KY">Islas Caimán</option>
              <option value="CK">Islas Cook</option>
              <option value="CC">Islas de Cocos o Keeling</option>
              <option value="FO">Islas Faroe</option>
              <option value="HM">Islas Heard y McDonald</option>
              <option value="FK">Islas Malvinas</option>
              <option value="MP">Islas Marianas del Norte</option>
              <option value="MH">Islas Marshall</option>
              <option value="UM">Islas menores de Estados Unidos</option>
              <option value="PW">Islas Palau</option>
              <option value="SB">Islas Salomón</option>
              <option value="SJ">Islas Svalbard y Jan Mayen</option>
              <option value="TK">Islas Tokelau</option>
              <option value="TC">Islas Turks y Caicos</option>
              <option value="VI">Islas Vírgenes (EEUU)</option>
              <option value="VG">Islas Vírgenes (Reino Unido)</option>
              <option value="WF">Islas Wallis y Futuna</option>
              <option value="IL">Israel</option>
              <option value="IT">Italia</option>
              <option value="JM">Jamaica</option>
              <option value="JP">Japón</option>
              <option value="JO">Jordania</option>
              <option value="KZ">Kazajistán</option>
              <option value="KE">Kenia</option>
              <option value="KG">Kirguizistán</option>
              <option value="KI">Kiribati</option>
              <option value="KW">Kuwait</option>
              <option value="LA">Laos</option>
              <option value="LS">Lesotho</option>
              <option value="LV">Letonia</option>
              <option value="LB">Líbano</option>
              <option value="LR">Liberia</option>
              <option value="LY">Libia</option>
              <option value="LI">Liechtenstein</option>
              <option value="LT">Lituania</option>
              <option value="LU">Luxemburgo</option>
              <option value="MK">Macedonia, Ex-República Yugoslava de</option>
              <option value="MG">Madagascar</option>
              <option value="MY">Malasia</option>
              <option value="MW">Malawi</option>
              <option value="MV">Maldivas</option>
              <option value="ML">Malí</option>
              <option value="MT">Malta</option>
              <option value="MA">Marruecos</option>
              <option value="MQ">Martinica</option>
              <option value="MU">Mauricio</option>
              <option value="MR">Mauritania</option>
              <option value="YT">Mayotte</option>
              <option value="MX">México</option>
              <option value="FM">Micronesia</option>
              <option value="MD">Moldavia</option>
              <option value="MC">Mónaco</option>
              <option value="MN">Mongolia</option>
              <option value="MS">Montserrat</option>
              <option value="MZ">Mozambique</option>
              <option value="NA">Namibia</option>
              <option value="NR">Nauru</option>
              <option value="NP">Nepal</option>
              <option value="NI">Nicaragua</option>
              <option value="NE">Níger</option>
              <option value="NG">Nigeria</option>
              <option value="NU">Niue</option>
              <option value="NF">Norfolk</option>
              <option value="NO">Noruega</option>
              <option value="NC">Nueva Caledonia</option>
              <option value="NZ">Nueva Zelanda</option>
              <option value="OM">Omán</option>
              <option value="NL">Países Bajos</option>
              <option value="PA">Panamá</option>
              <option value="PG">Papúa Nueva Guinea</option>
              <option value="PK">Paquistán</option>
              <option value="PY">Paraguay</option>
              <option value="PE">Perú</option>
              <option value="PN">Pitcairn</option>
              <option value="PF">Polinesia Francesa</option>
              <option value="PL">Polonia</option>
              <option value="PT">Portugal</option>
              <option value="PR">Puerto Rico</option>
              <option value="QA">Qatar</option>
              <option value="UK">Reino Unido</option>
              <option value="CF">República Centroafricana</option>
              <option value="CZ">República Checa</option>
              <option value="ZA">República de Sudáfrica</option>
              <option value="DO">República Dominicana</option>
              <option value="SK">República Eslovaca</option>
              <option value="RE">Reunión</option>
              <option value="RW">Ruanda</option>
              <option value="RO">Rumania</option>
              <option value="RU">Rusia</option>
              <option value="EH">Sahara Occidental</option>
              <option value="KN">Saint Kitts y Nevis</option>
              <option value="WS">Samoa</option>
              <option value="AS">Samoa Americana</option>
              <option value="SM">San Marino</option>
              <option value="VC">San Vicente y Granadinas</option>
              <option value="SH">Santa Helena</option>
              <option value="LC">Santa Lucía</option>
              <option value="ST">Santo Tomé y Príncipe</option>
              <option value="SN">Senegal</option>
              <option value="SC">Seychelles</option>
              <option value="SL">Sierra Leona</option>
              <option value="SG">Singapur</option>
              <option value="SY">Siria</option>
              <option value="SO">Somalia</option>
              <option value="LK">Sri Lanka</option>
              <option value="PM">St Pierre y Miquelon</option>
              <option value="SZ">Suazilandia</option>
              <option value="SD">Sudán</option>
              <option value="SE">Suecia</option>
              <option value="CH">Suiza</option>
              <option value="SR">Surinam</option>
              <option value="TH">Tailandia</option>
              <option value="TW">Taiwán</option>
              <option value="TZ">Tanzania</option>
              <option value="TJ">Tayikistán</option>
              <option value="TF">Territorios franceses del Sur</option>
              <option value="TP">Timor Oriental</option>
              <option value="TG">Togo</option>
              <option value="TO">Tonga</option>
              <option value="TT">Trinidad y Tobago</option>
              <option value="TN">Túnez</option>
              <option value="TM">Turkmenistán</option>
              <option value="TR">Turquía</option>
              <option value="TV">Tuvalu</option>
              <option value="UA">Ucrania</option>
              <option value="UG">Uganda</option>
              <option value="UY">Uruguay</option>
              <option value="UZ">Uzbekistán</option>
              <option value="VU">Vanuatu</option>
              <option value="VE">Venezuela</option>
              <option value="VN">Vietnam</option>
              <option value="YE">Yemen</option>
              <option value="YU">Yugoslavia</option>
              <option value="ZM">Zambia</option>
              <option value="ZW">Zimbabue</option>
            </select>
          </div>
          <hr>
          
          <!-- <div class="form-group"> -->
          <form id="agregar-banner-a-empresa" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <p>Agrega un nuevo banner</p>
              <div id="div_file">
                <p id="texto">Agregar</p>
                <input class="banner-empresa-img" type="file" name="banner-empresa-img" id="btn_enviar"
                        accept="image/x-png, image/gif, image/jpeg">
              </div>
            </div>
          </form>
  
          <!-- </div> -->

          <div class="form-group">
            <a id="redes-sociales" class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal2">Cambia de
              redes sociales <span class="sr-only">(current)</span></a>
          </div>

          <button onclick="actualizar()" type="button" class="btn btn-primary" style="float: right;">Guardar cambios</button>
        </div>

      </div>
    </div>
  </div>


  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Información</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Todo atributo presente en este lugar, es su información actual. Al mdoficarla, está cambiando los datos 
          de su empresa. Recuérdelos a la perfección.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Entendido</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cambia tus redes sociales</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid" style="padding: 30px;">
            <form>
              <div class="form-group">
                <!-- <label for="email-registro-empresa">Correo electrónico</label>
                            <input type="email" class="form-control" id="email-registro" aria-describedby="email-empresa-r">
                            <small id="emailHelp" class="form-text text-muted">Tu correo está a salvo con nosotros.</small> -->
                <table style="padding: 5px;">
                  <tr style="margin: 10px;">
                    <td><i class="fab fa-facebook"></i></td>
                    <td><input id="fb" type="text"></td>
                  </tr>
                  <tr>
                    <td><i class="fab fa-instagram"></i></td>
                    <td><input id="ig" type="text"></td>
                  </tr>
                  <tr>
                    <td><i class="fab fa-youtube"></i></td>
                    <td><input id="yt" type="text"></td>
                  </tr>
                  <tr>
                    <td><i class="fab fa-snapchat"></i></td>
                    <td><input id="sc" type="text"></td>
                  </tr>
                </table>
              </div>


            </form>


          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="exampleModalRegistroSucursales" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="contenedor" style="padding: 30px;">
            <form>
              <div class="form-group">
                <label for="sucursal-registro">Latitud - longitud de la nueva sucursal</label>
                <input type="email" class="form-control" id="sucursal-registro" aria-describedby="sucursal-r">
              </div>
              <div class="form-group">
                <label for="postal-registro">Código postal</label>
                <input type="text" class="form-control" id="postal-registro" aria-describedby="postal-r">
                <!-- <small id="nombre-empresa" class="form-text text-muted">Tu correo está a salvo con nosotros.</small> -->
              </div>
              <hr id="separador">
              <div class="form-group">
                <!-- <label for="imagen">Agregar imagen</label>
                      <input id="imagen" type="file" src="" alt=""> -->
                <p>¡Pon una imagen que identifique la sucursal!</p>
                <div id="div_file">
                  <p id="texto">Agregar</p>
                  <input type="file" id="btn_enviar">
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary">Guardar</button>
        </div>
      </div>
    </div>
  </div>

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
            <form>
              <div class="form-group">
                <label for="producto-registro">Nombre del producto</label>
                <input type="text" class="form-control" id="producto-registro" aria-describedby="sucursal-r">
              </div>
              <div class="form-group">
                <label for="precio-registro">Precio del producto</label>
                <input type="text" class="form-control" id="precio-registro" aria-describedby="precio-r">
                <small id="precio-producto" class="form-text text-muted">Precio en lempiras.</small>
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
                  <input type="file" id="btn_enviar">
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" data-toggle="modal"
            data-target="#exampleModalRegistroProductos2" data-dismiss="modal">Siguiente</button>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN DE MODAL PARA REGISTRAR PRODUCTOS -->

  <!-- MODAL 2 PARA REGISTRAR PRODUCTO -->
  <div class="modal fade" id="exampleModalRegistroProductos2" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Selecciona las sucursales donde estará disponible</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="contenedor" style="padding: 30px;">
            <form>
              <div class="form-group">
                <div class="checkbox">

                  <input type="checkbox" id="sucursal1" name="sucursal1" value="sucursal1">
                  <label for="sucursal1">Sucursal 1</label><br>


                  <input type="checkbox" id="sucursal2" name="sucursal2" value="sucursal2">
                  <label for="sucursal2">Sucursal 2</label><br>


                  <input type="checkbox" id="etc" name="etc" value="etc">
                  <label for="etc">etc</label><br>

                </div>
              </div>
              <div class="form-group">
                <label for="descripcion-producto-registro">Breve descripcion del producto</label>
                <textarea name="textarea" rows="6" cols="40"></textarea>
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
  </div>
  <!-- FIN DE MODAL 2 PARA REGISTRAR PRODUCTOS -->

  <!-- INICIO DE MODAL PARA REGISTRAR PROMOCIONES -->
  <div class="modal fade" id="exampleModalRegistroPromociones" tabindex="-1" role="dialog"
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
  </div>
  <!-- FIN MODAL PARA REGISTRAR PROMOCIONES -->

  <footer class="container">
    <hr style="border-color: #1B6DC1;">
    <p>&copy; BUSE 2020 - Todos los derechos reservados</p>
  </footer>

  <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
  <script src="bootstrap/jquery-3.2.1.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
  <script src="jss/contenedorActualizarPerfilEmpresa.js"></script>
</body>

</html>