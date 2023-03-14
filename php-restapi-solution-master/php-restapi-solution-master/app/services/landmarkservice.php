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
        $repository = new LandmarkRepository();
        $landmarks = $repository->getAllLandmarks();
        return $landmarks;
    }

    public function getLandmark($landmarkID) {
        // retrieve data
        $repository = new LandmarkRepository();
        $landmark = $repository->getLandmark($landmarkID);
        return $landmark;
    }

    public function create($landmark) {
        // retrieve data
        $repository = new LandmarkRepository();
        $repository->createLandmark($landmark->title, $landmark->description, $landmark->image);
    }

    public function update($landmark) {
        // retrieve data
        $repository = new LandmarkRepository();
        $repository->updateLandmark($landmark->landmarkID, $landmark->title, $landmark->description, $landmark->image);
    }

    public function delete($landmarkID) {
        // retrieve data
        $repository = new LandmarkRepository();
        $repository->deleteLandmark($landmarkID);
    }

    public function displayLandmarks() {
        $landmarks = $this->getAllLandmarks();
        $html = "";
        
        if(!is_null($landmarks) && count($landmarks) > 0) {
            foreach ($landmarks as $landmark) {
                $html .= "<div class='col-md-4'>";
                $html .= "<div class='card mb-4 shadow-sm'>";
                $html .= "<img class='card-img-top' src='images/" . $landmark->getImage() . "' alt='Card image cap'>";
                $html .= "<div class='card-body'>";
                $html .= "<h5 class='card-title'>" . $landmark->getTitle() . "</h5>";
                $html .= "<p class='card-text'>" . $landmark->getDescription() . "</p>";
                $html .= "<div class='d-flex justify-content-between align-items-center'>";
                $html .= "<div class='btn-group'>";
                $html .= "<a href='index.php?controller=landmark&action=edit&landmarkID=" . $landmark->getLandmarkID() . "' class='btn btn-sm btn-outline-secondary'>Edit</a>";
                $html .= "<a href='index.php?controller=landmark&action=delete&landmarkID=" . $landmark->getLandmarkID() . "' class='btn btn-sm btn-outline-secondary'>Delete</a>";
                $html .= "</div>";
                $html .= "</div>";
                $html .= "</div>";
                $html .= "</div>";
            }
        }
        else {
            $html .= "<div class='col-md-12'>";
            $html .= "<div class='card mb-4 shadow-sm'>";
            $html .= "<div class='card-body'>";
            $html .= "<h5 class='card-title'>No Landmarks</h5>";
            $html .= "<p class='card-text'>There are no landmarks to display.</p>";
            $html .= "</div>";
            $html .= "</div>";
            $html .= "</div>";
        }
    }

    public function displayCreateForm() {
        $html = "";
        $html .= "<form action='index.php?controller=landmark&action=create' method='post' enctype='multipart/form-data'>";
        $html .= "<div class='form-group'>";
        $html .= "<label for='title'>Title</label>";
        $html .= "<input type='text' class='form-control' id='title' name='title'>";
        $html .= "</div>";
        $html .= "<div class='form-group'>";
        $html .= "<label for='description'>Description</label>";
        $html .= "<input type='text' id='description' name='description'>";
        $html .= "</div>";
        $html .= "<div class='form-group'>";
        $html .= "<label for='image'>Image</label>";
        $html .= "<input type='text' id='image' name='image'>";
        $html .= "</div>";
        $html .= "<button type='submit' class='btn btn-primary'>Create</button>";
        $html .= "</form>";
        return $html;
    }

    public function displayEditForm($landmarkID) {
        $landmark = $this->get($landmarkID);
        $html = "";
        $html .= "<form action='index.php?controller=landmark&action=update' method='post' enctype='multipart/form-data'>";
        $html .= "<div class='form-group'>";
        $html .= "<label for='title'>Title</label>";
        $html .= "<input type='text' class='form-control' id='title' name='title' value='" . $landmark->title . "'>";
        $html .= "</div>";
        $html .= "<div class='form-group'>";
        $html .= "<label for='description'>Description</label>";
        $html .= "<input type='text' id='description' name='description' value='" . $landmark->description . "'>";
        $html .= "</div>";
        $html .= "<div class='form-group'>";
        $html .= "<label for='image'>Image</label>";
        $html .= "<input type='text' id='image' name='image'>";
        $html .= "</div>";
        $html .= "<input type='text' name='landmarkID' value='" . $landmark->landmarkID . "'>";
        $html .= "<button type='submit' class='btn btn-primary'>Update</button>";
        $html .= "</form>";
        return $html;
    }
}

?>