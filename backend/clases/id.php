<?php
    class Id{
        public static function obtenerIdEmpresa(){
            $contenidoArchivoEmpresas = file_get_contents('../../datos/empresas.json');
            $empresas = json_decode($contenidoArchivoEmpresas, true);

            $longitud = array(
                "longitud" => sizeof($empresas)
            );

            echo json_encode($longitud);
        }

        public static function obtenerIdUsuario(){
            $contenidoArchivoUsuarios = file_get_contents('../../datos/usuarios.json');
            $usuarios = json_decode($contenidoArchivoUsuarios, true);

            $longitud = array(
                "longitud" => sizeof($usuarios)
            );

            echo json_encode($longitud);
        }
    }
