
const urlEmpresas = '../backend/api/empresas.php';
const nombreEmpresa = leerCookie("name");

function abrirModal(id){
    $('#exampleModalIncrementar').modal('show');
    if(id == 0){
        document.getElementById('#exampleModalLabel').innerHTML = 'Elimina tus productos';
    }else{
        document.getElementById('#exampleModalLabel').innerHTML = 'Incrementa tus productos';
    }
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