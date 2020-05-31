const urlClientes = '../backend/api/usuarios.php';
const urlEmpresas = '../backend/api/empresas.php';
const nombreUser = leerCookie("user");

var productosAMostrar = [];


function cargarAlInicio() {
  cargarProductosAMostrar();
}

cargarAlInicio();

function dejarAzul() {
  document.getElementById('radioEstrella').style.display = 'none';
  document.getElementById('radioEstrellaGris').style.display = 'block';
}

function dejarGris() {
  document.getElementById('radioEstrellaGris').style.display = 'none';
  document.getElementById('radioEstrella').style.display = 'block';
}

function cargarProductosAMostrar() {
  document.getElementById('productos-de-empresas-a-mostrar').innerHTML = '';
  axios({
    url: urlEmpresas + '?prdC',
    method: 'GET',
    responseType: 'json'
  }).then(res => {
    console.log(res.data);
    if (res.data.estado == "exito") {
      for (let contadorEmpresas = 0; contadorEmpresas < res.data.info.length; contadorEmpresas++) {
        for (let contadorProductos = 0; contadorProductos < res.data.info[contadorEmpresas].productos.length; contadorProductos++) {
          document.getElementById('productos-de-empresas-a-mostrar').innerHTML += `
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card" style="width: 18rem; height: 600px;">
                        <div id="imagen-${contadorEmpresas}-${contadorProductos}" style="margin-right: auto; margin-left: auto; margin-bottom: 10px; width: 200px; height: 200px;">
                            <img src="${res.data.info[contadorEmpresas].productos[contadorProductos].imagen}" class="card-img-top" alt="..." style="width: 200px; height: 150px; margin-left: auto; margin-right: auto; margin-top: 7px;">
                        </div>
                      <div class="card-body">
                        <h5 class="card-title"></h5>
                        <a href="">
                          <h3>${res.data.info[contadorEmpresas].name}</h3>
                        </a>
                        <h2><b>${res.data.info[contadorEmpresas].productos[contadorProductos].precio} Lps</b></h2>
                        <h1><b>${res.data.info[contadorEmpresas].productos[contadorProductos].nombre}</b></h1>
                        <p class="card-text">${res.data.info[contadorEmpresas].productos[contadorProductos].descripcion}</p>
                        <a id="carrito-${contadorEmpresas}-${contadorProductos}" href="#" class="btn btn-primary" onclick="agregarCarrito(${contadorEmpresas}, ${contadorProductos}, '${res.data.info[contadorEmpresas].productos[contadorProductos].nombre}', '${res.data.info[contadorEmpresas].productos[contadorProductos].precio}', '${res.data.info[contadorEmpresas].productos[contadorProductos].descripcion}', '${res.data.info[contadorEmpresas].productos[contadorProductos].imagen}')">Agregar al carrito</a>
                      </div>
                      <div class="container-fluid" style="padding: 5px;">
                        <div class="row">
                          <div id="calificar-${contadorEmpresas}-${contadorProductos}" class="col-4"><a href="#" id="calificarP-${contadorEmpresas}-${contadorProductos}" class="btn btn-primary" onclick="calificarProducto(${contadorEmpresas}, ${contadorProductos}, '${res.data.info[contadorEmpresas].productos[contadorProductos].nombre}', '${res.data.info[contadorEmpresas].productos[contadorProductos].precio}', '${res.data.info[contadorEmpresas].productos[contadorProductos].descripcion}')">Calificar</a></div>
                          <div id="comentar-${contadorEmpresas}-${contadorProductos}" class="col-4"><a href="#" id="comentarP-${contadorEmpresas}-${contadorProductos}" class="btn btn-primary" onclick="comentarProducto(${contadorEmpresas}, ${contadorProductos}, '${res.data.info[contadorEmpresas].productos[contadorProductos].nombre}', '${res.data.info[contadorEmpresas].productos[contadorProductos].precio}', '${res.data.info[contadorEmpresas].productos[contadorProductos].descripcion}')">Comentar</a></div>
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
                    `;
        }
      }
    }
  }).catch(err => {
    alert("Error: " + err);
    return false;
  });
}

function generarProductos() {

}

//Función que agrega al carrito un producto
function agregarCarrito(e, p, nombre, precio, descripcion, imagen) {
  document.getElementById('nombre-producto-carrito').innerHTML = `${nombre}`;
  document.getElementById('precio-producto-carrito').innerHTML = `${precio}`;
  document.getElementById('comentario-carrito').innerHTML = `${descripcion}`;
  document.getElementById('imagen-carrito').innerHTML = `
  <img src="${imagen}" class="card-img-top" alt="..." style="width: 200px; height: 150px;">
  `;
  $('#exampleModal3').modal('show');
  document.getElementById('aqui-van-los-botones').innerHTML = `
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <button onclick="subirAlCarrito(${e}, ${p})" type="button" class="btn btn-primary">Agregar</button>
  `;

}

function subirAlCarrito(e, p) {
  let cantidad = document.getElementById('cantidad-elementos-carrito').value;
  axios({
    method: 'PUT',
    url: urlClientes + '?carr=' + nombreUser,
    responseType: 'json',
    data: {
      e: e,
      p: p,
      c: cantidad
    }
  }).then(res => {
    if(res.data.estado == "exito"){
      document.getElementById('cantidad-elementos-carrito').value = '';
      $('#exampleModal3').modal('hide');
      alert("Producto agregado al carrito");
      window.location.reload();
      return false;
    }else if(res.data.estado == "00"){
      alert(res.data.mensaje);
      return false;
    }else{
      alert("Error");
      return false;
    }
  }).catch(err => {
    alert("Error: " + err);
    return false;
  });
}


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
