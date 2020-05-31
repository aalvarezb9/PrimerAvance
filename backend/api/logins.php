<?php
session_start();
    header("Content-Type: application/json");
    include_once('../clases/login.php');
    $_POST = json_decode(file_get_contents('php://input'), true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $resultado = null;
            $usuario = Login::validarUsuario($_POST['email'], sha1($_POST['pw']));
            if($usuario == false){
                $resultado = array(
                    "codigo" => false,
                    "mensaje" => "error",
                    "token" => null
                );
                setcookie("token", "",time()-1, "/");
                setcookie("user", "",time()-1, "/");
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
                echo json_encode($resultado);
            }

        break;
    }
?>