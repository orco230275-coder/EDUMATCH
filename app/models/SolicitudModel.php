<?php

    class SolicitudModel {
        private $connection;

        public function __construct($connection) {
            $this->connection = $connection;
        }
  

         // Mostrar todos los horarios disponibles
    public function obtenerHorarios() {
       $sql = "SELECT h.id_horario, h.fecha, h.hora_inicio, h.hora_fin, 
               a.id_asignatura, a.nombre AS asignatura, 
               CONCAT(u.nombre, ' ', u.apellidos) AS tutor
        FROM horario h
        INNER JOIN asignatura a ON h.id_asignatura = a.id_asignatura
        INNER JOIN usuario u ON h.id_tutor = u.id_usuario";

        return $this->connection->query($sql);
    }

    // Enviar una solicitud

        public function insertarSolicitud($estado, $id_usuario, $id_horario, $id_asignatura) {
            $sql = "INSERT INTO solicitud_asesoria (estado, id_usuario, id_horario, id_asignatura)
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("siii", $estado, $id_usuario, $id_horario, $id_asignatura);
            $stmt->execute();
        }


    // Consultar solicitudes del asesorado
    public function obtenerSolicitudesPorUsuario($id_usuario) {
         $sql = "SELECT s.id_solicitud, s.estado, h.fecha,
                h.hora_inicio, h.hora_fin, a.nombre AS asignatura,
                CONCAT(u.nombre, ' ', u.apellidos) AS tutor
            FROM solicitud_asesoria s
            INNER JOIN horario h ON s.id_horario = h.id_horario
            INNER JOIN asignatura a ON s.id_asignatura = a.id_asignatura
            INNER JOIN usuario u ON h.id_tutor = u.id_usuario
            WHERE s.id_usuario = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        return $stmt->get_result();
    }

    //consultar solis de tutores
    public function obtenerSolicitudesParaTutor($id_tutor) {
        $sql = "SELECT s.id_solicitud, s.estado, 
                    u.nombre, u.apellidos,
                    a.nombre AS asignatura, 
                    h.fecha, h.hora_inicio, h.hora_fin
                FROM solicitud_asesoria s
                INNER JOIN horario h ON s.id_horario = h.id_horario
                INNER JOIN asignatura a ON s.id_asignatura = a.id_asignatura
                INNER JOIN usuario u ON s.id_usuario = u.id_usuario
                WHERE h.id_tutor = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id_tutor);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Cambiar estado (aceptar o rechazar)
    public function actualizarEstado($id_solicitud, $nuevoEstado) {
        $sql = "UPDATE solicitud_asesoria SET estado = ? WHERE id_solicitud = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("si", $nuevoEstado, $id_solicitud);
        return $stmt->execute();
    }

    // Obtener datos de una solicitud por su ID
    public function obtenerSolicitudPorId($id_solicitud) {
        $sql = "SELECT s.id_solicitud, s.id_usuario, h.id_tutor
                FROM solicitud_asesoria s
                INNER JOIN horario h ON s.id_horario = h.id_horario
                WHERE s.id_solicitud = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id_solicitud);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Registrar bitácora de asesoría
    public function registrarBitacora($id_solicitud, $id_tutor, $id_asesorado, $periodo_cuatrimestral) {
        $fecha = date('Y-m-d'); 
        $sql = "INSERT INTO bitacora_asesoria 
                (id_solicitud, fecha_realizada, retroalimentacion, periodo_cuatrimestral, id_tutor, id_asesorado, calificacion_estrellas)
                VALUES (?, ?, '', ?, ?, ?, NULL)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("sssii", $id_solicitud, $fecha, $periodo_cuatrimestral, $id_tutor, $id_asesorado);
        return $stmt->execute();
    }



    //cancelar solicitud (asesorado)
    public function cancelarSolicitud($id){
       $sql = "UPDATE solicitud_asesoria SET estado = 'Cancelada' WHERE id_solicitud = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();

    }

    //eliminar solicitud (asesorado)
    public function eliminarSolicitud($id){
        $sql = "DELETE FROM solicitud_asesoria WHERE id_solicitud = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
       
    }


    //metodo para ver si existe la solicitud
    public function solicitudExiste($id_usuario, $id_horario, $id_asignatura) {
        $sql = "SELECT COUNT(*) AS total
                FROM solicitud_asesoria
                WHERE id_usuario = ? AND id_horario = ? AND id_asignatura = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param("iii", $id_usuario, $id_horario, $id_asignatura);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'] > 0;
    }



}






    







    