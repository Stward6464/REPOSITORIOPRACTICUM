<?php
include_once __DIR__ . '/../models/Medico.php';

class MedicoController {
    private $model;

    public function __construct($db) {
        $this->model = new Medico($db);
    }

    public function listMedicos() {
        $medicos = $this->model->getMedicos();
        include_once __DIR__ . '/../views/listMedicos.php';
    }
}
?>
