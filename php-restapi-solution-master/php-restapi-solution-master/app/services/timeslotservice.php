<?php
require_once __DIR__ . '/../repositories/jazzRepository.php';

class JazzService
{
    private $jazzRepository;
    private $timeSlotRepository;

    function __construct()
    {
        $this->jazzRepository = new JazzRepository();
        $this->timeSlotRepository = new TimeSlotRepository();
    }

}
