<?php
    class Login{
        public static function validarUsuario($correo, $contrasena){
            $contenidoArchivoUsuarios = file_get_contents('../datos/usuarios.json');
            $usuarios = json_decode($contenidoArchivoUsuarios, true);
            $usuario = false;
            for($i = 0; $i < sizeof($usuarios); $i++){
                if($usuarios[$i]['email'] == $correo){
                    if($usuarios[$i]['pw'] == $contrasena){
                        $usuario = $usuarios[$i];
                    break;
                    }else{
                        $usuario = false;
                    }
                break;
                }
            }

            return $usuario;
            
        }

    }
?>