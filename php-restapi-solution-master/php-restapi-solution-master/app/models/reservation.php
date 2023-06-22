<?php

class Reservation implements JsonSerializable{
    private $customerName;
    private $phoneNumber;
    private $nrOfAdults;
    private $nrOfChild;
    private $remark;


    /**
     * Get the value of customerName
     */ 
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Set the value of customerName
     *
     * @return  self
     */ 
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * Get the value of phoneNumber
     */ 
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set the value of phoneNumber
     *
     * @return  self
     */ 
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get the value of nrOfAdults
     */ 
    public function getNrOfAdults()
    {
        return $this->nrOfAdults;
    }

    /**
     * Set the value of nrOfAdults
     *
     * @return  self
     */ 
    public function setNrOfAdults($nrOfAdults)
    {
        $this->nrOfAdults = $nrOfAdults;

        return $this;
    }

    /**
     * Get the value of nrOfChild
     */ 
    public function getNrOfChild()
    {
        return $this->nrOfChild;
    }

    /**
     * Set the value of nrOfChild
     *
     * @return  self
     */ 
    public function setNrOfChild($nrOfChild)
    {
        $this->nrOfChild = $nrOfChild;

        return $this;
    }

    /**
     * Get the value of remark
     */ 
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Set the value of remark
     *
     * @return  self
     */ 
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }
    public function jsonSerialize(): array
    {
            return [
                    'customerName' => $this->customerName,
                    'phoneNr' => $this->phoneNumber,
                    'nrAdult' => $this->nrOfAdults,
                    'nrChild' => $this->nrOfChild,
                    'remark' => $this->remark
            ];
    }
}