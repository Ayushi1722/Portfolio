<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $senderEmail = $_POST['email'];
    $message = $_POST['message'];

    // Receiver details (your details)
    $receiverEmail = 'ayushinirmal1996@gmail.com';
    $receiverName = 'Ayushi Nirmal';

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ayushinirmal1996@gmail.com'; // Your SMTP username
        $mail->Password   = 'Godiswatching@1'; // Your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender details
        $mail->setFrom($senderEmail, $name);

        // Receiver details
        $mail->addAddress($receiverEmail, $receiverName);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Form Submission from ' . $name;
        $mail->Body    = "Name: $name<br>Email: $senderEmail<br><br>Message:<br>$message";

        // Send email
        $mail->send();

        echo 'Email has been sent successfully!';
    } catch (Exception $e) {
        // Log the error
        $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        error_log($errorMessage);

        echo $errorMessage;
    }
} else {
    http_response_code(405); // Set 405 Method Not Allowed status
    echo 'Method Not Allowed';
}
?>
