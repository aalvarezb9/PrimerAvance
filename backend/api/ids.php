<?php
    header("Content-Type: application/json");
    include_once('../clases/id.php');

    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if(isset($_GET['idE'])){
                if($_GET['idE'] == 'get'){
                    Id::obtenerIdEmpresa();
                }
                exit();
            }if(isset($_GET['id'])){
                if($_GET['id'] == 'get'){
                    Id::obtenerIdUsuario();
                }
            }
        break;
    }
?>