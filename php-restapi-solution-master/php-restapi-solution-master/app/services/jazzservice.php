<?php
require_once __DIR__ . '/../repositories/jazzrepository.php';



class JazzService {
    private $repository;
    function __construct()
    {
        $this->repository = new JazzRepository();
    }
    public function getAllArtists() {
        $artists = $this->repository->getAllArtists();
        foreach ($artists as $artist){
            $artist->setTimeSlots($this->repository->getAllTimeSlots($artist));
        }
        return $artists;
    }
    public function getAllTimeSlots() {
        try{
            $timeSlots = $this->repository->getAllJazzTimeSlots();
            return $timeSlots;
        }catch(error $e){
            throw $e;
        }

    }
    public function getAllLocations(){
        $locations = $this->repository->getAllLocations();
        return $locations;
    }
}
