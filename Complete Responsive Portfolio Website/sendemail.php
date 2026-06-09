
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

   // Initialize PHPMailer
   $mail = new PHPMailer(true);

   // Enable debugging
   $mail->SMTPDebug = 2;

   try {
       // SMTP configuration
       $mail->isSMTP();
       $mail->Host = 'ssl0.ovh.net';  // Specify your SMTP server
       $mail->SMTPAuth = true;
       $mail->Username = 'admin@solutions-mtech.com'; // SMTP username
       $mail->Password = 'admin1234'; // SMTP password
       $mail->SMTPSecure = 'ssl'; // Enable TLS encryption
       $mail->Port = 465; // TCP port to connect to

       // Sender and recipient
       $mail->setFrom($email, $name);
       $mail->addAddress('walidbchini@gmail.com'); // Add a recipient

       // Email content
       $mail->isHTML(false);
       $mail->Subject = $subject;
       $mail->Body = "Name: $name\n" .
                     "Email: $email\n" .
                     "Mobile: $mobile\n" .
                     "Message:\n$message";

       // Send email
       $mail->send();
       // Redirect back to index.html with success flag
       header("Location: index.html?success=true");
       exit;
   } catch (Exception $e) {
       echo "Failed to send the message. Error: {$mail->ErrorInfo}";
   }
} else {
   // Not a POST request, ignore
   echo "Invalid request.";
}