<?php

class JazzArtist implements JsonSerializable
{

        private int $artistID;
        private string $description;
        private string $image;
        private string $name;
        private array $timeSlots;
        private string $imageSmall;

        public function __construct(int $artistID = 0, string $description = '', string $image = '', string $name = '', string $imageSmall = '')
        {
                $this->artistID = $artistID;
                $this->description = $description;
                $this->image = $image;
                $this->name = $name;
                $this->timeSlots = array();
                $this->imageSmall = $imageSmall;
        }

        /**
         * @return array
         */
        public function getTimeSlots(): array
        {
                return $this->timeSlots;
        }

        /**
         * @param array $timeSlots 
         * @return self
         */
        public function setTimeSlots(array $timeSlots): self
        {
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

        /**
         * Get the value of imageSmall
         */
        public function getImageSmall()
        {
                return $this->imageSmall;
        }

        /**
         * Set the value of imageSmall
         *
         * @return  self
         */
        public function setImageSmall($imageSmall)
        {
                $this->imageSmall = $imageSmall;

                return $this;
        }
        //return type will change because of return values differ in type 
        // 000webhost doesn't have php 8.1, which is why : mixed isn't used
        #[\ReturnTypeWillChange]
        public function jsonSerialize()
        {
        //         'productId' => $this->getProductId(),
        //     'foodCategory' => $this->getFoodCategory(),
        //     'price' => $this->getPrice(),
        //     'imageAddress' => $this->getImageAddress(),
        //     'productName' => $this->getProductName(),
        //     'kcal' => $this->getKcal(),
        //     'allergens' => $this->getAllergens(),
        //     'ingredients' => $this->getIngredients(),
        // private int $artistID;
        // private string $description;
        // private string $image;
        // private string $name;
        // private array $timeSlots;
        // private string $imageSmall;
                return [
                        
                        'artistID' => $this->getArtistID(),
                        'description' => $this->getDescription(),
                        'image' => $this->getImage(),
                        'name' => $this->getName(),
                        'timeSlots' => $this->getTimeSlots(),
                        'imageSmall' => $this->getImageSmall(),
                ];
        }
}
