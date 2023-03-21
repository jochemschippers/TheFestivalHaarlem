<?php
require __DIR__ . '/../repositories/landmarkrepository.php';


class LandmarkService {

    private $repository;

    function __construct()
    {
        $this->repository = new LandmarkRepository();
    }

    public function getAllLandmarks() {
        // retrieve data
        return $this->repository->getAllLandmarks();
    }

    public function getLandmark($landmarkID) {
        return $this->repository->getLandmark($landmarkID);
    }

    public function createLandmark($landmark) {
        $this->repository->createLandmark($landmark);
    }

    public function updateLandmark($landmark) {
        $this->repository->updateLandmark($landmark);
    }

    public function deleteLandmark($landmarkID) {
        $this->repository->deleteLandmark($landmarkID);
    }
}

?>