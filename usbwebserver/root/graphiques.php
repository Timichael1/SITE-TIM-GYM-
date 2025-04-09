<?php include 'partials/header.php'; ?>

<head>
  <link rel="stylesheet" href="assets/css/stylegraph.css"> 
</head>

<div class="container mt-5">
  
  <form id="searchForm" method="POST" action="">
    <label for="searchEmail" class="form-label">Entrez l'email de l'utilisateur :</label>
    <input type="text" id="searchEmail" name="nom_utilisateur" class="form-control" value="<?= isset($_POST['nom_utilisateur']) ? htmlspecialchars($_POST['nom_utilisateur']) : '' ?>" required>
    <button type="submit" class="btn btn-primary mt-2">Rechercher</button>
  </form>

 
  <div id="results"></div>

 
  <div id="pdfButtonContainer" style="margin-top: 20px;"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script src="assets/js/statistiques.js"></script>

<?php include 'partials/footer.php'; ?>
