<?php
    header("Content-Type: application/json");
    include_once('../clases/super-usuario.php');  
    $_POST = json_decode(file_get_contents('php://input'), true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $resultado = null;
            $login = Super::obtenerSU($_POST['usuario'], $_POST['pass']);
                if($login == null){
                    echo json_encode(array(
                        "estado" => "fracaso"
                    ));
                }else{
                    $resultado = array(
                        "estado" => "exito",
                        "token" => sha1(uniqid(rand(), true))
                    );
                    $_SESSION["token"] = $resultado["token"];
                    setcookie("token", $resultado["token"], time()+(60*60*24*31), "/");
                    setcookie("su", $login["usuario"], time()+(60*24*60*31), "/");
                    echo json_encode($resultado);
                }
        break;
    }
?>