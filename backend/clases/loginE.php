<?php
    class LoginE{

        public static function validarEmpresa($correo, $contrasena){
            $contenidoArchivoEmpresa = file_get_contents('../../datos/empresas.json');
            $empresas = json_decode($contenidoArchivoEmpresa, true);
            $verificacion = array(
                "empresaExiste" => null,
                "contraExiste" => null
            );
            $empresa = null;
            for($i = 0; $i < sizeof($empresas); $i++){
                if($empresas[$i]['emailEmpresa'] == $correo){
                    $verificacion["usuarioExiste"] = true;
                    if($empresas[$i]['pwEmpresa'] == $contrasena){
                        $verificacion["contraExiste"] = true;
                        $empresa = $empresas[$i];
                    }else{
                        $verificacion["contraExiste"] = false;
                    }
                break;
                }
            }

            echo json_encode($empresa);
        }
    }
?>