<?php $to = "recipient@example.com";
$subject = "Test Email";
$message = "This is a test email sent using PHP mail() function.";
$headers = "From: sender@example.com";

if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
    exit();
} else {
    echo "Email sending failed.";
    exit();
}

?>