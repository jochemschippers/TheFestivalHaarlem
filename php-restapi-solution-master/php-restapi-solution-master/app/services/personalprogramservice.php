<?php
require_once __DIR__ . '/../repositories/timeslotrepository.php';
require_once __DIR__ . '/../repositories/personalprogramrepository.php';


class PersonalProgramService
{
    private $timeSlotRepository;
    private $personalProgramRepository;

    function __construct()
    {
        $this->timeSlotRepository = new TimeSlotRepository();
        $this->personalProgramRepository = new PersonalProgramRepository();
    }
    public function getPersonalProgram($personalProgram, $id)
    {
        $result = $this->getPersonalProgramItems($personalProgram);
        $personalProgram = $result['items'];
        $message = $this->preparePersonalProgramMessage($result['changedItemsCount'], $result['notFoundCount']);

        return ['items' => $personalProgram, 'message' => $message];
    }
    private function getPersonalProgramItems($personalProgram)
    {
        $personalProgramItems = [];
        $notFoundCount = 0;
        $changedItemsCount = 0;

        foreach ($personalProgram as $item) {
            if ($this->checkTimeSlotIDExists($item['id'])) {
                $result = $this->processCartItem($item);
                $item = $result['item'];
                $changedItemsCount += $result['changed'];

                if ($item['quantity'] != 0) {
                    $personalProgramItems[] = $this->preparePersonalProgramItem($item);
                }
            } else {
                $notFoundCount += 1;
            }
        }

        return ['items' => $personalProgramItems, 'changedItemsCount' => $changedItemsCount, 'notFoundCount' => $notFoundCount];
    }
    private function processCartItem($item)
    {
        $oldQuantity = $item['quantity'];
        $item = $this->updateQuantity($item);
        $changed = ($item['quantity'] != $oldQuantity) ? 1 : 0;

        return ['item' => $item, 'changed' => $changed];
    }
    private function preparePersonalProgramItem($item)
    {
        if (isset($item['reservation'])) {
            $ticket = $this->timeSlotRepository->getRestaurantReservationById($item['id']);
            $ticket->setReservation($item['reservation']);
        } else {
            //check if it is a day ticket for jazz or a regular ticket; returns either ticket or false
            $ticket = $this->timeSlotRepository->retrieveTimeSlotIfItIsDayTicket($item['id']);
            if(!$ticket)
            {
                //retrieve regular ticket
                $ticket = $this->timeSlotRepository->getJazzTimeSlotById($item['id']);
            }
        }
        $ticket->setQuantity($item['quantity']);
        return $ticket;
    }
    private function preparePersonalProgramMessage($changedItemsCount, $notFoundCount)
    {
        $message = "";

        if ($changedItemsCount > 0) {
            $message .= "<strong> The quantity for {$changedItemsCount} item(s) in your Personal Program has been updated due to stock limitations.</strong> <br>";
        }
        if ($notFoundCount > 0) {
            $message .= "<strong>{$notFoundCount} of the Personal Program items have been sold out or are not available at the moment and have been removed for you.</strong> <br>";
        }

        return $message;
    }
    public function calculateTotals($personalProgramItems)
    {
        $subtotal = 0;
        $vat = 0;

        foreach ($personalProgramItems as $item) {
            $total = $item->getPrice() * $item->getQuantity();
            $subtotal += $total;

            if ($item->getEventID() == 1) {
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
            if($item['quantity'] > 30){
                $item['quantity'] = 30;
            }
        } else {
            $item['quantity'] = 0;
        }

        return $item;
    }
    public function getMostRecentPersonalProgram($userId)
    {
        return  $this->personalProgramRepository->getMostRecentPersonalProgramByUserId($userId);
    }
    public function checkTimeSlotIDExists($id)
    {
        if (!$this->timeSlotRepository->checkTimeSlotIDExists($id)) {
            return false;
        }
        return true;
    }
    public function savePersonalProgram($personalProgramItems, $userId)
    {
        $this->personalProgramRepository->beginTransaction();
        try {
            // Create a new personal program
            $programId = $this->personalProgramRepository->createPersonalProgram($userId);
            // Loop through the cart items and create tickets for each item
            foreach ($personalProgramItems as $item) {
                for ($i = 0; $i < $item->getQuantity(); $i++) {
                    $eventTicketId = $this->personalProgramRepository->createEventTicket($item->getTimeSlotID(), $programId);
                    if($item->getEventID() == 2){
                        $this->personalProgramRepository->createRestaurantReservation($item->getReservation(), $eventTicketId, $item->getTimeSlotID());
                    }
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
    public function updateStatus($programId, $isPaid)
    {
        $this->personalProgramRepository->updatePaymentStatus($programId, $isPaid);
    }
    public function fillPersonalProgramWithItems($personalProgram)
    {
        $personalProgram->setItems($this->personalProgramRepository->getItemsByPersonalProgramId($personalProgram->getProgramID()));
        if ($personalProgram->getItems() == null) {
            throw new ErrorException("Personal Program not found");
        }
        return $personalProgram;
    }
    public function getUserIdByProgramId($programID){
        return $this->personalProgramRepository->getUserIdByProgramId($programID);
    }
    public function getPersonalProgramById($personalProgramId, $userId)
    {
        $personalProgram = $this->personalProgramRepository->getPersonalProgramByIds($personalProgramId, $userId);
        if ($personalProgram == null) {
            throw new ErrorException("Personal Program not found");
        }
        return $personalProgram;
    }
}
