<?php include 'partials/header.php'; ?>
<div class="container mt-5">
  <h2 class="mb-4">Gymichael - Suivi de performance</h2>
  <form id="gymForm" action="php/traitement-formulaire.php" method="POST">
    <div class="mb-3">
      <label for="email" class="form-label">Adresse Email</label>
      <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="poids" class="form-label">Poids (kg)</label>
      <input type="number" name="poids" id="poids" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="reps" class="form-label">Répétitions</label>
      <input type="number" name="reps" id="reps" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="calories" class="form-label">Calories brûlées</label>
      <input type="number" name="calories" id="calories" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="duree" class="form-label">Durée (minutes)</label>
      <input type="number" name="duree" id="duree" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Soumettre</button>
  </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script src="assets/js/pdf.js"></script>
<?php include 'partials/footer.php'; ?>
<!-- k_t-->