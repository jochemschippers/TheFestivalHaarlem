<?php

class JazzArtist{
    
        private int $artistID;
        private string $description;
        private string $image;
        private string $name;
        private array $timeSlots;
        

        public function __construct(int $artistID, string $description, string $image, string $name){
            $this->artistID = $artistID;
            $this->description = $description;
            $this->image = $image;
            $this->name = $name;
            $this->timeSlots = array();
        }

	/**
	 * @return array
	 */
	public function getTimeSlots(): array {
		return $this->timeSlots;
	}

	/**
	 * @param array $timeSlots 
	 * @return self
	 */
	public function setTimeSlots(array $timeSlots): self {
		$this->timeSlots = $timeSlots;
		return $this;
	}

        /**
         * Get the value of artistID
         */ 
        public function getArtistID()
        {
                return $this->artistID;
        }

        /**
         * Set the value of artistID
         *
         * @return  self
         */ 
        public function setArtistID($artistID)
        {
                $this->artistID = $artistID;

                return $this;
        }

        /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        /**
         * Get the value of image
         */ 
        public function getImage()
        {
                return $this->image;
        }

        /**
         * Set the value of image
         *
         * @return  self
         */ 
        public function setImage($image)
        {
                $this->image = $image;

                return $this;
        }

        /**
         * Get the value of name
         */ 
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         *
         * @return  self
         */ 
        public function setName($name)
        {
                $this->name = $name;

                return $this;
        }
}

?>