<?php

class PersonalProgramItem{
    private $title;
    private $startTime;
    private $endTime;
    private $quantity;
    private $price; 
    private $eventID;
    

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of startTime
     */ 
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set the value of startTime
     *
     * @return  self
     */ 
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get the value of endTime
     */ 
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set the value of endTime
     *
     * @return  self
     */ 
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get the value of eventID
     */ 
    public function getEventID()
    {
        return $this->eventID;
    }

    /**
     * Set the value of eventID
     *
     * @return  self
     */ 
    public function setEventID($eventID)
    {
        $this->eventID = $eventID;

        return $this;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     *
     * @return  self
     */ 
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }
}