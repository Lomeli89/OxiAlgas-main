<?php
require 'Bioreactores.php'; // Incluye la clase

// Configuración de la conexión a la base de datos
$conn = new mysqli('localhost', 'usuario', 'contraseña', 'base_datos'); // Cambia con tus credenciales

// Verifica si hay errores en la conexión
if ($conn->connect_error) {
    die(json_encode(['error' => 'Error de conexión: ' . $conn->connect_error]));
}

// Instancia la clase y ejecuta la actualización
$bioreactores = new Bioreactores($conn);
echo $bioreactores->mostrarTDS();
?>
