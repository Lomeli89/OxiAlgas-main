<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "bioreactor";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            $this->conn->set_charset("utf8mb4");
        } catch (mysqli_sql_exception $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            if (count($params) > 0) {
                $types = '';
                foreach ($params as $param) {
                    // Detectar el tipo de cada parámetro para 'bind_param'
                    $types .= $this->getParamType($param);
                }
                $stmt->bind_param($types, ...$params);
            }

            $stmt->execute();
            if ($stmt->error) {
                echo "Error en la consulta: " . $stmt->error;
                return false;
            }

            // Si la consulta es un SELECT, obtener los resultados
            if (strpos(strtoupper($sql), 'SELECT') !== false) {
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC); // Obtener resultados como un array asociativo
                return $data;
            }

            return true; // Para consultas INSERT, UPDATE, DELETE, simplemente retorna true
        } else {
            echo "Error preparando la consulta: " . $this->conn->error;
            return false;
        }
    }
    // Método para obtener el último ID insertado
    public function lastInsertId() {
        return $this->conn->insert_id;
    }

    // Método para preparar la consulta
    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    // Método para detectar el tipo de parámetro (s = string, i = integer, d = double, b = blob)
    private function getParamType($param) {
        if (is_int($param)) {
            return 'i'; // Integer
        } elseif (is_double($param)) {
            return 'd'; // Double
        } elseif (is_string($param)) {
            return 's'; // String
        } elseif (is_null($param)) {
            return 's'; // Null treated as string (default)
        }
        return 's'; // Default to string
    }

    // Método para verificar si la consulta fue exitosa y retornar un mensaje de error personalizado
    public function checkQuerySuccess($stmt) {
        if ($stmt->error) {
            return "Error en la consulta: " . $stmt->error;
        } else {
            return true;
        }
    }
}
?>