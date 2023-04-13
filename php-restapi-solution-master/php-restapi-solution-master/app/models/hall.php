<?php

class Hall{
    
        private int $hallID;
        private int $locationID;
        private string $hallName;


        public function __construct(int $hallID = 0, int $locationID = 0, string $hallName = ''){
            $this->hallID = $hallID;
            $this->locationID = $locationID;
            $this->hallName = $hallName;
        }

        /**
         * Get the value of hallID
         */ 
        public function getHallID()
        {
                return $this->hallID;
        }

        /**
         * Set the value of hallID
         *
         * @return  self
         */ 
        public function setHallID($hallID)
        {
                $this->hallID = $hallID;

                return $this;
        }

        /**
         * Get the value of locationID
         */ 
        public function getLocationID()
        {
                return $this->locationID;
        }

        /**
         * Set the value of locationID
         *
         * @return  self
         */ 
        public function setLocationID($locationID)
        {
                $this->locationID = $locationID;

                return $this;
        }

        /**
         * Get the value of hallName
         */ 
        public function getHallName()
        {
                return $this->hallName;
        }

        /**
         * Set the value of hallName
         *
         * @return  self
         */ 
        public function setHallName($hallName)
        {
                $this->hallName = $hallName;

                return $this;
        }
}

?>