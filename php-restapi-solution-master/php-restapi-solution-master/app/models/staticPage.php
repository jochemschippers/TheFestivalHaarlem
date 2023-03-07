<?php

class StaticPage{
    
        private int $pageID;
        private string $bannerImage;
        private string $title;
        private string $secondTitle;
        private int $description;


        public function __construct(int $pageID, string $bannerImage, string $title, string $secondTitle, int $description){
            $this->pageID = $pageID;
            $this->bannerImage = $bannerImage;
            $this->title = $title;
            $this->secondTitle = $secondTitle;
            $this->description = $description;
        }
}

?>