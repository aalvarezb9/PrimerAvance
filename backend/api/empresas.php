<?php 
    header("Content-Type: application/json");
    include_once('../clases/empresa.php');  
    $_POST = json_decode(file_get_contents('php://input'), true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $empresa = new Empresa(
                $_POST['name'],
                $_POST['idE'],
                $_POST['emailEmpresa'],
                sha1($_POST['pwEmpresa']),
                $_POST['country'],
                $_POST['address'],
                $_POST['banner'],
                $_POST['offer'],
                $_POST['imagesEmpresa'],
                $_POST['products'],
                $_POST['social']
            );
            // echo $_POST['user'];
            $empresa->verificarEmpresa();
        break;
        case 'GET':
            if(isset($_GET['idE'])){
                Empresa::obtenerUnaEmpresa($_GET['idE']);
                exit();
            }elseif(isset($_GET['cod'])){
                Empresa::obtenerCodigoEmpresa();
                exit();
            }elseif(isset($_GET['idE'])){
                Empresa::longitud();
                exit();
            }else{
                Empresa::obtenerEmpresas();
                exit();
            }
        break;
        case 'DELETE':
            if(isset($_GET['idE'])){
                //Eliminar esa empresa
            }else{
                // Usuario::eliminarUsuarios()
            }
        break;
        case 'PUT':
            if(isset($_GET['nameE'])){
                Empresa::agregarProductoAEmpresa($_GET['nameE'], $_POST['producto']);
                exit();
            }
        break;
    }

?>