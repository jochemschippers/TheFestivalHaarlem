<?php

class RestaurantImage{
    
        private int $imageID;
        private int $restaurantID;
        private string $imageLink;
        private int $imageIndex;

		public function __construct(int $imageID, int $restaurantID, string $imageLink, int $imageIndex) {
			$this->imageID = $imageID;
			$this->restaurantID = $restaurantID;
			$this->imageLink = $imageLink;
			$this->imageIndex = $imageIndex;
		}

	/**
	 * @return int
	 */
	public function getImageID(): int {
		return $this->imageID;
	}
	
	/**
	 * @param int $imageID 
	 * @return self
	 */
	public function setImageID(int $imageID): self {
		$this->imageID = $imageID;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getRestaurantID(): int {
		return $this->restaurantID;
	}
	
	/**
	 * @param int $restaurantID 
	 * @return self
	 */
	public function setRestaurantID(int $restaurantID): self {
		$this->restaurantID = $restaurantID;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getImageLink(): string {
		return $this->imageLink;
	}
	
	/**
	 * @param string $imageLink 
	 * @return self
	 */
	public function setImageLink(string $imageLink): self {
		$this->imageLink = $imageLink;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getImageIndex(): int {
		return $this->imageIndex;
	}
	
	/**
	 * @param int $imageIndex 
	 * @return self
	 */
	public function setImageIndex(int $imageIndex): self {
		$this->imageIndex = $imageIndex;
		return $this;
	}
}

?>