const urlClientes = 'http://localhost/BUSE/backend/api/usuarios.php';

function dejarAzul(){
        document.getElementById('radioEstrella').style.display = 'none';
        document.getElementById('radioEstrellaGris').style.display = 'block';
}

function dejarGris(){
    document.getElementById('radioEstrellaGris').style.display = 'none';
    document.getElementById('radioEstrella').style.display = 'block';
}

//Función que agrega al carrito un producto
function agregarAlCarrito(){
    axios({
        method: 'PUT',
        url: urlClientes + '?carr=' + leerCookie("user"),
        data: {
            nombre: 
        }
    }).then(res => {

    }).catcht(err => {

    });
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
