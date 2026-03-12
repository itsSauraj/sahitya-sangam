<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/src/SMTP.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $contact_number = trim($_POST['contact_number']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email address.";
        header("Location: ../../contact.php");
        exit();
    }

    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($contact_number) || empty($subject) || empty($message)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../../contact.php");
        exit();
    }

    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Load environment variables
        require_once __DIR__ . '/../config/env.php';
        
        // Server settings
        $mail->isSMTP();
        $mail->Host = env('MAIL_HOST', 'smtp.gmail.com');
        $mail->SMTPAuth = true;
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls') === 'tls' 
            ? PHPMailer::ENCRYPTION_STARTTLS 
            : PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = env('MAIL_PORT', 587);

        // Recipients
        $mail->setFrom(
            env('MAIL_FROM_ADDRESS'), 
            env('MAIL_FROM_NAME', 'Sahitya Sangam Contact')
        );
        $mail->addAddress(
            env('MAIL_USERNAME'), 
            env('MAIL_FROM_NAME', 'Sahitya Sangam')
        );

        // Content
        $mail->isHTML(false);
        $mail->Subject = "Contact Form: " . $subject;
        $mail->Body = "Name: $first_name $last_name\n";
        $mail->Body .= "Email: $email\n";
        $mail->Body .= "Contact Number: $contact_number\n";
        $mail->Body .= "Subject: $subject\n\n";
        $mail->Body .= "Message:\n$message\n";

        $mail->send();
        $_SESSION['success'] = "Your message has been sent successfully!";
    } catch (Exception $e) {
        $_SESSION['error'] = "Failed to send message. Mailer Error: {$mail->ErrorInfo}";
    }

    // Redirect back to contact page
    header("Location: ../../contact.php");
    exit();
} else {
    // If not POST, redirect to contact
    header("Location: ../../contact.php");
    exit();
}
?>