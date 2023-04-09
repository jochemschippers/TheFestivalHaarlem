<?php
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/jazzservice.php';


class TestController extends Controller
{
    private $service;
    public function index()
    {
        $models = [];
        $this->displayView($models);
        include __DIR__ . '/../views/test/adminnav.php';
    }
    public function jazz(){
        $this->service = new JazzService();
        $models = [
            "artists" => $this->service->getAllArtists(),
            "locations" => $this->service->getAllLocations(),
        ];
        $this->displayView($models);
        include __DIR__ . '/../views/test/adminnav.php';
    }
    public function updateArtist(){
        $response = array(
            'status' => 1,
            'message' => 'Account is successfully created! You can now login'
        );
        // Read the JSON data from the request body
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        try{
            //$this->service->register($data["fullname"], $data["password"], $data["email"], 0, $data["phoneNumber"]);
        }
        catch(ErrorException $e){
            // $response['status'] = 0;
            // $response['message'] = $e->getMessage();
        }
        $response['message'] = "aaaaa";
        echo json_encode($response);
    }
}
