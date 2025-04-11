<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$message = $_POST['message'];

// Configurer PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';  // Le serveur SMTP de Gmail
$mail->SMTPAuth = true;
$mail->Username = 'gymenucourtoise@gmail.com';  // Ton adresse Gmail
$mail->Password = 'Menucourt-2-Best'      // Ton mot de passe Gmail
$mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;  // Sécurisation TLS
$mail->Port = 587;  // Le port SMTP pour Gmail

// Destinataire
$mail->setFrom('tonemail@gmail.com', 'Nom de ton site');
$mail->addAddress($email, $prenom . ' ' . $nom);  // Email de l'utilisateur

// Contenu du mail
$mail->isHTML(true);
$mail->Subject = 'Confirmation de votre message';
$mail->Body    = "Bonjour $prenom $nom,<br><br>Votre message a bien été envoyé. Voici ce que vous avez écrit :<br><br><strong>$message</strong><br><br>Merci pour votre contact !";

// Envoi du mail
if ($mail->send()) {
    // Si le message est envoyé avec succès, rediriger vers la page de confirmation
    header('Location: confirmation.php?status=success');
    exit();  // Important pour arrêter l'exécution du script
} else {
    // En cas d'erreur, afficher un message d'erreur
    echo 'Erreur lors de l\'envoi du message : ' . $mail->ErrorInfo;
}
?>

