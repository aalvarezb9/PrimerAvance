const urlRegistrarSucursal = '../backend/api/empresas.php?nameES=';
const urlRegistrarProducto = '../backend/api/empresas.php?nameE=';
const urlEmpresas = '../backend/api/empresas.php';
const nombreEmpresa = leerCookie("name");

var sucursal = {
  nombreSucursal: '',
  latitudLongitud: '',
  postal: '',
}

// var producto = {
//   nombre: '',
//   precio: '',
//   categoria: '',
//   cantidad: '',
//   imagen: '',
//   codigoQR: document.getElementById('comentario-del-producto').value,
//   descripcion: ''
// }



//INICIO del registro de sucursales
nombre = document.getElementById('sucursal-registro-nombre');
// latitud = document.getElementById('sucursal-registro');
codigoPostal = document.getElementById('postal-registro');

nombreProducto = document.getElementById('producto-registro');
precioProducto = document.getElementById('precio-registro');
categoriaProducto = document.getElementById('categoria-producto-registro');
cantidadProductos = document.getElementById('cantidad');
comentarioProducto = document.getElementById('comentario-del-producto');

function cargarAlIniciar(){
  obtenerNombreSucursales(nombreEmpresa);
  obtenerBanners(nombreEmpresa);
}

cargarAlIniciar();

//Función que sube un producto
function subirProducto() {
  if (camposVaciosProductos() == true) {
    alert("Por favor llene todos los campos");
    return false;
  } else {
    var form = $('#form-subir-producto');
    let data = new FormData(form[0]);
    axios.post('subirImagen.php', data)
      .then(resI => {
        let producto =
        {
          nombre: document.getElementById('producto-registro').value,
          precio: document.getElementById('precio-registro').value,
          categoria: document.getElementById('categoria-producto-registro').value,
          cantidad: document.getElementById('cantidad').value,
          imagen: resI.data,
          codigoQR: document.getElementById('comentario-del-producto').value,
          descripcion: document.getElementById('comentario-del-producto').value
        }

        axios({
          url: urlRegistrarProducto + leerCookieNombre(),
          method: 'PUT',
          responseType: 'json',
          data: {
            producto: producto
          }
        }).then(res => {
          if (res.data.estado == "exito") {
            $('#exampleModalRegistroProductos').modal('hide');
            limpiarCamposProductos();
            $('#exampleModalProductoRegistrado').modal('show');
            verProductoRegistrado(producto.nombre, producto.descripcion, producto.imagen, producto.precio);
            makeCode(producto.descripcion);
            console.log(producto);
          } else {
            // $('#exampleModalRegistroProductos2').modal('hide');
            $('#exampleModalProductoRegistrado').modal('show');
            verProductoRegistrado("ERROR", "Ocurrió un error en el registro del producto", '', "Intente nuevamente");
            makeCode(producto.descripcion);
          }
        }).catch(error => {
          // alert("Error del servidor "+error.data);
          limpiarCamposProductos();
          // $('#exampleModalRegistroProductos2').modal('hide');
          // $('#exampleModalProductoRegistrado').modal('show');
          // verProductoRegistrado(producto.nombre, producto.descripcion, 'img/pruebaproducto2.jpg', producto.precio);
          // makeCode(producto.descripcion);
          // console.log(producto);
        });
      })
      .catch(e => {
        console.error(e);
        limpiarCamposProductos();
      });
  }
}


function obtenerNombreSucursales(empresa) {
  console.log(nombreEmpresa);
  axios({
    method: 'GET',
    url: urlEmpresas + '?nSuc=' + empresa,
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
          document.getElementById('menu-desplegable-de-promociones').innerHTML += `<a class='dropdown-item' id='${res.data.nombreSucursales[i].replace(" ", "-")}' href='#' onclick='verSucursal(${i})'>${res.data.nombreSucursales[i]}  <button style="position: right;" onclick="eliminarSucursal(${i})">X</button></a>`;
          if (i == 10) {
            "<a class='dropdown-item' href='#' onclick='verMas()'>Ver más</a>";
            i = res.data.nombreSucursales.length;
          }
        }
      }
    } else {
      alert("Error");
    }
  }).catch(err => {
    alert("Error al obtener sucursales: " + err);
  });
}

function obtenerBanners(empresa) {
  axios({
    method: 'GET',
    url: urlEmpresas + '?bnnr=' + empresa,
    responseType: 'json'
  }).then(res => {
    if (res.data.estado == "exito") {
      console.log(res.data);
      console.log(res.data.banner);
      if (res.data.banner.length == 0) {
        document.getElementById('aqui-van-los-banners').innerHTML =
          `
        <div class='carousel-item active'>
          <img src='${'../backend/datos/img/empresas/banners/bnnrDefecto.png'}' style='height: 345px;' class='d-block w-100' alt='...'>
        </div>"
        `;
      } else {
        let bannerFinal = borrarElemento(res.data.banner, "");
        document.getElementById('aqui-van-los-banners').innerHTML =
          `
        <div class='carousel-item active'>
          <img src='${bannerFinal[0]}' style='height: 345px;' class='d-block w-100' alt='...'>
        </div>"
        `;
        for(let j = 0; j < bannerFinal.length; j++){
          document.getElementById('indicadores-banners').innerHTML +=
           `
           <li data-target='#carouselExampleIndicators' data-slide-to='${j + 1}' style='background-color: #1B6DC1'></li>
          `;
        }
        for (let i = 1; i < bannerFinal.length; i++) {
          document.getElementById('aqui-van-los-banners').innerHTML += 
          `
          <div class='carousel-item'>
            <img src='${bannerFinal[i]}' style='height: 345px;' class='d-block w-100' alt='...'>
          </div>
          `;
        }
      }
    } else {
      alert("Error");
    }
  }).catch(err => {
    alert("Error al obtener banners: " + err);
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

function borrarElemento(arr, elemento) {//función que borra un elemento de un arreglo, 
  return arr.filter(function (e) {
    return e !== elemento;
  });
}

//Función para obtener la cookie con el nombre:
function leerCookieNombre() {
  var lista = document.cookie.split(";");
  for (i in lista) {
    var busca = lista[i].search("name");
    if (busca > -1) { micookie = lista[i] }
  }
  var igual = micookie.indexOf("=");
  var valor = micookie.substring(igual + 1);
  return valor;
}

//Enviar la información de una sucursal al servidor:
function validarRegistroSucursales() {
  if (camposVacios() == true) {
    alert("Por favor llene todos los campos");
    return false;
  } else {
    axios({
      url: urlRegistrarSucursal + leerCookieNombre(),
      method: 'PUT',
      responseType: 'json',
      data: {
        sucursal: {
          nombre: nombre.value,
          latitud: document.getElementById('sucursal-registro-latitud').value,
          longitud: document.getElementById('sucursal-registro-longitud').value,
          codigoPostal: codigoPostal.value
        }
      }
    }).then(res => {
      if (res.data.estado == 'exito') {
        console.log(res.data);
        document.getElementById('sucursal-registro-nombre').value = '';
        document.getElementById('postal-registro').value = '';
        document.getElementById('sucursal-registro-latitud').value = '';
        document.getElementById('sucursal-registro-longitud').value = '';

        $('#example-modal').modal('hide');
        alert("Sucursal registrada");
        sleep(200);

        location.reload();
      } else {
        alert("Error");
      }
    }).catch(error => {
      alert("Error del servidor");
      console.log(error);
      $('#guardar-sucursal').modal('hide');
    })
    // document.getElementById('guardar-sucursal').setAttribute("data-dismiss", "modal");
  }

}

function camposVacios() {
  var vacio;
  if (!document.getElementById('sucursal-registro-latitud').value || !codigoPostal.value || !nombre.value) {
    vacio = true;
  } else {
    vacio = false;
  }

  return vacio;
}

//Función para ver la sucursal seleccionada
function verSucursal(indice) {
  let empresa = nombreEmpresa;
  axios({
    url: urlEmpresas + '?vSuc=' + empresa,
    method: 'POST',
    responseType: 'json',
    data: {
      id: indice
    }
  }).then(res => {
    if(res.data.estado == "exito"){
      $('#ver-sucursal').modal('show');
      document.getElementById('nombre-de-la-sucursal').innerHTML = res.data.sucursal.nombre;
      document.getElementById('latitud-de-la-sucursal').innerHTML = res.data.sucursal.latitud;
      document.getElementById('longitud-de-la-sucursal').innerHTML = res.data.sucursal.longitud;
      document.getElementById('codigo-postal-de-la-sucursal').innerHTML = res.data.sucursal.codigoPostal;
    }else{
      alert("Error");
    }
  }).catch(err => {
    alert("Error al ver sucursal: " + error);
  });
}

//Función que devuelve el valor del nombre de una sucursal
function leerCookieSucursalNombre(indice) {
  let name = `sucursal[nombre][${indice}]` + "=";
  let ca = document.cookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1);
    if (c.indexOf(name) == 0) return unescape(c.substring(name.length, c.length));
  }
  return "";
}

//Función que devuelve el valor de la latitud de una sucursal
function leerCookieSucursalLatitud(indice) {
  let name = `sucursal[latitud][${indice}]` + "=";
  let ca = document.cookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1);
    if (c.indexOf(name) == 0) return unescape(c.substring(name.length, c.length));
  }
  return "";
}

//Función que devuelve el valor de la longitud de una sucursal
function leerCookieSucursalLongitud(indice) {
  let name = `sucursal[longitud][${indice}]` + "=";
  let ca = document.cookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1);
    if (c.indexOf(name) == 0) return unescape(c.substring(name.length, c.length));
  }
  return "";
}

//Función que devuelve el valor del códigoPostal de una sucursal
function leerCookieSucursalCodigoPostal(indice) {
  let name = `sucursal[codigoPostal][${indice}]` + "=";
  let ca = document.cookie.split(';');
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1);
    if (c.indexOf(name) == 0) return unescape(c.substring(name.length, c.length));
  }
  return "";
}

//Función que visualiza las sucursales por si hay más de 10
function verMas() {

}


//FIN del registro de sucursales

//INICIO del registro de productos
// function validarRegistroProductos() {
//   if (camposVaciosProductos() == true) {
//     alert("Por favor llenar todos los campos");
//     return false;
//   } else {
//     if (isNaN(precioProducto.value) == true || isNaN(cantidadProductos.value) == true) {
//       alert("Por favor ingrese valores numéricos en los campos correspondientes");
//       return false;
//     } else {
//       if (esEntero(cantidadProductos.value) == false) {
//         alert("No puede vender una cantidad de productos no entera");
//         return false;
//       } else {
//         producto.nombre = nombreProducto.value;
//         producto.precio = precioProducto.value;
//         producto.categoria = categoriaProducto.value;
//         producto.cantidad = cantidadProductos.value;
//         document.getElementById('siguiente-producto').setAttribute('data-toggle', 'modal');
//         document.getElementById('siguiente-producto').setAttribute('data-target', '#exampleModalRegistroProductos2');
//         document.getElementById('siguiente-producto').setAttribute('data-dismiss', 'modal');
//         abrirModal2();
//       }
//     }
//   }
// }

function eliminarCuenta(){
  axios({
    url: urlEmpresas + '?idE=' + nombreEmpresa,
    method: 'DELETE',
    responseType: 'json',
  }).then(res => {
    if(res.data.estado == "exito"){
      alert("Empresa eliminada");
      window.location.href = 'logoutE.php';
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

function esEntero(numero) {
  var loEs;
  if (numero % 1 == 0) {
    loEs = true;
  } else {
    loEs = false;
  }
  return loEs;
}

function eliminarSucursal(indice){
  axios({
    url: urlEmpresas + '?suc=' + nombreEmpresa,
    method: 'DELETE',
    responseType: 'json',
    data:{
      i: indice
    }
  }).then(res => {
    if(res.data.estado == "exito"){
      alert("Sucursal eliminada");
      window.location.reload();
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

function camposVaciosProductos() {
  var productoVacio;
  if (!nombreProducto.value || !precioProducto.value || !categoriaProducto.value || !cantidadProductos.value || !comentarioProducto.value) {
    productoVacio = true;
  } else {
    productoVacio = false;
  }
  return productoVacio;
}

// function camposVaciosProductos2() {
//   var productoVacio2;
//   if (!comentarioProducto.value) {
//     productoVacio2 = true;
//   } else {
//     productoVacio2 = false;
//   }
//   return productoVacio2;
// }

function verProductoRegistrado(nombreDelProducto, descripcionDelProducto, imagenDelProducto, precioDelProducto) {
  document.getElementById('aqui-va-el-producto').innerHTML +=
    `
    <div class="form-group">
      <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="${imagenDelProducto}" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title"><b>${nombreDelProducto}</b></h5>
          <p class="card-text">${descripcionDelProducto}</p>
          <h6><b>${precioDelProducto} lempiras</b></h6>
        </div>
      </div>              
    </div>
  `;
}

function obtenerCategoria() {

}

function abrirModal2() {
  document.getElementById('exampleModalRegistroProductos2').setAttribute('aria-hidden', 'false');
}

function abrirModalProductoRegistrado() {
  document.getElementById('exampleModalProductoRegistrado').setAttribute('aria-hidden', 'false');
}
//FIN del registro de productos


// Función para crear el código QR
function makeCode(comentario) {
  var qrcode = new QRCode(document.getElementById("qrcode"), {
    width: 100,
    height: 100
  });
  qrcode.makeCode(comentario);
}



function limpiarCamposProductos() {
  // $('#exampleModalRegistroProductos').on('hidden.bs.modal', function () {
  //   $(this).find('form')[0].reset();
  //   $("label.error").remove();
  // });
  document.getElementById('producto-registro').value = '';
  document.getElementById('precio-registro').value = '';
  document.getElementById('categoria-producto-registro').value = '';
  document.getElementById('cantidad').value = '';
  document.getElementById('comentario-del-producto').value = '';

}

function limpiarCamposSucursal() {
  $('#exampleModal').on('hidden.bs.modal', function () {
    $(this).find('form')[0].reset();
    $("label.error").remove();
  });

}

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds) {
      break;
    }
  }
}