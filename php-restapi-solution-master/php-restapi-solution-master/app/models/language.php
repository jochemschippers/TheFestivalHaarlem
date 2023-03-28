<?php

class Language{
    
        private int $languageID;
        private string $language;
        private string $languageFlag;
        private int $guideID;


        public function __construct(int $languageID, string $language, string $languageFlag, int $guideID){
            $this->languageID = $languageID;
            $this->language = $language;
            $this->languageFlag = $languageFlag;
            $this->guideID = $guideID;
        }
}

?>