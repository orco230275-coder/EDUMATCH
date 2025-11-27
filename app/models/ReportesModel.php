<?php

class ReportesModel {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection; 
    }

    //Método para CONSULTAR el reporte de asignaturas
    public function obtenerReporteAsignaturas() { 
        $sql = "SELECT a.nombre AS asignatura, COUNT(s.id_solicitud) AS total_solicitudes, 
        (COUNT(s.id_solicitud) * 100.0 / (SELECT COUNT(*) FROM solicitud_asesoria)) AS porcentaje 
        FROM solicitud_asesoria s INNER JOIN asignatura a ON s.id_asignatura = a.id_asignatura 
        GROUP BY a.id_asignatura, a.nombre ORDER BY porcentaje DESC"; 
        
        $result = $this->connection->query($sql); 
        return $result; 
    }

    public function obtenerReporteTutores() {
        $sqlTotal = "SELECT CAST(COUNT(*) AS FLOAT) AS total_general FROM bitacora_asesoria";
        $resultTotal = $this->connection->query($sqlTotal);
        $rowTotal = $resultTotal->fetch_assoc();
        $totalGeneral = ($rowTotal['total_general'] == 0) ? 1 : $rowTotal['total_general'];

        $sql = "SELECT CONCAT(u.nombre, ' ', u.apellidos) AS tutor, COUNT(b.id_asesoria) AS total_atendidas,
                    (COUNT(b.id_asesoria) * 100.0 / $totalGeneral) AS porcentaje FROM bitacora_asesoria b
                INNER JOIN usuario u ON b.id_tutor = u.id_usuario GROUP BY u.id_usuario, u.nombre, u.apellidos
                ORDER BY porcentaje DESC";
        
        $result = $this->connection->query($sql);
        if (!$result) {
            echo "Error en la consulta de Tutores: " . $this->connection->error;
        }
        return $result;
    }
}
?>