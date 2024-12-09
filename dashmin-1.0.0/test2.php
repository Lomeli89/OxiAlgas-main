<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chart.js con JSON externo</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" width="400" height="200"></canvas>

    <script>
        // Ruta al archivo JSON
        const jsonUrl = '../php/json/generarArchivo.json';

        // Cargar los datos del JSON
        fetch(jsonUrl)
            .then(response => response.json())
            .then(data => {
                // Generar etiquetas automáticamente
                const labels = data.map((_, index) => `Día ${index + 1}`);

                // Configuración del gráfico
                const ctx = document.getElementById('myChart').getContext('2d');
                new Chart(ctx, {
                    type: 'line', // Cambiar a 'bar', 'pie', etc., según sea necesario
                    data: {
                        labels: labels, // Etiquetas generadas
                        datasets: [{
                            label: 'Valores',
                            data: data, // Los valores del JSON
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error al cargar el JSON:', error);
            });
    </script>
</body>
</html>
