<?php
include_once '../php/conexion.php'; // Asegúrate de que la ruta sea correcta
include_once '../php/bioreactores.php';

$database = new Database();
$conn = $database->getConnection();

$bioreactor = new Bioreactores($conn);

$tdsData = $bioreactor->mostrarTDS();

echo $tdsData; // Imprime los datos JSON
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Aseguramos que el canvas ocupe el 100% del tamaño disponible */
        #chartContainer {
            width: 80%;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <h1>Gráfica de TDS</h1>

    <!-- Contenedor para la gráfica -->
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>