<?php

class FestivalInformation{
        private DateTime $startTime;
        private DateTime $endTime;

        public function __construct(DateTime $start, DateTime $end){
            $this->startTime = $start;
            $this->endTime = $end;
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
}

?>