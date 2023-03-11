<?php

class RestaurantFoodType{
    
        private int $restaurantID;
		private int $foodTypeId;
		private string $foodTypeName;


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
	 * @return int
	 */
	public function getFoodTypeId(): int {
		return $this->foodTypeId;
	}
	
	/**
	 * @param int $foodTypeId 
	 * @return self
	 */
	public function setFoodTypeId(int $foodTypeId): self {
		$this->foodTypeId = $foodTypeId;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFoodTypeName(): string {
		return $this->foodTypeName;
	}
	
	/**
	 * @param string $foodTypeName 
	 * @return self
	 */
	public function setFoodTypeName(string $foodTypeName): self {
		$this->foodTypeName = $foodTypeName;
		return $this;
	}
}

?>