<?php

session_start();

// Verifica si la sesión está activa
if (isset($_SESSION['user_id'])) {
    // Recupera los datos de la sesión
    $user_id = $_SESSION['user_id'];
    $name = $_SESSION['nombre'];
    $lastname = $_SESSION['apellido'] ?? '';
    $phone = $_SESSION['telefono'] ?? '';
    $email = $_SESSION['correo_electronico'] ?? '';
    $tipoUsuario = $_SESSION['id_tipo_usuario'] ?? ''; // Asegúrate de usar la clave correcta
} else {
    session_destroy();
    header('Location: ./signin.php');
    exit;
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
    <style>
        .sensor-card {
            height: 300px; /* Altura fija para todas las cards */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center; /* Asegurar texto centrado */
            background-color: #f8f9fa; /* Fondo claro */
            border-radius: 10px; /* Bordes redondeados */
            padding: 20px;
        }

        .sensor-card canvas {
            width: auto; /* Tamaño fijo para canvas */
            height: 300px; /* Tamaño fijo para canvas */
        }
    

        .sensor-card p {
            margin-top: 10px;
            font-size: 14px; /* Tamaño del texto */
        }

        .sensor-card h6 {
            margin-top: 5px;
            font-weight: bold;
        }
    </style>

</head>

<body onload="init()">
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-success" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-success"></i>OxiAlgas</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                    <h6 class="mb-0"><?php echo 'Hola '.$name; ?></h6>
                    <?php
                    if ($tipoUsuario == 1){
                        echo '<code class="text-success">Cliente</code>';
                        
                    }else if ($tipoUsuario == 2) {
                        echo '<code class="text-success">Administrador</code>';
                    }else {
                        echo '<code class="text-danger">Error Desconocido</code>';
                    }
                    ?>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="./index.php" class="nav-item nav-link active"><i class="bi bi-clipboard-data"></i>Panel Rapido</a><br />
                    <a href="./clientes.php" class="nav-item nav-link "><i class="bi bi-clipboard-data"></i>Clientes</a><br />
                    <a href="./bioreactoradmin.php" class="nav-item nav-link "><i class="bi bi-bar-chart-fill"></i>Bioreactores</a><br />
                    <a href="./graficos.php" class="nav-item nav-link "><i class="bi bi-bar-chart-fill"></i>TDS</a><br />
                    <a href="./co2.php" class="nav-item nav-link "><i class="bi bi-bar-chart-fill"></i>cO2</a><br />
                    <a href="./tempagua.php" class="nav-item nav-link "><i class="bi bi-bar-chart-fill"></i>Temperatura agua</a><br />
                    <a href="./tvoc.php" class="nav-item nav-link "><i class="bi bi-bar-chart-fill"></i>TVOC</a><br />
                    <a href="./bioreactor.php" class="nav-item nav-link "><i class="bi bi-bar-chart-fill"></i>Bioreactor</a><br />


                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-success mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>

                <div class="navbar-nav align-items-center ms-auto">


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="img/user.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $name . ' ' . $lastname; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                            <a href="#" class="dropdown-item">Ajustes</a>
                            <a href="../php/sesion/cerrarSesion.phpss" class="dropdown-item">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <h1 class="display-6 text-center">Monitoreo de información</h1>
                <div class="row g-4">
                    <!-- Sensor 1 -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="sensor-card">
                            <canvas id="temperatura"></canvas>
                            <p>Temperatura Bioreactor:</p>
                            <p id="temperaturaValueLabel" style="font-size: 24px; margin-top: 1px; font-weight: bold; color: #333;">32.5 C</p>
                            <h6 id="temp_bioreactor"></h6>
                        </div>
                    </div>
                    <!-- Sensor 2 -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="sensor-card">
                            <canvas id="temperaturaAmbiente"></canvas>
                            <p>Temperatura Ambiente</p>
                            <p id="temperaturaAmbienteValueLabel" style="font-size: 24px; margin-top: 1px; font-weight: bold; color: #333;">27 C</p>
                            <h6 id="temp_ambiente"></h6>
                        </div>
                    </div>
                    <!-- Sensor 3 -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="sensor-card">
                            <canvas id="co2bioreactor"></canvas>
                            <p>CO2 Presente Bioreactor</p>
                            <p id="co2ValueLabel" style="font-size: 24px; margin-top: 1px; font-weight: bold; color: #333;">350 ppm</p>
                            <h6 id="co2_bioreactor"></h6>
                        </div>
                    </div>
                    <!-- Sensor 4 -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="sensor-card">
                            <canvas id="humedadAmbiental"></canvas>
                            <p>Humedad Ambiental</p>
                            <p id="humedadValueLabel" style="font-size: 24px; margin-top: 1px; font-weight: bold; color: #333;">50</p>
                            <h6 id="humedad_ambiental"></h6>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mt-4">
                    <!-- Sensor 5 -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="sensor-card">
                            <canvas id="tds"></canvas>
                            <p>Sólidos Disueltos Totales</p>
                            <p id="tdsValueLabel" style="font-size: 24px; margin-top: 1px; font-weight: bold; color: #333;">900</p>
                            <h6 id="tds_value"></h6>
                        </div>
                    </div>
                    <!-- Sensor 6 -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="sensor-card">
                            <canvas id="tvoc"></canvas>
                            <p>TVOC Presente</p>
                            <p id="tvocValueLabel" style="font-size: 24px; margin-top: 1px; font-weight: bold; color: #333;">50</p>
                            <h6 id="tvoc_value"></h6>
                        </div>
                    </div>
                    <!-- Sensor 7 -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="sensor-card">
                            <canvas id="tvocbioreactor"></canvas>
                            <p>TVOC en el Bioreactor</p>
                            <p id="tvocBioreactorValueLabel" style="font-size: 24px; margin-top: 1px; font-weight: bold; color: #333;">2</p>
                            <h6 id="tvoc_bioreactor"></h6>
                        </div>
                    </div>
                    <!-- Sensor 8 -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="sensor-card">
                            <canvas id="co2presente"></canvas>
                            <p>CO2 Presente Ambiente</p>
                            <p id="co2PresenteValueLabel" style="font-size: 24px; margin-top: 1px; font-weight: bold; color: #333;">700</p>
                            <h6 id="co2_presente"></h6>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->

            <!-- Sales Chart End -->

            <!-- SCRIPTS DE GRAFICAS -->
            <script>
                const cta = document.getElementById('temperatura');
                const temperaturaValueLabel = document.getElementById('temperaturaValueLabel');

                // Función para calcular el color dinámico en tonos azul-naranja
                function getColor(temperatura) {
                    const rangoInicio = 25; // Temperatura en la que comienza azul
                    const rangoNaranja = 30; // Temperatura en la que comienza naranja
                    const rangoFinal = 40;  // Temperatura máxima (naranja intenso)

                    // Escalar temperatura al rango 0-1
                    const porcentaje = Math.min(Math.max((temperatura - rangoInicio) / (rangoFinal - rangoInicio), 0), 1);

                    if (temperatura <= rangoNaranja) {
                        // Azul más claro en el rango de 25°C a 30°C
                        const azul = Math.floor(255 * (1 - porcentaje)); // Azul dominante
                        const rojo = Math.floor(200 * porcentaje); // Mezcla gradual hacia naranja
                        const verde = Math.floor(180 * (1 - porcentaje)); // Verde intermedio
                        return `rgb(${rojo}, ${verde}, ${azul})`;
                    } else {
                        // Naranja en el rango de 30°C a 40°C
                        const rojo = Math.floor(255 * porcentaje); // Rojo dominante
                        const verde = Math.floor(150 * (1 - porcentaje)); // Verde reducido
                        const azul = Math.floor(100 * (1 - porcentaje)); // Azul casi ausente
                        return `rgb(${rojo}, ${verde}, ${azul})`;
                    }
                }

                // Valor inicial desde el elemento <p>
                let temperaturaActual = parseFloat(temperaturaValueLabel.textContent);

                // Crear el gráfico
                const temperaturaChart = new Chart(cta, {
                    type: 'bar', // Tipo de gráfico: barra
                    data: {
                        labels: ['Temperatura'], // Etiqueta del gráfico
                        datasets: [{
                            label: 'Temperatura',
                            data: [temperaturaActual], // Valor actual
                            borderWidth: 1,
                            backgroundColor: getColor(temperaturaActual) // Color dinámico
                        }]
                    },
                    options: {
                        responsive: true, // Ajuste responsivo
                        maintainAspectRatio: true, // Mantener proporciones
                        scales: {
                            y: {
                                beginAtZero: true, // Comienza desde 0
                                max: 40 // Máximo del eje Y
                            },
                            x: {
                                grid: {
                                    display: false // Opcional: Ocultar las líneas de la grilla del eje X
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false // Ocultar leyenda
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `Temperatura: ${context.raw}°C`; // Tooltip personalizado
                                    }
                                }
                            }
                        }
                    }
                });

                // Función para actualizar el gráfico dinámicamente
                function updateTemperaturaChart() {
                    // Leer el nuevo valor desde el <p>
                    const nuevaTemperatura = parseFloat(temperaturaValueLabel.textContent);

                    // Actualizar el gráfico solo si el valor ha cambiado
                    if (nuevaTemperatura !== temperaturaActual) {
                        temperaturaActual = nuevaTemperatura;

                        // Actualizar datos del gráfico
                        temperaturaChart.data.datasets[0].data = [temperaturaActual];
                        temperaturaChart.data.datasets[0].backgroundColor = getColor(temperaturaActual);

                        // Actualizar el gráfico visualmente
                        temperaturaChart.update();
                    }
                }

                // Actualizar el gráfico cada segundo
                setInterval(updateTemperaturaChart, 1000); // Puedes ajustar el intervalo si es necesario
            </script>



            <script>
                const ctb = document.getElementById('temperaturaAmbiente');
                const temperaturaAmbienteValueLabel = document.getElementById('temperaturaAmbienteValueLabel');

                // Función para calcular el color dinámico en tonos azul-naranja
                function getColor(temperatura) {
                    const rangoInicio = 25; // Temperatura en la que comienza azul
                    const rangoNaranja = 30; // Temperatura en la que comienza naranja
                    const rangoFinal = 40;  // Temperatura máxima (naranja intenso)

                    if (temperatura <= rangoNaranja) {
                        // Azul más claro en el rango de 25°C a 30°C
                        const porcentaje = Math.min(Math.max((temperatura - rangoInicio) / (rangoNaranja - rangoInicio), 0), 1);
                        const azul = Math.floor(255 * (1 - porcentaje)); // Azul dominante
                        const rojo = Math.floor(200 * porcentaje); // Mezcla gradual hacia naranja
                        const verde = Math.floor(180 * (1 - porcentaje)); // Verde intermedio
                        return `rgb(${rojo}, ${verde}, ${azul})`;
                    } else {
                        // Naranja en el rango de 30°C a 40°C
                        const porcentaje = Math.min(Math.max((temperatura - rangoNaranja) / (rangoFinal - rangoNaranja), 0), 1);
                        const rojo = Math.floor(255 * porcentaje); // Rojo dominante
                        const verde = Math.floor(150 * (1 - porcentaje)); // Verde reducido
                        const azul = Math.floor(100 * (1 - porcentaje)); // Azul casi ausente
                        return `rgb(${rojo}, ${verde}, ${azul})`;
                    }
                }

                // Valor inicial desde el elemento <p>
                let temperaturaAmbienteActual = parseFloat(temperaturaAmbienteValueLabel.textContent);

                // Crear el gráfico
                const temperaturaAmbienteChart = new Chart(ctb, {
                    type: 'bar', // Tipo de gráfico: barra
                    data: {
                        labels: ['Temperatura'], // Etiqueta del gráfico
                        datasets: [{
                            label: 'Temperatura',
                            data: [temperaturaAmbienteActual],
                            borderWidth: 1,
                            backgroundColor: getColor(temperaturaAmbienteActual) // Color dinámico
                        }]
                    },
                    options: {
                        responsive: true, // Ajuste responsivo
                        maintainAspectRatio: true, // Mantener proporciones
                        scales: {
                            y: {
                                beginAtZero: true, // Comienza desde 0
                                max: 40 // Máximo del eje Y
                            }
                        },
                        plugins: {
                            legend: {
                                display: false // Ocultar leyenda
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `Temperatura: ${context.raw}°C`; // Etiqueta flotante al pasar el cursor
                                    }
                                }
                            }
                        }
                    }
                });

                // Función para actualizar el gráfico dinámicamente
                function updateTemperaturaAmbienteChart() {
                    // Leer el nuevo valor desde el <p>
                    const nuevaTemperatura = parseFloat(temperaturaAmbienteValueLabel.textContent);

                    // Actualizar el gráfico solo si el valor ha cambiado
                    if (nuevaTemperatura !== temperaturaAmbienteActual) {
                        temperaturaAmbienteActual = nuevaTemperatura;

                        // Actualizar datos del gráfico
                        temperaturaAmbienteChart.data.datasets[0].data = [temperaturaAmbienteActual];
                        temperaturaAmbienteChart.data.datasets[0].backgroundColor = getColor(temperaturaAmbienteActual);

                        // Actualizar el gráfico visualmente
                        temperaturaAmbienteChart.update();
                    }
                }

                // Actualizar el gráfico cada segundo
                setInterval(updateTemperaturaAmbienteChart, 1000); // Puedes ajustar el intervalo si es necesario
            </script>



            <script>
                // Obtener el contexto del lienzo y elementos DOM
                const cti = document.getElementById('co2bioreactor').getContext('2d');
                const co2ValueLabel = document.getElementById('co2ValueLabel');

                // Función para calcular el color dinámico en tonos de verde oscuro
                function getColor(co2) {
                    const rangoInicio = 0;     // Mínimo para verde
                    const rangoFinal = 1500;  // Máximo para verde oscuro

                    // Escalar CO2 al rango 0-1
                    const porcentaje = Math.min(Math.max(co2 / rangoFinal, 0), 1);

                    const verde = Math.floor(255 * (1 - porcentaje)); // Verde se oscurece a medida que aumenta el CO2
                    return `rgb(0, ${verde}, 0)`;                     // Verde puro
                }

                // Configuración inicial del gráfico
                let co2ValorActual = parseInt(co2ValueLabel.textContent, 10); // Lee el valor inicial desde el <p>

                const co2bioreactor = new Chart(cti, {
                    type: 'doughnut', // Tipo de gráfico
                    data: {
                        labels: ['CO2 Bioreactor', 'Restante'], // Etiquetas
                        datasets: [{
                            data: [co2ValorActual, 1500 - co2ValorActual], // Progreso y restante
                            backgroundColor: [
                                getColor(co2ValorActual), // Color dinámico para el progreso
                                'rgba(200, 200, 200, 0.4)' // Color fijo para el restante
                            ],
                            borderWidth: 0 // Quitar bordes
                        }]
                    },
                    options: {
                        rotation: -90, // Iniciar desde la parte superior (-90 grados)
                        circumference: 180, // Mostrar solo la mitad del círculo (180 grados)
                        cutout: '70%', // Grosor del anillo
                        responsive: true, // Ajustar dinámicamente
                        plugins: {
                            legend: {
                                position: 'bottom', // Posición de la leyenda
                                display: false // Ocultar la leyenda
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `CO2: ${context.raw} ppm`; // Etiqueta personalizada
                                    }
                                }
                            }
                        }
                    }
                });

                // Función para actualizar el gráfico dinámicamente
                function updateGraph() {
                    // Leer el valor desde el elemento <p>
                    const nuevoValor = parseInt(co2ValueLabel.textContent, 10);

                    // Actualizar el gráfico solo si el valor ha cambiado
                    if (nuevoValor !== co2ValorActual) {
                        co2ValorActual = nuevoValor;

                        // Actualizar datos del gráfico
                        co2bioreactor.data.datasets[0].data = [co2ValorActual, 1500 - co2ValorActual];
                        co2bioreactor.data.datasets[0].backgroundColor[0] = getColor(co2ValorActual);

                        // Actualizar el gráfico visualmente
                        co2bioreactor.update();
                    }
                }

                // Actualizar el gráfico cada segundo
                setInterval(updateGraph, 1000); // Puedes ajustar el intervalo si es necesario
            </script>



            <script>
                // Obtener el contexto del lienzo y el elemento <p>
                const ctd = document.getElementById('humedadAmbiental').getContext('2d');
                const humedadValueLabel = document.getElementById('humedadValueLabel');

                // Función para calcular el color dinámico en tonos de azul oscuro
                function getColor(humedad) {
                    const rangoMaximo = 100; // Máximo de humedad en porcentaje

                    // Escalar humedad al rango 0-1
                    const porcentaje = Math.min(Math.max(humedad / rangoMaximo, 0), 1);

                    const azul = Math.floor(255 - (255 * porcentaje)); // Azul claro para baja humedad, oscuro para alta humedad
                    return `rgb(0, 0, ${azul})`; // Azul puro
                }

                // Valor inicial desde el elemento <p>
                let humedadActual = parseInt(humedadValueLabel.textContent, 10);

                // Crear el gráfico
                const humedadAmbiental = new Chart(ctd, {
                    type: 'doughnut', // Tipo de gráfico
                    data: {
                        labels: ['Humedad', 'Restante'], // Etiquetas
                        datasets: [{
                            data: [humedadActual, 100 - humedadActual], // Progreso y restante
                            backgroundColor: [
                                getColor(humedadActual), // Color dinámico para el progreso
                                'rgba(200, 200, 200, 0.4)' // Color fijo para el restante
                            ],
                            borderWidth: 0 // Quitar bordes
                        }]
                    },
                    options: {
                        rotation: -90, // Iniciar desde la parte superior (-90 grados)
                        circumference: 180, // Mostrar solo la mitad del círculo (180 grados)
                        cutout: '70%', // Grosor del anillo
                        responsive: true, // Ajustar dinámicamente
                        plugins: {
                            legend: {
                                position: 'bottom', // Posición de la leyenda
                                display: false // Ocultar la leyenda
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `Humedad: ${context.raw}%`; // Etiqueta personalizada
                                    }
                                }
                            }
                        }
                    }
                });

                // Función para actualizar el gráfico dinámicamente
                function updateHumedadChart() {
                    // Leer el nuevo valor desde el <p>
                    const nuevaHumedad = parseInt(humedadValueLabel.textContent, 10);

                    // Actualizar el gráfico solo si el valor ha cambiado
                    if (nuevaHumedad !== humedadActual) {
                        humedadActual = nuevaHumedad;

                        // Actualizar datos del gráfico
                        humedadAmbiental.data.datasets[0].data = [humedadActual, 100 - humedadActual];
                        humedadAmbiental.data.datasets[0].backgroundColor[0] = getColor(humedadActual);

                        // Actualizar el gráfico visualmente
                        humedadAmbiental.update();
                    }
                }

                // Actualizar el gráfico cada segundo
                setInterval(updateHumedadChart, 1000); // Puedes ajustar el intervalo si es necesario
            </script>



            <script>
                // Obtener el contexto del lienzo y el elemento <p>
                const cte = document.getElementById('tds').getContext('2d');
                const tdsValueLabel = document.getElementById('tdsValueLabel');

                // Función para calcular el color dinámico en tonos grises
                function getColor(tds) {
                    const rangoMaximo = 2000; // Máximo de TDS

                    // Escalar TDS al rango 0-1
                    const porcentaje = Math.min(Math.max(tds / rangoMaximo, 0), 1);

                    const gris = Math.floor(255 - (255 * porcentaje)); // Gris claro a oscuro
                    return `rgb(${gris}, ${gris}, ${gris})`; // Gris puro
                }

                // Valor inicial desde el elemento <p>
                let tdsValorActual = parseInt(tdsValueLabel.textContent, 10);

                // Crear el gráfico
                const tdsChart = new Chart(cte, {
                    type: 'doughnut', // Tipo de gráfico
                    data: {
                        labels: ['TDS', 'Restante'], // Etiquetas
                        datasets: [{
                            data: [tdsValorActual, 2000 - tdsValorActual], // Progreso y restante
                            backgroundColor: [
                                getColor(tdsValorActual), // Color dinámico para el progreso
                                'rgba(200, 200, 200, 0.4)' // Color fijo para el restante
                            ],
                            borderWidth: 0 // Quitar bordes
                        }]
                    },
                    options: {
                        rotation: -90, // Iniciar desde la parte superior (-90 grados)
                        circumference: 180, // Mostrar solo la mitad del círculo (180 grados)
                        cutout: '70%', // Grosor del anillo
                        responsive: true, // Ajustar dinámicamente
                        plugins: {
                            legend: {
                                position: 'bottom', // Posición de la leyenda
                                display: false // Ocultar la leyenda
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `TDS: ${context.raw} ppm`; // Etiqueta personalizada
                                    }
                                }
                            }
                        }
                    }
                });

                // Función para actualizar el gráfico dinámicamente
                function updateTdsChart() {
                    // Leer el nuevo valor desde el <p>
                    const nuevoTds = parseInt(tdsValueLabel.textContent, 10);

                    // Actualizar el gráfico solo si el valor ha cambiado
                    if (nuevoTds !== tdsValorActual) {
                        tdsValorActual = nuevoTds;

                        // Actualizar datos del gráfico
                        tdsChart.data.datasets[0].data = [tdsValorActual, 2000 - tdsValorActual];
                        tdsChart.data.datasets[0].backgroundColor[0] = getColor(tdsValorActual);

                        // Actualizar el gráfico visualmente
                        tdsChart.update();
                    }
                }

                // Actualizar el gráfico cada segundo
                setInterval(updateTdsChart, 1000); // Puedes ajustar el intervalo si es necesario
            </script>

            <script>
                // Obtener el contexto del lienzo y el elemento <p>
                const ctf = document.getElementById('tvoc').getContext('2d');
                const tvocValueLabel = document.getElementById('tvocValueLabel');

                // Función para calcular el color dinámico en tonos verde-naranja
                function getColor(tvoc) {
                    const rangoVerde = 500;  // Máximo para tonos verdes
                    const rangoNaranja = 1000; // Máximo para tonos naranjas

                    if (tvoc <= rangoVerde) {
                        // Tonos verdes para niveles bajos (0-500)
                        const porcentaje = tvoc / rangoVerde;
                        const verde = Math.floor(255 * (1 - porcentaje)); // Verde disminuye
                        const amarillo = Math.floor(200 * porcentaje);   // Amarillo se mezcla
                        return `rgb(${amarillo}, ${verde}, 0)`;          // Tonos verdes-amarillos
                    } else {
                        // Tonos naranjas para niveles altos (500-1000)
                        const porcentaje = (tvoc - rangoVerde) / (rangoNaranja - rangoVerde);
                        const rojo = Math.floor(255 * porcentaje);       // Rojo domina
                        const amarillo = Math.floor(200 * (1 - porcentaje)); // Amarillo disminuye
                        return `rgb(${rojo}, ${amarillo}, 0)`;           // Tonos naranja-rojo
                    }
                }

                // Valor inicial desde el elemento <p>
                let tvocValorActual = parseInt(tvocValueLabel.textContent, 10);

                // Crear el gráfico
                const tvocChart = new Chart(ctf, {
                    type: 'doughnut', // Tipo de gráfico
                    data: {
                        labels: ['TVOC', 'Restante'], // Etiquetas
                        datasets: [{
                            data: [tvocValorActual, 1000 - tvocValorActual], // Progreso y restante
                            backgroundColor: [
                                getColor(tvocValorActual), // Color dinámico para el progreso
                                'rgba(200, 200, 200, 0.4)' // Color fijo para el restante
                            ],
                            borderWidth: 0 // Quitar bordes
                        }]
                    },
                    options: {
                        rotation: -90, // Iniciar desde la parte superior (-90 grados)
                        circumference: 180, // Mostrar solo la mitad del círculo (180 grados)
                        cutout: '70%', // Grosor del anillo
                        responsive: true, // Ajustar dinámicamente
                        plugins: {
                            legend: {
                                position: 'bottom', // Posición de la leyenda
                                display: false // Ocultar la leyenda
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `TVOC: ${context.raw} ppb`; // Etiqueta personalizada
                                    }
                                }
                            }
                        }
                    }
                });

                // Función para actualizar el gráfico dinámicamente
                function updateTvocChart() {
                    // Leer el nuevo valor desde el <p>
                    const nuevoTvoc = parseInt(tvocValueLabel.textContent, 10);

                    // Actualizar el gráfico solo si el valor ha cambiado
                    if (nuevoTvoc !== tvocValorActual) {
                        tvocValorActual = nuevoTvoc;

                        // Actualizar datos del gráfico
                        tvocChart.data.datasets[0].data = [tvocValorActual, 1000 - tvocValorActual];
                        tvocChart.data.datasets[0].backgroundColor[0] = getColor(tvocValorActual);

                        // Actualizar el gráfico visualmente
                        tvocChart.update();
                    }
                }

                // Actualizar el gráfico cada segundo
                setInterval(updateTvocChart, 1000); // Puedes ajustar el intervalo si es necesario
            </script>

            <script>
                // Obtener el contexto del lienzo y el elemento <p>
                const ctg = document.getElementById('tvocbioreactor').getContext('2d');
                const tvocBioreactorValueLabel = document.getElementById('tvocBioreactorValueLabel');

                // Función para calcular el color dinámico en tonos verde-naranja
                function getColor(tvoc) {
                    const rangoVerde = 500;  // Máximo para tonos verdes
                    const rangoNaranja = 1000; // Máximo para tonos naranjas

                    if (tvoc <= rangoVerde) {
                        // Tonos verdes para niveles bajos (0-500)
                        const porcentaje = tvoc / rangoVerde;
                        const verde = Math.floor(255 * (1 - porcentaje)); // Verde disminuye
                        const amarillo = Math.floor(200 * porcentaje);   // Amarillo se mezcla
                        return `rgb(${amarillo}, ${verde}, 0)`;          // Tonos verdes-amarillos
                    } else {
                        // Tonos naranjas para niveles altos (500-1000)
                        const porcentaje = (tvoc - rangoVerde) / (rangoNaranja - rangoVerde);
                        const rojo = Math.floor(255 * porcentaje);       // Rojo domina
                        const amarillo = Math.floor(200 * (1 - porcentaje)); // Amarillo disminuye
                        return `rgb(${rojo}, ${amarillo}, 0)`;           // Tonos naranja-rojo
                    }
                }

                // Valor inicial desde el elemento <p>
                let tvocBioreactorValorActual = parseInt(tvocBioreactorValueLabel.textContent, 10);

                // Crear el gráfico
                const tvocBioreactorChart = new Chart(ctg, {
                    type: 'doughnut', // Tipo de gráfico
                    data: {
                        labels: ['TVOC Bioreactor', 'Restante'], // Etiquetas
                        datasets: [{
                            data: [tvocBioreactorValorActual, 1000 - tvocBioreactorValorActual], // Progreso y restante
                            backgroundColor: [
                                getColor(tvocBioreactorValorActual), // Color dinámico para el progreso
                                'rgba(200, 200, 200, 0.4)' // Color fijo para el restante
                            ],
                            borderWidth: 0 // Quitar bordes
                        }]
                    },
                    options: {
                        rotation: -90, // Iniciar desde la parte superior (-90 grados)
                        circumference: 180, // Mostrar solo la mitad del círculo (180 grados)
                        cutout: '70%', // Grosor del anillo
                        responsive: true, // Ajustar dinámicamente
                        plugins: {
                            legend: {
                                position: 'bottom', // Posición de la leyenda
                                display: false // Ocultar la leyenda
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `TVOC Bioreactor: ${context.raw} ppb`; // Etiqueta personalizada
                                    }
                                }
                            }
                        }
                    }
                });

                // Función para actualizar el gráfico dinámicamente
                function updateTvocBioreactorChart() {
                    // Leer el nuevo valor desde el <p>
                    const nuevoTvoc = parseInt(tvocBioreactorValueLabel.textContent, 10);

                    // Actualizar el gráfico solo si el valor ha cambiado
                    if (nuevoTvoc !== tvocBioreactorValorActual) {
                        tvocBioreactorValorActual = nuevoTvoc;

                        // Actualizar datos del gráfico
                        tvocBioreactorChart.data.datasets[0].data = [tvocBioreactorValorActual, 1000 - tvocBioreactorValorActual];
                        tvocBioreactorChart.data.datasets[0].backgroundColor[0] = getColor(tvocBioreactorValorActual);

                        // Actualizar el gráfico visualmente
                        tvocBioreactorChart.update();
                    }
                }

                // Actualizar el gráfico cada segundo
                setInterval(updateTvocBioreactorChart, 1000); // Puedes ajustar el intervalo si es necesario
            </script>

            <script>
                // Obtener el contexto del lienzo y el elemento <p>
                const cth = document.getElementById('co2presente').getContext('2d');
                const co2PresenteValueLabel = document.getElementById('co2PresenteValueLabel');

                // Función para calcular el color dinámico en tonos de verde oscuro
                function getColor(co2) {
                    const rangoMaximo = 1500; // Máximo para CO2 en ppm

                    // Escalar CO2 al rango 0-1
                    const porcentaje = Math.min(Math.max(co2 / rangoMaximo, 0), 1);

                    const verde = Math.floor(255 - (255 * porcentaje)); // Verde claro a oscuro
                    return `rgb(0, ${verde}, 0)`; // Verde puro
                }

                // Valor inicial desde el elemento <p>
                let co2PresenteValorActual = parseInt(co2PresenteValueLabel.textContent, 10);

                // Crear el gráfico
                const co2PresenteChart = new Chart(cth, {
                    type: 'doughnut', // Tipo de gráfico
                    data: {
                        labels: ['CO2 Presente', 'Restante'], // Etiquetas
                        datasets: [{
                            data: [co2PresenteValorActual, 1500 - co2PresenteValorActual], // Progreso y restante
                            backgroundColor: [
                                getColor(co2PresenteValorActual), // Color dinámico para el progreso
                                'rgba(200, 200, 200, 0.4)' // Color fijo para el restante
                            ],
                            borderWidth: 0 // Quitar bordes
                        }]
                    },
                    options: {
                        rotation: -90, // Iniciar desde la parte superior (-90 grados)
                        circumference: 180, // Mostrar solo la mitad del círculo (180 grados)
                        cutout: '70%', // Grosor del anillo
                        responsive: true, // Ajustar dinámicamente
                        plugins: {
                            legend: {
                                position: 'bottom', // Posición de la leyenda
                                display: false // Ocultar la leyenda
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return `CO2 Presente: ${context.raw} ppm`; // Etiqueta personalizada
                                    }
                                }
                            }
                        }
                    }
                });

                // Función para actualizar el gráfico dinámicamente
                function updateCo2PresenteChart() {
                    // Leer el nuevo valor desde el <p>
                    const nuevoCo2 = parseInt(co2PresenteValueLabel.textContent, 10);

                    // Actualizar el gráfico solo si el valor ha cambiado
                    if (nuevoCo2 !== co2PresenteValorActual) {
                        co2PresenteValorActual = nuevoCo2;

                        // Actualizar datos del gráfico
                        co2PresenteChart.data.datasets[0].data = [co2PresenteValorActual, 1500 - co2PresenteValorActual];
                        co2PresenteChart.data.datasets[0].backgroundColor[0] = getColor(co2PresenteValorActual);

                        // Actualizar el gráfico visualmente
                        co2PresenteChart.update();
                    }
                }

                // Actualizar el gráfico cada segundo
                setInterval(updateCo2PresenteChart, 1000); // Puedes ajustar el intervalo si es necesario
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
                
                // Actualizar los valores directamente en los elementos con los nuevos IDs correspondientes
                document.getElementById("temperaturaValueLabel").innerText = data.temperatureWater + " °C"; // Temperatura del agua
                document.getElementById("temperaturaAmbienteValueLabel").innerText = data.temperatureBME + " °C"; // Temperatura ambiente
                document.getElementById("tvocBioreactorValueLabel").innerText = data.Tvoc_bioreactor + " ppb"; // TVOC en el bioreactor
                document.getElementById("humedadValueLabel").innerText = data.humidity + " %"; // Humedad ambiental
                document.getElementById("tdsValueLabel").innerText = data.TDS + " ppm"; // TDS
                document.getElementById("co2bioreactor").innerText = data.CO2 + " ppm"; // CO₂ en el bioreactor
                document.getElementById("tvocValueLabel").innerText = data.TVOC + " ppb"; // TVOC
                document.getElementById("co2PresenteValueLabel").innerText = data.Co2_presente + " ppm"; // CO₂ presente
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