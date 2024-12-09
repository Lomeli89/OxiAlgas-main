<?php
require_once '../conexion.php';
require_once '../auth.php';
require_once '../usuarioCRUD.php';
// Instancia la conexión
$db = new Database();
$conn = $db->getConnection();

// Instancia la autenticación
$auth = new Auth($conn);



// Datos del formulario (puedes obtenerlos desde $_POST en una aplicación real)
$nombre = $_POST['nombre']?? '';
$apellido = $_POST['apellido']?? '';
$telefono = $_POST['tel']?? '';
$correo = $_POST['correo'] ?? '';
$contrasena = $_POST['contrasenia'] ?? '';
$contra_encrypted = password_hash($contrasena, PASSWORD_DEFAULT);
$id_tipo_usuario = 1;

// Iniciar sesión
$response = $auth->comprobarCorreo($correo);

// Respuesta al cliente
if ($response['status']) {
    echo json_encode(['status' => true, 'message' => $response['message']]);
} else {
    echo json_encode(['status' => false, 'message' => $response['message']]);

    $db = new Database();
    $conn = $db->getConnection();

    // Instancia la autenticación
    $usuarioCRUD = new UsuarioCRUD($conn);
    $response2 = $usuarioCRUD->create($nombre, $apellido, $correo, $contra_encrypted, $telefono, $id_tipo_usuario);
    if ($response2['status']) {
        echo json_encode(['status' => true, 'message' => $response2['message']]);
        echo 'respuesta 1';
    } else {
        echo json_encode(['status' => false, 'message' => $response2['message']]);
        echo 'respuesta 2';
        header('Location: http://localhost/oxialgas-main/php/sesion/dashmin-1.0.0/signin.php');

        // $auth->cerrarSesion(); // Para cerrar la sesión después de crear el usuario, descomentar esta línea y comentar la línea anterior.    
    }

}
?>