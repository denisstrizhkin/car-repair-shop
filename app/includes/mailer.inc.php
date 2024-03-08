<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once(__DIR__ . '/../vendor/autoload.php');

class Sender {
    const string USER = "user";
    const string PASSWORD = "password";
}

function mailer_send(
    string $address,
    string $subject,
    string $body
): void {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    # $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPAuth = true;

    $mail->Username = Sender::USER;
    $mail->Password = Sender::PASSWORD;

    $mail->setFrom(Sender::USER);
    $mail->addAddress($address);
    $mail->isHTML(false);

    $mail->CharSet = 'UTF-8';
    $mail->setLanguage('ru');
    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->send();
}
