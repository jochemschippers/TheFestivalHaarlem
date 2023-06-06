<?php
require_once __DIR__ . '/../repositories/TimeSlotRepository.php';


class CartService
{
    private $repository;
    function __construct()
    {
        $this->repository = new TimeSlotRepository();
    }
    public function getCart($cart, $id)
    {
        $cartItems = [];
        $notFoundCount = 0;
        $changedItemsCount = 0;
        $message = "";
    
        foreach ($cart as $item) {
            if ($this->checkTimeSlotIDExists($item['id'])) {
                $oldQuantity = $item['quantity'];
                $item = $this->updateQuantity($item);
                if($item['quantity'] != $oldQuantity) {
                    $changedItemsCount += 1;
                }
                if($item['quantity'] != 0)
                {// TODO: toevoegen yummy timeslotID. Ook zorgen dat in de frontend de reservering informatie wordt doorgegeven/opgeslagen.
                    $ticket = $this->repository->getJazzTimeSlotById($item['id']);
                    $ticket->setQuantity($item['quantity']);
                    $cartItems[] = $ticket;
                }
            }
            else{
                $notFoundCount += 1;
            }
        }
        if ($changedItemsCount > 0) {
            $message .= "<strong> The quantity for {$changedItemsCount} item(s) in your Personal Program has been updated due to stock limitations.</strong> <br>";
        }
        if ($notFoundCount > 0) {
            $message .= "<strong>{$notFoundCount} of the Personal Program items have been sold out or are not available at the moment and have been removed for you.</strong> <br>";
        }
        return ['items' => $cartItems, 'message' => $message];
    }
    private function updateQuantity($item)
    {
        $amountSoldAndMaximumTickets = $this->repository->getAmountSoldAndMaximum($item['id']);
        $amountLeft = $amountSoldAndMaximumTickets['maximumAmountTickets'] - $amountSoldAndMaximumTickets['boughtTicketsCount'];
        if($amountLeft != 0){
            if ($item['quantity'] < 1) {
                $item['quantity'] = 1;
            }
            else if($item['quantity'] > $amountLeft){
                $item['quantity'] = $amountLeft;
            }
        }
        else{
            $item['quantity'] = 0;
        }
    
        return $item;
    }
    public function checkTimeSlotIDExists($id)
    {
        if (!$this->repository->checkTimeSlotIDExists($id)) {
            return false;
        }
        return true;
    }
}
