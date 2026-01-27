<?php
require_once ("../PHPMailer");
require_once ("../ExcelExportAPI/Classes/PHPExcel/IOFactory.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host       = 'mail.cancrm.in'; // ya smtp.cancrm.in
    $mail->SMTPAuth   = true;
    $mail->Username   = 'contact@cancrm.in';
    $mail->Password   = 'EMAIL_PASSWORD_HERE';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Sender
    $mail->setFrom('contact@cancrm.in', 'CAN CRM');

    // Receiver
    $mail->addAddress('testreceiver@gmail.com');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Test Mail from CAN CRM';
    $mail->Body    = '
        <h3>Hello 👋</h3>
        <p>This email is sent using <b>Plesk SMTP server</b>.</p>
        <p>No Gmail. No hacks. Just clean infrastructure.</p>
    ';

    $mail->send();
    echo "✅ Mail sent successfully!";
} catch (Exception $e) {
    echo "❌ Mail failed: {$mail->ErrorInfo}";
}
