<?php
    class LoginE{

        public static function validarEmpresa($correo, $contrasena){
            $contenidoArchivoEmpresa = file_get_contents('../datos/empresas.json');
            $empresas = json_decode($contenidoArchivoEmpresa, true);
            $empresa = false;
            for($i = 0; $i < sizeof($empresas); $i++){
                if($empresas[$i]['emailEmpresa'] == $correo){
                    if($empresas[$i]['pwEmpresa'] == $contrasena){
                        $empresa = $empresas[$i];
                    break;
                    }else{
                        $empresa = false;
                    }
                break;
                }
            }

            return $empresa;
        }
    }
?>