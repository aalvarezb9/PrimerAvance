<?php
    class Super{
        
        public static function obtenerSU(){
            $archivo = file_get_contents('../../datos/super-usuario.json');
            echo $archivo;
        }
    }
?>