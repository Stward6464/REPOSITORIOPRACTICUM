<?php
class HistorialMedico {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function agregarHistorial($paciente_id, $medico_id, $fecha, $sintomas, $diagnostico) {
        $query = "INSERT INTO historial_medico (paciente_id, medico_id, fecha, sintomas, diagnostico) 
                  VALUES (:paciente_id, :medico_id, :fecha, :sintomas, :diagnostico)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':paciente_id', $paciente_id);
        $stmt->bindParam(':medico_id', $medico_id);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':sintomas', $sintomas);
        $stmt->bindParam(':diagnostico', $diagnostico);

        return $stmt->execute();
    }
}
?>
