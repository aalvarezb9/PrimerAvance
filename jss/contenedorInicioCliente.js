var localStorage = window.localStorage;
var temporal = JSON.parse(localStorage.getItem("clientes"));

function dejarAzul(){
        document.getElementById('radioEstrella').style.display = 'none';
        document.getElementById('radioEstrellaGris').style.display = 'block';
}

function dejarGris(){
    document.getElementById('radioEstrellaGris').style.display = 'none';
    document.getElementById('radioEstrella').style.display = 'block';
}

