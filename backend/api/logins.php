<?php
    header("Content-Type: application/json");
    include_once('../clases/login.php');
    $_POST = json_decode(file_get_contents('php://input'), true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            Login::validarUsuario($_POST['email'], sha1($_POST['pw']));
        break;
    }
?>