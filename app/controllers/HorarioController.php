<?php

include_once "app/models/HorarioModel.php";
include_once "config/db_connection.php";

class HorarioController {

    private $model;

    public function __construct($connection) {
        $this -> model = new HorarioModel($connection);
    }

    // metodo para consultar horarios de un tutor siendo asesorado
    public function consultHorarios() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $idTutor = $_SESSION['id_usuario'] ?? null;
        if (!$idTutor) {
            header("Location: index.php?action=login");
            exit;
        }

        $horarios = $this->model->consultarHorariosPorTutor($idTutor);
        include "app/views/Tutor/consultHorario.php";
    }

    // metodo para registrar nuevo horario como tutor
    public function registrarHorario() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $idTutor = $_SESSION['id_usuario'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fecha = $_POST['fecha'];
            $hora_inicio = $_POST['hora_inicio'];
            $hora_fin = $_POST['hora_fin'];
            $id_asignatura = $_POST['id_asignatura'];

            $this->model->insertarHorario($fecha, $hora_inicio, $hora_fin, $id_asignatura, $idTutor);
            header("Location: index.php?action=consultHorario");
            exit;
        } else {
            $asignaturas = $this->model->obtenerAsignaturas();
            include_once "app/views/Tutor/gestion_horarios.php"; 
        }
    }


    // metodo para editar horario siendo tutor
    public function editarHorario() {
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = (int) $_GET['id'];
            $row = $this->model->consultarHorarioPorID($id);
            $asignaturas = $this->model->obtenerAsignaturas();

            include "app/views/Tutor/edithorario.php";
        } else {
            echo "ID de horario no válido.";
        }
    }
 

    // metodo para actualizar horario en la edicion
    public function actualizarHorario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
            $id = isset($_POST['id_horario']) ? (int)$_POST['id_horario'] : 0;
            $fecha = $_POST['fecha'] ?? null;
            $hora_inicio = $_POST['hora_inicio'] ?? null;
            $hora_fin = $_POST['hora_fin'] ?? null;
            $id_asignatura = isset($_POST['id_asignatura']) ? (int)$_POST['id_asignatura'] : null;

            if ($id > 0 && $fecha && $id_asignatura) {
                $update = $this->model->actualizarHorario($id, $fecha, $hora_inicio, $hora_fin, $id_asignatura);

                if ($update) {
                    header("Location: index.php?action=consultHorario");
                    exit;
                } else {
                    echo "Error al actualizar el horario.";
                }
            } else {
                echo "Datos incompletos para actualizar.";
            }
        }
        // Volver al formulario de edición si no es una solicitud POST válida
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $horario = $this->model->consultarHorarioPorId($id);
            $asignaturas = $this->model->obtenerAsignaturas();

            if (!$horario) {
                header("Location: index.php?action=consultHorario");
                exit;
            }
            include "app/views/Tutor/editHorario.php";
            return;
        }

        header("Location: index.php?action=consultHorario");
        exit;
    }


    // metodo para eliminar horario siendo tutor
    public function eliminarHorario($id) {
        
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = (int) $_GET['id'];

            $delete = $this->model->eliminarHorario($id);
            if ($delete) {
                echo "<script>alert('Horario eliminado correctamente');</script>";
                } else {
                    echo "<script>alert('Error al eliminar horario');</script>";
                }
                header("Location: index.php?action=consultHorario");
                exit;

        }
    }

   
}


