<?php
    class Tarjeta{
        private $numeroTarjeta;
        private $nombreTarjeta;
        private $validoHasta;
        private $cvv;

        public function __construct(
            $numeroTarjeta,
            $nombreTarjeta,
            $validoHasta,
            $cvv)
        {
            $this->numeroTarjeta = $numeroTarjeta;
            $this->nombreTarjeta = $nombreTarjeta;
            $this->validoHasta = $validoHasta;
            $this->cvv = $cvv;
        }


        /**
         * Get the value of numeroTarjeta
         */ 
        public function getNumeroTarjeta()
        {
                return $this->numeroTarjeta;
        }

        /**
         * Set the value of numeroTarjeta
         *
         * @return  self
         */ 
        public function setNumeroTarjeta($numeroTarjeta)
        {
                $this->numeroTarjeta = $numeroTarjeta;

                return $this;
        }

        /**
         * Get the value of nombreTarjeta
         */ 
        public function getNombreTarjeta()
        {
                return $this->nombreTarjeta;
        }

        /**
         * Set the value of nombreTarjeta
         *
         * @return  self
         */ 
        public function setNombreTarjeta($nombreTarjeta)
        {
                $this->nombreTarjeta = $nombreTarjeta;

                return $this;
        }

        /**
         * Get the value of validoHasta
         */ 
        public function getValidoHasta()
        {
                return $this->validoHasta;
        }

        /**
         * Set the value of validoHasta
         *
         * @return  self
         */ 
        public function setValidoHasta($validoHasta)
        {
                $this->validoHasta = $validoHasta;

                return $this;
        }

        /**
         * Get the value of cvv
         */ 
        public function getCvv()
        {
                return $this->cvv;
        }

        /**
         * Set the value of cvv
         *
         * @return  self
         */ 
        public function setCvv($cvv)
        {
                $this->cvv = $cvv;

                return $this;
        }
    }

?>