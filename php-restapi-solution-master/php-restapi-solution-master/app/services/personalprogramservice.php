<?php
require_once __DIR__ . '/../repositories/TimeSlotRepository.php';
require_once __DIR__ . '/../repositories/PersonalProgramRepository.php';


class PersonalProgramService
{
    private $timeSlotRepository;
    private $personalProgramRepository;

    function __construct()
    {
        $this->timeSlotRepository = new TimeSlotRepository();
        $this->personalProgramRepository = new PersonalProgramRepository();
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
                if ($item['quantity'] != $oldQuantity) {
                    $changedItemsCount += 1;
                }
                if ($item['quantity'] != 0) { // TODO: toevoegen yummy timeslotID. Ook zorgen dat in de frontend de reservering informatie wordt doorgegeven/opgeslagen.
                    $ticket = $this->timeSlotRepository->getJazzTimeSlotById($item['id']);
                    $ticket->setQuantity($item['quantity']);
                    $cartItems[] = $ticket;
                }
            } else {
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
    public function calculateTotals($cartItems)
    {
        $subtotal = 0;
        $vat = 0;

        foreach ($cartItems as $item) {
            $total = $item->getPrice() * $item->getQuantity();
            $subtotal += $total;

            if ($item->getEventID() !== 2) {
                $vat += $total * 0.09;
            }
        }
        $total = $subtotal + $vat;

        return [
            'subtotal' => number_format($subtotal, 2),
            'vat' => number_format($vat, 2),
            'total' => number_format($total, 2)
        ];
    }
    private function updateQuantity($item)
    {
        $amountSoldAndMaximumTickets = $this->timeSlotRepository->getAmountSoldAndMaximum($item['id']);
        $amountLeft = $amountSoldAndMaximumTickets['maximumAmountTickets'] - $amountSoldAndMaximumTickets['boughtTicketsCount'];
        if ($amountLeft != 0) {
            if ($item['quantity'] < 1) {
                $item['quantity'] = 1;
            } else if ($item['quantity'] > $amountLeft) {
                $item['quantity'] = $amountLeft;
            }
        } else {
            $item['quantity'] = 0;
        }

        return $item;
    }
    public function checkTimeSlotIDExists($id)
    {
        if (!$this->timeSlotRepository->checkTimeSlotIDExists($id)) {
            return false;
        }
        return true;
    }
    public function saveCart($cartItems, $userId)
    {
        $this->personalProgramRepository->beginTransaction();
        try {
            // Create a new personal program
            $programId = $this->personalProgramRepository->createPersonalProgram($userId);
            // Loop through the cart items and create tickets for each item
            foreach ($cartItems as $item) {
                for ($i = 0; $i < $item->getQuantity(); $i++) {
                    $this->personalProgramRepository->createEventTicket($item->getTimeSlotID(), $programId);
                }
            }

            // Commit the transaction
            $this->personalProgramRepository->commit();
            return $programId;
        } catch (Exception $e) {

            $this->personalProgramRepository->rollBack();
            throw $e;
        }
    }
    public function updateStatus($programId, $isPaid){
        $this->personalProgramRepository->updatePaymentStatus($programId, $isPaid);
    }
}
