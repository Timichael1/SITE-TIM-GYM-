document.getElementById('gymForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const email = document.getElementById('email').value;
  const poids = document.getElementById('poids').value;
  const reps = document.getElementById('reps').value;
  const calories = document.getElementById('calories').value;
  const duree = document.getElementById('duree').value;


  const doc = new jspdf.jsPDF();
  doc.text("Gymichael - Résumé de la séance", 10, 10);
  doc.text(`Email: ${email}`, 10, 20);
  doc.text(`Poids: ${poids} kg`, 10, 30);
  doc.text(`Répétitions: ${reps}`, 10, 40);
  doc.text(`Calories brûlées: ${calories}`, 10, 50);
  doc.text(`Durée: ${duree} minutes`, 10, 60);

  const pdfBlob = doc.output("blob");
  const url = URL.createObjectURL(pdfBlob);

  const a = document.createElement("a");
  a.href = url;
  a.download = "gymichael_seance.pdf";
  document.body.appendChild(a);
  a.click();

  setTimeout(() => {
    URL.revokeObjectURL(url);
    a.remove();
  }, 500);

  fetch('php/traitement-formulaire.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({
      email,
      poids,
      reps,
      calories,
      duree
    })
  })
    .then(response => response.text())
    .then(data => {
      console.log("Données bien enregistrées !");
    })
    .catch(error => {
      console.error("Erreur lors de l'enregistrement :", error);
    });
  });
