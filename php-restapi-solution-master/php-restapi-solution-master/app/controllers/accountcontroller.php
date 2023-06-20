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
    public function userdetails() {
        $models = [
            // "username" => $_SESSION['fullName'],
            "userDetails" => $this->service->getUserById($_SESSION['userID']),
            // "userDetails" => $this->service->getAllUsers(),
        ];
        $this->displayView($models);
    }

    public function updateUser() {
        $this->handleRequest(function ($data, &$response) {
            // Get the user data from the request
            var_dump($data);
            $fullName = isset($data['fullName']) ? $data['fullName'] : null;
            $email = isset($data['email']) ? $data['email'] : null;
            $phoneNumber = isset($data['phoneNumber']) ? $data['phoneNumber'] : null;
            $password = isset($data['password']) ? $data['password'] : null;
            
            
            $updatedUser = new User($fullName, $_SESSION['userRole'], $email, $phoneNumber, $password, $_SESSION['userID']);
            error_log("updateUser");
    
            // Call the update method from the userService
            $result = $this->service->updateUser($updatedUser);
    
            // Check the result and set the appropriate response
            if ($result) {
                $response['message'] = "User details updated successfully.";
                $response['status'] = 1;
            } else {
                $response['message'] = "User details update failed.";
                $response['status'] = 0;
            }
        });
    }
    
    private function handleRequest($action)
    {
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);
        $response = array(
            'status' => 1,
            'message' => ''
        );

        if ($data !== null) {
            try {
                $action($data, $response);
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
// $response = array(
//     'status' => 1,
//     'message' => "user details"
// );
// if (session_status() == PHP_SESSION_NONE) {
//     session_start();
// }
// if (isset($_SESSION['userID'])) {
//     $response['userID'] = $_SESSION['userID'];
//     $response['userRole'] = $_SESSION['userRole'];
//     $response['fullName'] = $_SESSION['fullName'];
// } else {
//     $response['status'] = 0;
//     $response['message'] = "user is not logged in";
// }
// echo json_encode($response);

// $user = $this->service->getUserById($_SESSION['userID']);
// var_dump($user)
