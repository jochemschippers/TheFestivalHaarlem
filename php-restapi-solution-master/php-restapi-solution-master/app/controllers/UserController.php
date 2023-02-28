<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/userservice.php';

class UserController extends Controller {
    private $userService; 
    function __construct() {
        $this->userService = new UserService();
    }
    public function index() {
        require __DIR__ . '/../views/admin/index.php';
    }
    public function loginToAccount(){
        $response = array(
            'status' => 1,
            'message' => 'Inloggen gelukt, je wordt nu gebracht naar de homepagina.'
        );
        try{ //geef variable door
            //session vanuit aparte controller
            $this->userService->login();
        }catch(ErrorException $e){
            $response['message'] = $e->getMessage();
            $response['status'] = 0;
        }
        echo json_encode($response);
    }

}
?>