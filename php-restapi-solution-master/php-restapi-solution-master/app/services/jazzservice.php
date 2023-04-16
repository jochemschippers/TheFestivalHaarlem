<?php
require_once __DIR__ . '/../repositories/jazzrepository.php';



class JazzService
{
    private $repository;
    private $allowed_extensions = ['png', 'jpg', 'jpeg', 'gif'];

    function __construct()
    {
        $this->repository = new JazzRepository();
    }
    public function getAllArtists()
    {
        $artists = $this->repository->getAllArtists();
        foreach ($artists as $artist) {
            $artist->setTimeSlots($this->repository->getAllTimeSlots($artist));
        }
        return $artists;
    }
    public function getAllTimeSlots()
    {
        try {
            $timeSlots = $this->repository->getAllJazzTimeSlots();
            return $timeSlots;
        } catch (error $e) {
            throw $e;
        }
    }
    public function getAllLocations()
    {
        try {
            $locations = $this->repository->getAllLocations();
            return $locations;
        } catch (error $e) {
            throw $e;
        }
    }
    public function updateArtist($artist)
    {
        try {
            $this->validateArtistData($artist);
            $this->checkArtistIDExists($artist);
            $this->repository->updateArtist($artist);
        } catch (error $e) {
            throw $e;
        }
    }
    public function deleteArtist($artist)
    {
        try {
            $this->checkArtistIDExists($artist);
            $this->repository->deleteArtist($artist);
        } catch (error $e) {
            throw $e;
        }
    }
    public function createArtist($artist)
    {
        try {
            $this->validateArtistData($artist);
            return $this->repository->createArtist($artist);
        } catch (error $e) {
            throw $e;
        }
    }
    public function updateLocation($location)
    {
        try {
            $this->validateLocationData($location);
            $this->checkLocationIDExists($location);
            return $this->repository->updateLocation($location);
        } catch (error $e) {
            throw $e;
        }
    }

    private function validateArtistData($artist)
    {
        $this->allowed_extensions = ['png', 'jpg', 'jpeg', 'gif'];
        if (!$this->validateImage($artist->getImage(), $this->allowed_extensions)) {
            $extensions = implode(', ', $this->allowed_extensions);
            throw new ErrorException("Image path is not in the correct format. It must be one of the following types: {$extensions}");
        }
        if (strlen($artist->getDescription()) > 1200) {
            throw new ErrorException("Description must be under 1200 characters.");
        }

        if (strlen($artist->getName()) > 90) {
            throw new ErrorException("Artist name must be under 90 characters.");
        }
    }
    private function checkArtistIDExists($artist)
    {
        if (!$this->repository->checkArtistIDExists($artist->getArtistID())) {
            throw new ErrorException("The provided artistID does not exist.");
        }
    }
    private function checkLocationIDExists($location)
    {
        if (!$this->repository->checkLocationIDExists($location->getLocationID())) {
            throw new ErrorException("The provided artistID does not exist.");
        }
    }

    private function validateImage($path, $allowed_extensions)
    {

        $path_info = pathinfo($path);
        if (isset($path_info['extension']) && in_array(strtolower($path_info['extension']), $allowed_extensions)) {
            return true;
        }
        return false;
    }
    private function validateLocationData($location)
    {
        if (!$this->validateImage($location->getLocationImage(), $this->allowed_extensions)) {
            $extensions = implode(', ', $this->allowed_extensions);
            throw new ErrorException("Image path is not in the correct format. It must be one of the following types: {$extensions}");
        }
        if (strlen($location->getToAndFromText()) > 1500) {
            throw new ErrorException("To and from text must be under 1500 characters.");
        }
        if (strlen($location->getAccesibillityText()) > 1500) {
            throw new ErrorException("Accesibillity Text must be under 1500 characters.");
        }
        if (strlen($location->getLocationName()) > 45) {
            throw new ErrorException("Location name must be under 45 characters.");
        }
        if (strlen($location->getAddress()) > 90) {
            throw new ErrorException("Address name must be under 90 characters.");
        }
    }
}
