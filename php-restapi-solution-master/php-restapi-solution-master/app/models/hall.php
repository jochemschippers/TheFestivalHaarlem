<?php

class Hall{
    
        private int $hallID;
        private int $locationID;
        private string $hallName;


        public function __construct(int $hallID, int $locationID, string $hallName){
            $this->hallID = $hallID;
            $this->locationID = $locationID;
            $this->hallName = $hallName;
        }
}

?>