<?php
require __DIR__ . '/controller.php';
require __DIR__ . '/../services/accountservice.php';

class UserController extends Controller {
    private $service; 
    function __construct() {
        $this->service = new AccountService();
    }
    public function index() {
        require __DIR__ . '/../views/admin/login.php';
    }
    public function loginToAccount(){
        $response = array(
            'status' => 1,
            'message' => 'Inloggen gelukt, je wordt nu gebracht naar de homepagina.'
        );
        try{ //geef variable door
            //session vanuit aparte controller
            $this->service->login();
        }catch(ErrorException $e){
            $response['message'] = $e->getMessage();
            $response['status'] = 0;
        }
        echo json_encode($response);
    }

}
?>