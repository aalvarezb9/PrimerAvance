// import mandar from './contenedorInicioCliente';
//local storage clientes
var localStorage = window.localStorage;
var clientes = [];
// var temporalClientes;
var temporalEmpresas;
var temporalClientes;

function ingresarClienteLocalStorage(arregloClientes){
    if(localStorage.getItem("clientes") == null){
        localStorage.setItem("clientes", JSON.stringify(arregloClientes));
    }
}

function obtenerClienteLocalStorage(){
    var t;
    if(localStorage.getItem("clientes") != null){
        t = JSON.parse(localStorage.getItem("clientes"));
    }
    return t;
}

//fin local storage clientes

//local storage empresas

//fin local storage empresas


//INICIO DE VALIDACIONES DE REGISTRO E INICIO DE SESIÓN COMO CLIENTE
var clientes = [];
//Valida la modal 1 de registro del cliente
function validar1() {
    cliente = {
        user: '',
        email: '',
        pw: '',
        gender: '',
        carrito: [],
        pleasures: [],
        images: [],
        purchases: [],
        formaDePago: {
            numeroTarjeta: '',
            fechaVencimiento: '',
            validoHasta: '',
            cvv: ''
        }
    };

    correo = document.getElementById('email-registro');
    usuario = document.getElementById('usuario-registro');
    password = document.getElementById('contra-registro');
    password2 = document.getElementById('contra-registro-repetir');
    genero = document.querySelector('input[name="gender"]:checked');
    if (correo.value == '' || usuario.value == '' || password.value == '' || password2.value == '') {
        alert("Debe llenar todos los campos");
        return false;
    } else {
        if (password.value != password2.value) {
            alert('Contraseñas distintas');
            return false;
        } else {
            cliente['email'] = correo.value;
            cliente['user'] = usuario.value;
            cliente['pw'] = password.value;
            cliente['gender'] = obtenerGenero();
            abrirModalRegistroCliente2();
            document.getElementById('boton-siguiente-modal-registro-1').setAttribute('data-toggle', 'modal');
            document.getElementById('boton-siguiente-modal-registro-1').setAttribute('data-target', '#exampleModal2');
            document.getElementById('boton-siguiente-modal-registro-1').setAttribute('data-dismiss', 'modal');
            document.getElementById('boton-siguiente-modal-registro-1').setAttribute('data-whatever', '@mdo');
        }
    }

}

function obtenerGenero() {
    var memo = document.getElementsByName('gender');
    for (i = 0; i < memo.length; i++) {
        if (memo[i].checked) {
            var memory = memo[i].value;
        }
    }

    return memory;
}

//Verifica que hayan datos en la modal 2 de registro para cliente
function validar2() {
    var deporte = document.getElementById('deporte');
    var ropa = document.getElementById('ropa');
    var electronica = document.getElementById('electronica');
    var electrodomesticos = document.getElementById('electrodomesticos');

    if (deporte.checked == false && ropa.checked == false && electrodomesticos.checked == false && electronica.checked == false) {
        alert("Seleccione al menos un gusto");
        return false;
    } else {
        $("input[type=checkbox]:checked").each(function () {
            cliente.pleasures.push(this.value);
        });
        document.getElementById('boton-fin-modal-registro-2').setAttribute('data-dismiss', 'modal');
        cliente.images.push(obtenerRutaImagenCliente());
    }

    // var clienteJSON = JSON.stringify(cliente);
    clientes.push(cliente);
    localStorage.setItem("clientes", JSON.stringify(clientes));
    console.log(clientes);

    limpiarInputs();

}

function irAMRC1() {
    abrirModalRegistroCliente1();
    document.getElementById('boton-atras-modal-registro-cliente-2').setAttribute('data-toggle', 'modal');
    document.getElementById('boton-atras-modal-registro-cliente-2').setAttribute('data-target', '#exampleModal');
    document.getElementById('boton-atras-modal-registro-cliente-2').setAttribute('data-dismiss', 'modal');
    document.getElementById('boton-atras-modal-registro-cliente-2').setAttribute('data-whatever', '@mdo');

}

function abrirModalRegistroCliente2() {
    document.getElementById('exampleModal2').setAttribute('aria-hidden', 'false');
}

function abrirModalRegistroCliente1() {
    document.getElementById('exampleModal').setAttribute('aria-hidden', 'false');
}

function ocultarModalRegistroCliente1() {
    document.getElementById('exampleModal').setAttribute('aria-hidden', 'true');
}

function ocultarModalRegistroCliente2() {
    document.getElementById('exampleModal2').setAttribute('aria-hidden', 'true');
}

//Limpia las modales 1 y 2 de registro para cliente
function limpiarInputs() {
    $('#exampleModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $("label.error").remove();
    });

    $('#exampleModal2').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $("label.error").remove();
    });
}

//Limpia la modal de inicio de sesión para el cliente
function limpiarModalInicioSesion() {
    $('#exampleModal3').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $("label.error").remove();
    });
}

function usuarioExiste() {
    var usuarioExiste = false;
    var pwExiste = false;
    //var temporal = clientes.filter(client => client.email == document.getElementById('exampleInputEmail1').value);
    var temporal = obtenerClienteLocalStorage();
     if (temporal.length != 0) {
        usuarioExiste = true;
        if (temporal[0].pw == document.getElementById('exampleInputPassword1').value) {
            pwExiste = true;
        }
    } 

    if (usuarioExiste == true) {
        console.log('Usuario existe');
        if (pwExiste == true) {
            console.log('Contraseña correcta');
            temporalClientes = obtenerClienteLocalStorage().filter(ct => ct.email == document.getElementById('exampleInputEmail1').value);
            console.log(temporalClientes[0].user);
            redirigirInicioSesionCliente(temporalClientes[0].user);
        } else {
            console.log('Contraseña incorrecta');
        }
    } else {
        console.log('Usuario no existe');
    }
    return usuarioPasswordCoinciden(usuarioExiste, pwExiste);

}

function redirigirInicioSesionCliente(temporal2){
    document.getElementById('start-session-client').setAttribute("href", "inicioCliente.html");
    temporal2 = obtenerClienteLocalStorage().filter(c => c.email == document.getElementById('exampleInputEmail1').value);
}

function usuarioPasswordCoinciden(user, password) {
    var ok = false;
    if ((user && password) == true) {
        ok = true;
    }
    return ok;
}


function inicioCliente(json){
    let temporal = json;
    document.getElementById('nombre-inicio-cliente').innerHTML = temporal;
}

function obtenerRutaImagenCliente(){
    var rutaImagenCliente = '';
    $('input[type=file]:first').change(function () {
        rutaImagenCliente = $('#btn_cliente_img').val(); 
    });

    return rutaImagenCliente;
}

//FIN DE VALIDACIONES DE REGISTRO E INICIO DE SESIÓN COMO CLIENTE



//INICIO DE VALIDACIONES DE REGISTRO E INICIO DE SESIÓN COMO EMPRESA

var empresas = [];
//INICIO de validación de la modal 1 de registro de empresa
function validar1Empresa() {
    empresa = {
        name: '',
        emailEmpresa: '',
        pwEmpresa: '',
        country: '',
        address: '',
        banner: '',
        offer: [],
        imagesEmpresa: [],
        officesAddress: [],
        products: [],
        social: {
            facebook: '',
            snapchat: '',
            instagram: '',
            youtube: ''
        }
    };

    product = {
        nombre: '',
        precio: '',
        categoria: '',
        cantidad: '',
        imagen: '',
        codigoQR: ''
    };

    correoEmpresa = document.getElementById('email-registro-empresa');
    nombreEmpresa = document.getElementById('empresa-registro');
    passwordEmpresa = document.getElementById('contra-registro-empresa');
    password2Empresa = document.getElementById('contra-registro-repetir-empresa');

    if (correoEmpresa.value == '' || nombreEmpresa.value == '' || passwordEmpresa.value == '' || password2Empresa.value == '') {
        alert("Debe llenar todos los campos");
        return false;
    } else {
        if (passwordEmpresa.value != password2Empresa.value) {
            alert('Contraseñas distintas');
            return false;
        } else {
            empresa['name'] = nombreEmpresa.value;
            empresa['emailEmpresa'] = correoEmpresa.value;
            empresa['pwEmpresa'] = passwordEmpresa.value;
            abrirModalRegistroEmpresa2();
            document.getElementById('boton-registro-empresa-1').setAttribute('data-toggle', 'modal');
            document.getElementById('boton-registro-empresa-1').setAttribute('data-target', '#exampleModalEmpresa2');
            document.getElementById('boton-registro-empresa-1').setAttribute('data-dismiss', 'modal');
            document.getElementById('boton-registro-empresa-1').setAttribute('data-whatever', '@mdo');
        }
    }

}
//FIN de modal 1 de registro de empresa

//INICIO de modal 2 de registro de empresa
function validar2Empresa() {
    var deportee = document.getElementById('deportee');
    var ropaa = document.getElementById('ropaa');
    var electronicaa = document.getElementById('electronicaa');
    var electrodomesticoss = document.getElementById('electrodomesticoss');
    var otross = document.getElementById('otross');

    if (deportee.checked == false && ropaa.checked == false && electrodomesticoss.checked == false && electronicaa.checked == false && otross.checked == false) {
        alert("Ofrezca al menos una categoría");
        return false;
    } else {
        $("input[type=checkbox]:checked").each(function () {
            empresa.offer.push(this.value);
        });
        empresa.imagesEmpresa.push(obtenerRutaImagenEmpresa());
        abrirModalRegistroEmpresa3();
        document.getElementById('boton-registro-empresa-2').setAttribute('data-toggle', 'modal');
        document.getElementById('boton-registro-empresa-2').setAttribute('data-target', '#exampleModalEmpresa3');
        document.getElementById('boton-registro-empresa-2').setAttribute('data-dismiss', 'modal');
        document.getElementById('boton-registro-empresa-2').setAttribute('data-whatever', '@mdo');
    }

}
//FIN de modal 2 de registro de empresa

//INICIO de modal 3 de registro de empresa
function validar3Empresa() {
    // var re = `([\d*6]-[\d*6])`;
    // direccion = document.getElementById('direccion-registro');

    // select.addEventListener('change',
    //     function () {
    //         var select = document.getElementById("pais"),
    //         //value = select.value,
    //         text = select.options[select.selectedIndex].innerText;
    //         // var selectedOption = this.options[select.selectedIndex];
    //         // empresa.country = selectedOption.text;
    //         // console.log(selectedOption.text);
    //     });

    if (document.getElementById('direccion-registro-empresa').value == '') {
        alert('Ingrese longitud y latitud');
        return false;
    } else {
        empresa.banner = obtenerRutaBanner();
        empresa.country = paisSeleccionado();
        empresa.address = document.getElementById('direccion-registro-empresa').value;
        abrirModalRegistroEmpresa4();
        document.getElementById('boton-registro-empresa-3').setAttribute('data-toggle', 'modal');
        document.getElementById('boton-registro-empresa-3').setAttribute('data-target', '#exampleModalEmpresa4');
        document.getElementById('boton-registro-empresa-3').setAttribute('data-dismiss', 'modal');
        document.getElementById('boton-registro-empresa-3').setAttribute('data-whatever', '@mdo');
    }
}
//FIN de modal 3 de registro de empresa

function paisSeleccionado() {
    var select = document.getElementById("pais"); 
    // var value = select.value;
    var text = select.options[select.selectedIndex].innerText;


    return text;
}

//INICIO de modal 4 de registro de empresa
function validar4Empresa() {
    facebookk = document.getElementById('fb');
    instagramm = document.getElementById('ig');
    snapchatt = document.getElementById('sc');
    youtubee = document.getElementById('yt');

    if (facebookk.value == '' && instagramm.value == '' && snapchatt.value == '' && youtubee.value == '') {
        alert("Ingresar al menos una red social");
        return false;
    } else {
        empresa.social.facebook = facebookk.value;
        empresa.social.snapchat = snapchatt.value;
        empresa.social.youtube = youtubee.value;
        empresa.social.instagram = instagramm.value;
        empresas.push(empresa);
        document.getElementById('boton-fin-empresa').setAttribute('data-dismiss', 'modal');
    }
    var empresaJSON = JSON.stringify(empresa);
    console.log(empresas);

    limpiarInputsEmpresa();
}
//FIN de modal 4 de registro de empresa

//INICIO de iniciar sesión empresa
function empresaExiste() {
    var empresaExiste = false;
    var pwEmpresaExiste = false;
    var temporalEmpresa = empresas.filter(empre => empre.emailEmpresa == document.getElementById('exampleInputEmail1Empresa').value);

    if (temporalEmpresa.length != 0) {
        empresaExiste = true;
        if (temporalEmpresa[0].pwEmpresa == document.getElementById('exampleInputPassword1Empresa').value) {
            pwEmpresaExiste = true;
        }
    }

    if (empresaExiste == true) {
        console.log('Usuario existe');
        if (pwEmpresaExiste == true) {
            console.log('Contraseña correcta');
        } else {
            console.log('Contraseña incorrecta');
        }
    } else {
        console.log('Usuario no existe');
    }

    return empresaPasswordCoinciden(empresaExiste, pwEmpresaExiste);

}

function empresaPasswordCoinciden(userEmpresa, passwordEmpresa) {
    var ok = false;
    if ((userEmpresa && passwordEmpresa) == true) {
        ok = true;
    }
    return ok;
}
//FIN de iniciar sesión empresa

function limpiarInputsEmpresa() {
    $('#exampleModalEmpresa1').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $("label.error").remove();
    });

    $('#exampleModalEmpresa2').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $("label.error").remove();
    });
    $('#exampleModalEmpresa3').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $("label.error").remove();
    });

    $('#exampleModalEmpresa4').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $("label.error").remove();
    });
}

function limpiarModalInicioSesionEmpresa() {
    $('#exampleModal10').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
        $("label.error").remove();
    });
}

function abrirModalRegistroEmpresa2() {
    document.getElementById('exampleModalEmpresa2').setAttribute('aria-hidden', 'false');
}

function abrirModalRegistroEmpresa3() {
    document.getElementById('exampleModalEmpresa3').setAttribute('aria-hidden', 'false');
}

function abrirModalRegistroEmpresa4() {
    document.getElementById('exampleModalEmpresa4').setAttribute('aria-hidden', 'false');
}

function obtenerRutaImagenEmpresa(){
    var rutaImagenEmpresa = '';
    $('input[type=file]').change(function () {
        rutaImagenEmpresa = $('#btn_enviar_imagen').val(); 
    });

    return rutaImagenEmpresa;
}

function obtenerRutaBanner(){
    var rutaBanner = '';
    $('input[type=file]:last').change(function () {
        rutaBanner = $('.banner-empresa-img').val(); 
    });

    return rutaBanner;
}

//FIN DE VALIDACIONES DE REGISTRO E INICIO DE SESIÓN COMO EMPRESA