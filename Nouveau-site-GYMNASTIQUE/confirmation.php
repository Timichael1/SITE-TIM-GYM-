<?php
$nom = htmlspecialchars($_GET['nom'] ?? '');
$prenom = htmlspecialchars($_GET['prenom'] ?? '');
$email = htmlspecialchars($_GET['email'] ?? '');
$message = htmlspecialchars($_GET['message'] ?? '');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Message envoyé</title>
</head>
<body>
    <h1>Merci <?php echo $prenom . " " . $nom; ?> !</h1>
    <p>Votre message a bien été envoyé à l'adresse : <strong><?php echo $email; ?></strong>.</p>
    <h3>Contenu de votre message :</h3>
    <p><?php echo nl2br($message); ?></p>
</body>
</html>
