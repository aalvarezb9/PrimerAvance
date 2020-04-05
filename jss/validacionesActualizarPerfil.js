cliente = {
    user: '',
    email: '',
    pw: '',
    gender: '',
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
//este sería el json de la empresa la cual tiene la sesión abierta
/*ya con el php incluído, se va a sobreescribir con la nueva información 
en el json de empresas*/

function actualizar(){
    nuevoUser = document.getElementById('nuevo-nombre-registro-cliente');
    nuevoEmail = document.getElementById('nuevo-email-registro-cliente');
    nuevaPw = document.getElementById('nueva-password-registro-cliente');
    
    if(nuevaPw.value != document.getElementById('nueva-password-repetir-registro-cliente').value){
        alert('Contraseñas distintas');
        return false;
    }else{
        cliente.user = nuevoUser.value;
        cliente.email = nuevoEmail.value;
        cliente.pw = nuevaPw.value;
        obtenerGustos();
        console.log(cliente);
        limpiarTodo();
        //A partir de aquí va el código que se encarga en enviar el nuevo json js al archivo .json
    }
    alert('Datos actualizados con éxito')
    return false;
    // nuevoImagen = document.getElementById('');
    // nuevaAddress = document.getElementById('');
}

function obtenerGustos(){
    $("input[type=checkbox]:checked").each(function () {
        cliente.pleasures.push(this.value);
    });
}

function limpiarTodo(){
    nuevoUser.value = '';
    nuevoEmail.value = '';
    nuevaPw.value = '';
    document.getElementById('nueva-password-repetir-registro-cliente').value = '';
}