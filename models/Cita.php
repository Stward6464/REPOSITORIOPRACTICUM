<?php
include_once 'db.php';

class Cita {
    private $conn;
    private $table_name = "citas";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCitas() {
        $query = "SELECT c.id, p.nombre AS paciente, m.nombre AS medico, c.fecha, c.estado 
                  FROM " . $this->table_name . " c
                  JOIN pacientes p ON c.paciente_id = p.id
                  JOIN medicos m ON c.medico_id = m.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCita($paciente_id, $medico_id, $fecha) {
        $query = "INSERT INTO citas (paciente_id, medico_id, fecha) VALUES (:paciente_id, :medico_id, :fecha)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':paciente_id', $paciente_id);
        $stmt->bindParam(':medico_id', $medico_id);
        $stmt->bindParam(':fecha', $fecha);
    
        return $stmt->execute(); // Devuelve true si la inserción fue exitosa
    }
    
    
    
    
    
}
?>
