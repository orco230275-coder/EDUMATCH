<?php

    include_once "app/models/SolicitudModel.php";
    include_once "config/db_connection.php";

    class SolicitudController {
        private $model;

        public function __construct($connection) {
            $this->model = new SolicitudModel($connection);
        }



    //metodo para enviar la solicitud asesorado a tutor
    public function enviarSolicitud() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id_usuario = $_SESSION['id_usuario'] ?? null;
        $id_horario = $_POST['id_horario'] ?? null;
        $id_asignatura = $_POST['id_asignatura'] ?? null;

        if ($id_usuario && $id_horario && $id_asignatura) {
            $estado = "Pendiente";
            $this->model->insertarSolicitud($estado, $id_usuario, $id_horario, $id_asignatura);
            echo "<script>alert('Solicitud enviada correctamente'); window.location='index.php?action=solicitarAsesoria';</script>";
        } else {
            echo "<script>alert('Selecciona un horario y una asignatura válidos'); history.back();</script>";
        }
        if ($this->model->solicitudExiste($id_usuario, $id_horario, $id_asignatura)) {
            echo "<script>alert('Ya tienes una solicitud igual'); history.back();</script>";
            exit;
        }

    }


    //metodo para mostrar los horarios disponibles al asesorado
    public function mostrarHorarios(){
        // Obtener todos los horarios con su asignatura y tutor
        $horarios = $this->model->obtenerHorarios();

        include 'app/views/Asesorado/form_solicitar.php';
    }


    //metodo para consultar las solicitudes del asesorado
    public function consultarSolicitudesAsesorado() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        $solicitudes = $this->model->obtenerSolicitudesPorUsuario($_SESSION['id_usuario']);
        include "app/views/Asesorado/consultarSolicitudes.php";
    }

    //metodo para gestionar las solicitudes del tutor
    public function gestionarSolicitudesTutor() {
        if (session_status() === PHP_SESSION_NONE) {
                session_start();
        }
        $solicitudes = $this->model->obtenerSolicitudesParaTutor($_SESSION['id_usuario']);
        include "app/views/Tutor/gestion_solicitudes.php";
    }

 // Función para calcular el periodo cuatrimestral
    public function obtenerPeriodoCuatrimestral($fecha) {
        $mes = (int)date('m', strtotime($fecha));
        if ($mes >= 1 && $mes <= 4) return 'Enero-Abril';
        if ($mes >= 5 && $mes <= 8) return 'Mayo-Agosto';
        return 'Septiembre-Diciembre';
    }



    //actualizar estado para el asesorado
    public function actualizarEstado() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['id_usuario'])) { 
            header("Location: index.php?action=login"); 
            exit; 
        }

        $id_solicitud = $_POST['id_solicitud'];
        $estado = $_POST['estado'];

        // Cambiar estado de la solicitud
        $this->model->actualizarEstado($id_solicitud, $estado);

        // Si se aceptó, registrar en bitácora
        if (strtolower($estado) === 'aceptada') {
            if (session_status() === PHP_SESSION_NONE) session_start();

            $solicitud = $this->model->obtenerSolicitudPorId($id_solicitud);
            $id_tutor = $solicitud['id_tutor'];
            $id_asesorado = $solicitud['id_usuario'];

            $fecha = date('Y-m-d');
            $periodo_cuatrimestral = $this->obtenerPeriodoCuatrimestral($fecha);

            $this->model->registrarBitacora($id_solicitud, $id_tutor, $id_asesorado, $periodo_cuatrimestral);
        }

        header("Location: index.php?action=gestionarSolicitudesTutor");
    }



    //metodo para cancelar la solicitud accion del asesorado 
    public function cancelarSolicitud(){
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['id_usuario'])) { 
            header("Location: index.php?action=login"); 
            exit; 
        }
        if (!isset($_GET['id'])) {
            echo "<script>alert('Solicitud no válida'); window.location='index.php?action=consultarSolicitudes';</script>";
            return;
        }

        $id = $_GET['id'];
        if ($this->model->cancelarSolicitud($id)) {
                echo "<script>alert('Solicitud cancelada correctamente');</script>";
            } else {
                echo "<script>alert('Error al cancelar la solicitud');</script>";
            }

            echo "<script>window.location='index.php?action=consultarSolicitudes';</script>";
    }

    


    //metodo para eliminar solicitud asesorado
    public function eliminarSolicitud(){
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (!isset($_SESSION['id_usuario'])) { 
            header("Location: index.php?action=login"); 
            exit; 
        }
        if (!isset($_GET['id'])) {
        echo "<script>alert('Solicitud no válida'); window.location='index.php?action=consultarSolicitudes';</script>";
        return;
        }

        $id = $_GET['id'];
            if ($this->model->eliminarSolicitud($id)) {
                echo "<script>alert('Solicitud eliminada correctamente');</script>";
            } else {
                echo "<script>alert('Error al eliminar la solicitud');</script>";
            }

            echo "<script>window.location='index.php?action=consultarSolicitudes';</script>";

    }




}