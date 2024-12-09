<?php

session_start();

// Incluir el archivo de conexión
require_once '../php/conexion.php';

// Crear una instancia de la clase Database
$db = new Database();

// Verifica si la sesión está activa
if (isset($_SESSION['user_id'])) {
    // Recupera los datos de la sesión
    $user_id = $_SESSION['user_id'];
    $name = $_SESSION['nombre'];
    $lastname = $_SESSION['apellido'] ?? '';
    $phone = $_SESSION['telefono'] ?? '';
    $email = $_SESSION['correo_electronico'] ?? '';
    $tipoUsuario = $_SESSION['id_tipo_usuario'] ?? ''; // Asegúrate de usar la clave correcta

    // Configuración de paginación para clientes
    $registros_por_pagina_bioreactor = 5;
    $pagina_actual_bioreactor = isset($_GET['page_bioreactor']) ? (int) $_GET['page_bioreactor'] : 1;
    if ($pagina_actual_bioreactor < 1)
        $pagina_actual_bioreactor = 1;
    $offset_bioreactor = ($pagina_actual_bioreactor - 1) * $registros_por_pagina_bioreactor;

    // Obtener el total de bioreactores registrados para este usuario
    $total_bioreactor_bioreactor = "SELECT COUNT(*) as total 
                                FROM tabla_bioreactor 
                                WHERE id_usuario = ?";
    $total_bioreactor = $db->query($total_bioreactor_bioreactor, [$user_id])[0]['total'];
    $total_paginas_clientes = ceil($total_bioreactor / $registros_por_pagina_bioreactor);

    // Consulta SQL para obtener los bioreactores del usuario
    $sql_bioreactor = "SELECT c.id_bioreactor, c.nombre_bioreactor AS nombre_bioreactor, 
                          c.descripcion_bioreactor AS descripcion_bioreactor, 
                          c.direccion_ip, c.clave
                   FROM tabla_bioreactor c
                   LEFT JOIN tabla_usuarios t ON c.id_usuario = t.id_usuario
                   WHERE c.id_usuario = ? 
                   ORDER BY c.nombre_bioreactor ASC 
                   LIMIT ? OFFSET ?";

    // Ejecutar la consulta
    $bioreactor = $db->query($sql_bioreactor, [$user_id, $registros_por_pagina_bioreactor, $offset_bioreactor]);
} else {
    // Si la sesión no está activa, destrúyela y redirige al usuario a signup.php
    session_destroy();
    header('Location: ./signup.php');
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
            height: 300px;
            /* Altura fija para todas las cards */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            /* Asegurar texto centrado */
            background-color: #f8f9fa;
            /* Fondo claro */
            border-radius: 10px;
            /* Bordes redondeados */
            padding: 20px;
        }

        .sensor-card canvas {
            width: auto;
            /* Tamaño fijo para canvas */
            height: 300px;
            /* Tamaño fijo para canvas */
        }


        .sensor-card p {
            margin-top: 10px;
            font-size: 14px;
            /* Tamaño del texto */
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
                            <a href="../index.html" class="dropdown-item">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <h1 class="display-6 text-center">Mis Bioreactores</h1>
                <div class="container">
                    <div class="container">
                        <div class="card shadow mb-4">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <h2>Tabla de bioreactores vinculados</h2>
                                    
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID Bioreactor</th>
                                                <th>Nombre</th>
                                                <th>Descripcion</th>
                                                <th>Direccion ip</th>
                                                <th>Clave</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($bioreactor as $bioreactor): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($bioreactor['id_bioreactor']) ?></td>
                                                    <td><?= htmlspecialchars($bioreactor['nombre_bioreactor']) ?></td>
                                                    <td><?= htmlspecialchars($bioreactor['descripcion_bioreactor']) ?></td>
                                                    <td><?= htmlspecialchars($bioreactor['direccion_ip']) ?></td>
                                                    <td><?= htmlspecialchars($bioreactor['clave']) ?></td>
                                                    
                                                    </td>





                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <nav>
                                        <ul class="pagination">
                                            <?php if ($pagina_actual_bioreactor > 1): ?>
                                                <li class="page-item"><a class="page-link"
                                                        href="?page_bioreactor=<?= $pagina_actual_bioreactor - 1 ?>">Anterior</a>
                                                </li>
                                            <?php endif; ?>
                                            <?php for ($i = 1; $i <= $total_paginas_clientes; $i++): ?>
                                                <li
                                                    class="page-item <?= ($i == $pagina_actual_bioreactor) ? 'active' : '' ?>">
                                                    <a class="page-link" href="?page_bioreactor=<?= $i ?>"><?= $i ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <?php if ($pagina_actual_bioreactor < $total_paginas_clientes): ?>
                                                <li class="page-item"><a class="page-link"
                                                        href="?page_bioreactor=<?= $pagina_actual_bioreactor + 1 ?>">Siguiente</a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>




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