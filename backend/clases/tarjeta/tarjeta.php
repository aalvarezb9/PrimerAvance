<?php
    class Tarjeta{
        private $numeroTarjeta;
        private $fechaVencimiento;
        private $validoHasta;
        private $cvv;

        public function __construct(
            $numeroTarjeta,
            $fechaVencimiento,
            $validoHasta,
            $cvv)
        {
            $this->numeroTarjeta = $numeroTarjeta;
            $this->fechaVencimiento = $fechaVencimiento;
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
         * Get the value of fechaVencimiento
         */ 
        public function getFechaVencimiento()
        {
                return $this->fechaVencimiento;
        }

        /**
         * Set the value of fechaVencimiento
         *
         * @return  self
         */ 
        public function setFechaVencimiento($fechaVencimiento)
        {
                $this->fechaVencimiento = $fechaVencimiento;

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