<?php
    include_once "app/models/BitacoraModel.php";
    include_once "config/db_connection.php";

    class BitacoraController {
        private $model;

        public function __construct($connection) {
            $this->model = new BitacoraModel($connection);
        }


        //metodo para consultar las bitacoras del tutor en sesion o sea el tutor
        public function consultarBitacorasTutor(){
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            if (!isset($_SESSION['id_usuario'])) {
                echo "<script>alert('Sesión no iniciada'); window.location='index.php?action=login';</script>";
                return;
            }

            $id_tutor = $_SESSION['id_usuario'];

            $bitacoras = $this->model->consultarBitacorasTutor($id_tutor);

            include "app/views/Tutor/consultBitacora.php";
        }

        // metodo para registrar la bitacora del asesorado para el tutor
        public function registrarBitacora() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $id_asesorado = $_SESSION['id_usuario'] ?? null;

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $id_solicitud = $_POST['id_solicitud'];
                $fecha = date('Y-m-d');
                $retro = $_POST['retroalimentacion'];
                $periodo = $_POST['periodo_cuatrimestral'];
                $id_tutor = $_POST['id_tutor'];
                $calificacion = $_POST['calificacion_estrellas'];

                $this->model->registrarBitacora($id_solicitud, $fecha, $retro, $periodo, $id_tutor, $id_asesorado, $calificacion);

                echo "<script>alert('Retroalimentación registrada con éxito'); 
                    window.location='index.php?action=registrarBitacora';</script>";
                exit;
            }

            $bitacoras = $this->model->obtenerBitacorasAsesorado($id_asesorado);

            include "app/views/Asesorado/gestion_bitacora.php";
        }

        //metodo para guardar la retroalimentacion del asesorado para el tutor 
        public function guardarRetroalimentacion(){
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (
                empty($_POST['retroalimentacion']) ||
                empty($_POST['calificacion_estrellas']) ||
                empty($_POST['periodo_cuatrimestral']) 
            ) {
                echo "<script> alert('Error: datos incompletos.');
                    window.history.back();
                </script>";
                return;
            }
            $id_solicitud = $_POST['id_solicitud'];
            $retro = $_POST['retroalimentacion'];
            $calificacion = $_POST['calificacion_estrellas'];
            $periodo = $_POST['periodo_cuatrimestral'];
            $id_tutor = $_POST['id_tutor'];
            $id_asesorado = $_SESSION['id_usuario'];
            $fecha = date("Y-m-d");

            $registroExiste = $this->model->existeBitacora($id_solicitud);

            if ($registroExiste) {
                $resultado = $this->model->actualizarBitacora($id_solicitud,$retro, $calificacion, $periodo);
            } else {
            $resultado = $this->model->registrarBitacora($id_solicitud, $fecha, $retro, $periodo, $id_tutor, $id_asesorado, $calificacion);

            }

            if ($resultado) {
                echo "<script>
                    alert('Retroalimentación guardada correctamente');
                    window.location = 'index.php?action=registrarBitacora';
                </script>";
            } else {
                echo "<script>
                    alert('Error al guardar la retroalimentación');
                    window.location = 'index.php?action=registrarBitacora';
                </script>";
            }

            exit;
        }

        //metodo para consultar las bitacoras de los tutores siendo profesor, es unica
        //accion para el profesor
        public function consultBitacoraProf() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $bitacoras = $this->model->obtenerTodasBitacoras();

            include "app/views/Profesor/consultBitacoraProf.php";
        }

    }
?>
