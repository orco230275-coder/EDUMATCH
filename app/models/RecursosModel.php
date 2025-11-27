<?php
    class RecursosModel {
        private $connection;

        public function __construct($connection) {
            $this->connection = $connection;
        }

  
           // metodo consultar
        public function consultarRecursos($asignatura = null) {
            
            $sql = "SELECT r.id_recurso, r.titulo, r.enlace, a.nombre AS asignatura
                    FROM recurso r
                    INNER JOIN asignatura a ON r.id_asignatura = a.id_asignatura";

            // si se proporciona una asignatura, agregar filtro
            if ($asignatura) {
                $sql .= " WHERE a.nombre LIKE ?";
                $stmt = $this->connection->prepare($sql);
                $like = "%" . $asignatura . "%";
                $stmt->bind_param("s", $like);
                $stmt->execute();
                return $stmt->get_result();
            } else {
            
                return $this->connection->query($sql);
            }
        }


    

        // metodo para insertar recurso
        public function insertarRecurso($titulo, $enlace, $id_asignatura) {
            $sql = "INSERT INTO recurso (titulo, enlace, id_asignatura) VALUES (?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("ssi", $titulo, $enlace, $id_asignatura);
            return $stmt->execute();

        }

        // metodo para obtener un recurso por id
        public function obtenerRecurso($id) {
            $sql = "SELECT * FROM recurso WHERE id_recurso = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }


        // metodo para eliminar recurso
        public function eliminarRecurso($id) {
            $sql = "DELETE FROM recurso WHERE id_recurso = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        }

                // Consultar un recurso por ID
        public function consultarRecursoPorID($id) {
            $sql = "SELECT * FROM recurso WHERE id_recurso = $id";
            return $this->connection->query($sql)->fetch_assoc();
        }

        // Obtener todas las asignaturas
        public function obtenerAsignaturas() {
            $sql = "SELECT * FROM asignatura";
            return $this->connection->query($sql);
        }

        // Actualizar un recurso
        public function actualizarRecurso($id, $titulo, $enlace, $id_asignatura) {
            $sql = "UPDATE recurso 
                    SET titulo = '$titulo', enlace = '$enlace', id_asignatura = $id_asignatura
                    WHERE id_recurso = $id";
            return $this->connection->query($sql);
        }

}





    

