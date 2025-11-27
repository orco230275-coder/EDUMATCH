<?php

    class BitacoraModel {
        private $connection;

        public function __construct($connection) {
            $this->connection = $connection;
        }

        //------------TUTOR------------

        //consultar bitacora para el tutor (puede ver todas sus asesorias dadas y terminadas con su retroalimentacion)
        public function consultarBitacorasTutor($id_tutor){
            $sql = "SELECT 
                        b.fecha_realizada AS fecha,
                        CONCAT(u.nombre, ' ', u.apellidos) AS nombre_asesorado,
                        a.nombre AS nombre_asignatura,
                        b.periodo_cuatrimestral,
                        b.calificacion_estrellas AS calificacion,
                        b.retroalimentacion
                    FROM bitacora_asesoria b
                    INNER JOIN usuario u      ON u.id_usuario = b.id_asesorado
                    INNER JOIN solicitud_asesoria s    ON s.id_solicitud = b.id_solicitud
                    INNER JOIN asignatura a   ON a.id_asignatura = s.id_asignatura
                    WHERE b.id_tutor = ?
                    ORDER BY b.fecha_realizada DESC";

            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("i", $id_tutor);
            $stmt->execute();

            return $stmt->get_result();   
        }






        //---------ASESORADO-------------
        // Registrar retroalimentación para el tutor(asesorado)
        public function registrarBitacora($id_solicitud, $fecha, $retro, $periodo, $id_tutor, $id_asesorado, $calificacion) {
            $sql = "INSERT INTO bitacora_asesoria 
                    (id_solicitud, fecha_realizada, retroalimentacion, periodo_cuatrimestral, id_tutor, id_asesorado, calificacion_estrellas)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("isssiii", $id_solicitud, $fecha, $retro, $periodo, $id_tutor, $id_asesorado, $calificacion);
            return $stmt->execute();
        }

        //bitacoras de asesorado
        public function obtenerBitacorasAsesorado($id_asesorado) {
            $sql = "SELECT b.*, 
                        u.nombre AS nombre_tutor,
                        a.nombre AS asignatura
                    FROM bitacora_asesoria b
                    INNER JOIN usuario u ON b.id_tutor = u.id_usuario
                    INNER JOIN solicitud_asesoria s ON b.id_solicitud = s.id_solicitud
                    INNER JOIN asignatura a ON s.id_asignatura = a.id_asignatura
                    WHERE b.id_asesorado = ?";
            
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("i", $id_asesorado);
            $stmt->execute();
            return $stmt->get_result();
        }


        //metodo para el boton de guardar 
        public function guardarRetroalimentacion($id_solicitud, $fecha, $retro, $periodo, $id_tutor, $calificacion) {
            $sql = "INSERT INTO bitacora_asesoria 
                    (id_solicitud, fecha_realizada, retroalimentacion, periodo_cuatrimestral, id_tutor, calificacion_estrellas)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->connection->prepare($sql);
            if (!$stmt) return false;
            $stmt->bind_param("isssiii", $id_solicitud, $fecha, $retro, $periodo, $id_tutor, $calificacion);
            return $stmt->execute();
        }

            // verifica si ya existe registro
        public function existeBitacora($id_solicitud) {
            $sql = "SELECT id_asesoria FROM bitacora_asesoria WHERE id_solicitud = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("i", $id_solicitud);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }

        //actualiza (asesorado)
        public function actualizarBitacora($id_solicitud, $retro, $calificacion) {
            $sql = "UPDATE bitacora_asesoria
                    SET retroalimentacion = ?, calificacion_estrellas = ?
                    WHERE id_solicitud = ?";

            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param("sii", $retro, $calificacion, $id_solicitud);

            return $stmt->execute();
        }




        //metodo para consultar todas las bitacoras  
        public function obtenerTodasBitacoras() {

            $sql = "SELECT b.id_asesoria, b.fecha_realizada, 
            b.retroalimentacion, b.periodo_cuatrimestral, b.calificacion_estrellas, 
            CONCAT(ut.nombre, ' ', ut.apellidos) AS nombre_tutor, CONCAT(ua.nombre, ' ', ua.apellidos) AS nombre_asesorado, asig.nombre 
            FROM bitacora_asesoria b INNER JOIN solicitud_asesoria s ON b.id_solicitud = s.id_solicitud 
            INNER JOIN usuario ut ON b.id_tutor = ut.id_usuario INNER JOIN usuario ua ON b.id_asesorado = ua.id_usuario 
            INNER JOIN asignatura asig ON s.id_asignatura = asig.id_asignatura ORDER BY b.fecha_realizada DESC";


            return $this->connection->query($sql);
        }


        // Obtener todas las bitácoras para  vista del profesor
        public function consultarBitacoraProf() {
            $sql = "SELECT b.id_asesoria, b.id_solicitud, b.fecha_realizada,
                        b.retroalimentacion, b.periodo_cuatrimestral, b.calificacion_estrellas,
                        CONCAT(u.nombre, ' ', u.apellidos) AS nombre_tutor,
                        a.nombre AS asignatura
                    FROM bitacora_asesoria b
                    INNER JOIN usuario u ON b.id_tutor = u.id_usuario
                    INNER JOIN asignatura a ON b.id_asignatura = u.id_usuario"; 
            $result = $this->connection->query($sql);
            return $result;
        }








    }
?>
