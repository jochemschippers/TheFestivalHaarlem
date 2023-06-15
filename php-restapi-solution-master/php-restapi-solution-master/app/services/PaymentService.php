<?php
require_once __DIR__ . '/../repositories/paymentrepository.php';


class PaymentService
{
    private $repository;
    private $mollie;
    
    private $URL;
    function __construct()
    {
        $this->repository = new PaymentRepository();
        $this->URL = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        require_once __DIR__ . "/../vendor/autoload.php";
        $this->mollie = new \Mollie\Api\MollieApiClient();
        $this->mollie->setApiKey("test_wJ4ga3MgMbww8yk3S3Hb98EUxDebuN");
    }
    public function GetJazzTickets()
    {
        return $this->repository->GetJazzTickets();
    }
    public function createMolliePayment($total) {
        // if(isset($_SESSION['paymentId'])) {
        //     $existingPayment = $this->mollie->payments->get($_SESSION['paymentId']);
        //     if($existingPayment->status == 'open') {
        //         throw new ErrorException('You have an open payment. Please complete that payment first.');
        //     }
        // }
        try {
            $expiresAt = new DateTime("+15 minutes");
            $paymentLink = $this->mollie->paymentLinks->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $total
                ],
                "description" => "Order for The Festival",
                "redirectUrl" => $this->URL . "paymentPage/paymentSuccess",
                "expiresAt" => $expiresAt->format(DateTime::ATOM)
            ]);
            //TODO; zoek op hoe je van paymentlink naar payment kan gaan
            $_SESSION['paymentId'] = $paymentLink->id;
            return $paymentLink->getCheckoutUrl();
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            throw new ErrorException("Something went wrong with our payment provider! We are fixing the issue right now, please try again later.");

            //throw new ErrorException($e->getMessage());
        }
    }

    public function verifyPayment($paymentId) {
        try {
            $paymentLink = $this->mollie->paymentLinks->get($_SESSION['paymentId']);
            $payments = $this->mollie->payments->page();
            return $payments[0]->status;
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
