<?php 
include_once('productos/producto.php');
include_once('social/social.php');
    class Empresa{
        private $name;
        // private $idE;
        private $emailEmpresa;
        private $pwEmpresa;
        private $country;
        private $address;
        private $banner;
        private $offer;
        private $imagesEmpresa;
        private $social;

        public function __construct(
            $name,
        //     $idE,
            $emailEmpresa,
            $pwEmpresa,
            $country,
            $address,
            $banner,
            $offer,
            $imagesEmpresa,
            $social
        )
        {
            $this->name = $name; 
        //     $this->idE = $idE;
            $this->emailEmpresa = $emailEmpresa;     
            $this->pwEmpresa = $pwEmpresa;  
            $this->country = $country;  
            $this->address = $address;
            $this->banner = $banner;  
            $this->offer = $offer;  
            $this->imagesEmpresa = $imagesEmpresa;  
            //0: nombre, 1: precio, 2: categoría, 3: cantidad, 4: imagen, 5: código QR, 6: descripción
            //$this->products = $products;//new Producto($products[0], $products[1], $products[2], $products[3], $products[4], $products[5]); //$products;
            //0: facebook, 1: snapchat, 2: instagram, 3: youtube
            $this->social = new Social($social[0], $social[1], $social[2], $social[3]);  
        }


        /**
         * Get the value of name
         */ 
        public function getName()
        {
            return $this->name;
        }
        
        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
            $this->name = $name;
            
            return $this;
        }
        
        /**
         * Get the value of idE
         */ 
        public function getIdE()
        {
                return $this->idE;
        }

        /**
         * Set the value of idE
         *
         * @return  self
         */ 
        public function setIdE($idE)
        {
                $this->idE = $idE;

                return $this;
        }

        /**
         * Get the value of emailEmpresa
         */ 
        public function getEmailEmpresa()
        {
                return $this->emailEmpresa;
        }

        /**
         * Set the value of emailEmpresa
         *
         * @return  self
         */ 
        public function setEmailEmpresa($emailEmpresa)
        {
                $this->emailEmpresa = $emailEmpresa;

                return $this;
        }

        /**
         * Get the value of pwEmpresa
         */ 
        public function getPwEmpresa()
        {
                return $this->pwEmpresa;
        }

        /**
         * Set the value of pwEmpresa
         *
         * @return  self
         */ 
        public function setPwEmpresa($pwEmpresa)
        {
                $this->pwEmpresa = $pwEmpresa;

                return $this;
        }

        /**
         * Get the value of country
         */ 
        public function getCountry()
        {
                return $this->country;
        }

        /**
         * Set the value of country
         *
         * @return  self
         */ 
        public function setCountry($country)
        {
                $this->country = $country;

                return $this;
        }

        /**
         * Get the value of address
         */ 
        public function getAddress()
        {
                return $this->address;
        }

        /**
         * Set the value of address
         *
         * @return  self
         */ 
        public function setAddress($address)
        {
                $this->address = $address;

                return $this;
        }

        /**
         * Get the value of banner
         */ 
        public function getBanner()
        {
                return $this->banner;
        }

        /**
         * Set the value of banner
         *
         * @return  self
         */ 
        public function setBanner($banner)
        {
                $this->banner = $banner;

                return $this;
        }

        /**
         * Get the value of offer
         */ 
        public function getOffer()
        {
                return $this->offer;
        }

        /**
         * Set the value of offer
         *
         * @return  self
         */ 
        public function setOffer($offer)
        {
                $this->offer = $offer;

                return $this;
        }

        /**
         * Get the value of imagesEmpresa
         */ 
        public function getImagesEmpresa()
        {
                return $this->imagesEmpresa;
        }

        /**
         * Set the value of imagesEmpresa
         *
         * @return  self
         */ 
        public function setImagesEmpresa($imagesEmpresa)
        {
                $this->imagesEmpresa = $imagesEmpresa;

                return $this;
        }

        /**
         * Get the value of products
         */ 
        public function getProducts()
        {
                return $this->products;
        }

        /**
         * Set the value of products
         *
         * @return  self
         */ 
        public function setProducts($products)
        {
                $this->products = new Producto($products[0], $products[1], $products[2], $products[3], $products[4], $products[5]);

                return $this;
        }

        /**
         * Get the value of social
         */ 
        public function getSocial()
        {
                return $this->social;
        }

        /**
         * Set the value of social
         *
         * @return  self
         */ 
        public function setSocial($social)
        {
                $this->social = new Social($social[0], $social[1], $social[2], $social[3]);

                return $this;
        }

        public function verificarEmpresa(){
                $existeCorreo = null;
                $existeName = null;
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                for($contadorCorreos = 0; $contadorCorreos < sizeof($empresas); $contadorCorreos++){
                        if($this->emailEmpresa == $empresas[$contadorCorreos]['emailEmpresa']){
                                $existeCorreo = true;
                        break;
                        }else{
                                $existeCorreo = false;
                        }
                }

                for($contadorNames = 0; $contadorNames < sizeof($empresas); $contadorNames++){
                        if($this->name == $empresas[$contadorNames]['name']){
                                $existeName = true;
                        break;
                        }else{
                                $existeName = false;
                        }
                }


                if($existeCorreo == false && $existeName == false){
                        // echo json_encode(array(
                        //         "existeCorreo" => $existeCorreo,
                        //         "existeName" => $existeName,
                        //         "mensaje" => "Sí se puede registrar"
                        // ));
                        $this->agregarEmpresa();
                        return true;
                // }elseif($existeCorreo == false && $existeName == true){
                //         echo json_encode(array(
                //                 "existeCorreo" => $existeCorreo,
                //                 "existeName" => $existeName,
                //                 "mensaje" => "NO se puede registrar, nombre ya existente"
                //         ));
                // }elseif($existeCorreo == true && $existeName == false){
                //         echo json_encode(array(
                //                 "existeCorreo" => $existeCorreo,
                //                 "existeName" => $existeName,
                //                 "mensaje" => "NO se puede registrar, correo ya existente"
                //         ));
                // }elseif($existeCorreo == true && $existeName == true){
                //         echo json_encode(array(
                //                 "existeCorreo" => $existeCorreo,
                //                 "existeName" => $existeName,
                //                 "mensaje" => "NO se puede registrar, correo y nombre ya existentes"
                //         ));
                }else{
                        return false;
                        // echo json_encode(array(
                        //         "existeCorreo" => $existeCorreo,
                        //         "existeName" => $existeName,
                        //         "mensaje" => null
                        // ));
                }
        }

        public function agregarEmpresa(){
            $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
            $empresas = json_decode($contenidoArchivoEmpresas, true);
            $empresas[] = array(
                "name" => $this->name,
                // "idE" => $this->idE,
                "emailEmpresa" => $this->emailEmpresa,
                "pwEmpresa" => $this->pwEmpresa,
                "country" => $this->country,
                "address" => $this->address,
                "banner" => $this->banner,
                "offer" => $this->offer,
                "imagesEmpresa" => $this->imagesEmpresa,
                "social" => array(
                    "facebook" => $this->social->getFacebook(),
                    "snapchat" => $this->social->getSnapchat(),
                    "instagram" => $this->social->getInstagram(),
                    "youtube" => $this->social->getYoutube()
                ),
                "ventas" => array()
            );

            $archivo = fopen('../datos/empresas.json', 'w');
            fwrite($archivo, json_encode($empresas));
            fclose($archivo);

        //     echo json_encode($empresas);
        }

        public static function obtenerEmpresas(){
            $empresas = file_get_contents('../datos/empresas.json');
            echo $empresas;
        }

        public static function obtenerUnaEmpresa($idE){
            $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
            $empresas = json_decode($contenidoArchivoEmpresas, true);
            $empresa = null;
            for($contadorEmpresas = 0; $contadorEmpresas < sizeof($empresas); $contadorEmpresas++){
                if($empresas[$contadorEmpresas]['idE'] == $idE){
                    $empresa = $empresas[$contadorEmpresas];
                break;
                }
            }

            echo json_encode($empresa);
        }

        public static function obtenerCodigoEmpresa(){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);

                $longitud = array(
                        "longitud" => sizeof($empresas)
                );

                echo json_encode($longitud);
        }

        public static function longitud(){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                echo json_encode(sizeof($empresas));
        }

        public static function agregarProductoAEmpresa($name, $producto){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;

                for($contadorEmpresas = 0; $contadorEmpresas < sizeof($empresas); $contadorEmpresas++){
                        if($empresas[$contadorEmpresas]['name'] == $name){
                                $empresas[$contadorEmpresas]['products'][] = array(
                                        "nombre" => $producto['nombre'],
                                        "precio" => $producto['precio'],
                                        "categoria" => $producto['categoria'],
                                        "cantidad" => $producto['cantidad'],
                                        "imagen" => $producto['imagen'],
                                        "codigoQR" => sha1($producto['codigoQR']),
                                        "descripcion" => $producto['descripcion']
                                );
                                $empresa = $empresas[$contadorEmpresas];
                        break;
                        }
                }

                $archivo = fopen('../datos/empresas.json', 'w');
                fwrite($archivo, json_encode($empresas));
                fclose($archivo);
                if($empresa != null){
                        return $empresa;
                }else{
                        return $empresa;
                }
        }

        public static function agregarSucursalAEmpresa($name, $sucursal){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;

                for($contadorEmpresas = 0; $contadorEmpresas < sizeof($empresas); $contadorEmpresas++){
                        if($empresas[$contadorEmpresas]['name'] == $name){
                                $empresas[$contadorEmpresas]['sucursal'][] = array(
                                        "nombre" => $sucursal['nombre'],
                                        "latitud" => $sucursal['latitud'],
                                        "longitud" => $sucursal['longitud'],
                                        "codigoPostal" => $sucursal['codigoPostal']
                                );
                                $empresa = $empresas[$contadorEmpresas];
                        break;
                        }
                }

                $archivo = fopen('../datos/empresas.json', 'w');
                fwrite($archivo, json_encode($empresas));
                fclose($archivo);
                if($empresa != null){
                        return $empresa;
                        
                }else{
                        return false;
                }
        }

        public static function obtenerOfferEmpresa($name){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;

                for($i = 0; $i < sizeof($empresas); $i++){
                        if($name == $empresas[$i]["name"]){
                                $empresa = $empresas[$i]["offer"];
                        break;
                        }
                }

                if($empresa == null){
                        echo json_encode(array(
                                "estado" => "fracaso",
                                "offer" => ''
                        ));
                }else{
                        echo json_encode(array(
                                "estado" => "exito",
                                "offer" => $empresa
                        ));
                }
        }

        public static function obtenerEmailEmpresa($name){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;

                for($i = 0; $i < sizeof($empresas); $i++){
                        if($name == $empresas[$i]["name"]){
                                $empresa = $empresas[$i]["emailEmpresa"];
                        break;
                        }
                }

                if($empresa == null){
                        echo json_encode(array(
                                "estado" => "fracaso",
                                "email" => ''
                        ));
                }else{
                        echo json_encode(array(
                                "estado" => "exito",
                                "email" => $empresa
                        ));
                }
        }

        public static function obtenerDireccionEmpresa($name){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;

                for($i = 0; $i < sizeof($empresas); $i++){
                        if($name == $empresas[$i]["name"]){
                                $empresa = $empresas[$i]["address"];
                        break;
                        }
                }

                if($empresa == null){
                        echo json_encode(array(
                                "estado" => "fracaso",
                                "direccion" => ''
                        ));
                }else{
                        echo json_encode(array(
                                "estado" => "exito",
                                "direccion" => $empresa
                        ));
                }
        }

        public static function obtenerRedesSociales($name){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;

                for($i = 0; $i < sizeof($empresas); $i++){
                        if($name == $empresas[$i]["name"]){
                                $empresa = $empresas[$i]["social"];
                        break;
                        }
                }

                if($empresa == null){
                        echo json_encode(array(
                                "estado" => "fracaso",
                                "social" => ''
                        ));
                }else{
                        echo json_encode(array(
                                "estado" => "exito",
                                "social" => $empresa
                        ));
                }
        }

        public static function obtenerNombreSucursales($name){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = array();

                for($i = 0; $i < sizeof($empresas); $i++){
                        if($name == $empresas[$i]["name"]){
                                for($j = 0; $j < sizeof($empresas[$i]["sucursal"]); $j++){
                                        $empresa[] = $empresas[$i]["sucursal"][$j]["nombre"];
                                }
                        break;
                        }
                }

                if($empresa == null){
                        echo json_encode(array(
                                "estado" => "fracaso",
                                "nombreSucursales" => ''
                        ));
                }else{
                        echo json_encode(array(
                                "estado" => "exito",
                                "nombreSucursales" => $empresa
                        ));
                }
        }

        public static function obtenerBanners($name){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = array();

                for($i = 0; $i < sizeof($empresas); $i++){
                        if($name == $empresas[$i]["name"]){
                                for($j = 0; $j < sizeof($empresas[$i]["banner"]); $j++){
                                        $empresa[] = $empresas[$i]["banner"][$j];
                                }
                        break;
                        }
                }

                echo json_encode(array(
                        "estado" => "exito",
                        "banner" => $empresa
                ));

                // if(sizeof($empresa) == 0){
                //         echo json_encode(array(
                //                 "estado" => "fracaso",
                //                 "banner" => ''
                //         ));
                // }else{
                //         echo json_encode(array(
                //                 "estado" => "exito",
                //                 "banner" => $empresa
                //         ));
                // }
        }

        public static function obtenerUnaSucursal($name, $id){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;

                for($i = 0; $i < sizeof($empresas); $i++){
                        if($name == $empresas[$i]["name"]){
                                $empresa = $empresas[$i]["sucursal"][$id];
                        break;
                        }
                }

                if($empresa == null){
                        echo json_encode(array(
                                "estado" => "fracaso",
                                "sucursal" => ''
                        ));
                }else{
                        echo json_encode(array(
                                "estado" => "exito",
                                "sucursal" => $empresa
                        ));
                }
        }

        public static function obtenerProductos($name){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = array();

                for($i = 0; $i < sizeof($empresas); $i++){
                        if($name == $empresas[$i]["name"]){
                                if($empresas[$i]["products"]){
                                        for($j = 0; $j < sizeof($empresas[$i]["products"]); $j++){
                                                $empresa[] = $empresas[$i]["products"][$j];
                                        }
                                }else{
                                        $empresa = array();
                                }
                        break;
                        }
                }

                echo json_encode(array(
                        "estado" => "exito",
                        "products" => $empresa
                ));
        }

        public static function eliminarCantidadProductos($name, $cantidad, $nombreP){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;

                for($i = 0; $i < sizeof($empresas); $i++){
                        if($name == $empresas[$i]["name"]){
                                for($j = 0; $j < sizeof($empresas[$i]["products"]); $j++){
                                        if($nombreP == $empresas[$i]["products"][$j]["nombre"]){
                                                if($cantidad > $empresas[$i]["products"][$j]["cantidad"]){
                                                        $empresas[$i]["products"][$j]["cantidad"] = 0;
                                                }else{
                                                        $empresas[$i]["products"][$j]["cantidad"] -= $cantidad;
                                                }
                                                $empresa = $empresas[$i];
                                        break;
                                        }
                                }
                        break;
                        }
                }

                $archivo = fopen('../datos/empresas.json', 'w');
                fwrite($archivo, json_encode($empresas));
                fclose($archivo);

                if($empresa == null){
                        echo json_encode(array(
                                "estado" => "fracaso"
                        ));
                }else{
                        echo json_encode(array(
                                "estado" => "exito"
                        ));
                }
        }

        public static function aumentarCantidadProductos($name, $cantidad, $nombreP){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;

                for($i = 0; $i < sizeof($empresas); $i++){
                        if($name == $empresas[$i]["name"]){
                                for($j = 0; $j < sizeof($empresas[$i]["products"]); $j++){
                                        if($nombreP == $empresas[$i]["products"][$j]["nombre"]){        
                                                $empresas[$i]["products"][$j]["cantidad"] += $cantidad;                                               
                                                $empresa = $empresas[$i];
                                        break;
                                        }
                                }
                        break;
                        }
                }

                $archivo = fopen('../datos/empresas.json', 'w');
                fwrite($archivo, json_encode($empresas));
                fclose($archivo);

                if($empresa == null){
                        echo json_encode(array(
                                "estado" => "fracaso",
                                "e" => $empresa
                        ));
                }else{
                        echo json_encode(array(
                                "estado" => "exito"
                        ));
                }
        }
        
        public static function cambiarPrecioProducto($name, $nuevoPrecio, $nombreP){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;

                for($i = 0; $i < sizeof($empresas); $i++){
                        if($name == $empresas[$i]["name"]){
                                for($j = 0; $j < sizeof($empresas[$i]["products"]); $j++){
                                        if($nombreP == $empresas[$i]["products"][$j]["nombre"]){        
                                                $empresas[$i]["products"][$j]["precio"] = $nuevoPrecio;                                               
                                                $empresa = $empresas[$i];
                                        break;
                                        }
                                }
                        break;
                        }
                }

                $archivo = fopen('../datos/empresas.json', 'w');
                fwrite($archivo, json_encode($empresas));
                fclose($archivo);

                if($empresa == null){
                        echo json_encode(array(
                                "estado" => "fracaso",
                        ));
                }else{
                        echo json_encode(array(
                                "estado" => "exito"
                        ));
                }
        }

        public static function obtenerTodosLosProductos(){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $info = array();
                $productos = array();
                $venderora = null;

                for($i = 0; $i < sizeof($empresas); $i++){
                        // $info[] = array(
                        //         "empresaVendedora" => $empresas[$i]["name"]
                        // );
                        for($j = 0; $j < sizeof($empresas[$i]["products"]); $j++){
                                // $productos[] = $empresas[$i]["products"][$j];
                                $info[$i] = array(
                                        "name" => $empresas[$i]["name"],
                                        "productos" => $empresas[$i]["products"]
                                );
                        }
                }

                // for($i = 0; $i < sizeof($empresas); $i++){
                //         $empresas[$i]["products"] = 
                // }

                if($info == null){
                        echo json_encode(array(
                                "estado" => "fracaso"
                        ));
                }else{
                        echo json_encode(array(
                                "estado" => "exito",
                                "info" => $info
                        ));  
                }
        }

        public static function obtenerProductosInicio(){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;

                for($i = 0; $i < sizeof($empresas); $i++){
                        for($j = 0; $j < sizeof($empresas[$i]["products"]); $j++){
                                $empresa[] = $empresas[$i]["products"][$j];
                        }
                }

                echo json_encode($empresa);
        }

        public static function actualizarEmpresa($name, $nEmpresa){
                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;
                
                for($contadorEmpresas = 0; $contadorEmpresas < sizeof($empresas); $contadorEmpresas++){
                        error_reporting(0);
                        if($empresas[$contadorEmpresas]['name'] == $name){
                                $empresas[$contadorEmpresas]["imagesEmpresa"][] = $nEmpresa["imagesEmpresa"];
                                $empresas[$contadorEmpresas]["banner"][] = $nEmpresa["banner"];
                                $empresas[$contadorEmpresas] = array(
                                        "name" => $nEmpresa["name"],
                                        "emailEmpresa" => $nEmpresa["emailEmpresa"],
                                        "pwEmpresa" => sha1($nEmpresa["pwEmpresa"]),
                                        "country" => $nEmpresa["country"],
                                        "address" => $nEmpresa["address"],
                                        "offer" => $nEmpresa["offer"],
                                        "imagesEmpresa" =>  $empresas[$contadorEmpresas]["imagesEmpresa"],
                                        "banner" =>  $empresas[$contadorEmpresas]["banner"],
                                        "social" => array(
                                                "facebook" => $nEmpresa["social"]["facebook"],
                                                "instagram" => $nEmpresa["social"]["instagram"],
                                                "snapchat" => $nEmpresa["social"]["snapchat"],
                                                "youtube" => $nEmpresa["social"]["youtube"]
                                        ),
                                        "products" => $empresas[$contadorEmpresas]["products"],
                                        "sucursal" => $empresas[$contadorEmpresas]["sucursal"],
                                        "ventas" => $empresas[$contadorEmpresas]["ventas"]
                                );

                                $empresa = $empresas[$contadorEmpresas];
                        break;
                        }
                }

                $archivo = fopen('../datos/empresas.json', 'w');
                fwrite($archivo, json_encode($empresas));
                fclose($archivo);

                if($empresa != null){
                        return $empresa;
                }else{
                        return $empresa;
                }

        }
    }

?>

