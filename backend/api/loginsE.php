<?php
    header("Content-Type: application/json");
    include_once('../clases/loginE.php');
    $_POST = json_decode(file_get_contents('php://input'), true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            LoginE::validarEmpresa($_POST['emailEmpresa'], sha1($_POST['pwEmpresa']));
        break;
    }
?>