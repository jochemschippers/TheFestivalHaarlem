<?php
require_once __DIR__ . '/controller.php';
require __DIR__ . '/../services/accountservice.php';

class AccountController extends Controller
{
    private $service;
    function __construct()
    {
        parent::__construct();
        $this->service = new AccountService();
    }
    public function index()
    {
        $models = [];
        $this->displayView($models);
    }
    public function createAccount()
    {
        $response = array(
            'status' => 1,
            'message' => 'Account is successfully created! You can now login'
        );
        // Read the JSON data from the request body
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        try{
            $this->service->register($data["fullname"], $data["password"], $data["email"], 0, $data["phoneNumber"]);
        }
        catch(ErrorException $e){
            $response['status'] = 0;
            $response['message'] = $e->getMessage();
        }
        echo json_encode($response);
    }
}
