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
                        // echo json_encode(array(
                        //         "user" => $this->user,
                        //         "existeCorreo" => $existeCorreo,
                        //         "existeUser" => $existeUser,
                        //         "mensaje" => "Sí se puede registrar el usuario"
                        // ));
                        $this->guardarUsuario();
                        return true;
                }//elseif($existeCorreo == false && $existeUser == true){
                //         echo json_encode(array(
                //                 "existeCorreo" => $existeCorreo,
                //                 "existeUser" => $existeUser,
                //                 "mensaje" => "NO se puede registrar, usuario ya existente"
                //         ));
                        
                // }elseif($existeCorreo == true && $existeUser == false){
                //         echo json_encode(array(
                //                 "existeCorreo" => $existeCorreo,
                //                 "existeUser" => $existeUser,
                //                 "mensaje" => "NO se puede registrar, correo ya existente"
                //         ));
                        
                // }elseif($existeCorreo == true && $existeUser == true){
                //         echo json_encode(array(
                //                 "existeCorreo" => $existeCorreo,
                //                 "existeUser" => $existeUser,
                //                 "mensaje" => "NO se puede registrar, correo y user ya existentes"
                //         ));
                        
                // }
                else{
                        return false;
                        // echo json_encode(array(
                        //         "existeCorreo" => $existeCorreo,
                        //         "existeUser" => $existeUser,
                        //         "mensaje" => null
                        // ));
                        
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
                        "fechaVencimiento" => $this->formaDePago->getFechaVencimiento(),
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

        public function agregarAlCarrito($usuario){

        }


    }
?>