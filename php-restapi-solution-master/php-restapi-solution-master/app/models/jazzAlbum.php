<?php

class jazzAlbum{
    
        private int $artistID;
        private int $albumID;
        private string $image;
        private string $title;
        private string $spotifyLink;
        private string $appleLink;


        public function __construct(int $artistID, int $albumID, string $image, string $title, string $spotifyLink, string $appleLink){
            $this->artistID = $artistID;
            $this->albumID = $albumID;
            $this->image = $image;
            $this->title = $title;
            $this->spotifyLink = $spotifyLink;
            $this->appleLink = $appleLink;
        }
}

?>