<?php
// Iniciar sesión
session_start();

// Verificar si la sesión está activa
if (!isset($_SESSION['user_id'])) {
    // Redirigir a login si no está activo
    header('Location: ../login.php');
    exit;
}

// Incluir el archivo de conexión a la base de datos
require_once '../conexion.php';

// Crear una instancia de la base de datos
$db = new Database();

// Verificar si los campos necesarios están presentes
if (isset($_POST['nombre_bioreactor'], $_POST['descripcion_bioreactor'], $_POST['direccion_ip'], $_POST['clave'], $_POST['id_usuario'])) {
    // Obtener los valores del formulario
    $nombre_bioreactor = $_POST['nombre_bioreactor'];
    $descripcion_bioreactor = $_POST['descripcion_bioreactor'];
    $direccion_ip = $_POST['direccion_ip'];
    $clave = $_POST['clave'];
    $id_usuario = $_POST['id_usuario'];

    // Consulta para insertar el bioreactor en la base de datos
    $sql = "INSERT INTO tabla_bioreactor (nombre_bioreactor, descripcion_bioreactor, direccion_ip, clave, id_usuario) 
            VALUES (?, ?, ?, ?, ?)";

    // Ejecutar la consulta
    if ($db->query($sql, [$nombre_bioreactor, $descripcion_bioreactor, $direccion_ip, $clave, $id_usuario])) {
        // Redirigir a la página de éxito o lista de bioreactores
        header('Location: http://localhost/oxialgas-main/dashmin-1.0.0/bioreactor.php');
    } else {
        // En caso de error, redirigir con mensaje de error
        header('Location: ../bioreactor.php?error=1');
    }
} else {
    // Si faltan los datos del formulario
    header('Location: ../bioreactor.php?error=2');
}
?>


