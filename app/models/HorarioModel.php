<?php

class HorarioModel {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

 
    //metodo para consultar horarios de un tutor
    public function consultarHorariosPorTutor($idTutor){
        $sql = "SELECT h.id_horario, h.fecha, h.hora_inicio, h.hora_fin, a.nombre AS asignatura, u.nombre AS nombre_tutor
                FROM horario h 
                JOIN asignatura a ON h.id_asignatura = a.id_asignatura
                JOIN usuario u ON h.id_tutor = u.id_usuario
                WHERE h.id_tutor = ?
                ORDER BY h.fecha, h.hora_inicio";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $idTutor);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function insertarHorario($fecha, $hora_inicio, $hora_fin, $id_asignatura, $id_tutor){
        $sql = "INSERT INTO horario (fecha, hora_inicio, hora_fin, id_asignatura, id_tutor) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sssii", $fecha, $hora_inicio, $hora_fin, $id_asignatura, $id_tutor);
        return $stmt->execute();
    }

    public function consultarHorarioPorID($id){
        $sql = "SELECT * FROM horario WHERE id_horario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }




    public function actualizarHorario($id, $fecha, $hora_inicio, $hora_fin, $id_asignatura){
        $sql = "UPDATE horario SET fecha = ?, hora_inicio = ?, hora_fin = ?, id_asignatura = ? WHERE id_horario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sssii", $fecha, $hora_inicio, $hora_fin, $id_asignatura, $id);
        return $stmt->execute();
    }

    // fuerza la eliminacion (tutor)
    public function eliminarHorario($id_horario) {
        $delSolicitudes = $this->connection->prepare("DELETE FROM solicitud_asesoria WHERE id_horario = ?");
        $delSolicitudes->bind_param("i", $id_horario);
        $delSolicitudes->execute();
        $delSolicitudes->close();


        $sql = $this->connection->prepare("DELETE FROM horario WHERE id_horario = ?");
        $sql->bind_param("i", $id_horario);
        
        return $sql->execute();
    }

    public function obtenerAsignaturas(){
        $sql = "SELECT id_asignatura, nombre FROM asignatura";
        return $this->connection->query($sql);
    }





   
}


