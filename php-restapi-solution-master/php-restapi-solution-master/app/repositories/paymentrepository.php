<?php
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/ticketItem.php';

class PaymentRepository extends Repository
{
    function getAll()
    {
        try {
            $items = array();
            $items[] = new Item(1, "Ticket 1", 10.00);
        return $items;
        } catch (PDOException $e) {
            echo $e;
        }
        
    }
}
?>
