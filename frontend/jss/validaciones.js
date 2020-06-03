//PHP INICIA EN LA LÍNEA 468
// import mandar from './contenedorInicioCliente';
//local storage clientes
//paisSeleccionado()
var img;
var imgB;
var imgC;
const urlClientes = '../backend/api/usuarios.php';
const urlEmpresas = '../backend/api/empresas.php';
var localStorage = window.localStorage;
var clientes = [];
// var temporalClientes;
var temporalEmpresas;
var temporalClientes;
var codigoEmpresa;

function ingresarClienteLocalStorage(arregloClientes) {
    if (localStorage.getItem("clientes") == null) {
        localStorage.setItem("clientes", JSON.stringify(arregloClientes));
    }
}

function obtenerClienteLocalStorage() {
    var t;
    if (localStorage.getItem("clientes") != null) {
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



function redirigirInicioSesionCliente(temporal2) {
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


function inicioCliente(json) {
    let temporal = json;
    document.getElementById('nombre-inicio-cliente').innerHTML = temporal;
}

function obtenerRutaImagenCliente() {
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

function obtenerRutaImagenEmpresa() {
    var rutaImagenEmpresa = '';
    $('input[type=file]').change(function () {
        rutaImagenEmpresa = $('#btn_enviar_imagen').val();
    });

    return rutaImagenEmpresa;
}

function obtenerRutaBanner() {
    var rutaBanner = '';
    $('input[type=file]:last').change(function () {
        rutaBanner = $('.banner-empresa-img').val();
    });

    return rutaBanner;
}

//FIN DE VALIDACIONES DE REGISTRO E INICIO DE SESIÓN COMO EMPRESA


//CON PHP ------------------------------------------------------------------------------------------------->

//Inicio de Modal 1 para registar cliente
var contadorIDs = 0;
function registrarCliente1() {
    contadorIDs++;
    cliente = {
        user: '',
        email: '',
        pw: '',
        gender: '',
        carrito: [],
        pleasures: [],
        images: [],
        purchases: [],
        formaDePago: ['no ingresada', 'no ingresada', 'no ingresada', 'no ingresada']
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

//Fin de Modal 1 para registrar cliente

//Inicio de Modal 2 para registrar cliente
function registrarCliente2() {
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
        document.querySelector('input[name="gender"]:checked');
        // enviarClienteAlServidor(cliente);
        // abrirModalComprobacion();
        subirImagenCliente();
        $('#exampleModalComprobacion').modal('show');
        document.getElementById('comprueba').innerHTML += 
        `
        <td style="border: .6px solid grey; border-collapse: collapse;">${cliente.user}</td>
        <td style="border: .6px solid grey; border-collapse: collapse;">${cliente.email}</td>
        `;
    }
    
}
//Fin de Modal 2 para registrar cliente

//Función que comprueba datos
function comprobacion(){
    cliente.images.push(imgC);
    document.getElementById('comprueba').innerHTML = null;
    $('#exampleModalComprobacion').modal('hide');
    enviarClienteAlServidor(cliente);
}



//Función que envía el cliente al servidor
function enviarClienteAlServidor(cliente) {
    // document.getElementById('boton-fin-modal-registro-2').disabled = true;
    axios({
        method: 'POST',
        url: urlClientes,
        responseType: 'json',
        data: cliente
    }).then(res => {
        // console.log(JSON.parse(res.config));
        // console.log(res.config);
        console.log(res);
        console.log(res.data);
        if (res.data.estado == true) {
            //Usuario registrado con éxito
            // document.getElementById('exampleModalUsuarioExito').setAttribute('aria-hidden', 'false');
            limpiarInputs();
            $('#exampleModalUsuarioExito').modal('show');
            document.getElementById('titulo-user-exito').innerHTML = '¡Usuario registrado! --';
            document.getElementById('usuario-exito').innerHTML = 'Bienvenido, ' + res.data.user;
            document.getElementById('card-exito').setAttribute('src', 'img/check.jpg');
        } else {
            //Correo o usuario ya existentes
            // document.getElementById('exampleModalUsuarioExito').setAttribute('aria-hidden', 'false');
            $('#exampleModalUsuarioExito').modal('show');
            document.getElementById('titulo-user-exito').innerHTML = '¡Correo o usuario en uso! ';
            document.getElementById('usuario-exito').innerHTML = 'Intenta nuevamente';
            document.getElementById('card-exito').setAttribute('src', 'img/intenta.jpg');
        }
        // console.log('Usuario registrado con éxito: ' + res.data);
        // document.getElementById('boton-fin-modal-registro-2').disabled = false;
    }).catch(error => {
        // document.getElementById('boton-fin-modal-registro-2').disabled = false;
        console.error(error);
    });
}
//superUsuarioExiste()
//Inicio de Modal 1 para registrar empresa
function registroEmpresa1() {
    empresa = {
        name: '',
        emailEmpresa: '',
        pwEmpresa: '',
        country: '',
        address: '',
        banner: [],
        offer: [],
        imagesEmpresa: [],
        officesAddress: [],
        social: []
    };

    // product = {
    //     nombre: '',
    //     precio: '',
    //     categoria: '',
    //     cantidad: '',
    //     imagen: '',
    //     codigoQR: ''
    // };

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
            // empresa['idE'] = codigoEmpresa;
            abrirModalRegistroEmpresa2();
            document.getElementById('boton-registro-empresa-1').setAttribute('data-toggle', 'modal');
            document.getElementById('boton-registro-empresa-1').setAttribute('data-target', '#exampleModalEmpresa2');
            document.getElementById('boton-registro-empresa-1').setAttribute('data-dismiss', 'modal');
            document.getElementById('boton-registro-empresa-1').setAttribute('data-whatever', '@mdo');
        }
    }

}
//Fin de Modal 1 para registrar empresa

//Inicio de Modal 2 para registrar empresa
function registroEmpresa2() {
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
        abrirModalRegistroEmpresa3();
        document.getElementById('boton-registro-empresa-2').setAttribute('data-toggle', 'modal');
        document.getElementById('boton-registro-empresa-2').setAttribute('data-target', '#exampleModalEmpresa3');
        document.getElementById('boton-registro-empresa-2').setAttribute('data-dismiss', 'modal');
        document.getElementById('boton-registro-empresa-2').setAttribute('data-whatever', '@mdo');
    }

}
//Fin de Modal 2 para registrar empresa

//Inicio de Modal 3 para registrar empresa
function registroEmpresa3() {
    if (document.getElementById('direccion-registro-empresa').value == '') {
        alert('Ingrese longitud y latitud');
        return false;
    } else {
        empresa.country = paisSeleccionado();
        empresa.address = document.getElementById('direccion-registro-empresa').value;
        abrirModalRegistroEmpresa4();
        document.getElementById('boton-registro-empresa-3').setAttribute('data-toggle', 'modal');
        document.getElementById('boton-registro-empresa-3').setAttribute('data-target', '#exampleModalEmpresa4');
        document.getElementById('boton-registro-empresa-3').setAttribute('data-dismiss', 'modal');
        document.getElementById('boton-registro-empresa-3').setAttribute('data-whatever', '@mdo');
    }
}
//Fin de Modal 3 para registrar empresa

//Inicio de Modal 4 para registrar empresa
function registroEmpresa4() {
    facebookk = document.getElementById('fb');
    instagramm = document.getElementById('ig');
    snapchatt = document.getElementById('sc');
    youtubee = document.getElementById('yt');

    if (facebookk.value == '' && instagramm.value == '' && snapchatt.value == '' && youtubee.value == '') {
        alert("Ingresar al menos una red social");
        return false;
    } else {
        empresa.social[0] = facebookk.value;
        empresa.social[1] = snapchatt.value;
        empresa.social[2] = instagramm.value;
        empresa.social[3] = youtubee.value;
        empresa.imagesEmpresa.push(img);
        empresa.banner.push(imgB);
        empresas.push(empresa);
        enviarEmpresaAlServidor(empresa);
        document.getElementById('boton-fin-empresa').setAttribute('data-dismiss', 'modal');
    }
    // var empresaJSON = JSON.stringify(empresa);
    // console.log(empresas);

    // limpiarInputsEmpresa();
}
//Fin de Modal 4 para registrar empresa

//Función que envía la empresa al servidor
function enviarEmpresaAlServidor(empresa) {
    // document.getElementById('boton-fin-empresa').disabled = true;
    axios({
        method: 'POST',
        url: urlEmpresas,
        responseType: 'json',
        data: empresa
    }).then(res => {
        console.log(res);
        console.log(res.data);
        if (res.data.estado == true) {
            limpiarInputsEmpresa();
            //Usuario registrado con éxito
            // document.getElementById('exampleModalUsuarioExito').setAttribute('aria-hidden', 'false');
            $('#exampleModalUsuarioExito').modal('show');
            document.getElementById('titulo-user-exito').innerHTML = '¡Empresa registrada! --'
            document.getElementById('usuario-exito').innerHTML = 'Bienvenida, ' + res.data.name;
            document.getElementById('card-exito').setAttribute('src', 'img/check.jpg');
        } else {
            //Correo o usuario ya existentes
            // document.getElementById('exampleModalUsuarioExito').setAttribute('aria-hidden', 'false');
            $('#exampleModalUsuarioExito').modal('show');
            document.getElementById('titulo-user-exito').innerHTML = '¡Correo o nombre en uso! ';
            document.getElementById('usuario-exito').innerHTML = 'Intenta nuevamente';
            document.getElementById('card-exito').setAttribute('src', 'img/intenta.jpg');
        }
    }).catch(error => {
        // document.getElementById('boton-fin-empresa').disabled = false;
        console.error(error);
    });
}

//Función para obtener cliente
function obtenerUnCliente(id) {
    axios({
        method: 'GET',
        url: urlClientes + '?id=' + id,
        responseType: 'json'
    }).then(res => {
        console.log(res.data);
    }).catch(error => {
        console.log(error);
    });
}

//Función para obtener una empresa
function obtenerUnaEmpresa(idE) {
    axios({
        method: 'GET',
        url: urlEmpresas + '?idE=' + idE,
        responseType: 'json'
    }).then(res => {
        console.log(res.data);
    }).catch(error => {
        console.log(error);
    });
}

//Verificación del súper-usuario
function superUsuarioExiste() {
    let user = document.getElementById('exampleInputSuperUsuario').value;
    let ps = document.getElementById('exampleInputPasswordSuperUsuario').value;
    axios({
        method: 'POST',
        url: '../backend/api/super.php',
        responseType: 'json',
        data: {
            usuario: user,
            pass: ps
        }
    }).then(res => {
        console.log(user);
        console.log(ps);
        console.log(res);
        if(res.data.estado == "exito"){
            window.location.href = 'su.php';
        }else{
            alert("Credenciales inválidas");
            return false;
        }
    }).catch(error => {
        console.error(error);
    });

    return superUsuarioExiste;
}

//Función que obtiene el id de Empresa
function obtenerCodigoDeEmpresa() {
    axios({
        method: 'GET',
        url: 'http://localhost/BUSE/backend/api/ids.php?idE=get',
        responseType: 'json'
    }).then(res => {
        codigoEmpresa = res.data.longitud;
        console.log(res.data);
        return res.data.longitud;
        // codigoEmpresa = res.data.longitud;
    }).catch(error => {
        console.log(error);
        return null;
        // codigoEmpresa = null;
    });

}

// obtenerCodigoDeEmpresa();

//Función 2 que obtiene el id de Empresa
function obtenerCodigoDeEmpresa2() {
    var longitudE;
    axios({
        method: 'GET',
        url: urlEmpresas,
        responseType: 'json'
    }).then(res => {
        console.log(res.data);
        longitudE = res.data.length;
        console.log(longitudE);
    }).catch(error => {
        console.log(error);
    });

    return longitudE;
}

//Función que obtiene el id de usuario
function obtenerCodigoDeUsuario() {
    axios({
        method: 'GET',
        url: 'http://localhost/BUSE/backend/api/ids.php?id=get',
        responseType: 'json'
    }).then(res => {
        console.log(res.data);
        return res.data.longitud;
        // codigoEmpresa = res.data.longitud;
    }).catch(error => {
        console.log(error);
        return null;
        // codigoEmpresa = null;
    });

}

//limpiarInputs()
//Función que inicia sesión como cliente
function iniciarSesionCliente() {
    axios({
        method: 'POST',
        url: 'http://localhost/BUSE/backend/api/logins.php',
        responseType: 'json',
        data: {
            email: document.getElementById('exampleInputEmail1').value,
            pw: document.getElementById('exampleInputPassword1').value
        }
    }).then(res => {
        console.log(res.data);
        if (res.data.codigo == true)
            window.location.href = 'inicioCliente.php';
        else {
            $('#exampleModalUsuarioExito').modal('show');
            document.getElementById('titulo-user-exito').innerHTML = '¡ERROR!'
            document.getElementById('usuario-exito').innerHTML = 'Credenciales inválidas';
            document.getElementById('cart-exito').setAttribute('src', 'img/intenta.jpg');
        }
    }).catch(error => {
        console.error(error);
    });
}

//Función que inicia sesión como empresa
function iniciarSesionEmpresa() {
    axios({
        method: 'POST',
        url: 'http://localhost/BUSE/backend/api/loginsE.php',
        responseType: 'json',
        data: {
            emailEmpresa: document.getElementById('exampleInputEmail1Empresa').value,
            pwEmpresa: document.getElementById('exampleInputPassword1Empresa').value
        }
    }).then(res => {
        console.log(res);
            if(res.data == null || res.data.codigo == null || res.data.codigo == false) {
                $('#exampleModalUsuarioExito').modal('show');
                document.getElementById('titulo-user-exito').innerHTML = '¡ERROR!'
                document.getElementById('usuario-exito').innerHTML = 'Credenciales inválidas';
                document.getElementById('card-exito').setAttribute('src', 'img/intenta.jpg');
            }
            else {
                window.location.href = 'visualizarPerfilEmpresa.php';
            }
        }).catch(error => {
        console.error(error);
    });
}

//Función que sube las imágenes de una empresa
function subirImagenesEmpresa() {
    var form = $('#form-img-imagen-empresa');
    let dataF = new FormData(form[0]);
    axios.post('subirImagen.php', dataF)
        .then(res => {
            console.log(res);
            img = res.data;
        }).catch(err => {
            console.log(err);
        });
}

//Función que sube el banner de una empresa
function subirBannersEmpresa() {
    var form1 = $('#form-banner');
    let dataF = new FormData(form1[0]);
    axios.post('subirImagen.php', dataF)
        .then(res => {
            console.log(res);
            imgB = res.data;
        }).catch(err => {
            console.log(err);
        });
}

//Función que sube la imagen del cliente
function subirImagenCliente() {
    var form2 = $('#form-img-cliente');
    let dataF = new FormData(form2[0]);
    axios.post('subirImagen.php', dataF)
        .then(res => {
            // console.log(res);
            imgC = res.data;
        }).catch(err => {
            // console.log(err);
            imgC = err;
        });
    return imgC;
}

function cargarCatalogo(){
    document.getElementById('productos-empresa-ver').innerHTML = '';
    axios({
        url: urlEmpresas,
        method: 'GET',
        responseType: 'json'
    }).then(res => {
        for(let i = 0; i < res.data.length; i++){
            document.getElementById('productos-empresa-ver').innerHTML += `
            <div style="margin: 8px" class="card" style="width: 18rem;">
                <img src="${res.data[i].imagen}" class="card-img-top" alt="..." style="width: 140px;">
                <div class="card-body">
                  <h5 class="card-title">${res.data[i].nombre}</h5>
                  <p class="card-text">${res.data[i].descripcion}</p>
                </div>
            </div>
            `;
        }
    }).catch(err => {
        console.log("nada");
    });
} cargarCatalogo();

function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds) {
            break;
        }
    }
}

function recargar(){
    window.location.reload();
}