/*Antes de ejecutar toda acción que implique modificar el json original, se implementará una función
 (cuando esté listo el servidor PHP) que primero verifique si el json cargado desde el servidor tiene datos, 
 para no alterar en él los datos que aquí no sean modificados
*/ 

function actualizar() {
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
            numeroTarjeta: '',
            fechaVencimiento: '',
            validoHasta: '',
            cvv: ''
        }
    };

    correo = document.getElementById('nuevo-email-registro-cliente');
    usuario = document.getElementById('nuevo-nombre-registro-cliente');
    password = document.getElementById('nueva-password-registro-cliente');
    password2 = document.getElementById('nueva-password-repetir-registro-cliente');
    if (correo.value == '' && usuario.value == '' && password.value == '' && password2.value == '' && obtenerRutaImagen() == '') {
        alert("No se actualizó nada");
        irInicio();
    } else {
        if (password.value != password2.value) {
            alert('Contraseñas distintas');
            return false;
        } else {
            cliente.email = correo.value;
            cliente.user = usuario.value;
            cliente.pw = password.value;
            cliente.images.push(obtenerRutaImagen());
            alert("Perfil actualizado con éxito");
            irInicio();
        }
    }

}

function obtenerRutaImagen(){
    var rutaImagen = '';
    $('input[type=file]').change(function () {
        rutaImagen = $('#btn_anviar').val(); 
    });

    return rutaImagen;
}

function irInicio(){
    document.getElementById('ir-inicio').setAttribute("href", "inicioCliente.html");
}