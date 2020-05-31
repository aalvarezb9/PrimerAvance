<?php 
    header("Content-Type: application/json");
    include_once('../clases/usuario.php');  
    $_POST = json_decode(file_get_contents('php://input'), true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $resultado = null;
            $usuario = new Usuario(
                $_POST['user'],
                $_POST['email'],
                sha1($_POST['pw']),
                $_POST['gender'],
                $_POST['carrito'],
                $_POST['pleasures'],
                $_POST['images'],
                $_POST['purchases'],
                $_POST['formaDePago']
            );
            $verificacion = $usuario->verificarUsuario();
            if($verificacion == true){
                $resultado = array(
                    "estado" => true,
                    "user" => $_POST['user']
                );
                // echo json_encode(array(
                //     "existeCorreo" => false,
                //     "existeUser" => false
                // ));
                echo json_encode($resultado);
            }else{
                $resultado = array(
                    "estado" => false
                );
                // echo json_encode(array(
                //     "mensaje" => "error"
                // ));
                echo json_encode($resultado);
            }

        break;
        case 'GET':
            if(isset($_GET['id'])){
                Usuario::obtenerUnUsuario($_GET['id']);
                exit();
            }
            if(isset($_GET['carr'])){
                Usuario::obtenerDelCarrito($_POST["user"], $_GET["carr"]);
                exit();
            }
            if(isset($_GET['obtC'])){
                // echo $_GET['obtC'];
                Usuario::obtenerTodoElCarrito($_GET['obtC']);
                exit();
            }
            if(isset($_GET['trj'])){
                Usuario::obtenerTarjeta($_GET['trj']);
                exit();
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
            if(isset($_GET['carr'])){
                $cadena = str_replace("+", " ", $_GET['carr'], $contador);
                if($contador > 0){
                    Usuario::agregarAlCarrito2($user, $_POST['e'], $_POST['p'], $_POST['c']);
                }else{
                    Usuario::agregarAlCarrito2($_GET["carr"], $_POST['e'], $_POST['p'], $_POST['c']);
                }
            }else if(isset($_GET['cmp'])){
                Usuario::comprar($_GET['cmp'], $_POST["carrito"], $_POST["tarjeta"]);
            }
        break;
    }
?>