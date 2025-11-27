  <?php
  
  
    class AsignaturasModel{

        private $connection;

        //Crear constructor para recibir la conexion
        public function __construct($connection){
            $this -> connection = $connection; 
        }

    

        // Consultar todas las asignaturas
        public function consultarAsignaturas() {
            $sql = "SELECT id_asignatura, nombre FROM asignatura";
            return $this->connection->query($sql);
        }


        //metodo para consultar asignatura por ID
        public function consultarPorID($id) {
            $sql = "SELECT * FROM asignatura WHERE id_asignatura = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        //metodo para obtener todas las asignaturas (id y nombre)
        public function obtenerAsignaturas() {
            $sql = "SELECT id_asignatura, nombre FROM asignatura";
            return $this->connection->query($sql);
        }


    }