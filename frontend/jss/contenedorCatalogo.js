
const urlEmpresas = '../backend/api/empresas.php';
const nombreEmpresa = leerCookie("name");
var productos;

function alCargar(){
    cargarProductos(nombreEmpresa);
}

alCargar();

function abrirModal(id, imagen, codigoQR, nombre, cantidad) {
    document.getElementById('num').innerHTML = '';
    document.getElementById('qrcode').innerHTML = '';
    $('#exampleModalIncrementar').modal('show');
    makeCode(codigoQR);
    var ct = 0;
    document.getElementById('imagen-aqui').innerHTML = `<img src="${imagen}" class="card-img-top" alt="..." style="width: 100px; height: 100px">`;
    if (id == 0) {
        for(let i = 0; i < cantidad; i++){
            document.getElementById('num').innerHTML += `
                <option onchange="numSeleccionado()" value="${i + 1}">${i + 1}</option>
            `;
        }
        // numSeleccionado();
        // ct = numSeleccionado();
        document.getElementById('exampleModalLabel').innerHTML = `<b>Elimina tu producto: ${nombre} <br> Máximo: ${cantidad}</b>`;
        document.getElementById('depende').innerHTML = 'a eliminar';
        document.getElementById('botones-modal').innerHTML = `
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" onclick="mandarCambios(0, '${nombre}')" class="btn btn-primary" data-dismiss="modal">Aplicar</button>
        `;
    } else {
        for(let i = 0; i < cantidad; i++){
            document.getElementById('num').innerHTML += `
                <option onchange="numSeleccionado()" value="${i + 1}">${i + 1}</option>
            `;
        }
        // ct = numSeleccionado();
        document.getElementById('exampleModalLabel').innerHTML = `<b>Incrementa tu producto: ${nombre}</b>`;
        document.getElementById('depende').innerHTML = 'a incrementar';
        document.getElementById('botones-modal').innerHTML = `
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" onclick="mandarCambios(1, '${nombre}')" class="btn btn-primary" data-dismiss="modal">Aplicar</button>
        `;
    }
}

function mandarCambios(estado, nombre){
    let cantidad = numSeleccionado();
    // console.log(cantidad);
    // console.log(leerCookie(nombreEmpresa));
    if(cantidad == null || cantidad == 0 || cantidad == ''){
        alert("Establezca una cantidad");
        return false;
    }else{
        axios({
            url: urlEmpresas + '?cPrd=' + nombreEmpresa,
            method: 'PUT',
            responseType: 'json',
            data: {
                cantidad: cantidad,
                status: estado,
                nombreP: nombre
            }
        }).then(res => {
            // console.log(res.data);
            if(res.data.estado == "exito"){
                alert("Cambio efectuado con éxito");
                window.location.reload();
            }else{
                alert("Ocurrió un error en el servidor, intente de nuevo");
            }
        }).catch(error => {
            alert("Error: " + error);
        });
    }
}

function vaciar(){
    document.getElementById('exampleModalLabel').innerHTML = '';
    document.getElementById('imagen-aqui').innerHTML = '';
    document.getElementById('depende').innerHTML = '';
    document.getElementById('qrcode').innerHTML = '';
    document.getElementById('botones-modal').innerHTML = '';
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

function cargarProductos(name){
    productos = [];
    axios({
        url: urlEmpresas + '?prd=' + name,
        method: 'GET',
        responseType: 'json'
    }).then(res => {
        console.log(res.data);
        if(res.data.estado == "exito" && res.data.products.length > 0)
        {   for(let i = 0; i < res.data.products.length; i++){
                productos.push(res.data.products[i]);
                document.getElementById('aqui-van-los-productos').innerHTML +=
                    `
                    <div class="col-lg-4 col-md-4 col-sm-6-col-xs-12" style="margin-bottom: 15px;">
                        <div class="card" style="width: 18rem;">
                            <div style="width: 200px; height: 150px; margin-left: auto; margin-right: auto; margin-top: 10px">
                                <img src="${res.data.products[i].imagen}" class="card-img-top" alt="..." style="width: 200px; height: 150px">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">${res.data.products[i].nombre}</h5>
                                <h3>${res.data.products[i].categoria}</h3>
                                <h2><b>${res.data.products[i].precio} Lps</b></h2>
                                <h3>${res.data.products[i].cantidad} disponibles</h3>
                                <p class="card-text">${res.data.products[i].descripcion}</p>
                                <a href="#" class="btn btn-primary" onclick="abrirModal(0, '${res.data.products[i].imagen}', '${res.data.products[i].codigoQR}', '${res.data.products[i].nombre}', ${res.data.products[i].cantidad})">Eliminar</a>
                                <br><br>
                                <a href="#" class="btn btn-primary" onclick="abrirModal(1, '${res.data.products[i].imagen}', '${res.data.products[i].codigoQR}', '${res.data.products[i].nombre}', ${res.data.products[i].cantidad})">Incrementar</a>
                                <br><br>
                                <a href="#" class="btn btn-primary" onclick="imprimir(${i})">Imprimir</a>
                            </div>
                        </div>
                    </div>
                    `;
            }
        }else if(res.data.estado == "exito" && res.data.products.length == 0){
            alert("Error, no tiene registrado ningún producto. Diríjase a su perfil para agregar");
            window.location.href = 'visualizarPerfilEmpresa.php';
            return false;
        }else{
            alert("Error");
            return false;
        }
    }).catch(err => {
        alert('Error: ' + err);
    });
}

function imprimir(indice){
    document.getElementById('qrcode1').innerHTML = '';
    $('#exampleModalImprimir').modal('show');
    makeCode1(productos[indice].descripcion);
    document.getElementById('img-p').setAttribute("src", `${productos[indice].imagen}`);
    document.getElementById('n-p').innerHTML = productos[indice].nombre;
    document.getElementById('p-p').innerHTML = productos[indice].precio + ' Lps';
}

function makeCode(comentario) {
    var qrcode = new QRCode(document.getElementById("qrcode"), {
      width: 100,
      height: 100
    });
    qrcode.makeCode(comentario);
  }

  function makeCode1(comentario) {
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
      width: 100,
      height: 100
    });
    qrcode.makeCode(comentario);
  }

function numSeleccionado() {
    var select = document.getElementById("num");
    // var value = select.value;
    var text = select.options[select.selectedIndex].innerText;


    return text;
}