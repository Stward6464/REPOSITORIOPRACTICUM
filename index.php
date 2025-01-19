<?php
include_once 'models/db.php';
include_once 'controllers/MedicoController.php';
include_once 'controllers/CitaController.php';
include_once 'controllers/PacienteController.php';
include_once 'controllers/AuthController.php'; // Controlador de autenticación
include_once 'middleware.php'; // Middleware para roles
include_once 'controllers/HistorialController.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$database = new Database();
$db = $database->getConnection();

$action = $_GET['action'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema MVC - Hospital</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .menu {
            margin-bottom: 20px;
        }

        .menu a {
            margin-right: 15px;
            text-decoration: none;
            color: blue;
            font-weight: bold;
        }

        .menu a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h1>Gestión del Hospital</h1>
    <?php
    if (isset($_SESSION['username'])) {
        echo "<p>Bienvenido, " . $_SESSION['username'] . " (" . $_SESSION['rol'] . ")</p>";
        echo '<div class="menu">';
        echo '<a href="index.php?action=logout">Cerrar Sesión</a>';

        // Menú dinámico según el rol
        if ($_SESSION['rol'] === 'admin') {
            echo '<a href="index.php?action=listMedicos">Ver Médicos</a>';
            echo '<a href="index.php?action=listPacientes">Ver Pacientes</a>';
            echo '<a href="index.php?action=addPacienteForm">Añadir Paciente</a>';
            echo '<a href="index.php?action=addCitaForm">Agregar Cita</a>';
            echo '<a href="index.php?action=listCitas">Ver Citas</a>';
        } elseif ($_SESSION['rol'] === 'medico') {
            echo '<a href="index.php?action=mostrarFormularioHistorial">Registrar Síntomas y Diagnóstico</a>';
            echo '<a href="index.php?action=listCitas">Ver Citas</a>';
        } elseif ($_SESSION['rol'] === 'paciente') {
            echo '<a href="index.php?action=listCitas">Ver Mis Citas</a>';
            //echo '<a href="index.php?action=agregarHistorial">Ver Mis Sintomas</a>';/
        }
        echo '</div>';
    } else {
        echo '<p><a href="index.php?action=loginForm">Iniciar Sesión</a></p>';
    }
    ?>

    <?php
    switch ($action) {
            // Acciones de autenticación
        case 'loginForm':
            include_once 'views/login.php';
            break;

        case 'login':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new AuthController($db);
                $controller->login($_POST);
            }
            break;

        case 'logout':
            $controller = new AuthController($db);
            $controller->logout();
            break;

            // Acciones para administradores
        case 'listMedicos':
            verificarRol('admin');
            $controller = new MedicoController($db);
            $controller->listMedicos();
            break;

        case 'listPacientes':
            verificarRol('admin');
            $controller = new PacienteController($db);
            $controller->listPacientes();
            break;

        case 'addPacienteForm':
            verificarRol('admin');
            include_once 'views/addPacienteForm.php';
            break;

        case 'addPaciente':
            verificarRol('admin');
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new PacienteController($db);
                $controller->addPaciente($_POST);
            } else {
                echo "<p>Error: método no permitido.</p>";
            }
            break;

        case 'addCitaForm':
            verificarRol('admin'); // Solo admins pueden acceder a esta acción
            $controller = new CitaController($db);
            $controller->showAddCitaForm();
            break;


        case 'addCita':
            verificarRol('admin'); // Solo admins pueden agregar citas
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller = new CitaController($db);
                $controller->addCita($_POST);
            }
            break;


            // Acciones para médicos
        case 'listCitas':
            verificarRol(['admin', 'medico', 'paciente']); // Permitir acceso a administradores y médicos
            $controller = new CitaController($db);
            $controller->listCitas();
            break;


            // Acciones para pacientes
        case 'dashboardPaciente':
            verificarRol('paciente');
            include_once 'views/dashboardPaciente.php';
            break;

        case 'home': // Página de inicio básica
        default:
            echo "<h2>Bienvenido al Sistema de Gestión del Hospital</h2>";
            if (!isset($_SESSION['username'])) {
                echo "<p><a href='index.php?action=loginForm'>Iniciar Sesión</a></p>";
            }
            break;
        case 'mostrarFormularioHistorial':
    verificarRol(['medico', 'paciente']);
    $controller = new HistorialController($db);
    $controller->mostrarFormularioHistorial();
    break;

case 'agregarHistorial':
    verificarRol(['medico', 'paciente']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $controller = new HistorialController($db);
        $controller->agregarHistorial($_POST);
    }
    break;

    }

    ?>
</body>

</html>