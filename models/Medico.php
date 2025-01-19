<?php
include_once 'db.php';

class Medico {
    private $conn;
    private $table_name = "medicos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getMedicos() {
        $query = "SELECT id, nombre, especialidad FROM medicos";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve un array de médicos
    }
    

    public function addMedico($nombre, $especialidad) {
        $query = "INSERT INTO " . $this->table_name . " (nombre, especialidad) VALUES (:nombre, :especialidad)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':especialidad', $especialidad);
        return $stmt->execute();
    }
}
?>
