<?php
require __DIR__ . '/../repositories/paymentrepository.php';


class PaymentService {
    public function getAll() {
        // retrieve data
        $repository = new PaymentRepository();
        $items = array();
        $items = $repository->getAll();
        return $items;
    }
}

?>