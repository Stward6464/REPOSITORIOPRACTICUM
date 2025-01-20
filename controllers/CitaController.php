<?php
include_once __DIR__ . '/../models/Cita.php';

class CitaController {
    private $conn; // Propiedad para la conexión
    private $model;

    public function __construct($db) {
        $this->conn = $db; // Almacena la conexión en la propiedad.
        $this->model = new Cita($db);
    }

    public function listCitas() {
        $citas = $this->model->getCitas();
        include_once __DIR__ . '/../views/listCitas.php';
    }

    public function addCita($data) {
        $paciente_id = $data['paciente_id'];
        $medico_id = $data['medico_id'];
        $fecha = $data['fecha'];
    
        // Llama al modelo para crear la cita
        if ($this->model->addCita($paciente_id, $medico_id, $fecha)) {
            // Redirige a la lista de citas
            header("Location: index.php?action=listCitas");
            exit; // Asegúrate de detener la ejecución después de redirigir.
        } else {
            // Mostrar mensaje de error y enlace al formulario
            echo "<p>Error al programar la cita. Inténtalo nuevamente.</p>";
            echo '<a href="index.php?action=addCitaForm">Volver al formulario</a>';
        }
    }
    

    public function showAddCitaForm() {
        include_once 'models/Paciente.php';
        include_once 'models/Medico.php';

        $pacienteModel = new Paciente($this->conn); // Usa $this->conn para la conexión.
        $medicoModel = new Medico($this->conn); // Usa $this->conn para la conexión.

        $pacientes = $pacienteModel->getPacientes();
        $medicos = $medicoModel->getMedicos();

        

        include 'views/addCitaForm.php';
    }
}
?>
