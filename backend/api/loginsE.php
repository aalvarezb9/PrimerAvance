<?php
    session_start();
    header("Content-Type: application/json");
    include_once('../clases/loginE.php');
    $_POST = json_decode(file_get_contents('php://input'), true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $resultado = null;
            $empresa = LoginE::validarEmpresa($_POST['emailEmpresa'], sha1($_POST['pwEmpresa']));
            if($empresa == false || $empresa == null){
                $resultado = array(
                    "codigo" => false,
                    "mensaje" => "error",
                    "token" => null
                );
                setcookie("token", "",time()-1, "/");
                setcookie("name", "",time()-1, "/");
                echo json_encode($resultado);
            }else{
                error_reporting(0);
                $resultado = array(
                    "codigo" => true,
                    "mensaje" => "empresa autenticada",
                    "token" => sha1(uniqid(rand(), true))
                );
                $_SESSION["token"] = $resultado["token"];
                setcookie("token", $resultado["token"], time()+(60*60*24*31), "/");
                setcookie("name", $empresa["name"], time()+(60*60*24*31), "/");
                echo json_encode($resultado);
            }
        break;
    }
?>