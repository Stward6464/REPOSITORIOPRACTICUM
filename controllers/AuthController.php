<?php
include_once __DIR__ . '/../models/Usuario.php';

class AuthController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new Usuario($db);
    }
    public function login($data)
    {
        $username = $data['username'];
        $password = $data['password'];

        $user = $this->model->login($username, $password);

        if ($user) {
            session_start(); // Asegúrate de iniciar la sesión
            $_SESSION['username'] = $user['username'];
            $_SESSION['rol'] = $user['rol'];

            // Verifica si el usuario es un médico
            if ($user['rol'] === 'medico') {
                $_SESSION['medico_id'] = $user['id']; // Asegúrate de que 'id' es correcto
            }

            // Redirige según el rol
            switch ($user['rol']) {
                case 'admin':
                    header("Location: index.php?action=dashboardAdmin");
                    break;
                case 'medico':
                    header("Location: index.php?action=dashboardMedico");
                    break;
                case 'paciente':
                    header("Location: index.php?action=dashboardPaciente");
                    break;
            }
            exit;
        } else {
            echo "<p>Usuario o contraseña incorrectos.</p>";
            echo '<a href="index.php?action=loginForm">Volver al inicio de sesión</a>';
        }
    }


    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php?action=loginForm");
    }
}
