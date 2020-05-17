
cliente = {
    user: '',
    email: '',
    pw: '',
    gender: '',
    pleasures: [],
    carrito: [],
    images: [],
    purchases: [],
    formaDePago: {
        nombreTarjeta: '',
        numeroTarjeta: '',
        validoHasta: '',
        cvv: ''
    }
};




// if (purchases.length == 0) {
//     alert("No tienes nada en tu carrito, te invitamos a elegir uno de nuestros productos e intentarlo nuevamente");
//     return false;
// } else {
//     for (let i = 0; i < purchases.length - 1; i++) {
//         total += purchases[i].precio;
//     }
//     alert(`Compra hecha por un total de ${total} lempiras`);
//     limpiar();
// }

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


