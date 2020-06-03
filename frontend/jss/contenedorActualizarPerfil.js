/*Antes de ejecutar toda acción que implique modificar el json original, se implementará una función
 (cuando esté listo el servidor PHP) que primero verifique si el json cargado desde el servidor tiene datos, 
 para no alterar en él los datos que aquí no sean modificados
*/ 

const user = leerCookie("user");
const urlUsuarios = '../backend/api/usuarios.php';

function obtenerCliente(){
    axios({
        url: urlUsuarios + '?id=' + user,
        method: 'GET',
        responseType: 'json'
    }).then(res => {
        console.log(res);
        document.getElementById('nuevo-email-registro-cliente').value = res.data.usuario.email;
        document.getElementById('nuevo-nombre-registro-cliente').value = res.data.usuario.user;
        for(let i = 0; i < res.data.usuario.pleasures.length; i++){
            document.getElementById(res.data.usuario.pleasures[i]).setAttribute("checked", "true");
        }
    }).catch(err => {
        alert("Error " + err);
        return false;
    })
} obtenerCliente();

function actualizar() {
    let correo = document.getElementById('nuevo-email-registro-cliente');
    let usuario = document.getElementById('nuevo-nombre-registro-cliente');
    let password = document.getElementById('nueva-password-registro-cliente');
    let password2 = document.getElementById('nueva-password-repetir-registro-cliente');
    if (correo.value == '' && usuario.value == '' && password.value == '' && password2.value == '' && obtenerRutaImagen() == '') {
        alert("No se actualizó nada");
        irInicio();
    } else {
        if (password.value != password2.value) {
            alert('Contraseñas distintas');
            return false;
        } else {
            axios({
                url: urlUsuarios + '?act=' + user,
                method: 'PUT',
                responseType: 'json',
                data: {
                    cliente: {
                        user: usuario.value,
                        email: correo.value,
                        pw: password.value,
                        pleasures: this.oferta()
                    }
                }
            }).then(res => {
                alert("Perfil actualizado con éxito, inicie sesión nuevamente con las nuevas credenciales");
                window.location.href = 'logout.php';
                return false;
            }).catch(err => {
                alert("Error " + err);
                return false;
            });
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

function actualizar2(){

}

function irInicio(){
    window.location.href = 'inicioCliente.php';
}

function oferta(){
    let a = [];
    $("input[type=checkbox]:checked").each(function () {
        a.push(this.value);
    });

    return a;
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

