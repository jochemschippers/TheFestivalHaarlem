<?php

class FoodType{
    
        private int $foodTypeId;
        private string $foodTypeName;

        public function __construct(int $foodTypeId, string $foodTypeName){
            $this->foodTypeId = $foodTypeId;
            $this->foodTypeName = $foodTypeName;
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