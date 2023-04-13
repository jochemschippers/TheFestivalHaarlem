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
    public function updateArtist($artist) {
        $this->validateArtistData($artist);
        $this->checkArtistIDExists($artist);
        $this->repository->updateArtist($artist);
        
    }
    public function deleteArtist($artist) {
        $this->checkArtistIDExists($artist);
        $this->repository->deleteArtist($artist);
    }
    public function createArtist($artist) {
        $this->validateArtistData($artist);
        $this->repository->createArtist($artist);
    }

    private function validateArtistData($artist) {
        if (!$this->validatePathFormat($artist->getImage()) || !$this->validatePathFormat($artist->getImageSmall())) {
            throw new ErrorException("Image path is not in the correct format. It must begin with '/imgage/'.");
        }
        if (strlen($artist->getDescription()) > 1200) {
            throw new ErrorException("Description must be under 1200 characters.");
        }

        if (strlen($artist->getName()) > 90) {
            throw new ErrorException("Artist name must be under 90 characters.");
        }
    }
    private function checkArtistIDExists($artist){
        if (!$this->repository->checkArtistIDExists($artist->getArtistID())) {
            throw new ErrorException("The provided artistID does not exist.");
        }
    }

    private function validatePathFormat($path) {
        return substr($path, 0, 7) === "/image/";
    }
}
