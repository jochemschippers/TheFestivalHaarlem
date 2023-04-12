<?php
require_once __DIR__ . '/controller.php';
require __DIR__ . '/../services/accountservice.php';
require_once __DIR__ . '/../models/user.php';

class AccountController extends Controller
{
    private $service;
    function __construct()
    {
        $this->service = new AccountService();
    }
    public function index()
    {
        if (isset($_SESSION['userID'])) {
            $this->overview();
        } else {
            $models = [];
            $this->displayView($models);
        }
    }
    public function overview()
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
        if ($data !== null) {
            try {
                //0 at the end represents userRole, 1 = admin 0 = normal visitor
                $userToRegister = new User($data["fullname"], 0, $data["email"], $data["phoneNumber"], $data["password"]);
                $this->service->register($userToRegister);
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
    public function login()
    {
        $response = array(
            'status' => 1,
            'message' => "login successfull, redirecting to home page. Please wait... <br>if nothing happends; click <a href='/'>here</a>"
        );
        // Read the JSON data from the request body
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        try {
            if (isset($data["email"]) && isset($data["password"])) {
                $user = $this->service->login($data["email"], $data["password"]);
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['userID'] = $user->getUserID();
                $_SESSION['userRole'] = $user->getUserRole();
                $_SESSION['fullName'] = $user->getFullName();
            } else {
                $response['status'] = 0;
                $response['message'] = "Email or password is not provided.";
            }
        } catch (ErrorException $e) {
            $response['status'] = 0;
            $response['message'] = $e->getMessage();
        }
        echo json_encode($response);
    }
    public function logout()
    {
        $this->service->logout();
    }
}
