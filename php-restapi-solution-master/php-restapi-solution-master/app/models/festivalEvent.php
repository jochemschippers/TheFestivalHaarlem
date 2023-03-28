<?php

class FestivalEvent {
    
        private int $eventID;
        private string $eventName;
        private string $bannerImage;
        private string $bannerDescription;
        private string $eventTitle;


        public function getEventID(): int {
                return $this->eventID;
            }
        
            public function setEventID(int $eventID): void {
                $this->eventID = $eventID;
            }
        
            public function getEventName(): string {
                return $this->eventName;
            }
        
            public function setEventName(string $eventName): void {
                $this->eventName = $eventName;
            }
        
            public function getBannerImage(): string {
                return $this->bannerImage;
            }
        
            public function setBannerImage(string $bannerImage): void {
                $this->bannerImage = $bannerImage;
            }
        
            public function getBannerDescription(): string {
                return $this->bannerDescription;
            }
        
            public function setBannerDescription(string $bannerDescription): void {
                $this->bannerDescription = $bannerDescription;
            }
            public function getEventTitle(): string {
                return $this->eventTitle;
            }
        
            public function setEventTitle(string $eventTitle): void {
                $this->eventTitle = $eventTitle;
            }
}

?>