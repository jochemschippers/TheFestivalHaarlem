<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/jazzservice.php';


class TestController extends Controller
{
    private $jazzService;
    public function index()
    {
        $models = [];
        $this->displayView($models);
        include __DIR__ . '/../views/test/adminnav.php';
    }
    public function jazz(){
        $this->jazzService = new JazzService();
        $models = [
            "artists" => $this->jazzService->getAllArtists(),
            "locations" => $this->jazzService->getAllLocations(),
        ];
        $this->displayView($models);
        include __DIR__ . '/../views/test/adminnav.php';
    }
    public function updateArtist(){
        $this->jazzService = new JazzService();
        // Read the JSON data from the request body
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        $response = array(
            'status' => 1,
            'message' => 'Artist is successfully updated!'
        );
        if ($data !== null) {
            try {
                $artist = new JazzArtist($data["artistID"], $data["description"], $data["imagePath"], $data["artistName"], $data["imageSmallPath"]);
                $this->jazzService->updateArtist($artist);
            }catch (ErrorException $e) {
                $response['status'] = 0;
                $response['message'] = $e->getMessage();
            }
        } else {
            $response['status'] = 0;
            $response['message'] = "Invalid input data format. Please check the provided data.";
        }

        echo json_encode($response);
    }
    public function deleteArtist(){
        $this->jazzService = new JazzService();
        // Read the JSON data from the request body
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        $response = array(
            'status' => 1,
            'message' => 'Artist is successfully deleted!'
        );
        if ($data !== null) {
            try {
                $artist = new JazzArtist($data["artistID"]);
                $this->jazzService->DeleteArtist($artist);
            }catch (ErrorException $e) {
                $response['status'] = 0;
                $response['message'] = $e->getMessage();
            }
        } else {
            $response['status'] = 0;
            $response['message'] = "Invalid input data format. Please check the provided data.";
        }

        echo json_encode($response);
    }
    public function createArtist() {
        $this->jazzService = new JazzService();
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        $response = array(
            'status' => 1,
            'message' => 'Artist is successfully created!'
        );
        if ($data !== null) {
            try {
                //artistID wont be used, so it's 0 for now
                $artist = new JazzArtist(0, $data["description"], $data["imagePath"], $data["artistName"], $data["imageSmallPath"]);
                $this->jazzService->createArtist($artist);
            } catch (ErrorException $e) {
                $response['status'] = 0;
                $response['message'] = $e->getMessage();
            }
        } else {
            $response['status'] = 0;
            $response['message'] = "Invalid input data format. Please check the provided data.";
        }
    
        echo json_encode($response);
    }
}
