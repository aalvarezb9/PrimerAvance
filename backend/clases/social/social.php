<?php 
    class Social{
        private $facebook;
        private $snapchat;
        private $instagram;
        private $youtube;

        public function __construct(
            $facebook,
            $snapchat,
            $instagram,
            $youtube
        )
        {
            $this->facebook = $facebook;
            $this->snapchat = $snapchat;
            $this->instagram = $instagram;
            $this->youtube = $youtube;
        }

        

        /**
         * Get the value of facebook
         */ 
        public function getFacebook()
        {
                return $this->facebook;
        }

        /**
         * Set the value of facebook
         *
         * @return  self
         */ 
        public function setFacebook($facebook)
        {
                $this->facebook = $facebook;

                return $this;
        }

        /**
         * Get the value of snapchat
         */ 
        public function getSnapchat()
        {
                return $this->snapchat;
        }

        /**
         * Set the value of snapchat
         *
         * @return  self
         */ 
        public function setSnapchat($snapchat)
        {
                $this->snapchat = $snapchat;

                return $this;
        }

        /**
         * Get the value of instagram
         */ 
        public function getInstagram()
        {
                return $this->instagram;
        }

        /**
         * Set the value of instagram
         *
         * @return  self
         */ 
        public function setInstagram($instagram)
        {
                $this->instagram = $instagram;

                return $this;
        }

        /**
         * Get the value of youtube
         */ 
        public function getYoutube()
        {
                return $this->youtube;
        }

        /**
         * Set the value of youtube
         *
         * @return  self
         */ 
        public function setYoutube($youtube)
        {
                $this->youtube = $youtube;

                return $this;
        }
    }
    
?>