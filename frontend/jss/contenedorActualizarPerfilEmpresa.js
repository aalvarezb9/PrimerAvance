/*Antes de ejecutar toda acción que implique modificar en el json original, se implementará una función
 (cuando esté listo el servidor PHP) que primero verifique si el json cargado desde el servidor tiene datos, 
 para no alterar en él los datos que aquí no sean modificados   
*/
const nombreEmpresa = leerCookie("name");
// const offerr = ["ropaa", "electronicaa", "electrodomesticoss", "deportee", "otross"];
// var offer1, offer2, offer3, offer4, offer5;
// var offerN = [];
const urlEmpresas = '../backend/api/empresas.php';
var imagenN;
//document.getElementById('nuevo-email-registro-empresa').value = obtenerEmailEmpresa(leerCookie("name"));//leerCookie("emailEmpresa");
document.getElementById('nuevo-nombre-registro-empresa').value = nombreEmpresa.replace("+", " ");


function generarTodo(){
    obtenerOfferEmpresa(nombreEmpresa);
    obtenerEmailEmpresa(nombreEmpresa);
    obtenerDireccionEmpresa(nombreEmpresa);
    obtenerRedesSociales(nombreEmpresa);
} generarTodo();1



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

function obtenerOfferEmpresa(empresa){
    axios({
        method: 'GET',
        url: urlEmpresas + '?offr=' + empresa,
        responseType: 'json' 
    }).then(res => {
        if(res.data.estado == "exito"){
            console.log(res.data.offer);
            for(let i = 0; i < res.data.offer.length; i++){
                document.getElementById(res.data.offer[i]).setAttribute("checked", "true");
            }
        }else{
            alert("Error");
        }
    }).catch(err => {
        alert("Error: " + err);
    });
}

function obtenerEmailEmpresa(empresa){
    axios({
        method: 'GET',
        url: urlEmpresas + '?eml=' + empresa,
        responseType: 'json' 
    }).then(res => {
        if(res.data.estado == "exito"){
            console.log(res.data.email);
            document.getElementById('nuevo-email-registro-empresa').value = res.data.email;
        }else{
            alert("Error");
        }
    }).catch(err => {
        alert("Error: " + err);
    });
}

function obtenerDireccionEmpresa(empresa){
    axios({
        method: 'GET',
        url: urlEmpresas + '?dir=' + empresa,
        responseType: 'json' 
    }).then(res => {
        if(res.data.estado == "exito"){
            console.log(res.data.direccion);
            document.getElementById('direccion-registro').value = res.data.direccion;
        }else{
            alert("Error");
        }
    }).catch(err => {
        alert("Error: " + err);
    });
}

function obtenerRedesSociales(empresa){
    axios({
        method: 'GET',
        url: urlEmpresas + '?soc=' + empresa,
        responseType: 'json' 
    }).then(res => {
        if(res.data.estado == "exito"){
            console.log(res.data.social);
            document.getElementById('fb').value = res.data.social.facebook;
            document.getElementById('ig').value = res.data.social.instagram;
            document.getElementById('yt').value = res.data.social.youtube;
            document.getElementById('sc').value = res.data.social.snapchat;
        }else{
            alert("Error");
        }
    }).catch(err => {
        alert("Error: " + err);
    });
}

function test(){
    empresaa = {
        nombre: 'hola',
        offer: this.c()
    }

    console.log(empresaa);
}

function oferta(){
    let a = [];
    $("input[type=checkbox]:checked").each(function () {
        a.push(this.value);
    });

    return a;
}

function actualizar() {
    var img;
    var bnnr;
    correo = document.getElementById('nuevo-email-registro-empresa');
    nombre = document.getElementById('nuevo-nombre-registro-empresa');
    password = document.getElementById('nueva-password-registro-empresa');
    password2 = document.getElementById('nueva-password-repetir-registro-empresa');
    direccion = document.getElementById('direccion-registro');
    fb = document.getElementById('fb');
    ig = document.getElementById('ig');
    yt = document.getElementById('yt');
    sc = document.getElementById('sc');

    if (correo.value == '' && nombre.value == '' && password.value == '' && password2.value == '') {
        alert("Llene todos los campos");
        return false;
    } else {
        if (password.value != password2.value) {
            alert('Contraseñas distintas');
            return false;
        } else {
            var form = $('#agregar-imagen-a-empresa');
            let dataF = new FormData(form[0]);
            var form1 = $('#agregar-banner-a-empresa');
            let dataFF = new FormData(form1[0]);
            axios.post('subirImagen.php', dataF)
                .then(res => {
                    let nada = {
                        i: res.data
                    }
                    imagenN = nada.i;
                    axios.post('subirImagen.php', dataFF)
                        .then(res1 => {
                            var empresaa = {
                                name: document.getElementById('nuevo-email-registro-empresa').value,
                                emailEmpresa: document.getElementById('nuevo-nombre-registro-empresa').value,
                                pwEmpresa: document.getElementById('nueva-password-registro-empresa'),
                                country: paisSeleccionado(),
                                address: document.getElementById('direccion-registro').value,
                                banner: res1.data,
                                offer: this.oferta(),
                                imagesEmpresa: imagenN,
                                social: {
                                    facebook: document.getElementById('fb').value,
                                    instagram: document.getElementById('ig').value,
                                    youtube: document.getElementById('yt').value,
                                    snapchat: document.getElementById('sc').value
                                }
                            }
                            bnnr = res1.data;
                            axios({
                                url: urlEmpresas + '?actE=' + leerCookie("name"),
                                method: 'PUT',
                                responseType: 'json',
                                data: {
                                    empresa: {
                                        name: document.getElementById('nuevo-nombre-registro-empresa').value,
                                        emailEmpresa: document.getElementById('nuevo-email-registro-empresa').value,
                                        pwEmpresa: document.getElementById('nueva-password-registro-empresa').value,
                                        country: paisSeleccionado(),
                                        address: document.getElementById('direccion-registro').value,
                                        banner: bnnr,
                                        offer: this.oferta(),
                                        imagesEmpresa: imagenN,
                                        social: {
                                            facebook: document.getElementById('fb').value,
                                            instagram: document.getElementById('ig').value,
                                            youtube: document.getElementById('yt').value,
                                            snapchat: document.getElementById('sc').value
                                        }
                                    }
                                }
                                
                            })
                                .then(res2 => {
                                    console.log(res2.data);
                                    if (res2.data.estado == 'exito') {
                                        alert("Empresa actualizada con éxito, inicie sesión con las nuevas credenciales");
                                        cerrarSesion();
                                    } else {
                                        alert("Error, intente de nuevo");
                                        return false;
                                    }
                                })
                                .catch(err => {
                                    alert("Error: " + err);
                                    irInicio();
                                });
                            // );
                        })
                        .catch(err1 => {
                            console.log(err1);
                            alert("Error: " + err1);
                            return false;
                        });
                })
                .catch (err2 => {
                console.log(err2);
                alert("Error: " + err2);
                return false;
                });
    }
}

}



function irInicio() {
    window.location.href = 'visualizarPerfilEmpresa.php';
}

function paisSeleccionado() {
    var select = document.getElementById("pais");
    // var value = select.value;
    var text = select.options[select.selectedIndex].innerText;


    return text;
}

function cerrarSesion(){
    window.location.href = 'logoutE.php';
}


