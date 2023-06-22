<?php
require_once __DIR__ . '/controller.php';
require __DIR__ . '/../services/accountservice.php';
require_once __DIR__ . '/../services/mailService.php';
require_once __DIR__ . '/../models/user.php';

class AccountController extends Controller
{
    private $service;
    private $mailService;
    function __construct()
    {
        $this->service = new AccountService();
        $this->mailService = new MailService();
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
    public function login()
    {
        $response = array(
            'status' => 1,
            'message' => "login successfull, redirecting to home page. Please wait... <br>if nothing happends; click <a href='/'>here</a>"
        );
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
    public function userdetails()
    {
        $models = [
            "userDetails" => $this->service->getUserById($_SESSION['userID']),
        ];
        $this->displayView($models);
    }

    public function updateUser()
    {
        $this->handleRequest(function ($data, &$response) {
            $fullName = isset($data['fullName']) ? $data['fullName'] : null;
            $email = isset($data['email']) ? $data['email'] : null;
            $phoneNumber = isset($data['phoneNumber']) ? $data['phoneNumber'] : null;
            if (isset($data['password']) && $data['password'] != "") {
                // $password = password_hash($data['password'], PASSWORD_DEFAULT);
                $password = $data['password'];
            } else {
                $password = "";
            }
            $updatedUser = new User($fullName, $_SESSION['userRole'], $email, $phoneNumber, $password, $_SESSION['userID']);
            $result = $this->service->updateUser($updatedUser);
            if ($result) {
                try {
                    $this->mailService->sendUpdateEmail($email, $fullName);
                } catch (Exception $e) {
                    error_log($e->getMessage());
                }
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

    public function reset_password()
    {
        $models = [];
        $this->displayView($models);
    }

    public function checkEmail()
    {

        $this->handleRequest(function ($data, &$response) {
            $email = isset($data['email']) ? $data['email'] : null;
            $result = $this->service->checkEmail($email);

            if ($result) {
                try {
                    $this->mailService->sendPasswordResetEmail($email, null);
                } catch (Exception $e) {
                    // Log or echo your error message
                    error_log($e->getMessage());
                }
                $response['message'] = "We will send you a mail to change your password.";
                $response['status'] = 0;                
            } else {
                $response['message'] = "No user found with this email.";
                $response['status'] = 1;
            }
        });
    }

    public function resetPassword()
    {

        $this->handleRequest(function ($data, &$response) {
            // Get the user data from the request
            $email = isset($data['email']) ? $data['email'] : null;
            $password = isset($data['newPassword']) ? $data['newPassword'] : null;

            $result = $this->service->resetPassword($email, $password);

            if ($result) {
                try {
                    $this->mailService->sendResetConfirmEmail($email, null);
                } catch (Exception $e) {
                    // Log or echo your error message
                    error_log($e->getMessage());
                }
                $response['message'] = "Password reset successfully.";
                $response['status'] = 0;                
            } else {
                $response['message'] = "Password reset failed.";
                $response['status'] = 1;
            }
        });
    }
}
