<?php
    class Login{
        public static function validarUsuario($correo, $contrasena){
            $contenidoArchivoUsuarios = file_get_contents('../../datos/usuarios.json');
            $usuarios = json_decode($contenidoArchivoUsuarios, true);
            $verificacion = array(
                "usuarioExiste" => null,
                "contraExiste" => null
            );
            $usuario = null;
            for($i = 0; $i < sizeof($usuarios); $i++){
                if($usuarios[$i]['email'] == $correo){
                    $verificacion["usuarioExiste"] = true;
                    if($usuarios[$i]['pw'] == $contrasena){
                        $verificacion["contraExiste"] = true;
                        $usuario = $usuarios[$i];
                    break;
                    }else{
                        $verificacion["contraExiste"] = false;
                    }
                break;
                }
            }

            echo json_encode($usuario);
            
        }

    }
?>