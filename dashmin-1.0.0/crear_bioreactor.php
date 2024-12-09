<?php
session_start();

// Verificar si la sesión está iniciada y si hay un usuario registrado
if (isset($_SESSION['usuario_id'])) {

    // El usuario está autenticado

    header('Location:./index.php');

} else {
    // El usuario no está autenticado

    $variableSesion = 0;
}
?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
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
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <form method="post" action="../php/registrar/irRegistrarBioreactor.php">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="index.html" class="">
                                    <h3 class="text-primary">Vincular Bioreactor</h3>
                                </a>
                            </div>

                            <!-- Nombre del Bioreactor -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" name="nombre_bioreactor"
                                    placeholder="Nombre del Bioreactor" required>
                                <label for="nombre">Nombre del Bioreactor</label>
                            </div>

                            <!-- Descripción del Bioreactor -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="descripcion" name="descripcion_bioreactor"
                                    placeholder="Descripción" required>
                                <label for="descripcion">Descripción</label>
                            </div>

                            <!-- Dirección IP del Bioreactor -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="direccion_ip" name="direccion_ip"
                                    placeholder="Dirección IP" required>
                                <label for="direccion_ip">Dirección IP</label>
                            </div>

                            <!-- Clave del Bioreactor -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="clave" name="clave" placeholder="Clave"
                                    required>
                                <label for="clave">Clave</label>
                            </div>

                            <!-- ID Usuario (para el Administrador) -->
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="id_usuario" name="id_usuario"
                                    placeholder="ID del Usuario" required>
                                <label for="id_usuario">ID del Usuario</label>
                            </div>

                            <!-- Botones -->
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Vincular Bioreactor</button>
                            <a href="./index.php">
                                <input type="button" class="btn btn-primary py-3 w-100 mb-4" value="Cancelar">
                            </a>
                        </form>


                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
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