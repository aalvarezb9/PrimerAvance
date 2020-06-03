<?php
    $rutaImgEmpresa = '../backend/datos/img/empresas/imgs';
    $rutaBannerEmpresa = '../backend/datos/img/empresas/banners';
    $rutaImgUsuarios = '../backend/datos/img/usuarios';
    $rutaImgProducto = '../backend/datos/img/empresas/productos';


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_FILES['btn_enviar_imagen'])){
            $nombre = $_FILES['btn_enviar_imagen']['name'];
            $guardado = $_FILES['btn_enviar_imagen']['tmp_name'];
            // echo json_encode($_FILES['enviar-imagen-empresa'])." - ".$_SERVER["REQUEST_METHOD"]." - ".json_encode($_POST);
            if(!file_exists($rutaImgEmpresa)){
                mkdir($rutaImgEmpresa, 0777, true);
                if(file_exists($rutaImgEmpresa)){
                    if(move_uploaded_file($guardado, $rutaImgEmpresa.'/'.$nombre)){
                        echo $rutaImgEmpresa.'/'.$nombre;
                        return $rutaImgEmpresa.'/'.$nombre;
                    }else{
                        return "nega";
                    }
                }
            }else{
                if(move_uploaded_file($guardado, $rutaImgEmpresa.'/'.$nombre)){
                    echo $rutaImgEmpresa.'/'.$nombre;
                    return $rutaImgEmpresa.'/'.$nombre;    
                }else{
                    return "nega";
                }
            }
            exit();  
        }if(isset($_FILES['banner-empresa-img'])){
            $nombre = $_FILES['banner-empresa-img']['name'];
            $guardado = $_FILES['banner-empresa-img']['tmp_name'];
            // echo json_encode($_FILES['enviar-imagen-empresa'])." - ".$_SERVER["REQUEST_METHOD"]." - ".json_encode($_POST);
            if(!file_exists($rutaBannerEmpresa)){
                mkdir($rutaBannerEmpresa, 0777, true);
                if(file_exists($rutaBannerEmpresa)){
                    if(move_uploaded_file($guardado, $rutaBannerEmpresa.'/'.$nombre)){
                        echo $rutaBannerEmpresa.'/'.$nombre;
                        return $rutaBannerEmpresa.'/'.$nombre;
                    }else{
                        return "nega";
                    }
                }
            }else{
                if(move_uploaded_file($guardado, $rutaBannerEmpresa.'/'.$nombre)){
                    echo $rutaBannerEmpresa.'/'.$nombre;
                    return $rutaBannerEmpresa.'/'.$nombre;    
                }else{
                    return "nega";
                }
            }  
            exit();
        }if(isset($_FILES['enviar-imagen-cliente'])){
            $nombre = $_FILES['enviar-imagen-cliente']['name'];
            $guardado = $_FILES['enviar-imagen-cliente']['tmp_name'];
            // echo json_encode($_FILES['enviar-imagen-empresa'])." - ".$_SERVER["REQUEST_METHOD"]." - ".json_encode($_POST);
            if(!file_exists($rutaImgUsuarios)){
                mkdir($rutaImgUsuarios, 0777, true);
                if(file_exists($rutaImgUsuarios)){
                    if(move_uploaded_file($guardado, $rutaImgUsuarios.'/'.$nombre)){
                        echo $rutaImgUsuarios.'/'.$nombre;
                        return $rutaImgUsuarios.'/'.$nombre;
                    }else{
                        return "nega";
                    }
                }
            }else{
                if(move_uploaded_file($guardado, $rutaImgUsuarios.'/'.$nombre)){
                    echo $rutaImgUsuarios.'/'.$nombre;
                    return $rutaImgUsuarios.'/'.$nombre;    
                }else{
                    return "nega";
                }
            }
            exit();  
        }if(isset($_FILES['imagen-producto'])){
            $nombre = $_FILES['imagen-producto']['name'];
            $guardado = $_FILES['imagen-producto']['tmp_name'];

            if(!file_exists($rutaImgProducto)){
                mkdir($rutaImgProducto, 0777, true);
                if(file_exists($rutaImgProducto)){
                    if(move_uploaded_file($guardado, $rutaImgProducto.'/'.$nombre)){
                        echo $rutaImgProducto.'/'.$nombre;
                        return $rutaImgProducto.'/'.$nombre;
                    }else{
                        return "nega";
                    }
                }
            }else{
                if(move_uploaded_file($guardado, $rutaImgProducto.'/'.$nombre)){
                    echo $rutaImgProducto.'/'.$nombre;
                    return $rutaImgProducto.'/'.$nombre;    
                }else{
                    return "nega";
                }
            }
            exit();
        }
    }


?>