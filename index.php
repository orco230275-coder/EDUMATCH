<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


include_once "app/controllers/UserController.php";
include_once "app/controllers/PremioController.php";
include_once "app/controllers/HorarioController.php";
include_once "app/controllers/AsignaturasController.php";
include_once "app/controllers/SolicitudController.php";
include_once "app/controllers/RecursosController.php";
include_once "app/controllers/BitacoraController.php";
include_once "app/controllers/ReportesController.php"; 
include_once "app/controllers/TutorPremioController.php";

include_once "config/db_connection.php";

// Crear instancias de los controladores
$userController = new UserController($connection);
$premioController = new PremioController($connection);
$horarioController = new HorarioController($connection);
$asignaturasController = new AsignaturasController($connection);
$solicitudController = new SolicitudController($connection);
$recursoController = new RecursosController($connection);
$bitacoraController = new BitacoraController($connection);
$reportesController = new ReportesController($connection);
$tutorPremioController = new TutorPremioController($connection);


// Detectar acción
$action = $_GET['action'] ?? 'home';




// si no hay sesión iniciada
$accionesPublicas = ['home','login', 'registrar', 'validarLogin']; 

if (!in_array($action, $accionesPublicas) && !isset($_SESSION['rol_usuario'])) {
    header("Location: index.php?action=login");
    exit;
}


switch($action){

    //USUARIOS-------------------------------------
    case 'home':
        include_once "app/views/home.php";
    break;
    case 'registrar':
        $userController->insertarUsuario();
        break;
    case 'gestion_usuarios':
        include_once "app/views/Profesor/gestion_usuarios.php";
        break;
    case 'insertarUsuarioProfesor':
        $userController->insertarUsuarioProfesor();
        break;
    case 'consult':
        $userController->consultarUsuarios();
        break;
    case 'update':
        $userController->actualizarUsuario();
        break;
    case 'delete':
        $userController->eliminarUsuario();
        break;
    case 'login':
        $userController->loginUsuario();
        break;
    case 'formInsert2':
        include_once "app/views/Profesor/form_insert2.php";
        break;


    //PREMIOS-----------------------------------
    case 'gestion_premios':
        $premioController->insertarPremio();
        break;
    case 'editarPremio':
        $premioController->mostrarFormularioEdicion();
        break;

    case 'actualizarPremio':
        $premioController->actualizarPremio();
        break;
    case 'deletePremio':
        if (isset($_GET['id'])) {
            $premioController->eliminarPremio($_GET['id']);
        }
        break;
    case 'consultPremios':
        $premioController->consultarPremios();
        break;

    //HORARIOS-------------------------------------

       //tutor
    case 'consultHorario':
        $horarioController->consultHorarios();
        break;

    case 'registrarHorario':
        $horarioController->registrarHorario();
        break;

    case 'actualizarHorario':
        $horarioController->actualizarHorario();
        break;

    case 'eliminarHorario':
        if (isset($_GET['id'])) {
            $horarioController->eliminarHorario($_GET['id']);
        } else {
            echo "ID no proporcionado para eliminar.";
        }
        break;

        //ASIGNATURAS-------------------------------------
    
    case 'consultarAsignaturas':
            $asignaturasController->consultarAsignaturas();
        break;


        //SOLICITUDES-------------------------------------

    case 'solicitarAsesoria':
        $solicitudController->mostrarHorarios();
        break;

    case 'cancelarSolicitud':
        $solicitudController->cancelarSolicitud();
        break;

    case 'eliminarSolicitud':
        $solicitudController->eliminarSolicitud();
        break;


    case 'enviarSolicitud':
        $solicitudController->enviarSolicitud();
        break;

    case 'gestionarSolicitudesTutor':
        $solicitudController->gestionarSolicitudesTutor();
        break;

    case 'actualizarEstadoSolicitud':
        $solicitudController->actualizarEstado();
        break;

    case 'consultarSolicitudes':
        $solicitudController->consultarSolicitudesAsesorado();
        break;

        // RECURSOS ----------------------------------------------------
    case 'consultarRecursos':
        $recursoController->consultarRecursos();
        break;

    case 'insertarRecurso':
        $recursoController->insertarRecurso();
        break;

    case 'editarRecurso':
        $recursoController->editarRecurso();
        break;

    case 'eliminarRecurso':
        if (isset($_GET['id'])) {
            $recursoController->eliminarRecurso($_GET['id']);
        }
        break;


        //BITACORAS-------------------------------------

        //bitacora profesor
    case 'consultBitacoraProf':
        $bitacoraController->consultBitacoraProf();
        break;
        //accion del asesorado para registrar en la bitacora
    case 'registrarBitacora':
        $bitacoraController->registrarBitacora();
        break;

    case 'guardarRetroalimentacion':
        $bitacoraController->guardarRetroalimentacion();
        break;

        //bitacora turor
    case 'consultarBitacorasTutor':
        $bitacoraController -> consultarBitacorasTutor();
        break;

      
    //paneles segun el rol-----------------------------
    case 'panelAsesorado':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['rol_usuario']) || $_SESSION['rol_usuario'] !== 'Asesorado') {
            header("Location: index.php?action=login");
            exit;
        }
        include_once "app/views/Asesorado/panelAsesorado.php";
        break;

    case 'panelProfesor':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['rol_usuario']) || $_SESSION['rol_usuario'] !== 'Profesor') {
            header("Location: index.php?action=login");
            exit;
        }
        include_once "app/views/Profesor/panelProfesor.php";
        break;

    //Reportes---------------------- -----
    case 'gestion_reportes':
        $reportesController->mostrarMenuReportes();
        break;
    
    case 'reporteAsignaturas':
        $reportesController->reportePorAsignatura();
        break;
    
    case 'reporteTutores':
        $reportesController->reportePorTutor();
        break;

    //Reportes en PDF
    case 'pdf_report':
        $reportesController -> generarPDF();
        break;
    case 'pdfTutores':
        $reportesController -> generarPDFTutores();
        break;
    case 'pdf_graph_asignaturas':
        $reportesController -> generarGraficaAsignaturas();
        break;
    case 'pdf_pie_asignaturas':
        $reportesController -> generarPastel();
        break;
    case 'pdf_graph_tutores':
        $reportesController -> generarGraficaTutores();
        break;
    case 'pdf_pie_tutores':
        $reportesController -> generarPastelTutores();
        break;

    //Restaurar y Respaldar BD
    case 'backup':
        $userController-> realizarRespaldoBD();
    break;
    
    case 'restore':
        $userController -> restaurarBD();
    break;

    case 'panelTutor':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['rol_usuario']) || $_SESSION['rol_usuario'] !== 'Tutor') {
            header("Location: index.php?action=login");
            exit;
        }
        include_once "app/views/Tutor/panelTutor.php";
        break;

    // Premios tutor -----------------
    case 'premiosDisponibles':
        $tutorPremioController->premiosDisponibles();
        break;

    case 'aceptarPremioTutor':
        $tutorPremioController->aceptarPremio();
        break;

    case 'rechazarPremioTutor':
        $tutorPremioController->rechazarPremio();
        break;

    case 'misPremios':
        $tutorPremioController->misPremios();
        break;

    //cierre de sesion
    case 'logout':
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?action=login");
        break;

    default:
        echo "Acción no válida";
        break;
}
?>