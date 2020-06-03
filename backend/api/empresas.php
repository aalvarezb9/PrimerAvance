<?php 
    header("Content-Type: application/json");
    include_once('../clases/empresa.php');  
    $_POST = json_decode(file_get_contents('php://input'), true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            if(isset($_GET['vSuc'])){
                $cadena = str_replace("+", " ", $_GET['vSuc'], $contador);
                if($contador > 0){
                    Empresa::obtenerUnaSucursal($cadena, $_POST["id"]);
                }else{
                    Empresa::obtenerUnaSucursal($_GET['vSuc'], $_POST["id"]);
                }
            }else{
                $empresa = new Empresa(
                    $_POST['name'],
                    // $_POST['idE'],
                    $_POST['emailEmpresa'],
                    sha1($_POST['pwEmpresa']),
                    $_POST['country'],
                    $_POST['address'],
                    $_POST['banner'],
                    $_POST['offer'],
                    $_POST['imagesEmpresa'],
                    $_POST['social']
                );
                // echo $_POST['user'];
                $verificacion = $empresa->verificarEmpresa();
                if($verificacion == true){
                    echo json_encode(array(
                        "estado" => true,
                        "name" => $_POST['name']
                    ));
                }else{
                    echo json_encode(array(
                        "estado" => false
                    ));
                }
            }
        break;
        case 'GET':
            if(isset($_GET['idE'])){
                Empresa::obtenerUnaEmpresa($_GET['idE']);
                exit();
            }elseif(isset($_GET['cod'])){
                Empresa::obtenerCodigoEmpresa();
                exit();
            }elseif(isset($_GET['idE'])){
                Empresa::longitud();
                exit();
            }else if(isset($_GET['offr'])){
                $cadena = str_replace("+", " ", $_GET['offr'], $contador);
                if($contador > 0){
                    Empresa::obtenerOfferEmpresa($cadena);
                }else{
                    Empresa::obtenerOfferEmpresa($_GET['offr']);
                }
            }else if(isset($_GET['eml'])){
                $cadena = str_replace("+", " ", $_GET['eml'], $contador);
                if($contador > 0){
                    Empresa::obtenerEmailEmpresa($cadena);
                }else{
                    Empresa::obtenerEmailEmpresa($_GET['eml']);
                }
            }else if(isset($_GET['dir'])){
                $cadena = str_replace("+", " ", $_GET['dir'], $contador);
                if($contador > 0){
                    Empresa::obtenerDireccionEmpresa($cadena);
                }else{
                    Empresa::obtenerDireccionEmpresa($_GET['dir']);
                }
            }else if(isset($_GET['soc'])){
                $cadena = str_replace("+", " ", $_GET['soc'], $contador);
                if($contador > 0){
                    Empresa::obtenerRedesSociales($cadena);
                }else{
                    Empresa::obtenerRedesSociales($_GET['soc']);
                }
            }else if(isset($_GET['nSuc'])){
                $cadena = str_replace("+", " ", $_GET['nSuc'], $contador);
                if($contador > 0){
                    Empresa::obtenerNombreSucursales($cadena);
                }else{
                    Empresa::obtenerNombreSucursales($_GET['nSuc']);
                }
            }else if(isset($_GET['bnnr'])){
                $cadena = str_replace("+", " ", $_GET['bnnr'], $contador);
                if($contador > 0){
                    Empresa::obtenerBanners($cadena);
                }else{
                    Empresa::obtenerBanners($_GET['bnnr']);
                }
            }else if(isset($_GET['prd'])){
                $cadena = str_replace("+", " ", $_GET['prd'], $contador);
                if($contador > 0){
                    Empresa::obtenerProductos($cadena);
                }else{
                    Empresa::obtenerProductos($_GET['prd']);
                }
            }else if(isset($_GET['prdC'])){
                Empresa::obtenerTodosLosProductos();
            }else if(isset($_GET['dsh'])){
                $cadena = str_replace("+", " ", $_GET['dsh'], $contador);
                if($contador > 0){
                    Empresa::paraElDash($cadena);
                }else{
                    Empresa::paraElDash($_GET['dsh']);
                }
            }else if(isset($_GET['tds'])){
                Empresa::obtenerEmpresas();
            }else{
                Empresa::obtenerProductosInicio();
            }
        break;
        case 'DELETE':
            if(isset($_GET['idE'])){
                $cadena = str_replace("+", " ", $_GET['idE'], $contador);
                if($contador > 0){
                    Empresa::eliminarEmpresa($cadena);
                }else{
                    Empresa::eliminarEmpresa($_GET['idE']);
                }
            }else if(isset($_GET['suc'])){
                $cadena = str_replace("+", " ", $_GET['suc'], $contador);
                if($contador > 0){
                    Empresa::eliminarSucursal($cadena, $_POST['i']);
                }else{
                    Empresa::eliminarSucursal($_GET['suc'], $_POST['i']);
                }
            }else{
                // Usuario::eliminarUsuarios()
            }
        break;
        case 'PUT':
            if(isset($_GET['nameE'])){
                // $empresa = null;
                $cadena = str_replace("-", " ", $_GET['nameE'], $contador);
                if($contador > 0){
                    $empresa = Empresa::agregarProductoAEmpresa($cadena, $_POST['producto']);
                    if($empresa != null){
                        echo json_encode(array(
                            "estado" => "exito"
                        ));
                    }
                }else{
                    $empresa = Empresa::agregarProductoAEmpresa($_GET['nameE'], $_POST['producto']);
                    if($empresa != null){
                        echo json_encode(array(
                            "estado" => "exito"
                        ));
                    }
                }
            }elseif(isset($_GET['nameES'])){
                $cadena = str_replace("-", " ", $_GET['nameES'], $contador);
                if($contador > 0){
                    $empresa = Empresa::agregarSucursalAEmpresa($cadena, $_POST['sucursal']);
                    if($empresa != null){
                        echo json_encode(array(
                            "estado" => "exito"
                        ));
                    }
                }else{
                    $empresa = Empresa::agregarSucursalAEmpresa($_GET['nameES'], $_POST['sucursal']);
                    if($empresa != null){
                        echo json_encode(array(
                            "estado" => "exito"
                        ));
                    }
                }
            }elseif(isset($_GET['actE'])){
                $cadena = str_replace("+", " ", $_GET['actE'], $contador);
                if($contador > 0){
                    $empresa = Empresa::actualizarEmpresa($cadena, $_POST["empresa"]);
                    if($empresa != null){
                        echo json_encode(array(
                            "estado" => "exito"
                        ));
                        
                    }else{
                        echo json_encode(array(
                            "estado" => "fracaso",
                            "-" => $empresa,
                            "contador" => $contador
                        ));
                    }
                }else{
                    $empresa = Empresa::actualizarEmpresa($_GET['actE'], $_POST["empresa"]);
                    if($empresa != null){
                        echo json_encode(array(
                            "estado" => "exito"
                        ));
                    }else{
                        echo json_encode(array(
                            "estado" => "fracaso",
                            "--" => $empresa,
                            "contador" => $contador
                        ));
                    }
                    
                }
                
            }else if(isset($_GET['cPrd'])){
                $cadena = str_replace("+", " ", $_GET['cPrd'], $contador);   
                if($contador > 0){
                    if($_POST["status"] == 0){
                        Empresa::eliminarCantidadProductos($cadena, $_POST["cantidad"], $_POST["nombreP"]);
                    }else{
                        Empresa::aumentarCantidadProductos($cadena, $_POST["cantidad"], $_POST["nombreP"]);
                    }
                }else{
                    if($_POST["status"] == 0){
                        Empresa::eliminarCantidadProductos($_GET['cPrd'], $_POST["cantidad"], $_POST["nombreP"]);
                    }else{
                        Empresa::aumentarCantidadProductos($_GET['cPrd'], $_POST["cantidad"], $_POST["nombreP"]);
                    }
                }
            }
        break;
    }

?>