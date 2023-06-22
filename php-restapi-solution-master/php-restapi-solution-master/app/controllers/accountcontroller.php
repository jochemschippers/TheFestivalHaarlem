<?php
require_once __DIR__ . '/controller.php';
require __DIR__ . '/../services/accountservice.php';
require_once __DIR__ . '/../models/user.php';
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
    public function userdetails()
    {
        $models = [
            // "username" => $_SESSION['fullName'],
            "userDetails" => $this->service->getUserById($_SESSION['userID']),
            // "userDetails" => $this->service->getAllUsers(),
        ];
        $this->displayView($models);
    }

    public function updateUser()
    {
        $this->handleRequest(function ($data, &$response) {
            // Get the user data from the request
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
                $response['message'] = "User details updated successfully.";
                $response['status'] = 1;

                $Subject = 'Account Update Confirmation';
                $Body    = 'Hello, your account details have been updated successfully. If you did not make this change, please contact us immediately.';
                $AltBody = 'This is the body in plain text for non-HTML mail clients';
                try {
                    $this->sendEmail($email, $fullName, $Subject, $Body, $AltBody);
                } catch (Exception $e) {
                    // Log or echo your error message
                    error_log($e->getMessage());
                }
                // var_dump($response);
            } else {
                $response['message'] = "User details update failed.";
                $response['status'] = 0;
            }
            // $data = null;
        });
    }

    private function sendEmail($email, $nameReceiver, $subject, $body, $altBody)
    {
        //Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'info.thehaarlemfestival@gmail.com';
            $mail->Password = 'fesvstifrbiaxkil';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('info.thehaarlemfestival@gmail.com', 'The Haalem Festival');
            $mail->addAddress($email, $nameReceiver ?? 'User');

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = $altBody;

            if ($mail->send()) {
                // echo 'Message has been sent';
            } else {
                // echo 'Message could not be sent.';
            }
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
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

    public function checkEmail() {

        $this->handleRequest(function ($data, &$response) {
            // Get the user data from the request
            $email = isset($data['email']) ? $data['email'] : null;

            $result = $this->service->checkEmail($email);

            if ($result) {
                $response['message'] = "We will send you a mail to change your password.";
                $response['status'] = 0;

                $Subject = 'Password Reset';
                $Body    = 'Hello, you have requested to reset your password. Please click on the link below to reset your password. <br> <a href="http://localhost/account/reset_password?email=' . urlencode($email) . '">Reset Password</a>';
                $AltBody = 'This is the body in plain text for non-HTML mail clients';
                try {
                    $this->sendEmail($email, null, $Subject, $Body, $AltBody);
                } catch (Exception $e) {
                    // Log or echo your error message
                    error_log($e->getMessage());
                }
            } else {
                $response['message'] = "No user found with this email.";
                $response['status'] = 1;
            }
        });
    }

    public function resetPassword() {

        // var_dump("test");
        $this->handleRequest(function ($data, &$response) {
            // Get the user data from the request
            $email = isset($data['email']) ? $data['email'] : null;
            $password = isset($data['newPassword']) ? $data['newPassword'] : null;

            var_dump($email);
            var_dump($password);

            $result = $this->service->resetPassword($email, $password);

            if ($result) {
                $response['message'] = "Password reset successfully.";
                $response['status'] = 0;

                $Subject = 'Password Reset Confirmation';
                $Body    = 'Hello, your password has been reset successfully. If you did not make this change, please contact us immediately.';
                $AltBody = 'This is the body in plain text for non-HTML mail clients';
                try {
                    $this->sendEmail($email, null, $Subject, $Body, $AltBody);
                } catch (Exception $e) {
                    // Log or echo your error message
                    error_log($e->getMessage());
                }
            } else {
                $response['message'] = "Password reset failed.";
                $response['status'] = 1;
            }
        });
    }
}

