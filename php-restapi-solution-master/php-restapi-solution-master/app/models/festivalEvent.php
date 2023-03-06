<?php

class FestivalEvent {
    
        private int $eventID;
        private string $eventTitle;
        private string $bannerImage;
        private string $bannerDescription;

        public function __construct(int $eventID, string $eventTitle, string $bannerImage, string $bannerDescription){
            $this->eventID = $eventID;
            $this->eventTitle = $eventTitle;
            $this->bannerImage = $bannerImage;
            $this->bannerDescription = $bannerDescription;
        }
}

?>