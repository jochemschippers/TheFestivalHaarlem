<?php
require_once __DIR__ . '/../repositories/CartRepository.php';


class CartService {
    private $repository;
    function __construct()
    {
        $this->repository = new TimeSlotRepository();
    }
    public function getCart($cart, $id)
    {
        $cartItems = [];
        $notFoundCount = 0;

        foreach ($cart as $item) {
            if($this->checkTimeSlotIDExists($item['id']))
            {
                $quantity = $this->updateQuantity($item['quantity']);
                if ($quantity > 0) {
                    $productId = $item['id'];
                    $order = null;
                    if ($order->getProduct()->getProductId() !== null) {
                        $cartItems[] = $order;
                    } else {
                        $notFoundCount++;
                    }
                }
            }
            
        }
        if($notFoundCount > 0){
            $message = "{$notFoundCount} of the PP items are no longer being sold or are not available at the moment and have been removed." ;
        }else{
            $message = "";
        }

        return ['items' => $cartItems, 'message' => $message];
    }
    private function updateQuantity($quantity)
    {
        if ($quantity < 1) {
            $quantity = 1;
        }
        return $quantity;
    }
    public function checkTimeSlotIDExists($id)
    {
        if (!$this->repository->checkTimeSlotIDExists($id)) {
            return false;
        }
        return true;
    }
}