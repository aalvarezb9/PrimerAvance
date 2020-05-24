<?php
session_start();
    header("Content-Type: application/json");
    include_once('../clases/login.php');
    $_POST = json_decode(file_get_contents('php://input'), true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $resultado = null;
            $usuario = Login::validarUsuario($_POST['email'], sha1($_POST['pw']));
            if($usuario == false || $usuario == null){
                $resultado = array(
                    "codigo" => false,
                    "mensaje" => "error",
                    "token" => null
                );
                setcookie("token", "",time()-1, "/");
                setcookie("user", "",time()-1, "/");
                setcookie("email", "",time()-1, "/");
                setcookie("gender", "",time()-1, "/");
                if(sizeof($usuario["purchases"]) != 0){
                    for($purchases = 0; $purchases < sizeof($usuario["purchases"]); $purchases++){
                        setcookie("purchases[".strval($purchases+1)."]", "", time() - 1, "/");
                    }
                }else{
                    setcookie("purchases[0]", "", time() - 1, "/");
                }
                if(sizeof($usuario["carrito"]) != 0){
                    for($carrito = 0; $carrito < sizeof($usuario["carrito"]); $carrito++){
                        setcookie("carrito[".strval($carrito+1)."]", "", time() - 1, "/");
                    }
                }else{
                    setcookie("carrito[0]", "", time() - 1, "/");
                }
                echo json_encode($resultado);
            }else{
                error_reporting(0);
                $resultado = array(
                    "codigo" => true,
                    "mensaje" => "usuario autenticado",
                    "token" => sha1(uniqid(rand(), true))
                );
                $_SESSION["token"] = $resultado["token"];
                setcookie("token", $resultado["token"], time()+(60*60*24*31), "/");
                setcookie("user", $usuario["user"], time()+(60*60*24*31), "/");
                setcookie("email", $usuario["email"], time()+(60*60*24*31), "/");
                setcookie("gender", $usuario["gender"], time()+(60*60*24*31), "/");
                if(sizeof($usuario["purchases"]) == 0){
                    for($purchases = 0; $purchases < sizeof($usuario["purchases"]); $purchases++){
                        setcookie("purchases[0]", "", time() - 1, "/");
                    }
                }else{
                    for($purchases = 0; $purchases < sizeof($usuario["purchases"]); $purchases++){
                        setcookie("purchases[".strval($purchases+1)."]", $usuario["purchases"][$purchases], time()+(60*60*24*31), "/");
                    }
                }
                if(sizeof($usuario["carrito"]) == 0){
                    for($carrito = 0; $carrito < sizeof($usuario["carrito"]); $carrito++){
                        setcookie("carrito[0]", "", time() - 1, "/");
                    }
                }else{
                    for($carrito = 0; $carrito < sizeof($usuario["carrito"]); $carrito++){
                        setcookie("carrito[".strval($carrito+1)."]", $usuario["carrito"][$carrito], time()+(60*60*24*31), "/");
                    }
                }
                
                echo json_encode($resultado);

            }

        break;
    }
?>