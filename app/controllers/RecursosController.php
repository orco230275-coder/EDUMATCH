<?php
    include_once "app/models/RecursosModel.php";
    include_once "config/db_connection.php";
    include_once "app/models/AsignaturasModel.php";


    
    class RecursosController {
        private $model;
        private $connection;

        public function __construct($connection) {
            $this->connection = $connection;
            $this->model = new RecursosModel($connection);
        }


        // Consultar recursos (todos los roles)
        public function consultarRecursos() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $rol = $_SESSION['rol_usuario'] ?? null;
            $asignatura = $_GET['asignatura'] ?? null;

            $recursos = $this->model->consultarRecursos($asignatura);

            include_once "app/views/consultar_recursos.php";
        }



        // Insertar recurso (solo profesor)
        public function insertarRecurso() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $titulo = $_POST['titulo'];
                $enlace = $_POST['enlace'];
                $id_asignatura = $_POST['id_asignatura'];

                $this->model->insertarRecurso($titulo, $enlace, $id_asignatura);
                header("Location: index.php?action=consultarRecursos");
                exit();
            } else {
                $asignaturaModel = new AsignaturasModel($this->connection);
                $asignaturas = $asignaturaModel->obtenerAsignaturas();
                include "app/views/Profesor/form_recurso.php";
            }
        }

        // Editar recurso (solo profesor)
        public function editarRecurso() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_POST['editar'])) {
                $id = (int)$_GET['id'];
                $titulo = $_POST['titulo'];
                $enlace = $_POST['enlace'];
                $id_asignatura = $_POST['id_asignatura'];

                $update = $this->model->actualizarRecurso($id, $titulo, $enlace, $id_asignatura);

                if ($update) {
                    header("Location: index.php?action=consultarRecursos");
                    exit;
                } else {
                    echo "Error al actualizar el recurso.";
                }
            } 
            else if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = (int)$_GET['id'];
                $row = $this->model->consultarRecursoPorID($id);
                $asignaturas = $this->model->obtenerAsignaturas();
                include "app/views/Profesor/editRecurso.php";
            } 
            else {
                echo "ID no válido.";
            }
        }


        // Eliminar recurso (solo profesor)
        public function eliminarRecurso() {
            $id = $_GET['id'];
            $this->model->eliminarRecurso($id);
            header("Location: index.php?action=consultarRecursos");
            exit();
        }
    
}
?>