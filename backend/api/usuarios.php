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
            if(isset($_GET['tds'])){
                Usuario::obtenerUsuarios();
            }
        break;
        case 'DELETE':
            if(isset($_GET['id'])){
                Usuario::eliminarUnUsuario($_GET['id']);
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
            }else if(isset($_GET['com'])){
                Usuario::comentarProducto($_GET['com'], $_POST['e'], $_POST['p'], $_POST['c']);
            }else if(isset($_GET['cal'])){
                Usuario::calificarProducto($_GET['cal'], $_POST['e'], $_POST['p'], $_POST['c']);
            }else if(isset($_GET['vrp'])){
                Usuario::verPerfilDeEmpresa($_GET['vrp'], $_POST['emp']);
            }else if(isset($_GET['fav'])){
                Usuario::marcarEmpresaFavorita($_GET['fav'], $_POST['empresa']);
            }else if(isset($_GET['act'])){
                Usuario::actualizar($_GET['act'], $_POST['cliente']);
            }
        break;
    }
?>