document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchEmail');
    const resultsDiv = document.getElementById('results');
    const pdfButtonContainer = document.getElementById('pdfButtonContainer');
  
    
    form.addEventListener('submit', function (e) {
      e.preventDefault(); 
      searchAndDisplay();
    });
  
    function searchAndDisplay() {
      const emailQuery = searchInput.value.trim().toLowerCase();
      resultsDiv.innerHTML = '';          
      pdfButtonContainer.innerHTML = '';  
  
      fetch('data/data.json')
        .then(response => response.json())
        .then(data => {
          
          const filteredData = data.filter(item => item.email.toLowerCase().includes(emailQuery));
  
          if (filteredData.length === 0) {
            resultsDiv.innerHTML = '<div class="error-message"><h3>Aucune donnée trouvée pour cet email.</h3></div>';
          } else {
            
            const title = document.createElement('h2');
            title.textContent = 'Statistiques de ' + emailQuery;
            title.className = 'mb-4';
            resultsDiv.appendChild(title);
  
            
            const graphs = [
              { id: 'chartPoids', label: 'Poids (kg)', key: 'poids', borderColor: 'blue', stepSize: 5 },
              { id: 'chartCalories', label: 'Calories brûlées (kcal)', key: 'calories', borderColor: 'red', stepSize: 10 },
              { id: 'chartReps', label: 'Répétitions', key: 'reps', borderColor: 'green', stepSize: 2 },
              { id: 'chartDuree', label: 'Durée (minutes)', key: 'duree', borderColor: 'purple', stepSize: 1 }
            ];
  
            
            const chartImages = [];
  
            
            graphs.forEach(graph => {
              
              const container = document.createElement('div');
              container.className = 'chart-container';
  
              
              const h4 = document.createElement('h4');
              h4.textContent = graph.label;
              container.appendChild(h4);
  
              
              const canvas = document.createElement('canvas');
              canvas.id = graph.id;
              canvas.width = 400;
              canvas.height = 200;
              container.appendChild(canvas);
  
              resultsDiv.appendChild(container);
  
              const labels = filteredData.map(item => item.date);
              const graphData = filteredData.map(item => item[graph.key]);
  
              
              new Chart(canvas, {
                type: 'line',
                data: {
                  labels: labels,
                  datasets: [{
                    label: graph.label,
                    data: graphData,
                    borderColor: graph.borderColor,
                    fill: false,
                    pointRadius: 5,
                    pointBackgroundColor: graph.borderColor
                  }]
                },
                options: {
                  scales: {
                    x: { ticks: { autoSkip: false } },
                    y: {
                      beginAtZero: true,
                      ticks: { stepSize: graph.stepSize },
                      title: { display: true, text: graph.label }
                    }
                  }
                }
              });
  
              
              setTimeout(() => {
                const dataUrl = canvas.toDataURL('image/png');
                chartImages.push(dataUrl);
              }, 1000);
            });
  
            
            const pdfButton = document.createElement('button');
            pdfButton.id = 'downloadPDF';
            pdfButton.className = 'btn btn-secondary mt-4';
            pdfButton.textContent = 'Télécharger PDF';
            pdfButtonContainer.appendChild(pdfButton);
  
            
            pdfButton.addEventListener('click', function () {
              const { jsPDF } = window.jspdf;
              const doc = new jsPDF();
  
              doc.setFontSize(18);
              doc.text('Statistiques de ' + emailQuery, 10, 20);
              doc.setFontSize(12);
              let y = 30;
  
              
              filteredData.forEach(item => {
                doc.text('Date: ' + item.date, 10, y);
                doc.text('Poids: ' + item.poids + ' kg', 10, y + 10);
                doc.text('Calories: ' + item.calories + ' kcal', 10, y + 20);
                doc.text('Répétitions: ' + item.reps, 10, y + 30);
                doc.text('Durée: ' + item.duree + ' min', 10, y + 40);
                y += 50;
                if (y > 250) {
                  doc.addPage();
                  y = 20;
                }
              });
              doc.addPage();
              y = 20;
              
              chartImages.forEach((img, index) => {
                if (index > 0) {
                  doc.addPage();
                }
                doc.addImage(img, 'PNG', 10, 60, 180, 90);
              });
  
              
              doc.save('statistiques_' + emailQuery + '.pdf');
            });
          }
        })
        .catch(error => {
          console.error('Erreur lors de la récupération des données :', error);
          resultsDiv.innerHTML = '<div class="error-message"><h3>Erreur lors de la récupération des données.</h3></div>';
        });
    }
  });
  