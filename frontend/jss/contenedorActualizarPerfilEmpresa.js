/*Antes de ejecutar toda acción que implique modificar en el json original, se implementará una función
 (cuando esté listo el servidor PHP) que primero verifique si el json cargado desde el servidor tiene datos, 
 para no alterar en él los datos que aquí no sean modificados   
*/ 

function actualizar() {
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
        social: {
            facebook: '',
            snapchat: '',
            instagram: '',
            youtube: ''
        }
    };

    correo = document.getElementById('nuevo-email-registro-empresa');
    nombre = document.getElementById('nuevo-nombre-registro-empresa');
    password = document.getElementById('nueva-password-registro-empresa');
    password2 = document.getElementById('nueva-password-repetir-registro-empresa');
    direccion = document.getElementById('direccion-registro');
    fb = document.getElementById('fb');
    ig = document.getElementById('ig');
    yt = document.getElementById('yt');
    sc = document.getElementById('sc');

    if (correo.value == '' && nombre.value == '' && password.value == '' && password2.value == '' && obtenerRutaImagen() == '' && obtenerRutaBanner() == '') {
        alert("No se actualizó nada");
        irInicio();
    } else {
        if (password.value != password2.value) {
            alert('Contraseñas distintas');
            return false;
        } else {
            empresa.emailEmpresa = correo.value;
            empresa.name = nombre.value;
            empresa.pw = password.value;
            empresa.address = direccion.value;
            empresa.social.facebook = fb.value;
            empresa.social.instagram = ig.value;
            empresa.social.snapchat = sc.value;
            empresa.social.youtube = yt.value;
            empresa.country = paisSeleccionado();
            empresa.imagesEmpresa.push(obtenerRutaImagen());
            empresa.banner = obtenerRutaBanner();
            alert("Perfil actualizado con éxito");
            irInicio();
        }
    }

}

function obtenerRutaImagen(){
    var rutaImagen = '';
    $('input[type=file]:first').change(function () {
        rutaImagen = $('#btn_anviar').val(); 
    });

    return rutaImagen;
}

function obtenerRutaBanner(){
    var rutaBanner = '';
    $('input[type=file]:last').change(function () {
        rutaBanner = $('#btn_anviar').val(); 
    });

    return rutaBanner;
}

function irInicio(){
    document.getElementById('ir-inicio').setAttribute("href", "inicioEmpresa.html");
}

function paisSeleccionado() {
    var select = document.getElementById("pais"); 
    // var value = select.value;
    var text = select.options[select.selectedIndex].innerText;


    return text;
}

