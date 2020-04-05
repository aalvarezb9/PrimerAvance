var sucursal = {
  nombreSucursal: '',
  latitudLongitud: '',
  postal: '',
}

var producto = {
  nombreP: '',
  precioP: '',
  categoriaP: '',
  cantidadP: '',
  sucursalesP: [],
  descripcionP: ''
}



//INICIO del registro de sucursales
nombre = document.getElementById('sucursal-registro-nombre');
latitud = document.getElementById('sucursal-registro');
codigoPostal = document.getElementById('postal-registro');

nombreProducto = document.getElementById('producto-registro');
precioProducto = document.getElementById('precio-registro');
categoriaProducto = document.getElementById('categoria-producto-registro');
cantidadProductos = document.getElementById('cantidad');
comentarioProducto = document.getElementById('comentario-del-producto');
function validarRegistroSucursales() {

  if (camposVacios() == true) {
    alert("Por favor llene todos los campos");
    return false;
  } else {

    sucursal.nombreSucursal = nombre.value;
    sucursal.latitudLongitud = latitud.value;
    sucursal.postal = codigoPostal.value;
    console.log(sucursal);
    alert("Sucursal registrada");
    document.getElementById('guardar-sucursal').setAttribute("data-dismiss", "modal");
  }

}

function camposVacios() {
  var vacio;
  if (!latitud.value || !codigoPostal.value || !nombre.value) {
    vacio = true;
  } else {
    vacio = false;
  }

  return vacio;
}



//FIN del registro de sucursales

//INICIO del registro de productos
function validarRegistroProductos() {
  if (camposVaciosProductos() == true) {
    alert("Por favor llenar todos los campos");
    return false;
  } else {
    if (isNaN(precioProducto.value) == true || isNaN(cantidadProductos.value) == true) {
      alert("Por favor ingrese valores numéricos en los campos correspondientes");
      return false;
    } else {
      if (esEntero(cantidadProductos.value) == false) {
        alert("No puede vender una cantidad de productos no entera");
        return false;
      } else {
        producto.nombreP = nombreProducto.value;
        producto.precioP = precioProducto.value;
        producto.categoriaP = categoriaProducto.value;
        producto.cantidadP = cantidadProductos.value;
        document.getElementById('siguiente-producto').setAttribute('data-toggle', 'modal');
        document.getElementById('siguiente-producto').setAttribute('data-target', '#exampleModalRegistroProductos2');
        document.getElementById('siguiente-producto').setAttribute('data-dismiss', 'modal');
        abrirModal2();
      }
    }
  }
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

function validarRegistroProductos2() {
  if (camposVaciosProductos2() == true) {
    alert('Por favor llenar todos los campos');
    return false;
  } else {
    producto.descripcionP = comentarioProducto.value;
    document.getElementById('guardar-producto').setAttribute('data-toggle', 'modal');
    document.getElementById('guardar-producto').setAttribute('data-target', '#exampleModalProductoRegistrado');
    document.getElementById('guardar-producto').setAttribute('data-dismiss', 'modal');
    abrirModalProductoRegistrado();
    verProductoRegistrado(producto.nombreP, producto.descripcionP, 'img/pruebaproducto2.jpg', producto.precioP);
    makeCode(producto.descripcionP);
    console.log(producto);
  }
}

function camposVaciosProductos() {
  var productoVacio;
  if (!nombreProducto.value || !precioProducto.value || !categoriaProducto.value || !cantidadProductos.value) {
    productoVacio = true;
  } else {
    productoVacio = false;
  }
  return productoVacio;
}

function camposVaciosProductos2() {
  var productoVacio2;
  if (!comentarioProducto.value) {
    productoVacio2 = true;
  } else {
    productoVacio2 = false;
  }
  return productoVacio2;
}

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
  $('#exampleModalRegistroProductos').on('hidden.bs.modal', function () {
    $(this).find('form')[0].reset();
    $("label.error").remove();
  });

  $('#exampleModalRegistroProductos2').on('hidden.bs.modal', function () {
    $(this).find('form')[0].reset();
    $("label.error").remove();
  });
}

function limpiarCamposSucursal() {
  $('#exampleModal').on('hidden.bs.modal', function () {
    $(this).find('form')[0].reset();
    $("label.error").remove();
  });

}