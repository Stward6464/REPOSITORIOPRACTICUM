<?php
include_once __DIR__ . '/../models/Paciente.php';

class PacienteController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new Paciente($db);
    }

    // Método para listar pacientes
    public function listPacientes()
    {
        $pacientes = $this->model->getPacientes(); // Llama al método del modelo
        include_once __DIR__ . '/../views/listPacientes.php';
    }

    // Método para añadir un nuevo paciente
    public function addPaciente($data) {
        $nombre = $data['nombre'] ?? '';
        $email = $data['email'] ?? '';
        $telefono = $data['telefono'] ?? '';
        $direccion = $data['direccion'] ?? '';
        $historial = $data['historial'] ?? '';
    
        try {
            if ($this->model->addPaciente($nombre, $email, $telefono, $direccion, $historial)) {
                // Redirigir al listado de pacientes si se agrega correctamente
                header("Location: ../index.php?action=listPacientes");
                exit;
            } else {
                // Mostrar un mensaje si algo falla
                echo "<p>Error: No se pudo agregar el paciente. Inténtalo nuevamente.</p>";
                echo '<a href="index.php?action=addPacienteForm">Volver al formulario</a>';
            }
        } catch (Exception $e) {
            // Manejar excepciones y mostrar el mensaje de error
            echo "<p>Error: " . $e->getMessage() . "</p>";
            echo '<a href="index.php?action=addPacienteForm">Volver al formulario</a>';
        }
    }
    
    
}
