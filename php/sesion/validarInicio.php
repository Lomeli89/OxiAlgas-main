<?php
require_once '../conexion.php';
require_once '../auth.php';

// Instancia la conexión
$db = new Database();
$conn = $db->getConnection();

// Instancia la autenticación
$auth = new Auth($conn);

// Datos del formulario (puedes obtenerlos desde $_POST en una aplicación real)
$correo = $_POST['correo'] ?? '';
$contrasena = $_POST['contrasena'] ?? '';

// Iniciar sesión
$response = $auth->login($correo, $contrasena);

// Respuesta al cliente
if ($response['status']) {
    session_start();
    $_SESSION['user_id'] = $response['user_id']; // Guardar ID de usuario en la sesión
    $_SESSION['nombre'] = $response['nombre'];
    $_SESSION['apellido'] = $response['apellido'];
    $_SESSION['telefono'] = $response['telefono'];
    $_SESSION['correo_electronico'] = $response['correo_electronico'];
    $_SESSION['id_tipo_usuario'] = $response['id_tipo_usuario'];
    header('Location: http://localhost/oxialgas-main/dashmin-1.0.0/index.php');

    
    echo json_encode(['status' => true, 'message' => $response['message']]);
} else {
    echo json_encode(['status' => false, 'message' => $response['message']]);
}
?>
