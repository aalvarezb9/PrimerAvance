var nombres;
var cantidadEmpresas;
var correos;
var correosC;
var productos;
var nombresC;

function inicio(){
    cantidadEmpresas = 0;
    nombres = [];
    productos = [];
    correos = [];
    axios({
        url: '../backend/api/empresas.php?tds',
        method: 'GET',
        responseType: 'json'
    }).then(res => {
        console.log(res.data);
        cantidadEmpresas = res.data.length;
        for(let i = 0; i < res.data.length; i++){
            nombres.push(res.data[i].name);
            correos.push(res.data[i].emailEmpresa);
        }
        
        generar();
    }).catch(err => {
        alert("Error");
        return false;
    });
} inicio();

function inicioC(){
    nombresC = [];
    correosC = []
    axios({
        url: '../backend/api/usuarios.php?tds',
        method: 'GET',
        responseType: 'json'
    }).then(res => {
        console.log(res.data);
        for(let i = 0; i < res.data.length; i++){
            nombresC.push(res.data[i].user);
            correosC.push(res.data[i].email);
        }
        generarN();
    }).catch(err => {
        alert("Error");
        return false;
    });
} inicioC();

function generarN(){
    // console.log(nombresC);
    document.getElementById('lista-compradores').innerHTML = '';
    document.getElementById('ttt').innerHTML = `Lista de compradores (${nombresC.length})`;
    for(let i = 0; i < nombresC.length; i++){
        document.getElementById('lista-compradores').innerHTML += `
            <li>${nombresC[i]} (${correosC[i]})</li>
        `; 
    }
}

function generar(){
    document.getElementById('lista-empresas').innerHTML = '';
    document.getElementById('tt').innerHTML = `Lista de empresas (${nombres.length})`;

    for(let i = 0; i < nombres.length; i++){
        document.getElementById('lista-empresas').innerHTML += `
            <li>${nombres[i]} (${correos[i]})</li>
        `; 
    }
}

function cs(){
    window.location.href = 'lo.php';
}