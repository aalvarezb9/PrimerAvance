<?php 
    session_start();
    session_destroy();
    $empresa = null;
    $archivo = file_get_contents('../backend/datos/empresas.json');
    $empresas = json_decode($archivo, true);
    for($i = 0; $i < sizeof($empresas); $i++){
        if($_COOKIE["emailEmpresa"] == $empresas[$i]["emailEmpresa"]){
            $empresa = $empresas[$i];
        }
    };
    
    setcookie("token", "",time()-1, "/");
    setcookie("name", "",time()-1, "/");
    setcookie("emailEmpresa", "",time()-1, "/");
    if($_COOKIE["facebook"])
    {setcookie("facebook", "", time()-1, "/");}
    if($_COOKIE["instagram"])
    {setcookie("instagram", "", time()-1, "/");}
    if($_COOKIE["snapchat"])
    {setcookie("snapchat", "", time()-1, "/");}
    if($_COOKIE["youtube"])
    {setcookie("youtube", "", time()-1, "/");}
    setcookie("country", "", time()-1, "/");
    setcookie("address", "", time()-1, "/");
    for($offer = 0; $offer < sizeof($empresa["offer"]) ; $offer++){
        setcookie("offer".strval($offer+1), "", time()-1, "/");
    }
    for($images = 0; $images < sizeof($empresa["imagesEmpresa"]) ; $images++){
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
            setcookie("producto[precio][".strval($products+1)."]", "", time()-1, "/");
            setcookie("producto[categoria][".strval($products+1)."]", "", time()-1, "/");
            setcookie("producto[cantidad][".strval($products+1)."]", "", time()-1, "/");
            setcookie("producto[imagen][".strval($products+1)."]", "", time()-1, "/");
            setcookie("producto[codigoQR][".strval($products+1)."]", "", time()-1, "/");
            setcookie("producto[descripcion][".strval($products+1)."]", "", time()-1, "/");
        }
    }
    header("Location: index.html");

?>