<?php

class RestaurantMenuItem{
    
	private int $menuItemID;
	private int $restaurantID;
	private int $courseID;
	private string $name;
	private ?string $description;
	private float $price;
	private ?string $specialty;

	public function __construct(int $menuItemID, int $restaurantID, int $courseID, string $name, ?string $description, float $price, ?string $specialty) {
		$this->menuItemID = $menuItemID;
		$this->restaurantID = $restaurantID;
		$this->courseID = $courseID;
		$this->name = $name;
		$this->description = $description;
		$this->price = $price;
		$this->specialty = $specialty;
	}

	/**
	 * @return int
	 */
	public function getMenuItemID(): int {
		return $this->menuItemID;
	}
	
	/**
	 * @param int $menuItemID 
	 * @return self
	 */
	public function setMenuItemID(int $menuItemID): self {
		$this->menuItemID = $menuItemID;
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
	 * @return int
	 */
	public function getCourseID(): int {
		return $this->courseID;
	}
	
	/**
	 * @param int $courseID 
	 * @return self
	 */
	public function setCourseID(int $courseID): self {
		$this->courseID = $courseID;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}
	
	/**
	 * @param string $name 
	 * @return self
	 */
	public function setName(string $name): self {
		$this->name = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription(): ?string {
		return $this->description;
	}
	
	/**
	 * @param string $description 
	 * @return self
	 */
	public function setDescription(?string $description): self {
		$this->description = $description;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getPrice(): float {
		return $this->price;
	}
	
	/**
	 * @param float $price 
	 * @return self
	 */
	public function setPrice(float $price): self {
		$this->price = $price;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getFoodType(): int {
		return $this->specialty;
	}
	
	/**
	 * @param int $specialty 
	 * @return self
	 */
	public function setFoodType(int $specialty): self {
		$this->specialty = $specialty;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getSpecialty(): ?string {
		return $this->specialty;
	}
	
	/**
	 * @param string|null $specialty 
	 * @return self
	 */
	public function setSpecialty(?string $specialty): self {
		$this->specialty = $specialty;
		return $this;
	}
}

?>