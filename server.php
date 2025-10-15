<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["First_name"];
    $lastName = $_POST["Last_name"];
    $email = $_POST["Email"];
    $subject = $_POST["Subject"];
    $message = $_POST["Message"];
    
    // Validate email format and required fields (add more validation as needed)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($firstName) || empty($subject) || empty($message)) {
        echo "Invalid form data. Please check your inputs.";
    } else {
        $to = "animsaha16@gmail.com"; // Your email address
        $subject = "Contact Form Submission: $subject";
        $headers = "From: $email";
        
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
            //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'animsaha16@gmail.com';                     //SMTP username
    $mail->Password   = 'erbd grok ther slym';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('animsaha16@gmail.com', 'Anim');
    $mail->addAddress('animsaha16@gmail.com', 'Anim Saha');     //Add a recipient

    //Content
    $mail->isHTML(true);                                       //Set email format to HTML
    $mail->setFrom($email);
    $mail->addAddress($to);                                  
    $mail->Subject = $subject;
    $mail->Body = $message;
        
        if ($mail->send()) {
            echo "Message sent successfully!";
        } else {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";        }
    }
  }
?>
