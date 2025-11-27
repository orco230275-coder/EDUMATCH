<?php
include_once "app/models/PremioModel.php";
include_once "config/db_connection.php";

class TutorPremioController {
    private $model;

    public function __construct($connection) {
        $this->model = new PremioModel($connection);
    }

    // Mostrar TODOS los premios disponibles
    public function premiosDisponibles() {
        $premio = $this->model->obtenerTodosLosPremios();
        include "app/views/Tutor/premios_disponibles.php";
    }

    // Aceptar premio (tutor)
    public function aceptarPremio() {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $this->model->cambiarEstado($id, "aceptado");
        }

        header("Location: index.php?action=premiosDisponibles");
        exit;
    }

    // Rechazar premio (tutor)
    public function rechazarPremio() {
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $this->model->cambiarEstado($id, "rechazado");
        }

        header("Location: index.php?action=premiosDisponibles");
        exit;
    }

    // Mis premios aceptados (tutor)
    public function misPremios() {
        $premio = $this->model->obtenerPremiosAceptados();
        include "app/views/Tutor/mis_premios.php";
    }
}
?>
