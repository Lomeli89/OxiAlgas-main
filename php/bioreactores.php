<?php
class Bioreactores
{
    private $conn;
    private $jsonFilePathTDS = '../php/json/tds.json'; // Ruta del archivo JSON para TDS
    private $jsonFilePathCO2 = '../php/json/co2.json'; // Ruta del archivo JSON para CO2
    private $jsonFilePathTempAgua = '../php/json/tempagua.json'; // Ruta del archivo JSON para TDS
    private $jsonFilePathTVOC = '../php/json/tvoc.json'; // Ruta del archivo JSON para CO2


    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método genérico para obtener datos de cualquier columna
    private function obtenerDatos($columna, $limite)
    {
        // Consulta SQL
        $sql = "SELECT $columna FROM tabla_datos ORDER BY id_dato ASC LIMIT $limite";

        // Ejecutar la consulta
        $result = $this->conn->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            $datos = [];
            while ($row = $result->fetch_assoc()) {
                $datos[] = $row[$columna];
            }
            return $datos; // Retornar el array con los datos
        }

        // Si no hay resultados, retornar un array vacío
        return [];
    }

    // Método genérico para sobrescribir un archivo JSON
    private function actualizarArchivoJSON($datos, $filePath)
    {
        // Convertir los datos a formato JSON
        $json_data = json_encode($datos, JSON_PRETTY_PRINT);

        // Verificar si la carpeta del archivo existe, si no, crearla
        $carpeta = dirname($filePath);
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }

        // Sobrescribir el archivo JSON
        if (file_put_contents($filePath, $json_data) !== false) {
            return json_encode(['success' => "Archivo JSON actualizado correctamente: $filePath"]);
        } else {
            return json_encode(['error' => "Error al escribir en el archivo JSON: $filePath"]);
        }
    }

    // Método para obtener y actualizar los datos de TDS
    public function mostrarTDS()
    {
        $tds = $this->obtenerDatos('tds', 20);
        return $this->actualizarArchivoJSON($tds, $this->jsonFilePathTDS);
    }

    // Método para obtener y actualizar los datos de CO2
    public function mostrarCO2()
    {
        $co2 = $this->obtenerDatos('cO2_bioreactor', 20);
        return $this->actualizarArchivoJSON($co2, $this->jsonFilePathCO2);
    }
    public function mostrarTempAgua()
    {
        $temp_agua = $this->obtenerDatos('temp_agua', 20);
        return $this->actualizarArchivoJSON($temp_agua, $this->jsonFilePathTempAgua);
    }
    public function mostrarTVOC()
    {
        $tvoc = $this->obtenerDatos('tvoc_bioreactor', 20);
        return $this->actualizarArchivoJSON($tvoc, $this->jsonFilePathTVOC);
    }
}
?>
