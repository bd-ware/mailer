<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $sender = $_POST['sender'];    
    $username = $_POST['username'];  
    $password = $_POST['password'];  
    $from =  $_POST['username'];


    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->setFrom($from, $sender);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->addAddress($to);


    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent successfully!';
    }
} else {
    echo 'Please submit the form.';
}
?>
