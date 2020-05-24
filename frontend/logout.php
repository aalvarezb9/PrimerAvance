<?php 
    session_start();
    session_destroy();
    $usuario = null;
    $archivo = file_get_contents('../backend/datos/usuarios.json');
    $usuarios = json_decode($archivo, true);
    for($i = 0; $i < sizeof($usuarios); $i++){
        if($_COOKIE["emailEmpresa"] == $usuarios[$i]["email"]){
            $usuario = $usuarios[$i];
        }
    };

    setcookie("token", "",time()-1, "/");
    setcookie("user", "",time()-1, "/");
    setcookie("email", "",time()-1, "/");
    setcookie("gender", "",time()-1, "/");
    if($usuario["purchases"] != null){
        for($purchases = 0; $purchases < sizeof($usuario["purchases"]); $purchases++){
            setcookie("purchases[".strval($purchases+1)."]", "", time() - 1, "/");
        }
    }

    header("Location: index.html");

 ?>