/*Antes de ejecutar toda acción que implique modificar en el json original, se implementará una función
 (cuando esté listo el servidor PHP) que primero verifique si el json cargado desde el servidor tiene datos, 
 para no alterar en él los datos que aquí no sean modificados   
*/
const urlEmpresas = 'http://localhost/BUSE/backend/api/empresas.php';
var imagenN;
document.getElementById('nuevo-email-registro-empresa').value = leerCookie("emailEmpresa");
document.getElementById('nuevo-nombre-registro-empresa').value = leerCookie("name").replace("+", " ");
document.getElementById('direccion-registro').value = leerCookie("address");
document.getElementById('fb').value = leerCookie("facebook").replace("+", " ");
document.getElementById('ig').value = leerCookie("instagram").replace("+", " ");
document.getElementById('yt').value = leerCookie("youtube").replace("+", " ");
document.getElementById('sc').value = leerCookie("snapchat").replace("+", " ");

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


function actualizar() {
    // empresa = {
    //     name: '',
    //     emailEmpresa: '',
    //     pwEmpresa: '',
    //     country: '',
    //     address: '',
    //     banner: [],
    //     offer: [],
    //     imagesEmpresa: [],
    //     officesAddress: [],
    //     social: {
    //         facebook: '',
    //         snapchat: '',
    //         instagram: '',
    //         youtube: ''
    //     }
    // };

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
            // empresa.emailEmpresa = correo.value;
            // empresa.name = nombre.value;
            // empresa.pw = password.value;
            // empresa.address = direccion.value;
            // empresa.social.facebook = fb.value;
            // empresa.social.instagram = ig.value;
            // empresa.social.snapchat = sc.value;
            // empresa.social.youtube = yt.value;
            // empresa.country = paisSeleccionado();
            // empresa.imagesEmpresa.push(obtenerRutaImagen());
            // empresa.banner = obtenerRutaBanner();
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
                            let empresa = {
                                name: document.getElementById('nuevo-email-registro-empresa').value,
                                emailEmpresa: document.getElementById('nuevo-nombre-registro-empresa').value,
                                pwEmpresa: document.getElementById('nueva-password-registro-empresa'),
                                country: paisSeleccionado(),
                                address: document.getElementById('direccion-registro').value,
                                banner: res1.data,
                                offer: [],
                                imagesEmpresa: imagenN,
                                officesAddress: [],
                                social: {
                                    facebook: document.getElementById('fb').value,
                                    instagram: document.getElementById('ig').value,
                                    youtube: document.getElementById('yt').value,
                                    snapchat: document.getElementById('sc').value
                                }
                            }

                            axios({
                                url: urlEmpresas + '?id=' + leerCookie("name"),
                                method: 'PUT',
                                responseType: 'json',
                                data: empresa
                            })
                                .then(res2 => {
                                    console.log(res2.data);
                                    if (res2.data == 'exito') {
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

function obtenerRutaImagen() {
    var rutaImagen = '';
    $('input[type=file]:first').change(function () {
        rutaImagen = $('#btn_anviar').val();
    });

    return rutaImagen;
}

function obtenerRutaBanner() {
    var rutaBanner = '';
    $('input[type=file]:last').change(function () {
        rutaBanner = $('#btn_anviar').val();
    });

    return rutaBanner;
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

