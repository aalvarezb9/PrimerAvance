<?php
    class Producto{
        private $nombre;
        private $precio;
        private $categoria;
        private $cantidad;
        private $imagen;
        private $codigoQR;

        public function __construct(
            $nombre,
            $precio,
            $categoria,
            $cantidad,
            $imagen,
            $codigoQR
        )
        {
            $this->nombre = $nombre;
            $this->precio = $precio;
            $this->categoria = $categoria;
            $this->cantidad = $cantidad;
            $this->imagen = $imagen;
            $this->codigo = $codigoQR;
        }

        /**
         * Get the value of nombre
         */ 
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         *
         * @return  self
         */ 
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of precio
         */ 
        public function getPrecio()
        {
                return $this->precio;
        }

        /**
         * Set the value of precio
         *
         * @return  self
         */ 
        public function setPrecio($precio)
        {
                $this->precio = $precio;

                return $this;
        }

        /**
         * Get the value of categoria
         */ 
        public function getCategoria()
        {
                return $this->categoria;
        }

        /**
         * Set the value of categoria
         *
         * @return  self
         */ 
        public function setCategoria($categoria)
        {
                $this->categoria = $categoria;

                return $this;
        }

        /**
         * Get the value of cantidad
         */ 
        public function getCantidad()
        {
                return $this->cantidad;
        }

        /**
         * Set the value of cantidad
         *
         * @return  self
         */ 
        public function setCantidad($cantidad)
        {
                $this->cantidad = $cantidad;

                return $this;
        }

        /**
         * Get the value of imagen
         */ 
        public function getImagen()
        {
                return $this->imagen;
        }

        /**
         * Set the value of imagen
         *
         * @return  self
         */ 
        public function setImagen($imagen)
        {
                $this->imagen = $imagen;

                return $this;
        }

        /**
         * Get the value of codigoQR
         */ 
        public function getCodigoQR()
        {
                return $this->codigoQR;
        }

        /**
         * Set the value of codigoQR
         *
         * @return  self
         */ 
        public function setCodigoQR($codigoQR)
        {
                $this->codigoQR = $codigoQR;

                return $this;
        }
    }
?>