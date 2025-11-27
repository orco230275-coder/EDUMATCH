<?php
class PremioModel {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }
   
    //metodo para insertar premio
    public function insertarPremio($nombre_premio, $descripcion, $id_usuario) {
        $sql = "INSERT INTO premio (nombre_premio, descripcion, id_usuario) VALUES (?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("ssi", $nombre_premio, $descripcion, $id_usuario);
        return $stmt->execute();
}

    //metodo para consultar premios
    public function consultarPremios($id_usuario) {
        $sql = "SELECT * FROM premio WHERE id_usuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        return $stmt->get_result();
}

    //metodo para eliminar premio
    public function eliminarPremio($id) {
        $sql = "DELETE FROM premio WHERE id_premio = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    // metodo para actualizar premio
    public function actualizarDatosPremio($id, $nombre_premio, $descripcion){
        $sql = "UPDATE premio SET nombre_premio = ?, descripcion = ? WHERE id_premio = ?";
        $statement = $this -> connection -> prepare($sql);
        $statement -> bind_param("ssi",$nombre_premio, $descripcion, $id);
        return $statement -> execute();
        }

        // metodo para obtener premio por id
    public function obtenerPremioPorId($id) {
        $sql = "SELECT * FROM premio WHERE id_premio = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); 
    }
    
    public function obtenerTodosLosPremios() {
        $sql = "SELECT * FROM premio";
        return $this->connection->query($sql);
    }
    public function cambiarEstado($id_premio, $estado) {
        $sql = "UPDATE premio SET estado = ? WHERE id_premio = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("si", $estado, $id_premio);
        return $stmt->execute();
    }
    
    public function obtenerPremiosAceptados() {
        $sql = "SELECT * FROM premio WHERE estado = 'aceptado'";
        return $this->connection->query($sql);
    }

}

?>
