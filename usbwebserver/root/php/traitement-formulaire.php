<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_POST['email'], $_POST['poids'], $_POST['reps'], $_POST['calories'], $_POST['duree'])) {
        echo "Toutes les informations sont requises.";
        exit;
    }


    date_default_timezone_set('Europe/Paris');  

    $email = $_POST['email'];
    $poids = $_POST['poids'];
    $reps = $_POST['reps'];
    $calories = $_POST['calories'];
    $duree = $_POST['duree'];


    $data = [
        'email' => $email,
        'poids' => (int)$poids,
        'reps' => (int)$reps,
        'calories' => (int)$calories,
        'duree' => (int)$duree,
        'date' => date('Y-m-d H:i:s') 
    ];

    
    $jsonFile = '../data/data.json';
    $jsonData = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
    $jsonData[] = $data;
    file_put_contents($jsonFile, json_encode($jsonData, JSON_PRETTY_PRINT));

    
    require_once('../libs/jsPDF/autoload.php'); 

    $pdf = new \JSPDF\JSPDF();
    $pdf->AddPage();

    
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Résumé de la Seance - Gymichael', 0, 1, 'C');

    
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Date : ' . date('Y-m-d H:i:s'), 0, 1);  
   
    $pdf->Cell(0, 10, 'Email : ' . $email, 0, 1);
    $pdf->Cell(0, 10, 'Poids : ' . $poids . ' kg', 0, 1);
    $pdf->Cell(0, 10, 'Répétitions : ' . $reps, 0, 1);
    $pdf->Cell(0, 10, 'Calories : ' . $calories, 0, 1);
    $pdf->Cell(0, 10, 'Durée : ' . $duree . ' minutes', 0, 1);

    
    $pdf->Output('I', 'seance_' . time() . '.pdf');  
}
?>
