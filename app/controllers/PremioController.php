<?php
include_once "app/models/PremioModel.php";
 include_once "config/db_connection.php";

class PremioController {
    private $model;

    public function __construct($connection) {
        $this->model = new PremioModel($connection);
    }

    // metodo para insertar premio como profesor
    public function insertarPremio() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_POST['enviar'])) {
            $nombre_premio = $_POST['nombre_premio'] ?? null;
            $descripcion = $_POST['descripcion'] ?? null;
            $id_usuario = $_SESSION['id_usuario'] ?? null; 

            $this->model->insertarPremio($nombre_premio, $descripcion, $id_usuario);
            echo "<script>alert('Premio registrado correctamente');</script>";
        }
        include_once "app/views/Profesor/gestion_premios.php";
    }


    //metodo para mostrar formulario de edicion
    public function mostrarFormularioEdicion() {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $row = $this->model->obtenerPremioPorId($id); 
            
            if ($row) {
                include_once "app/views/Profesor/editPremio.php"; 
            } else {
                echo "Error: Premio no encontrado.";
            }
        } else {
            echo "Error: ID de premio no especificado.";
        }
    }

    // metodo para actualizar premio
    public function actualizarPremio(){
        if(isset($_POST['editar'])){

            $id = (int)$_GET['id']; 
            $nombre_premio = $_POST['nombre_premio'];
            $descripcion = $_POST["descripcion"];

            $update = $this->model->actualizarDatosPremio(
                $id, $nombre_premio, $descripcion
            );

            if($update){
                header("Location: index.php?action=gestion_premios");
                exit;
            } else {
                echo "Error al actualizar el premio.";
            }

        } else {
            header("Location: index.php?action=gestion_premios");
            exit;
        }
    }

    // metodo para eliminar premio
    public function eliminarPremio($id) {
        $delete = $this->model->eliminarPremio($id);

        if ($delete) {
            echo "<script>alert('Premio eliminado correctamente');</script>";
        } else {
            echo "<script>alert('Error al eliminar el premio');</script>";
        }
        header("Location: index.php?action=consultPremios");
        exit;
    }
    

    // metodo para consultar premios solo del usuario logueado
    public function consultarPremios() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id_usuario = $_SESSION['id_usuario'];
        $premios = $this->model->consultarPremios($id_usuario);

        include_once "app/views/Profesor/consultPremio.php";
    }


}
?>
