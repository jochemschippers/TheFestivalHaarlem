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
}

?>
