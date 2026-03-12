<?php
require_once __DIR__ . '/../config/init.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/phpmailer/src/Exception.php';
require '../../vendor/phpmailer/src/PHPMailer.php';
require '../../vendor/phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = env('MAIL_HOST', 'smtp.gmail.com');
    $mail->SMTPAuth = true;
    $mail->Username = env('MAIL_USERNAME');
    $mail->Password = env('MAIL_PASSWORD');
    $mail->SMTPSecure = env('MAIL_ENCRYPTION', 'tls') === 'tls' 
        ? PHPMailer::ENCRYPTION_STARTTLS 
        : PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = env('MAIL_PORT', 587);

    $mail->setFrom(
        env('MAIL_FROM_ADDRESS'), 
        env('MAIL_FROM_NAME', 'Test')
    );
    $mail->addAddress(
        env('MAIL_USERNAME'), 
        'Test Recipient'
    );

    $mail->isHTML(false);
    $mail->Subject = 'Test Email from PHPMailer';
    $mail->Body = 'This is a test email sent using PHPMailer.';

    $mail->send();
    echo 'Email sent successfully!';
} catch (Exception $e) {
    echo "Failed to send email. Error: {$mail->ErrorInfo}";
}
?>