<?php
class Auth
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login($correo, $contrasena)
    {
        // Buscar al usuario por correo
        $stmt = $this->conn->prepare("SELECT id_usuario, nombre, apellido, correo_electronico, telefono, id_tipo_usuario, contrasena 
                                  FROM tabla_usuarios 
                                  WHERE correo_electronico = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $usuario = $result->fetch_assoc();

            // Verificar la contraseña (suponiendo que esté cifrada)
            if (password_verify($contrasena, $usuario['contrasena'])) {
                // Contraseña correcta
                return [
                    'status' => true,
                    'message' => 'Inicio de sesión exitoso.',
                    'user_id' => $usuario['id_usuario'],
                    'nombre' => $usuario['nombre'],
                    'apellido' => $usuario['apellido'],
                    'correo_electronico' => $usuario['correo_electronico'],
                    'telefono' => $usuario['telefono'],
                    'id_tipo_usuario' => $usuario['id_tipo_usuario']
                ];
            } else {
                // Contraseña incorrecta
                return [
                    'status' => false,
                    'message' => 'Contraseña incorrecta.'
                ];
            }
        } else {
            // Usuario no encontrado
            return [
                'status' => false,
                'message' => 'Usuario no encontrado.'
            ];
        }
    }


    public function comprobarCorreo($correo)
    {
        $stmt = $this->conn->prepare("SELECT correo_electronico FROM tabla_usuarios WHERE correo_electronico =?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            // Correo ya está registrado
            return [
                'status' => true,
                'message' => 'Este correo ya existe.',

                //'nombre' => $nombre['usuario_nombre']
            ];
        } else {
            // Correo disponible
            return [
                'status' => false,
                'message' => 'Correo disponible'
            ];
        }

    }

}
?>