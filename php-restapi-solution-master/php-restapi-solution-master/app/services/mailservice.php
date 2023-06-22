<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    function sendEmail($email, $nameReceiver, $subject, $body, $altBody)
    {
        //Create a new PHPMailer instance
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'info.thehaarlemfestival@gmail.com';
            $mail->Password = 'fesvstifrbiaxkil';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('info.thehaarlemfestival@gmail.com', 'The Haalem Festival');
            $mail->addAddress($email, $nameReceiver ?? 'User');

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AltBody = $altBody;

            if ($mail->send()) {
                // echo 'Message has been sent';
            } else {
                // echo 'Message could not be sent.';
            }
        } catch (Exception $e) {
            // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    function sendPaymentEmail($encryptedId)
    {
        $email = $_SESSION['email'];
        $nameReceiver = $_SESSION['fullName'];
        $subject = "Payment confirmation";
        $body = "We are pleased to confirm the successful receipt of your payment. Thank you for your prompt settlement.<br>
            To view your event tickets, please click on the following link:<br>            
            [https://yourwebsite.com/paymentPage/personalProgram?id={$encryptedId}](https://yourwebsite.com/paymentPage/personalProgram?id={$encryptedId})<br>            
            Please note, this link is personalized for your purchase and should not be shared with others. You will be able to view all the details regarding your purchased event tickets on this page.<br>            
            Should you have any questions or need further assistance, please do not hesitate to reach out to our customer service team.<br>            
            Thank you once again for your purchase. We hope you have an enjoyable experience at the event.<br>            
            Best regards,<br>            
            The Haarlem Festival Team<br>
            info.thehaarlemfestival@gmail.com";
        $altBody = "Payment confirmation";
        $this->sendEmail($email, $nameReceiver, $subject, $body, $altBody);
    }
}
