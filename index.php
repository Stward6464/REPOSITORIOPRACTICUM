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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <header class="mb-4">
            <h1 class="text-center text-primary">Gestión del Hospital</h1>
        </header>

        <?php
        if (isset($_SESSION['username'])) {
            echo "<p class='text-end'>Bienvenido, <strong>" . $_SESSION['username'] . "</strong> (<em>" . $_SESSION['rol'] . "</em>)</p>";
            echo '<nav class="nav nav-pills mb-3">';
            echo '<a class="nav-link" href="index.php?action=logout">Cerrar Sesión</a>';

            // Menú dinámico según el rol
            if ($_SESSION['rol'] === 'admin') {
                echo '<a class="nav-link" href="index.php?action=listMedicos">Ver Médicos</a>';
                echo '<a class="nav-link" href="index.php?action=listPacientes">Ver Pacientes</a>';
                echo '<a class="nav-link" href="index.php?action=addPacienteForm">Añadir Paciente</a>';
                echo '<a class="nav-link" href="index.php?action=addCitaForm">Agregar Cita</a>';
                echo '<a class="nav-link" href="index.php?action=listCitas">Ver Citas</a>';
            } elseif ($_SESSION['rol'] === 'medico') {
                echo '<a class="nav-link" href="index.php?action=mostrarFormularioHistorial">Registrar Síntomas y Diagnóstico</a>';
                echo '<a class="nav-link" href="index.php?action=listCitas">Ver Citas</a>';
            } elseif ($_SESSION['rol'] === 'paciente') {
                echo '<a class="nav-link" href="index.php?action=listCitas">Ver Mis Citas</a>';
            }
            echo '</nav>';
        } else {
            echo '<div class="text-center"><a class="btn btn-primary" href="index.php?action=loginForm">Iniciar Sesión</a></div>';
        }
        ?>

        <main>
            <?php
            switch ($action) {
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
                        echo "<div class='alert alert-danger'>Error: método no permitido.</div>";
                    }
                    break;

                case 'addCitaForm':
                    verificarRol('admin');
                    $controller = new CitaController($db);
                    $controller->showAddCitaForm();
                    break;

                case 'addCita':
                    verificarRol('admin');
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $controller = new CitaController($db);
                        $controller->addCita($_POST);
                    }
                    break;

                case 'listCitas':
                    verificarRol(['admin', 'medico', 'paciente']);
                    $controller = new CitaController($db);
                    $controller->listCitas();
                    break;

                case 'dashboardPaciente':
                    verificarRol('paciente');
                    include_once 'views/dashboardPaciente.php';
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

                case 'home':
                default:
                    echo "<div class='text-center'><h2>Bienvenido al Sistema de Gestión del Hospital</h2>";
                    if (!isset($_SESSION['username'])) {
                        echo "<a class='btn btn-primary mt-3' href='index.php?action=loginForm'>Iniciar Sesión</a>";
                    }
                    echo "</div>";
                    break;
            }
            ?>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
