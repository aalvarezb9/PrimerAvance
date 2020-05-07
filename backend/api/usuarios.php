<?php 
    header("Content-Type: application/json");
    include_once('../clases/usuario.php');  
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $_POST = json_decode(file_get_contents('php://input'), true);
            $usuario = new Usuario(
                $_POST['user'],
                $_POST['id'],
                $_POST['email'],
                sha1($_POST['pw']),
                $_POST['gender'],
                $_POST['carrito'],
                $_POST['pleasures'],
                $_POST['images'],
                $_POST['purchases'],
                $_POST['formaDePago']
            );
            //$usuario->verificarUsuario();
            if($usuario->verificarUsuario() == true){
                echo json_encode(array(
                    "existeCorreo" => false,
                    "existeUser" => false,
                    "user" => $_POST['user']
                ));
            }else{
                echo json_encode(array(
                    "mensaje" => "error"
                ));
            }

        break;
        case 'GET':
            if(isset($_GET['id'])){
                Usuario::obtenerUnUsuario($_GET['id']);
            }else{
                Usuario::obtenerUsuarios();
            }
        break;
        case 'DELETE':
            if(isset($_GET['id'])){
                //Eliminar ese usuario
            }else{
                Usuario::eliminarUsuarios();
            }
        break;
        case 'PUT':
            
        break;
    }
?>