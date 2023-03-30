<?php
require_once __DIR__ . '/controller.php';
require __DIR__ . '/../services/accountservice.php';
require_once __DIR__ . '/../models/user.php';

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
    public function login()
    {
        $response = array(
            'status' => 1,
            'message' => 'login successfull, redirecting to home page. If you are seeing this however, something is going wrong.'
        );
        // Read the JSON data from the request body
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        try{
            $user = $this->service->login($data["email"], $data["password"]);
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['userID'] = $user->getUserID();
            $_SESSION['userRole'] = $user->getUserRole();
            $_SESSION['fullName'] = $user->getFullName();
        }
        catch(ErrorException $e){
            $response['status'] = 0;
            $response['message'] = $e->getMessage();
        }
        echo json_encode($response);
    }
}
