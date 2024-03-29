<?php
require_once __DIR__ . '/../models/timeslot.php';
require_once __DIR__ . '/../models/hall.php';



class TimeSlotsJazz extends TimeSlot implements JsonSerializable
{

        private JazzArtist $artist;
        private JazzLocation $jazzLocation;
        private hall $hall;

        public function __construct(int $timeSlotID = 0, int $eventID = 0, float $price = 0, string $startTime = '2001-07-29 02:43:00', string $endTime = '2001-07-29 02:43:01', int $maximmumAmountTickets = 0, $artist = new JazzArtist(), $jazzLocation = new JazzLocation(), $hall = new Hall())
        {

                parent::__construct($timeSlotID, $eventID, $price,  DateTime::createFromFormat('Y-m-d H:i:s', $startTime), DateTime::createFromFormat('Y-m-d H:i:s', $endTime), $maximmumAmountTickets);
                $this->artist = $artist;
                $this->jazzLocation = $jazzLocation;
                $this->hall = $hall;
        }


        /**
         * Get the value of artist
         */
        public function getArtist()
        {
                return $this->artist;
        }

        /**
         * Set the value of artist
         *
         * @return  self
         */     
        public function setArtist($artist)
        {
                $this->artist = $artist;

                return $this;
        }

        /**
         * Get the value of jazzLocation
         */
        public function getJazzLocation()
        {
                return $this->jazzLocation;
        }

        /**
         * Set the value of jazzLocation
         *
         * @return  self
         */
        public function setJazzLocation($jazzLocation)
        {
                $this->jazzLocation = $jazzLocation;

                return $this;
        }

        /**
         * Set the value of artist based on ID
         *
         * @return  self
         */
        public function setArtistID($artistID)
        {
                $this->artist = new JazzArtist($artistID);

                return $this;
        }
        /**
         * Set the value of jazzLocation based on ID
         *
         * @return  self
         */
        public function setLocationID($jazzLocationID)
        {
                $this->jazzLocation = new JazzLocation($jazzLocationID);
                return $this;
        }

        /**
         * Set the value of hall based on ID
         *
         * @return  self
         */
        public function setHallID($hallID)
        {
                $this->hall = new Hall($hallID);

                return $this;
        }
        /**
         * Get the value of hall
         */
        public function getHall()
        {
                return $this->hall;
        }

        /**
         * Set the value of hall
         *
         * @return  self
         */
        public function setHall($hall)
        {
                $this->hall = $hall;

                return $this;
        }
        public function jsonSerialize(): array
        {
                return array_merge(parent::jsonSerialize(), [
                        'artist' => $this->artist,
                        'jazzLocation' => $this->jazzLocation,
                        'hall' => $this->hall,
                ]);
        }

        /**
         * Get the value of jazzLocation
         */ 
        public function getLocation()
        {
                return $this->jazzLocation;
        }

        /**
         * Set the value of jazzLocation
         *
         * @return  self
         */ 
        public function setLocation($jazzLocation)
        {
                $this->jazzLocation = $jazzLocation;

                return $this;
        }
}
