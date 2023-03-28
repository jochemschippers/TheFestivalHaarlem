<?php
require_once __DIR__ . '/../repositories/paymentrepository.php';


class PaymentService {
    private $repository;
    function __construct()
    {
        $this->repository = new PaymentRepository();
    }
    public function GetJazzTickets() {
        return $this->repository->GetJazzTickets();
    }
}

?>