<?php
session_start();
    class Super{
        
        public static function obtenerSU($user, $contra){
            error_reporting(0);
            $archivo = file_get_contents('../datos/super-usuario.json');
            $arc = json_decode($archivo, true);
            $res = null;
            if($user == $arc['usuario'] && $contra == $arc['pass']){
                $res = array(
                    "usuario" => $user,
                    "estado" => "exito",
                    "token" => sha1(uniqid(rand(), true))
                );

            }

            return $res;
        }
    }
?>