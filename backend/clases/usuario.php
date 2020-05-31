<?php
header("Content-Type: application/json");
include_once('tarjeta/tarjeta.php');
    class Usuario{
        private $user;
        private $email;
        private $pw;
        private $gender;
        private $carrito;
        private $pleasures;
        private $images;
        private $purchases;
        private $formaDePago;

        public function __construct(
            $user,
            $email,
            $pw,
            $gender,
            $carrito,
            $pleasures,
            $images,
            $purchases,
            $formaDePago
        )
        {
            $this->user = $user;
            $this->email = $email;
            $this->pw = $pw;
            $this->gender = $gender;
            $this->carrito = $carrito;
            $this->pleasures = $pleasures;
            $this->images = $images;
            $this->purchases = $purchases;
            $this->formaDePago = $formaDePago;
            $this->formaDePago = new Tarjeta($formaDePago[0], $formaDePago[1], $formaDePago[2], $formaDePago[3]);
        }


        /**
         * Get the value of user
         */ 
        public function getUser()
        {
                return $this->user;
        }
        
        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setUser($user)
        {
                $this->user = $user;
                
                return $this;
        }
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        /**
         * Get the value of pw
         */ 
        public function getPw()
        {
                return $this->pw;
        }

        /**
         * Set the value of pw
         *
         * @return  self
         */ 
        public function setPw($pw)
        {
                $this->pw = $pw;

                return $this;
        }

        /**
         * Get the value of gender
         */ 
        public function getGender()
        {
                return $this->gender;
        }

        /**
         * Set the value of gender
         *
         * @return  self
         */ 
        public function setGender($gender)
        {
                $this->gender = $gender;

                return $this;
        }

        /**
         * Get the value of carrito
         */ 
        public function getCarrito()
        {
                return $this->carrito;
        }

        /**
         * Set the value of carrito
         *
         * @return  self
         */ 
        public function setCarrito($carrito)
        {
                $this->carrito[] = $carrito;

                return $this;
        }

        /**
         * Get the value of pleasures
         */ 
        public function getPleasures()
        {
                return $this->pleasures;
        }

        /**
         * Set the value of pleasures
         *
         * @return  self
         */ 
        public function setPleasures($pleasures)
        {
                $this->pleasures = $pleasures;

                return $this;
        }

        /**
         * Get the value of images
         */ 
        public function getImages()
        {
                return $this->images;
        }

        /**
         * Set the value of images
         *
         * @return  self
         */ 
        public function setImages($images)
        {
                $this->images = $images;

                return $this;
        }

        /**
         * Get the value of purchases
         */ 
        public function getPurchases()
        {
                return $this->purchases;
        }

        /**
         * Set the value of purchases
         *
         * @return  self
         */ 
        public function setPurchases($purchases)
        {
                $this->purchases = $purchases;

                return $this;
        }

        

        /**
         * Get the value of formaDePago
         */ 
        public function getFormaDePago()
        {
                return $this->formaDePago;
        }

        /**
         * Set the value of formaDePago
         *
         * @return  self
         */ 
        public function setFormaDePago($formaDePago)
        {
            $this->formaDePago = new Tarjeta($formaDePago["numeroTarjeta"], $formaDePago["fechaVencimiento"], $formaDePago["validoHasta"], $formaDePago["cvv"]);

                return $this;
        }

        public function verificarUsuario(){
                $existeCorreo = null;
                $existeUser = null;
                $contenidoArchivoUsuarios = file_get_contents('../datos/usuarios.json');
                $usuarios = json_decode($contenidoArchivoUsuarios, true);
                for($contadorCorreos = 0; $contadorCorreos < sizeof($usuarios); $contadorCorreos++){
                        if($this->email == $usuarios[$contadorCorreos]['email']){
                                $existeCorreo = true;
                        break;
                        }else{
                                $existeCorreo = false;
                        }
                }

                for($contadorUsers = 0; $contadorUsers < sizeof($usuarios); $contadorUsers++){
                        if($this->user == $usuarios[$contadorUsers]['user']){
                                $existeUser = true;
                        break;
                        }else{
                                $existeUser = false;
                        }
                }


                if($existeCorreo == false && $existeUser == false){
                        $this->guardarUsuario();
                        return true;
                }else{
                        return false;
                }
        }

        public function guardarUsuario(){
                $existe = null;
                $contenidoArchivoUsuarios = file_get_contents('../datos/usuarios.json');
                $usuarios = json_decode($contenidoArchivoUsuarios, true);

                $usuarios[] = array(
                    "user" => $this->user,
                    "email" => $this->email,
                    "pw" => $this->pw,
                    "gender" => $this->gender,
                    "carrito" => $this->carrito,
                    "pleasures" => $this->pleasures,
                    "images" => $this->images,
                    "purchases" => $this->purchases,
                    "formaDePago" => array(
                        "numeroTarjeta" => $this->formaDePago->getNumeroTarjeta(),
                        "nombreTarjeta" => $this->formaDePago->getNombretarjeta(),
                        "validoHasta" => $this->formaDePago->getValidoHasta(),
                        "cvv" => $this->formaDePago->getCvv()
                    )
                );

                $archivo = fopen('../datos/usuarios.json', 'w');
                fwrite($archivo, json_encode($usuarios));
                fclose($archivo);

                // echo json_encode($usuarios);
        }

        public static function obtenerUsuarios(){
            $usuarios = file_get_contents('../datos/usuarios.json');
            echo $usuarios;
        }

        public static function obtenerUnUsuario($id){
            $contenidoArchivoUsuarios = file_get_contents('../datos/usuarios.json');
            $usuarios = json_decode($contenidoArchivoUsuarios, true);
            $usuario = null;
            for($contadorUsuarios = 0; $contadorUsuarios < sizeof($usuarios); $contadorUsuarios++){
                if($usuarios[$contadorUsuarios]['id'] == $id){
                    $usuario = $usuarios[$contadorUsuarios];
                break;
                }
            }

            echo json_encode($usuario);
        }

        public static function eliminarUsuarios(){
                $contenidoArchivoUsuarios = file_get_contents('../datos/usuarios.json');
                $usuarios = json_decode($contenidoArchivoUsuarios, true);
                for($contadorUsuarios = 0; $contadorUsuarios < sizeof($usuarios); $contadorUsuarios++){
                        $usuarios[$contadorUsuarios] = null;
                }

                $archivo = fopen('../datos/usuarios.json', 'w');
                fwrite($archivo, json_encode($usuarios));
                fclose($archivo);

                echo json_encode($usuarios);
        }

        public static function agregarAlCarrito($producto, $user){
                $contenidoArchivoUsuarios = file_get_contents('../datos/usuarios.json');
                $usuarios = json_decode($contenidoArchivoUsuarios, true);
                $usuario = null;
                for($contadorUsers = 0; $contadorUsers < sizeof($usuarios); $contadorUsers++){
                        if($user == $usuarios[$contadorUsers]["user"]){
                                $usuarios[$contadorUsers]["carrito"][] = array(
                                        "nombre" => $producto["nombre"],
                                        "precio" => $producto["precio"],
                                        "categoria" => $producto["categoria"],
                                        "imagen" => $producto["imagen"],
                                        "descripcion" => $producto["descripcion"]
                                );
                                $usuario = $usuarios[$contadorUsers];
                        break;
                        }
                }

                $archivo = fopen('../datos/usuarios.json', 'w');
                fwrite($archivo, json_encode($usuarios));
                fclose($archivo);

                return $usuario;
        }

        public static function agregarAlCarrito2($user, $empresa, $producto, $cantidad){
                $contenidoArchivoUsuarios = file_get_contents('../datos/usuarios.json');
                $usuarios = json_decode($contenidoArchivoUsuarios, true);
                $usuario = null;

                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);

                if($cantidad > $empresas[$empresa]["products"][$producto]["cantidad"]){
                        echo json_encode(array(
                                "estado" => "00",
                                "mensaje" => "La cantidad deseada excede la cantidad disponible"
                        ));
                }else{
                        $empresas[$empresa]["products"][$producto]["cantidad"] = $cantidad;
                        $empresas[$empresa]["products"][$producto]["ne"] = $empresa;
                        for($contadorUsers = 0; $contadorUsers < sizeof($usuarios); $contadorUsers++){
                                if($user == $usuarios[$contadorUsers]["user"]){
                                        $usuarios[$contadorUsers]["carrito"][] = $empresas[$empresa]["products"][$producto];
                                        $usuario = $usuarios[$contadorUsers];
                                break;
                                }
                        }
        
                        $archivo = fopen('../datos/usuarios.json', 'w');
                        fwrite($archivo, json_encode($usuarios));
                        fclose($archivo);
        
                        if($usuario == null){
                                echo json_encode(array(
                                    "estado" => "fracaso"
                                ));
                            }else{
                                echo json_encode(array(
                                    "estado" => "exito"
                                ));
                            }
                }


        }

        public static function obtenerDelCarrito($user, $nameC){
                $contenidoArchivoUsuarios = file_get_contents('../datos/usuarios.json');
                $usuarios = json_decode($contenidoArchivoUsuarios, true);
                $carrito = null;

                for($i = 0; $i < sizeof($usuarios); $i++){
                        if($user == $usuarios[$i]["user"]){
                                for($j = 0; $j < sizeof($usuarios[$i]["carrito"]); $j++){
                                        if($nameC == $usuarios[$i]["carrito"][$j]["nombre"]){
                                                $carrito = $usuarios[$i]["carrito"][$j];
                                        }
                                }
                        break;
                        }
                }

                echo json_encode($carrito);
        }

        public static function obtenerTodoElCarrito($user){
                $contenidoArchivoUsuarios = file_get_contents('../datos/usuarios.json');
                $usuarios = json_decode($contenidoArchivoUsuarios, true);
                $carrito = null;

                for($i = 0; $i < sizeof($usuarios); $i++){
                        if($user == $usuarios[$i]["user"]){
                                $carrito = $usuarios[$i]["carrito"];
                        break;
                        }
                }

                if($carrito == null){
                        echo json_encode(array(
                                "estado" => "fracaso",
                                "carrito" => []
                        ));
                }else{
                        echo json_encode(array(
                                "estado" => "exito",
                                "carrito" => $carrito
                        )); 
                }
        }

        public static function comprar($user, $carrito, $tarjeta){
                $contenidoArchivoUsuarios = file_get_contents('../datos/usuarios.json');
                $usuarios = json_decode($contenidoArchivoUsuarios, true);
                $compra = null;
                $usuario = array();

                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;

                for($i = 0; $i < sizeof($usuarios); $i++){
                        if($user == $usuarios[$i]["user"]){
                                if($usuarios[$i]["formaDePago"]["nombreTarjeta"] == "no ingresada"){
                                        $usuarios[$i]["formaDePago"]["nombreTarjeta"] = $tarjeta["nombreTarjeta"];
                                        $usuarios[$i]["formaDePago"]["numeroTarjeta"] = $tarjeta["numeroTarjeta"];
                                        $usuarios[$i]["formaDePago"]["validoHasta"] = $tarjeta["validoHasta"];
                                        $usuarios[$i]["formaDePago"]["cvv"] = $tarjeta["cvv"];

                                        $archivoUsuarios = fopen('../datos/usuarios.json', 'w');
                                        fwrite($archivoUsuarios, json_encode($usuarios));
                                        fclose($archivoUsuarios);
                                        Usuario::hacerCompra($user, $carrito);
                                }else{
                                        if(
                                                $usuarios[$i]["formaDePago"]["nombreTarjeta"] == $tarjeta["nombreTarjeta"] &&
                                                $usuarios[$i]["formaDePago"]["numeroTarjeta"] == $tarjeta["numeroTarjeta"] &&
                                                $usuarios[$i]["formaDePago"]["validoHasta"] == $tarjeta["validoHasta"] &&
                                                $usuarios[$i]["formaDePago"]["cvv"] == $tarjeta["cvv"]   
                                        ){
                                                Usuario::hacerCompra($user, $carrito);
                                        }else{
                                                echo json_encode(array(
                                                        "estado" => "fracaso",
                                                        "mensaje" => "Credenciales inválidas"
                                                ));
                                        }
                                }
                        break;
                        }
                }
                

        }

        public static function hacerCompra($user, $carrito){
                $contenidoArchivoUsuarios = file_get_contents('../datos/usuarios.json');
                $usuarios = json_decode($contenidoArchivoUsuarios, true);
                $compra = null;
                $usuario = array();

                $contenidoArchivoEmpresas = file_get_contents('../datos/empresas.json');
                $empresas = json_decode($contenidoArchivoEmpresas, true);
                $empresa = null;

                for($i = 0; $i < sizeof($usuarios); $i++){
                        // echo json_encode($usuarios[$i]);
                        if($user == $usuarios[$i]["user"]){
                                // $usuario[] = $usuarios[$i];
                                for($j = 0; $j < sizeof($usuarios[$i]["carrito"]); $j++){
                                        for($k = 0; $k < sizeof($carrito); $k++){
                                                if($usuarios[$i]["carrito"][$j]["nombre"] == $carrito[$k]["nombre"]){
                                                        $usuarios[$i]["purchases"][] = $carrito[$k];    
                                                        array_splice($usuarios[$i]["carrito"], $j, 1);
                                                        $compra = $carrito;
                                                }
                                        }
                                }
                                $usuario = $usuarios[$i];
                        }
                }

                $num = null;
                for($i = 0; $i < sizeof($carrito); $i++){
                        $numEmpresa = intval($carrito[$i]["ne"]);
                        $num[] = $numEmpresa;
                        for($j = 0; $j < sizeof($empresas[$numEmpresa]["products"]); $j++){
                                if($carrito[$i]["nombre"] == $empresas[$numEmpresa]["products"][$j]["nombre"]){
                                        $empresa = true;
                                        $empresas[$numEmpresa]["products"][$j]["cantidad"] -= $carrito[$i]["cantidad"]; 
                                        $empresas[$numEmpresa]["ventas"][] = $carrito[$i];
                                }
                        }
                }

                

                $archivoUsuarios = fopen('../datos/usuarios.json', 'w');
                fwrite($archivoUsuarios, json_encode($usuarios));
                fclose($archivoUsuarios);
                $archivoEmpresas = fopen('../datos/empresas.json', 'w');
                fwrite($archivoEmpresas, json_encode($empresas));
                fclose($archivoEmpresas);

                if($empresa == null && $compra == null){
                        echo json_encode(array(
                                "estado" => "fracaso",
                                "mensaje" => "error"
                        ));
                }else if($compra != null && $empresa == null){
                        echo json_encode(array(
                                "estado" => "01",
                                "mensaje" => "Se hizo la compra, pero no se actualizó en la empresa"
                        ));
                }else{
                        echo json_encode(array(
                                "estado" => "exito",
                                "mensaje" => "Compra realizada"
                        ));   
                }
        }

        public static function obtenerTarjeta($user){
                $contenidoArchivoUsuarios = file_get_contents('../datos/usuarios.json');
                $usuarios = json_decode($contenidoArchivoUsuarios, true);
                $tarjeta = null;

                for($i = 0; $i < sizeof($usuarios); $i++){
                        if($user == $usuarios[$i]["user"]){
                                $tarjeta = $usuarios[$i]["formaDePago"];
                        break;
                        }
                }

                if($tarjeta == null){
                        echo json_encode(array(
                                "estado" => "fracaso"
                        ));
                }else if($tarjeta["numeroTarjeta"] == "no ingresada"){
                        echo json_encode(array(
                                "estado" => "00",
                                "mensaje" => "No se ha ingresado tarjeta"
                        ));
                }else{
                        echo json_encode(array(
                                "estado" => "exito",
                                "formaDePago" => $tarjeta
                        ));
                }
        }

        public static function eliminarDelCarrito($user, $nameC){
                
        }


    }
?>