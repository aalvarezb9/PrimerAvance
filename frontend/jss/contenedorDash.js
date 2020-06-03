const nombreEmpresa = leerCookie("name");
const urlEmpresas = '../backend/api/empresas.php';
function cargarDatos() {
    axios({
        url: '../backend/api/empresas.php?dsh=' + nombreEmpresa,
        method: 'GET',
        responseType: 'json'
    }).then(res => {
        if(res.data.estado == "exito" && res.data.mensaje == "ventas"){
            let dinero = 0;
            let productos = 0;
            let ventas = res.data.ventas.length;
            for(let i = 0; i < res.data.ventas.length; i++){
                dinero += parseInt(res.data.ventas[i].precio)*parseInt(res.data.ventas[i].cantidad);
                productos += parseInt(res.data.ventas[i].cantidad);
            }
            document.getElementById('c').innerHTML = ventas;
            document.getElementById('v').innerHTML = productos;
            document.getElementById('d').innerHTML = dinero + " Lps";
        }else if(res.data.estado == "exito" && res.data.mensaje == "No ventas"){
            document.getElementById('length-ventas').setAttribute("display", "none");
            document.getElementById('productos-vendidos').setAttribute("display", "none");
            document.getElementById('dinero').setAttribute("display", "none");
            alert("No ha hecho ninguna venta");
            window.location.href = 'visualizarPerfilEmpresa.php';
            return false;
        }else{
            alert("Error del sistema");
            return false;
        }
    }).catch(err => {
        alert("Error " + err);
            return false;
    });
} cargarDatos();

function obtenerEmpresa(){
    axios({
        url: urlEmpresas + '?idE=' + nombreEmpresa,
        method: 'GET',
        responseType: 'json'
    }).then(res => {
        let sum = 0;
        let sumc = 0;
        let sumv = 0;
        console.log(res.data);
        for(let i = 0; i < res.data.products.length; i++){
            if(res.data.products[i].comentarios != undefined){
                sumc += res.data.products[i].comentarios.length;
            }
        }
        document.getElementById('comme').innerHTML = sumc;
        if(res.data.vistas != undefined){
            document.getElementById('visitas').innerHTML = res.data.vistas.length;
        }else{
            document.getElementById('visitas').innerHTML = 0;
        }
        for(let i = 0; i < res.data.products.length; i++){
            if(res.data.products[i].calificaciones != undefined){
            for(let j = 0; j < res.data.products[i].calificaciones.length; j++){
                    sumv++;
                    sum += parseInt(res.data.products[i].calificaciones[j].calificacion);
                }
            }
        }
        document.getElementById('calificaciones').innerHTML = parseInt(sum/sumv);
    }).catch(err => {
        alert("Error " + err);
        return false;
    });
} obtenerEmpresa();

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