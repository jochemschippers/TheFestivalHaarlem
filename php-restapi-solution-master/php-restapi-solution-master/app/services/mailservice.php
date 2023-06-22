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
            $mail->SMTPDebug = 0;
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
    function sendUpdateEmail($email, $fullName)
    {
        try {
            $subject = 'Account Update Confirmation';
            $body    = 'Hello, your account details have been updated successfully. If you did not make this change, please contact us immediately.';
            $altBody = 'Account Update Confirmation';
            $this->sendEmail($email, $fullName, $subject, $body, $altBody);
        } catch (Exception $e) {
            // Log or echo your error message
            error_log($e->getMessage());
        }
    }
    function sendPaymentEmail($encryptedId)
    {
        try {
            $email = $_SESSION['email'];
            $nameReceiver = $_SESSION['fullName'];
            $subject = "Payment confirmation";
            $body = "We are pleased to confirm the successful receipt of your payment. Thank you for your prompt settlement.<br>
            To view your event tickets, please click on the following link:<br>
            <a href='" . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . "/paymentPage/personalProgram?id={$encryptedId}'>View your tickets</a><br>
            Please note, this link is personalized for your purchase and should not be shared with others. You will be able to view all the details regarding your purchased event tickets on this page.<br>
            Should you have any questions or need further assistance, please do not hesitate to reach out to our customer service team.<br>
            Thank you once again for your purchase. We hope you have an enjoyable experience at the event.<br>
            Best regards,<br>
            The Haarlem Festival Team<br>
            info.thehaarlemfestival@gmail.com";
            $altBody = "Payment confirmation";
            $this->sendEmail($email, $nameReceiver, $subject, $body, $altBody);
        } catch (Exception $e) {
            // Log or echo your error message
            error_log($e->getMessage());
        }
    }
    function sendPasswordResetEmail($email, $nameReceiver)
    {
        try {
            $subject = 'Password Reset';
            $body = 'Hello, you have requested to reset your password. Please click on the link below to reset your password. <br> <a href="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/account/reset_password?email=' . urlencode(base64_encode($email)) . '">Reset Password</a>';
            $altBody = 'This is the body in plain text for non-HTML mail clients';
            $this->sendEmail($email, $nameReceiver, $subject, $body, $altBody);
        } catch (Exception $e) {
            // Log or echo your error message
            error_log($e->getMessage());
        }
    }
    function sendResetConfirmEmail($email, $nameReceiver)
    {
        try {
            $subject = 'Password Reset Confirmation';
            $body    = 'Hello, your password has been reset successfully. If you did not make this change, please contact us immediately.';
            $altBody = 'This is the body in plain text for non-HTML mail clients';
            $this->sendEmail($email, $nameReceiver, $subject, $body, $altBody);
        } catch (Exception $e) {
            // Log or echo your error message
            error_log($e->getMessage());
        }
    }
}
