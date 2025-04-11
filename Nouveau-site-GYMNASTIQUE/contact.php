<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_POST['submit'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'gymenucourtoise@gmail.com';
        $mail->Password = 'Menucourt-2-Best';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('gymenucourtoise@gmail.com', 'Formulaire Tim Gym');
        $mail->addAddress('gymenucourtoise@gmail.com', 'Toi');
        $mail->isHTML(true);
        $mail->Subject = 'Nouveau message de contact';
        $mail->Body = "
            <h2>Nouveau message de contact</h2>
            <p><strong>Nom :</strong> $nom</p>
            <p><strong>Prénom :</strong> $prenom</p>
            <p><strong>Email :</strong> $email</p>
            <p><strong>Message :</strong><br>$message</p>
        ";
        $mail->send();

        $mail->clearAddresses();
        $mail->addAddress($email, "$prenom $nom");
        $mail->Subject = 'Confirmation de votre message';
        $mail->Body = "
            <p>Bonjour $prenom,</p>
            <p>Nous avons bien reçu votre message :</p>
            <blockquote>$message</blockquote>
            <p>Nous vous répondrons dans les meilleurs délais.</p>
            <p>L’équipe Tim Gym</p>
        ";
        $mail->send();

        header("Location: confirmation.php?nom=$nom&prenom=$prenom&email=$email&message=" . urlencode($message));
        exit();

    } catch (Exception $e) {
        header("Location: erreur.php");
        exit();
    }
} else {
    header("Location: index.html");
    exit();
}
