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
        $this->URL = 'https://' . $_SERVER['HTTP_HOST'] . '/';
        require_once __DIR__ . "/../vendor/autoload.php";
        $this->mollie = new \Mollie\Api\MollieApiClient();
        $this->mollie->setApiKey("test_wJ4ga3MgMbww8yk3S3Hb98EUxDebuN");
    }
    public function GetJazzTickets()
    {
        return $this->repository->GetJazzTickets();
    }
    public function createMolliePayment($total, $cart, $programID)
    {
        $userId = $_SESSION['userID'];
        $this->checkOpenPayment($userId);
        try {
            $payment = $this->mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => $total
                ],
                "description" => "Order for The Festival",
                "redirectUrl" => $this->URL . "paymentPage/paymentConfirm",
                "webhookUrl"  => $this->URL . "paymentPage/mollieWebhook",
            ]);
            $this->storePaymentId($userId, $payment->id, $programID);
            error_log($payment->id);
            return $payment->getCheckoutUrl();
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            throw new ErrorException("Something went wrong with our payment provider! We are fixing the issue right now, please try again later.");

            //throw new ErrorException($e->getMessage());
        }
    }
    public function checkIfPaymentPaid($paymentId)
    {
        $payment = $this->mollie->payments->get($paymentId);
        $paymentStatus = $payment->status;
        if ($paymentStatus === 'paid') {
            return true;
        } else {
            return false;
        }
    }
    public function getProgramIdByPaymentId($paymentId)
    {
        $paymentId = $this->repository->getProgramIdByPaymentId($paymentId);
        $this->repository->deletePaymentIdByPaymentId($paymentId);
        return $paymentId;
    }

    private function storePaymentId($userId, $paymentId, $programID)
    {
        $this->repository->storePaymentId($userId, $paymentId, $programID);
    }

    public function checkOpenPayment($userId)
    {
        // Fetch the most recent payment id for the user from the database
        $paymentId = $this->repository->getPaymentIdByUserId($userId);

        // If there is a payment id, check its status
        if ($paymentId) {
            // Fetch the payment status from Mollie's API
            $paymentStatus = $this->getPaymentStatusFromMollie($paymentId);

            if ($paymentStatus === 'open') {
                // If the payment status is 'open', throw an exception to prevent creating a new payment
                throw new ErrorException('You have an open payment. Please complete that payment first. <a href="' . $this->getPaymentUrl($paymentId) . '">Click here to complete your payment.</a>');
            }
        }
    }
    public function getPaymentStatusFromMollie($paymentId)
    {
        $payment = $this->mollie->payments->get($paymentId);
        return $payment->status;
    }
    private function getPaymentUrl($paymentId)
    {
        $payment = $this->mollie->payments->get($paymentId);
        return $payment->getCheckoutUrl();
    }
}
