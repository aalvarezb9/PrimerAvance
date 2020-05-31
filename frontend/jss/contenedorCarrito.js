
const urlUsuarios = '../backend/api/usuarios.php';
const nombreUser = leerCookie("user");
var carrito = [];

function verificarFormaDePago(){
    if(hayFormaDePagoRegistrada() == false){
        alert("Registre una forma de pago");
        return false;
    }else{
        nombre.innerHTML = cliente.formaDePago.nombreTarjeta;
        numero.innerHTML = cliente.formaDePago.numeroTarjeta;
        valido.innerHTML = cliente.formaDePago.validoHasta;
        cvvv.innerHTML = cliente.formaDePago.cvv;
    }
}

function efectuarCompra() {

    if (hayCarrito() == false) {
        alert("No tiene elementos en el carrito");
        return false;
    } else {
        verificar();
    }

}

function verificar() {
    var total = 0 ;
    nombre = document.getElementById('nombre-tarjeta');
    numero = document.getElementById('tarjeta');
    valido = document.getElementById('hasta');
    cvvv = document.getElementById('cvv');

    if (nombre.value == '' && numero.value == '' && valido.value == '' && cvv.value == '') {
        if (formaDePago.nombreTarjeta != nombre.value || formaDePago.numeroTarjeta != numero.value || formaDePago.validoHasta != valido || formaDePago.cvv != cvvv.value) {
            alert("Alguno de los elementos ingresados no coincide con su forma de pago ya registrada");
            return false;
        } else {
            for (let i = 0; i < cliente.carrito.length - 1; i++) {
                purchases.push(cliente.carrito[i]);
                total += cliente.carrito[i].precio;
            }
            cliente.carrito.splice(0, cliente.carrito.length - 1);
            alert(`Compra realizada con éxito, gastó un total de ${total} lempiras`);
            return false;
        }
    }

}

function hayFormaDePagoRegistrada(){
    var hayForma;
    if(cliente.formaDePago.nombreTarjeta == '' && cliente.formaDePago.numeroTarjeta == '' && cliente.formaDePago.validoHasta == '' && cliente.formaDePago.cvv == ''){
        hayForma = false;
    }else{
        hayForma = true;
    }
    return hayForma;
}

function hayCarrito() {
    var hay;
    if (cliente.carrito.length == 0) {
        hay = false;
    } else {
        hay = true;
    }
    return hay;
}

function cargarCarrito(){
    let totalC = 0;
    axios({
        url: urlUsuarios + '?obtC=' + nombreUser,
        method: 'GET',
        responseType: 'json'
    }).then(res => {
        if(res.data.estado == "exito"){
            carrito = res.data.carrito;
            console.log(carrito);
            console.log(res.data.carrito);
            if(carrito.length == 0){
                alert("No tiene nada en el carrito, compre productos");
                window.location = 'inicioCliente.php';
                return false;
            }else if(carrito.length > 0){
                 for(let i = 0; i < res.data.carrito.length; i++){
                    totalC += parseInt(res.data.carrito[i].precio)*parseInt(res.data.carrito[i].cantidad);
                    document.getElementById('aqui-va-lo-del-carrito').innerHTML += `
                        <li><img src="..." alt="" style="width: 30px;"><h5>${res.data.carrito[i].nombre}</h5><h4><b>${res.data.carrito[i].precio} Lps</b> (x${res.data.carrito[i].cantidad})</h4></li>
                    `;
                }
                document.getElementById('total-carrito').innerHTML = `${totalC} Lps`
            }      
        }else if(res.data.estado == "fracaso"){
            if(carrito.length == 0){
                alert("No tiene nada en el carrito, compre productos");
                window.location = 'inicioCliente.php';
                return false;
            }else{
                alert("Error");
                return false;
            }
        }
    }).catch(err => {
        alert("Error del servidor " + err);
        return false;
    });
} cargarCarrito();

function comprar(){
    console.log(this.carrito);
    axios({
        url: urlUsuarios + '?cmp=' + nombreUser,
        method: 'PUT',
        responseType: 'json',
        data: {
            carrito: this.carrito,
            tarjeta: {
                nombreTarjeta: document.getElementById('nombre-tarjeta').value, 
                numeroTarjeta: document.getElementById('tarjeta').value, 
                validoHasta: document.getElementById('cvv').value,
                cvv: document.getElementById('hasta').value
            }
        }
    }).then(res => {
        if(res.data.estado == "exito"){
            alert("Compra realizada");
            window.location.href = 'inicioCliente.php';
            return false;
        }else if(res.data.estado == "fracaso" && res.data.mensaje == "error"){
            alert("No se puedo realizar la compra");
            return false;
        }else if(res.data.estado == "fracaso" && res.data.mensaje == "Credenciales inválidas"){
            alert(res.data.mensaje);
            return false;
        }
    }).catch(err => {
        alert("Error " + err);
        return false;
    });
}

function cargarTarjeta(){
    axios({
        url: urlUsuarios + '?trj=' + nombreUser,
        method: 'GET',
        responseType: 'json'
    }).then(res => {
        if(res.data.estado == "exito"){
            document.getElementById('nombre-tarjeta').value = res.data.formaDePago.nombreTarjeta;
            document.getElementById('tarjeta').value = res.data.formaDePago.numeroTarjeta;
            document.getElementById('cvv').value = res.data.formaDePago.cvv;
            document.getElementById('hasta').value = res.data.formaDePago.validoHasta
        }
    }).catch(err => {
        alert("Error del servidor " + err);
        return false;
    });
} cargarTarjeta();

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


