        <?php
        include_once "public/libraries/fpdf/fpdf.php";
        include_once "config/db_connection.php";
        include_once "app/models/ReportesModel.php";
        include_once "public/libraries/phplot/phplot.php";

        class ReportesController {
            private $model;

            public function __construct($connection) {
                $this->model = new ReportesModel($connection);
            }

            // Metodo para mostrar el menú de reportes
            public function mostrarMenuReportes() {
                include_once "app/views/Profesor/gestion_reportes.php";
            }

            // Metodo para mostrar el reporte por asignatura
            public function reportePorAsignatura() {
                $data = $this->model->obtenerReporteAsignaturas();
                
                include_once "app/views/Profesor/reporte_asignaturas.php";
            }

            // Metodo para mostrar el reporte por tutor
            public function reportePorTutor() {
                $data = $this->model->obtenerReporteTutores();

                include_once "app/views/Profesor/reporte_tutores.php";
            }

            // Método para generar el PDF, reporte por asignaturas
            public function generarPDF() {

                $result = $this->model->obtenerReporteAsignaturas();

                $data = [];
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }

                $pdf = new FPDF();
                $pdf->AddPage();

                $pdf->SetFont('Arial', 'B', 16);
                $pdf->Cell(0, 10, "Reporte por Asignaturas", 0, 1, 'C');
                $pdf->Ln(5);//salto de linea

                //cabecera de la tabla
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetFillColor(0, 0, 0);//agregar un relleno de color
                $pdf->SetTextColor(255, 255, 255);//cambia el color de la letra

                $pdf->Cell(60, 10, 'Asignatura', 1, 0, 'C', true);
                $pdf->Cell(50, 10, 'Total Solicitudes', 1, 0, 'C', true);
                $pdf->Cell(50, 10, 'Porcentaje (%)', 1, 1, 'C', true);
                $pdf -> ln();

                
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetTextColor(0, 0, 0);

                foreach ($data as $row) {

                    $texto = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $row['asignatura']);
                    $pdf->Cell(60, 10, $texto, 1, 0, 'C');
                    $pdf->Cell(50, 10, $row['total_solicitudes'], 1, 0, 'C');
                    $pdf->Cell(50, 10, number_format($row['porcentaje'], 2) . '%', 1, 1, 'C');
                }

                $pdf->Output('D', 'Reporte_asignaturas.pdf');
            }
            // Método para generar el PDF, reporte por tutores
            public function generarPDFTutores() {

                // Obtener datos del modelo
                $tutores = $this->model->obtenerReporteTutores();

                $pdf = new FPDF();
                $pdf->AddPage();

                // Título
                $pdf->SetFont('Arial', 'B', 16);
                $pdf->Cell(0, 10, "Reporte de tutorias por Tutor", 0, 1, 'C');
                $pdf->Ln(10); // salto de línea

                // Cabecera de la tabla
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetFillColor(0, 0, 0);        // Fondo negro
                $pdf->SetTextColor(255, 255, 255);  // Texto blanco

                $pdf->Cell(70, 10, "Tutor", 1, 0, 'C', true);
                $pdf->Cell(50, 10, "Total atendidas", 1, 0, 'C', true);
                $pdf->Cell(50, 10, "Porcentaje", 1, 0, 'C', true);
                $pdf->Ln();

                // Cuerpo de la tabla
                $pdf->SetFont('Arial', 'B', 12);
                $pdf->SetTextColor(0, 0, 0); // texto negro

                foreach ($tutores as $t) {

                    $pdf->Cell(70, 10, $t['tutor'], 1, 0, 'C');
                    $pdf->Cell(50, 10, $t['total_atendidas'], 1, 0, 'C');
                    $pdf->Cell(50, 10, number_format($t['porcentaje'], 2) . "%", 1, 0, 'C');
                    $pdf->Ln();
                }

                $pdf->Output('D', 'Reporte_Tutores.pdf');
            }


         //Metodo para generar grafica y pdf para asignaturas
        public function generarGraficaAsignaturas(){


            if (ob_get_length()) { ob_end_clean(); }
            ob_start();
            error_reporting(E_ALL & ~E_WARNING & ~E_DEPRECATED);
            
            $result = $this -> model -> obtenerReporteAsignaturas();
            
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    $row['asignatura'],                 
                    (int)$row['total_solicitudes'],     
                    round($row['porcentaje'], 2)        
                ];
            }

            //GENERAR GRAFICA
            $plot = new PHPlot(800, 600);
            $plot -> SetImageBorderType('plain'); // añadir borde a la imagen
            $plot -> SetPlotType('bars'); // Definir el tipo de grafica
            $plot -> SetDataType('text-data'); // Tipo de datos en la grafica
            $plot -> SetDataValues($data); // Cargar datos del modelo

            $plot -> SetTitle('Reporte de porcentaje por asignaturas');
            $plot -> SetXTitle('Asignatura');
            $plot -> SetYTitle('Total de solicitudes');
            $plot -> SetShading(5); // Añadir una sombra a la grafica

            $plot -> SetDataColors(['#a832a8']); //CAMBIAR EL color de la grafica

            $filename = 'public/media/graphs/grafica_barra.png';
            $plot -> SetOutputFile($filename); // Agregar grafica al sistema
            $plot -> SetIsInline(true); // Guardar imagen de forma local
            $plot -> DrawGraph(); //Dibujar la grafica}


            // Generar PDF
            $pdf = new FPDF();
            $pdf -> AddPage();

            $pdf -> SetFont('Arial', 'B', 16);
            $pdf -> Cell(0, 10, 'Reporte de asignaturas', 0, 1, 'C');
            // $pdf -> Image(ruta, x, y, ancho , alto);
            $pdf -> Image($filename, 30, 40, 150, 100);
            $pdf -> Output("D", "Reporte_Asignaturas_Grafica.pdf");
        }

        // Generar grafica de pastel y pdf de asignaturas
        public function generarPastel(){

            if (ob_get_length()) { ob_end_clean(); }
            ob_start();
            error_reporting(E_ALL & ~E_WARNING & ~E_DEPRECATED);

            $result = $this -> model -> obtenerReporteAsignaturas();

            
            $data = [];
            $labels = [];

            while ($row = $result->fetch_assoc()) {
                $labels[] = $row['asignatura'];              
                $data[] = ['', (float)$row['porcentaje']];   
            }

            // GERERAR GRAFICA
            $plot = new PHPlot(600, 400);

            $plot -> SetDataType('text-data-single'); // Añadir los datos de la grafica
            $plot -> SetPlotType('pie'); // Grafica de pastel
            $plot -> SetDataValues($data); // Cargar los datos del modelo

            $plot->SetLegend($labels);
            $plot->SetTitle('Porcentaje de asignaturas');


            $filename = 'public/media/graphs/grafica_pastel.png';

            $plot -> SetOutputFile($filename);
            $plot -> SetIsInline(true);
            $plot -> DrawGraph();

            // Generar PDF
            $pdf = new FPDF();
            $pdf -> AddPage();
            $pdf -> SetFont('Arial', 'B', 16);
            $pdf -> Cell(0, 10, 'Reporte de asignaturas', 0, 1, 'C');
            $pdf -> Image($filename, 30, 40, 150, 100);
            $pdf -> Ln(100);

            $pdf -> Output("D", "Reporte_Asignaturas_Pastel.pdf");
        }

        // Generar grafica y pdf para tutores
        public function generarGraficaTutores(){

            if (ob_get_length()) { ob_end_clean(); }
            ob_start();
            error_reporting(E_ALL & ~E_WARNING & ~E_DEPRECATED);

            $result = $this->model->obtenerReporteTutores();

            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    $row['tutor'],              
                    (int)$row['total_atendidas'] 
                ];
            }

            // GENERAR GRAFICA
            $plot = new PHPlot(900, 600);
            $plot->SetImageBorderType('plain');
            $plot->SetPlotType('bars');
            $plot->SetDataType('text-data');
            $plot->SetDataValues($data);

            // Títulos correctos
            $plot->SetTitle('Cantidad de tutorías atendidas por tutor');
            $plot->SetXTitle('Tutores');
            $plot->SetYTitle('Tutorías atendidas');

            $plot->SetShading(5);
            $plot->SetDataColors(['#3e64ff']);

            // Guardar imagen
            $filename = 'public/media/graphs/grafica_tutores_barra.png';
            $plot->SetOutputFile($filename);
            $plot->SetIsInline(true);
            $plot->DrawGraph();

            // Generar PDF
            $pdf = new FPDF();
            $pdf->AddPage();

            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Reporte de tutorías por tutor', 0, 1, 'C');

            $pdf->Image($filename, 20, 40, 170, 120);
            $pdf->Output("D", "Reporte_Tutores_Grafica.pdf");
        }

        
        // Generar grafica de pastel y pdf para tutores
        public function generarPastelTutores(){

            if (ob_get_length()) { ob_end_clean(); }
            ob_start();
            error_reporting(E_ALL & ~E_WARNING & ~E_DEPRECATED);

            $result = $this->model->obtenerReporteTutores();

            $data = [];
            $labels = [];

            while ($row = $result->fetch_assoc()) {
                $labels[] = $row['tutor'];           
                $data[] = ['', (float)$row['porcentaje']];
            }

            $plot = new PHPlot(700, 500);

            $plot->SetDataType('text-data-single');
            $plot->SetPlotType('pie');
            $plot->SetDataValues($data);

            $plot->SetLegend($labels);
            $plot->SetTitle('Porcentaje de tutorías atendidas por tutor');

            $filename = 'public/media/graphs/grafica_tutores_pastel.png';

            $plot->SetOutputFile($filename);
            $plot->SetIsInline(true);
            $plot->DrawGraph();

            // Generar PDF
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(0, 10, 'Reporte de tutorías por tutor', 0, 1, 'C');

            $pdf->Image($filename, 20, 40, 170, 140);
            $pdf->Ln(120);

            $pdf->Output("D", "Reporte_Tutores_Pastel.pdf");
        }




}
?>