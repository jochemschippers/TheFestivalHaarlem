<?php

class Guide{
    
        private int $guideID;
        private string $guideName;
        private int $languageID;


        public function __construct(int $guideID, string $guideName, int $languageID){
            $this->guideID = $guideID;
            $this->guideName = $guideName;
            $this->languageID = $languageID;
        }
}

?>