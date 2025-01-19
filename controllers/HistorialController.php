<?php
include_once __DIR__ . '/../models/HistorialMedico.php';
include_once __DIR__ . '/../models/Paciente.php';

class HistorialController {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function mostrarFormularioHistorial() {
        $pacienteModel = new Paciente($this->conn);
        $pacientes = $pacienteModel->getPacientes();
        include __DIR__ . '/../views/agregarHistorialForm.php';
    }

    public function agregarHistorial($data) {
        if (!isset($_SESSION['medico_id'])) {
            echo "<p>Error: No se ha identificado al médico. Por favor, inicie sesión nuevamente.</p>";
            exit;
        }
    
        $historialModel = new HistorialMedico($this->conn);
        $medico_id = $_SESSION['medico_id']; // Obtiene el ID del médico desde la sesión
        $paciente_id = $data['paciente_id'];
        $fecha = $data['fecha'];
        $sintomas = $data['sintomas'];
        $diagnostico = $data['diagnostico'];
    
        if ($historialModel->agregarHistorial($paciente_id, $medico_id, $fecha, $sintomas, $diagnostico)) {
            echo "<p>Historial registrado correctamente.</p>";
        } else {
            echo "<p>Error al registrar el historial. Inténtalo nuevamente.</p>";
        }
    }
    
    
}
?>
