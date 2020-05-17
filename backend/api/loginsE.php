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
                setcookie("emailEmpresa", "",time()-1, "/");
                setcookie("facebook", "", time()-1, "/");
                setcookie("instagram", "", time()-1, "/");
                setcookie("snapchat", "", time()-1, "/");
                setcookie("youtube", "", time()-1, "/");
                setcookie("country", "", time()-1, "/");
                setcookie("address", "", time()-1, "/");
                for($offer = 0; $offer < sizeof($empresa["offer"]); $offer++){
                    setcookie("offer".strval($offer+1), "", time()-1, "/");
                }
                for($images = 0; $images < sizeof($empresa["imagesEmpresa"]); $images++){
                    setcookie("imagesEmpresa".strval($images+1), "", time()-1, "/");
                }
                for($banner = 0; $banner < sizeof($empresa["banner"]); $banner++){
                    setcookie("banner".strval($banner+1), "", time()-1, "/");
                }
                if($empresa["sucursal"]){
                    for($sucursal = 0; $sucursal < sizeof($empresa["sucursal"]); $sucursal++){
                        setcookie("sucursal[nombre][".strval($sucursal+1)."]", "", time()-1, "/");
                        setcookie("sucursal[latitud][".strval($sucursal+1)."]", "", time()-1, "/");
                        setcookie("sucursal[longitud][".strval($sucursal+1)."]", "", time()-1, "/");
                        setcookie("sucursal[codigoPostal][".strval($sucursal+1)."]", "", time()-1, "/");
                    }
                }
            
                if($empresa["products"]){
                    for($products = 0; $products < sizeof($empresa["products"]); $products++){
                        setcookie("producto[nombre][".strval($products+1)."]", "", time()-1, "/");
                        setcookie("producto[precio]".strval($products+1)."]", "", time()-1, "/");
                        setcookie("producto[cateogoria]".strval($products+1)."]", "", time()-1, "/");
                        setcookie("producto[cantidad]".strval($products+1)."]", "", time()-1, "/");
                        setcookie("producto[imagen]".strval($products+1)."]", "", time()-1, "/");
                        setcookie("producto[codigoQR]".strval($products+1)."]", "", time()-1, "/");
                        setcookie("producto[descripcion]".strval($products+1)."]", "", time()-1, "/");
                    }
                }
                echo json_encode($resultado);
            }else{
                $resultado = array(
                    "codigo" => true,
                    "mensaje" => "empresa autenticada",
                    "token" => sha1(uniqid(rand(), true))
                );
                $_SESSION["token"] = $resultado["token"];
                setcookie("token", $resultado["token"], time()+(60*60*24*31), "/");
                setcookie("name", $empresa["name"], time()+(60*60*24*31), "/");
                setcookie("emailEmpresa", $empresa["emailEmpresa"], time()+(60*60*24*31), "/");
                setcookie("facebook", $empresa["social"]["facebook"], time()+(60*60*24*31), "/");
                setcookie("instagram", $empresa["social"]["instagram"], time()+(60*60*24*31), "/");
                setcookie("snapchat", $empresa["social"]["snapchat"], time()+(60*60*24*31), "/");
                setcookie("youtube", $empresa["social"]["youtube"], time()+(60*60*24*31), "/");
                setcookie("country", $empresa["country"], time()+(60*60*24*31), "/");
                setcookie("address", $empresa["address"], time()+(60*60*24*31), "/");
                for($offer = 0; $offer < sizeof($empresa["offer"]); $offer++){
                    setcookie("offer".strval($offer+1), $empresa["offer"][$offer], time()+(60*60*24*31), "/");
                }
                for($images = 0; $images < sizeof($empresa["imagesEmpresa"]); $images++){
                    setcookie("imagesEmpresa".strval($images+1), $empresa["imagesEmpresa"][$images], time()+(60*60*24*31), "/");
                }
                for($banner = 0; $banner < sizeof($empresa["banner"]); $banner++){
                    setcookie("banner".strval($banner+1), $empresa["banner"][$banner], time()+(60*60*24*31), "/");
                }
                if($empresa["products"]){
                    for($products = 0; $products < sizeof($empresa["products"]); $products++){
                        setcookie("producto[nombre][".strval($products+1)."]", $empresa["products"][$products]["nombre"], time()+(60*60*24*31), "/");
                        setcookie("producto[precio][".strval($products+1)."]", $empresa["products"][$products]["precio"], time()+(60*60*24*31), "/");
                        setcookie("producto[categoria][".strval($products+1)."]", $empresa["products"][$products]["categoria"], time()+(60*60*24*31), "/");
                        setcookie("producto[cantidad][".strval($products+1)."]", $empresa["products"][$products]["cantidad"], time()+(60*60*24*31), "/");
                        setcookie("producto[imagen][".strval($products+1)."]", $empresa["products"][$products]["imagen"], time()+(60*60*24*31), "/");
                        setcookie("producto[codigoQR][".strval($products+1)."]", $empresa["products"][$products]["codigoQR"], time()+(60*60*24*31), "/");
                        setcookie("producto[descripcion][".strval($products+1)."]", $empresa["products"][$products]["descripcion"], time()+(60*60*24*31), "/");
                    }
                }
                if($empresa["sucursal"]){
                    for($sucursal = 0; $sucursal < sizeof($empresa["sucursal"]); $sucursal++){
                        setcookie("sucursal[nombre][".strval($sucursal+1)."]", $empresa["sucursal"][$sucursal]["nombre"], time()+(60*60*24*31), "/");
                        setcookie("sucursal[latitud][".strval($sucursal+1)."]", $empresa["sucursal"][$sucursal]["latitud"], time()+(60*60*24*31), "/");
                        setcookie("sucursal[longitud][".strval($sucursal+1)."]", $empresa["sucursal"][$sucursal]["longitud"], time()+(60*60*24*31), "/");
                        setcookie("sucursal[codigoPostal][".strval($sucursal+1)."]", $empresa["sucursal"][$sucursal]["codigoPostal"], time()+(60*60*24*31), "/");
                    }
                }
                echo json_encode($resultado);
            }
        break;
    }
?>