<?php
session_start();


$user_id = $_SESSION['user_id'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$telefono = $_SESSION['telefono'];
$email = $_SESSION['email'];
$id_tipo_usuario = $_SESSION['correo_electronico'];


if (isset($_SESSION['usuario_id'])) {

    $x = 1 + 1;

} else {
    //  no existe la sesion
    $user_id = 1;
}
?>











<!DOCTYPE html>
<html lang="en">

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

</head>

<body onload="init()">
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>OxiAlgas</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $nombre; ?></h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="./index.php" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Panel Rapido</a>
                    <a href="./graficos.php" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Calidad oxigeno</a>


                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="navbar-nav align-items-center ms-auto">


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $nombre . ' ' . $apellido; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                            <a href="#" class="dropdown-item">Ajustes</a>
                            <a href="../index.html" class="dropdown-item">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <h1 class="display-6">Monitoreo de sensores</h1>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">

                            <div class="ms-3">
                                <canvas id="temperatura" width="40" height="40"></canvas>
                                <p class="mb-2" align="center">Temperatura ioreactor</p>
                                <div class="container">

                                </div>
                                <h6 class="mb-0" id="temp_ambiente"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">

                            <div class="ms-3">
                                <canvas id="temperaturaAmbiente" width="40" height="40"></canvas>
                                <p class="mb-2" align="center">Temperatura ambiente</p>
                                <div class="container">

                                </div>
                                <h6 class="mb-0" id="temp_ambiente"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">

                            <div class="ms-3">
                                <canvas id="presionAtmosferica" width="40" height="20"></canvas>
                                <p class="mb-2" align="center">Presion Atmosferica</p>
                                <div class="container">

                                </div>
                                <h6 class="mb-0" id="temp_ambiente"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">

                            <div class="ms-3">
                                <canvas id="humedadAmbiental" width="40" height="20"></canvas>
                                <p class="mb-2" align="center">Humedad Ambiental</p>
                                <div class="container">

                                </div>
                                <h6 class="mb-0" id="temp_ambiente"></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row g-4">

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">

                            <div class="ms-3">
                                <canvas id="tds" width="40" height="20"></canvas>
                                <p class="mb-2" align="center">Solidos Disueltos Totales</p>
                                <div class="container">

                                </div>
                                <h6 class="mb-0" id="temp_ambiente"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">

                            <div class="ms-3">
                                <canvas id="tvoc" width="40" height="20"></canvas>
                                <p class="mb-2" align="center">TVOC Presente en Bio</p>
                                <div class="container">

                                </div>
                                <h6 class="mb-0" id="temp_ambiente"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">

                            <div class="ms-3">
                                <canvas id="tvocbioreactor" width="40" height="20"></canvas>
                                <p class="mb-2" align="center">TVOC en el Bioreactor</p>
                                <div class="container">

                                </div>
                                <h6 class="mb-0" id="temp_ambiente"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">

                            <div class="ms-3">
                                <canvas id="co2presente" width="40" height="20"></canvas>
                                <p class="mb-2" align="center">CO2 Presente ambiente</p>
                                <div class="container">

                                </div>
                                <h6 class="mb-0" id="temp_ambiente"></h6>
                            </div>
                        </div>
                    </div>

                </div>
                <br />
                <div class="row g-4">

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">

                            <div class="ms-3">
                                <canvas id="co2bioreactor" width="40" height="20"></canvas>
                                <p class="mb-2" align="center">CO2 Presente Bioreactor</p>
                                <div class="container">

                                </div>
                                <h6 class="mb-0" id="temp_ambiente"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        
                    </div>

                </div>

            </div>
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->

            <!-- Sales Chart End -->

            <!-- SCRIPTS DE GRAFICAS -->
            <script>
                const cta = document.getElementById('temperatura');

                new Chart(cta, {
                    type: 'bar',
                    data: {
                        labels: ['Red'],
                        datasets: [{
                            label: 'Temperatura',
                            data: [27],

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
            </script>
            <script>
                const ctb = document.getElementById('temperaturaAmbiente');

                new Chart(ctb, {
                    type: 'bar',
                    data: {
                        labels: ['Red'],
                        datasets: [{
                            label: 'Temperatura',
                            data: [27],

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
            </script>
            <script>
                // Obtener el contexto del lienzo
                const ctc = document.getElementById('presionAtmosferica').getContext('2d');

                // Crear el gráfico
                const presionAtmosferica = new Chart(ctc, {
                    type: 'doughnut', // Tipo de gráfico
                    data: {
                        labels: ['Progreso', 'Restante'], // Etiquetas
                        datasets: [{

                            data: [15, 85], // Progreso (75%) y restante (25%)
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.8)', // Color del progreso
                                'rgba(200, 200, 200, 0.4)' // Color del restante
                            ],
                            borderWidth: 0 // Quitar bordes
                        }]
                    },
                    options: {
                        rotation: -90, // Iniciar desde la parte superior (-90 grados)
                        circumference: 180, // Mostrar solo la mitad del círculo (180 grados)
                        cutout: '70%', // Grosor del anillo (ajusta según el diseño deseado)
                        responsive: true, // Ajustar dinámicamente
                        plugins: {
                            legend: {

                                position: 'bottom', // Posición de la leyenda
                                display: false // Ocultar la leyenda


                            },
                            tooltip: {
                                enabled: false // Desactivar tooltips
                            }
                        }
                    }
                });
            </script>
            <script>
                // Obtener el contexto del lienzo
                const ctd = document.getElementById('humedadAmbiental').getContext('2d');

                // Crear el gráfico
                const humedadAmbiental = new Chart(ctd, {
                    type: 'doughnut', // Tipo de gráfico
                    data: {
                        labels: ['Progreso', 'Restante'], // Etiquetas
                        datasets: [{

                            data: [15, 85], // Progreso (75%) y restante (25%)
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.8)', // Color del progreso
                                'rgba(200, 200, 200, 0.4)' // Color del restante
                            ],
                            borderWidth: 0 // Quitar bordes
                        }]
                    },
                    options: {
                        rotation: -90, // Iniciar desde la parte superior (-90 grados)
                        circumference: 180, // Mostrar solo la mitad del círculo (180 grados)
                        cutout: '70%', // Grosor del anillo (ajusta según el diseño deseado)
                        responsive: true, // Ajustar dinámicamente
                        plugins: {
                            legend: {

                                position: 'bottom', // Posición de la leyenda
                                display: false // Ocultar la leyenda


                            },
                            tooltip: {
                                enabled: false // Desactivar tooltips
                            }
                        }
                    }
                });
            </script>

            <script>
                // Obtener el contexto del lienzo
                const cte = document.getElementById('tds').getContext('2d');

                // Crear el gráfico
                const tds = new Chart(cte, {
                    type: 'doughnut', // Tipo de gráfico
                    data: {
                        labels: ['Progreso', 'Restante'], // Etiquetas
                        datasets: [{

                            data: [15, 85], // Progreso (75%) y restante (25%)
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.8)', // Color del progreso
                                'rgba(200, 200, 200, 0.4)' // Color del restante
                            ],
                            borderWidth: 0 // Quitar bordes
                        }]
                    },
                    options: {
                        rotation: -90, // Iniciar desde la parte superior (-90 grados)
                        circumference: 180, // Mostrar solo la mitad del círculo (180 grados)
                        cutout: '70%', // Grosor del anillo (ajusta según el diseño deseado)
                        responsive: true, // Ajustar dinámicamente
                        plugins: {
                            legend: {

                                position: 'bottom', // Posición de la leyenda
                                display: false // Ocultar la leyenda


                            },
                            tooltip: {
                                enabled: false // Desactivar tooltips
                            }
                        }
                    }
                });
            </script>
            <script>
                // Obtener el contexto del lienzo
                const ctf = document.getElementById('tvoc').getContext('2d');

                // Crear el gráfico
                const tvoc = new Chart(ctf, {
                    type: 'doughnut', // Tipo de gráfico
                    data: {
                        labels: ['Progreso', 'Restante'], // Etiquetas
                        datasets: [{

                            data: [15, 85], // Progreso (75%) y restante (25%)
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.8)', // Color del progreso
                                'rgba(200, 200, 200, 0.4)' // Color del restante
                            ],
                            borderWidth: 0 // Quitar bordes
                        }]
                    },
                    options: {
                        rotation: -90, // Iniciar desde la parte superior (-90 grados)
                        circumference: 180, // Mostrar solo la mitad del círculo (180 grados)
                        cutout: '70%', // Grosor del anillo (ajusta según el diseño deseado)
                        responsive: true, // Ajustar dinámicamente
                        plugins: {
                            legend: {

                                position: 'bottom', // Posición de la leyenda
                                display: false // Ocultar la leyenda


                            },
                            tooltip: {
                                enabled: false // Desactivar tooltips
                            }
                        }
                    }
                });
            </script>
            <script>
                // Obtener el contexto del lienzo
                const ctg = document.getElementById('tvocbioreactor').getContext('2d');

                // Crear el gráfico
                const tvocbioreactor = new Chart(ctg, {
                    type: 'doughnut', // Tipo de gráfico
                    data: {
                        labels: ['Progreso', 'Restante'], // Etiquetas
                        datasets: [{

                            data: [15, 85], // Progreso (75%) y restante (25%)
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.8)', // Color del progreso
                                'rgba(200, 200, 200, 0.4)' // Color del restante
                            ],
                            borderWidth: 0 // Quitar bordes
                        }]
                    },
                    options: {
                        rotation: -90, // Iniciar desde la parte superior (-90 grados)
                        circumference: 180, // Mostrar solo la mitad del círculo (180 grados)
                        cutout: '70%', // Grosor del anillo (ajusta según el diseño deseado)
                        responsive: true, // Ajustar dinámicamente
                        plugins: {
                            legend: {

                                position: 'bottom', // Posición de la leyenda
                                display: false // Ocultar la leyenda


                            },
                            tooltip: {
                                enabled: false // Desactivar tooltips
                            }
                        }
                    }
                });
            </script>
            <script>
                // Obtener el contexto del lienzo
                const cth = document.getElementById('co2presente').getContext('2d');

                // Crear el gráfico
                const co2presente = new Chart(cth, {
                    type: 'doughnut', // Tipo de gráfico
                    data: {
                        labels: ['Progreso', 'Restante'], // Etiquetas
                        datasets: [{

                            data: [15, 85], // Progreso (75%) y restante (25%)
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.8)', // Color del progreso
                                'rgba(200, 200, 200, 0.4)' // Color del restante
                            ],
                            borderWidth: 0 // Quitar bordes
                        }]
                    },
                    options: {
                        rotation: -90, // Iniciar desde la parte superior (-90 grados)
                        circumference: 180, // Mostrar solo la mitad del círculo (180 grados)
                        cutout: '70%', // Grosor del anillo (ajusta según el diseño deseado)
                        responsive: true, // Ajustar dinámicamente
                        plugins: {
                            legend: {

                                position: 'bottom', // Posición de la leyenda
                                display: false // Ocultar la leyenda


                            },
                            tooltip: {
                                enabled: false // Desactivar tooltips
                            }
                        }
                    }
                });
            </script>

            <script>
                // Obtener el contexto del lienzo
                const cti = document.getElementById('co2bioreactor').getContext('2d');

                // Crear el gráfico
                const co2bioreactor = new Chart(cti, {
                    type: 'doughnut', // Tipo de gráfico
                    data: {
                        labels: ['Progreso', 'Restante'], // Etiquetas
                        datasets: [{

                            data: [15, 85], // Progreso (75%) y restante (25%)
                            backgroundColor: [
                                'rgba(75, 192, 192, 0.8)', // Color del progreso
                                'rgba(200, 200, 200, 0.4)' // Color del restante
                            ],
                            borderWidth: 0 // Quitar bordes
                        }]
                    },
                    options: {
                        rotation: -90, // Iniciar desde la parte superior (-90 grados)
                        circumference: 180, // Mostrar solo la mitad del círculo (180 grados)
                        cutout: '70%', // Grosor del anillo (ajusta según el diseño deseado)
                        responsive: true, // Ajustar dinámicamente
                        plugins: {
                            legend: {

                                position: 'bottom', // Posición de la leyenda
                                display: false // Ocultar la leyenda


                            },
                            tooltip: {
                                enabled: false // Desactivar tooltips
                            }
                        }
                    }
                });
            </script>

            <!-- Widgets Start -->

            <!-- Widgets End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">OxiAlgas</a>, Derechos Reservados.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            </br>
                            Distributed By <a class="border-bottom" href="https://themewagon.com"
                                target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    <script>
        var ws;

        function init() {
            // Cambia '192.168.1.76' por la dirección IP de tu ESP32
            ws = new WebSocket('ws://192.168.1.76:81'); // IP del ESP32

            ws.onopen = function () {
                console.log("Conectado al WebSocket");
                // Enviar un mensaje para solicitar datos del sensor
                ws.send("GET_DATA");
            };

            ws.onmessage = function (event) {
                const data = JSON.parse(event.data);
                document.getElementById("temp_bioreactor").innerText = "Temperatura: " + data.temperatureWater + " °C";
                document.getElementById("temp_ambiente").innerText = "Temperatura: " + data.temperatureBME + " °C";
                document.getElementById("presion_ambiente").innerText = "Presión: " + data.pressure + " hPa";
                document.getElementById("humedad_ambiente").innerText = "Humedad: " + data.humidity + " %";
                document.getElementById("TDS").innerText = "TDS: " + data.TDS + " ppm";
                document.getElementById("CO2").innerText = "CO₂: " + data.CO2 + " ppm";
                document.getElementById("TVOC").innerText = "TVOC: " + data.TVOC + " ppb";
                document.getElementById("color").innerText = "Color Hexadecimal: " + data.colorHex;
                document.getElementById("Intensidad_luz").innerText = "Intensidad de la luz:" + data.lux;
            };

            ws.onclose = function () {
                console.log("Desconectado del WebSocket");
            };
        }
    </script>

    <!-- JavaScript Libraries -->
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