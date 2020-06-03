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
      for (let contadorEmpresas = res.data.info.length - 1; contadorEmpresas >= 0; contadorEmpresas--) {
        for (let contadorProductos = res.data.info[contadorEmpresas].productos.length - 1; contadorProductos >= 0; contadorProductos--) {
          document.getElementById('productos-de-empresas-a-mostrar').innerHTML += `
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="card" style="width: 18rem; height: 600px;">
                        <div id="imagen-${contadorEmpresas}-${contadorProductos}" style="margin-right: auto; margin-left: auto; margin-bottom: 10px; width: 200px; height: 200px;">
                            <img src="${res.data.info[contadorEmpresas].productos[contadorProductos].imagen}" class="card-img-top" alt="..." style="width: 200px; height: 150px; margin-left: auto; margin-right: auto; margin-top: 7px;">
                        </div>
                      <div class="card-body">
                        <h5 class="card-title"></h5>
                        <a href="#" onclick="verPerfilEmpresa('${res.data.info[contadorEmpresas].name}')">
                          <h3 value="${res.data.info[contadorEmpresas].name}">${res.data.info[contadorEmpresas].name}</h3>
                        </a>
                        <h2><b>${res.data.info[contadorEmpresas].productos[contadorProductos].precio} Lps</b></h2>
                        <h1><b>${res.data.info[contadorEmpresas].productos[contadorProductos].nombre}</b></h1>
                        <p class="card-text">${res.data.info[contadorEmpresas].productos[contadorProductos].descripcion}</p>
                        <a id="carrito-${contadorEmpresas}-${contadorProductos}" href="#" class="btn btn-primary" onclick="agregarCarrito(${contadorEmpresas}, ${contadorProductos}, '${res.data.info[contadorEmpresas].productos[contadorProductos].nombre}', '${res.data.info[contadorEmpresas].productos[contadorProductos].precio}', '${res.data.info[contadorEmpresas].productos[contadorProductos].descripcion}', '${res.data.info[contadorEmpresas].productos[contadorProductos].imagen}')">Agregar al carrito</a>
                      </div>
                      <div class="container-fluid" style="padding: 5px;">
                        <div class="row">
                          <div id="calificar-${contadorEmpresas}-${contadorProductos}" class="col-4"><a href="#" id="calificarP-${contadorEmpresas}-${contadorProductos}" class="btn btn-primary" onclick="calificarProducto(${contadorEmpresas}, ${contadorProductos}, '${res.data.info[contadorEmpresas].productos[contadorProductos].nombre}', '${res.data.info[contadorEmpresas].productos[contadorProductos].precio}', '${res.data.info[contadorEmpresas].productos[contadorProductos].descripcion}')">Calificar</a></div>
                          <div id="comentar-${contadorEmpresas}-${contadorProductos}" class="col-4"><a href="#" id="comentarP-${contadorEmpresas}-${contadorProductos}" class="btn btn-primary" onclick="comentarProducto(${contadorEmpresas}, ${contadorProductos}, '${res.data.info[contadorEmpresas].productos[contadorProductos].nombre}', '${res.data.info[contadorEmpresas].productos[contadorProductos].precio}', '${res.data.info[contadorEmpresas].productos[contadorProductos].descripcion}', '${res.data.info[contadorEmpresas].productos[contadorProductos].imagen}')">Comentar</a></div>
                          <div class="col-4">
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

function eliminarCuenta(){
  axios({
    url: urlClientes + '?id=' + nombreUser,
    method: 'DELETE',
    responseType: 'json'
  }).then(res => {
    if(res.data.estado == "exito"){
      alert("Usuario eliminado");
      window.location.href = 'logout.php';
      return false;
    }else{
      alert("Error");
      return false;
    }
  }).catch(err => {
    alert("Error " + err);
    return false;
  });
}

function verPerfilEmpresa(empresa) {
  let empresaa = empresa;
  document.getElementById('comments').innerHTML = '';
  document.getElementById('calificaciones').innerHTML = '';
  axios({
    url: urlClientes + '?vrp=' + nombreUser,
    method: 'PUT',
    responseType: 'json',
    data: {
      emp: empresa
    }
  }).then(res => {
    let sum = 0;
    let cont = 0;
    $('#exampleModalVerEmpresa').modal('show');
    document.getElementById('exampleModalLabelT').innerHTML = empresa;
    document.getElementById('imagen-ve').setAttribute("src", `${res.data.empresa.imagesEmpresa[0]}`);
    document.getElementById('imagen-ve').style = 'width: 100px';
    document.getElementById('dir').innerHTML = `${res.data.empresa.address}`;
    document.getElementById('fb').innerHTML = `Facebook: ${res.data.empresa.social.facebook}`;
    document.getElementById('ig').innerHTML = `Instagram: ${res.data.empresa.social.instagram}`;
    document.getElementById('sc').innerHTML = `Snapchat: ${res.data.empresa.social.snapchat}`;
    document.getElementById('yt').innerHTML = `Youtube: ${res.data.empresa.social.youtube}`;
    for(let j = 0; j < res.data.empresa.products.length; j++){

      if (res.data.empresa.products[j].comentarios == undefined || res.data.empresa.products[j].comentarios.length == 0) {
        console.log('nada');
      } else {
        for (let i = 0; i < res.data.empresa.products[j].comentarios.length; i++) {
          document.getElementById('comments').innerHTML += `
          <li class="media">
            <h5 id="comentario-${i}">${res.data.empresa.products[j].comentarios[i].comentario}  ${'    '}</h5>
            <div class="media-body">
              <h5 class="mt-0 mb-1">  <b>    (${res.data.empresa.products[j].comentarios[i].autor})</b></h5>
            </div>
          </li>
          `;
        }
      }
      if (res.data.empresa.products[j].calificaciones == undefined || res.data.empresa.products[j].calificaciones.length == 0) {
        console.log('nada');
      } else {
        for (let i = 0; i < res.data.empresa.products[j].calificaciones.length; i++) {
          sum += parseInt(res.data.empresa.products[j].calificaciones[i].calificacion); 
          cont++;
          document.getElementById('calificaciones').innerHTML += `
          <li class="media">
            <h5 id="calificacion-${i}">${res.data.empresa.products[j].calificaciones[i].calificacion}  ${'    '}</h5>
            <div class="media-body">
              <h5 class="mt-0 mb-1">  <b>   (${res.data.empresa.products[j].calificaciones[i].autor})</b></h5>
            </div>
          </li>
          `;
        }
      }
    }
    document.getElementById('cal').innerHTML = `Promedio: ${parseInt(sum/cont)}`;
    document.getElementById('botones-ver').innerHTML = `
    <button type="button" onclick="fav('${empresaa}')" class="btn btn-primary" data-dismiss="modal">Marcar como favorita</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    `;
  }).catch(err => {
    // console.error(err);
    alert("Error " + err);
    return false;
  });
}

function fav(e){
  axios({
    url: urlClientes + '?fav=' + nombreUser,
    method: 'PUT',
    responseType: 'json',
    data: {
      empresa: e
    }
  }).then(res => {
    alert("Empresa marcada como favorita");
    return false;
  }).catch(err => {
    alert("Error " + err);
    return false;
  });
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
    if (res.data.estado == "exito") {
      document.getElementById('cantidad-elementos-carrito').value = '';
      $('#exampleModal3').modal('hide');
      alert("Producto agregado al carrito");
      window.location.reload();
      return false;
    } else if (res.data.estado == "00") {
      alert(res.data.mensaje);
      return false;
    } else {
      alert("Error");
      return false;
    }
  }).catch(err => {
    alert("Error: " + err);
    return false;
  });
}

function comentarProducto(e, p, nombre, precio, descripcion, imagen) {
  $('#exampleModalComentar').modal('show');
  document.getElementById('nombre-producto-comentar').innerHTML = nombre;
  document.getElementById('botones-comentario').innerHTML = `
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <button type="button" onclick="subirComentario(${e}, ${p})" class="btn btn-primary" id="comentar" data-dismiss="modal">Comentar</button>
  `;
}

function subirComentario(e, p) {
  let comentario = document.getElementById('comentar-producto').value;
  axios({
    url: urlClientes + '?com=' + nombreUser,
    method: 'PUT',
    responseType: 'json',
    data: {
      e: e,
      p: p,
      c: comentario
    }
  }).then(res => {
    document.getElementById('comentar-producto').value = '';
    alert("Comentario hecho");
    return false;
  }).catch(err => {
    alert("Error " + err);
  });
}

function calificarProducto(e, p, nombre, precio, descripcion) {
  $('#exampleModalCalificar').modal('show');
  document.getElementById('nombre-producto-calificar').innerHTML = nombre;
  document.getElementById('botones-calificar').innerHTML =
    `
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
    <button type="button" onclick="subirCalificacion(${e}, ${p})" class="btn btn-primary" id="calificar-p" data-dismiss="modal">Calificar</button>
  `;
}

function subirCalificacion(e, p) {
  let cal = document.getElementById('calificacion').value;
  if (cal < 0) {
    alert("Imposible poner números negativos");
    return false;
  } else if (cal > 10) {
    alert("Rango entre 0 y 10");
    return false;
  } else if (isNaN(cal) == true) {
    alert("No puede ingresar letras");
    return false;
  } else {
    axios({
      url: urlClientes + '?cal=' + nombreUser,
      method: 'PUT',
      responseType: 'json',
      data: {
        e: e,
        p: p,
        c: cal
      }
    }).then(res => {
      document.getElementById('calificacion').value = 0;
      alert("Calificación hecha");
      return false;
    }).catch(err => {
      alert("Error " + err);
      return false;
    })
  }
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
