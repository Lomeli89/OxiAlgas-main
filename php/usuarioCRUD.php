<?php
class UsuarioCRUD
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Crear un nuevo usuario
    public function create($nombre, $apellido, $correo, $contrasena, $telefono, $id_tipo_usuario)
    {
        $stmt = $this->conn->prepare("INSERT INTO tabla_usuarios (nombre, apellido,correo_electronico, contrasena, telefono, id_tipo_usuario) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $nombre, $apellido, $correo, $contrasena, $telefono, $id_tipo_usuario);
        
        return $stmt->execute();

    }


    // Leer todos los usuarios
    public function readAll()
    {
        $result = $this->conn->query("SELECT * FROM tabla_usuarios");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Leer un usuario por ID
    public function readById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tabla_usuarios WHERE id_usuario = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Actualizar un usuario
    public function update($id, $nombre, $apellido, $correo, $telefono, $id_tipo_usuario)
    {
        $stmt = $this->conn->prepare("UPDATE tabla_usuarios 
                                      SET nombre = ?, apellido = ?, correo_electronico = ?, telefono = ?, id_tipo_usuario = ? 
                                      WHERE id_usuario = ?");
        $stmt->bind_param("ssssii", $nombre, $apellido, $correo, $telefono, $id_tipo_usuario, $id);
        return $stmt->execute();
    }

    // Eliminar un usuario
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM tabla_usuarios WHERE id_usuario = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>