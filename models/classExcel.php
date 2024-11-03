<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Dompdf\Dompdf;
use Dompdf\Options;

class Excel extends DDBB{
    CONST PATH = KM . 'template.xlsx';
    CONST EXCEL_PATH = KM_EXCEL;
    CONST PDF_PATH = KM_PDF;
    CONST ROOT = ROOT;

    protected $table = 'kilometros';
    
    public function __construct() {
        parent::__construct();
    }

    public function read($file) 
    {
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($file);
        $currentSheet = $spreadsheet->getActiveSheet();
        $data = array();
        $data['rows'] = array();
        for ($row = 15; $row <= 50; $row++) {
            $aux = array();
            $aux['day'] = $currentSheet->getCell('A' . $row)->getValue();
            $aux['long'] = $currentSheet->getCell('B' . $row)->getValue();
            $aux['distance'] = $currentSheet->getCell('D' . $row)->getValue();
            if(!is_null($aux['day']) && !is_null($aux['long']) && !is_null($aux['distance'])) {
                array_push($data['rows'], $aux); 
            }
        }
        $data['total'] = $currentSheet->getCell('D51')->getValue();
        return $data;
    }

    public function save($data, $total, $from, $to)
    {
		$spreadsheet = IOFactory::load($this::PATH);
		$sheet = $spreadsheet->getSheet(0);
		$lastRow = $sheet->getHighestRow();
		$currentRow = 15;
        $from = strtotime($from); 
        $to = strtotime($to);
		foreach ($data as $fila) {
		    $sheet->setCellValue('A' . $currentRow, $fila['date']);
		    $sheet->setCellValue('B' . $currentRow, $fila['long']);
		    $sheet->setCellValue('D' . $currentRow, $fila['distance']);

		    $currentRow++;
		}

        $sheet->setCellValue('D51', $total);

		$filename = $this->getFileName($from, $to);

		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save(self::EXCEL_PATH . $filename['excel']);

        return $this->insert(['name' => $filename['name'], 'excel_path' => self::EXCEL_PATH . $filename['excel'], 'pdf_path' => self::PDF_PATH . $filename['pdf'], 'from_date' => $from, 'to_date' => $to]);
    }

    public function getFileName($from, $to)
    {
        $currentMonth = $this->getMonth(date('n', $from));
        $lastMonth = $this->getMonth(date('n', $to));

        $currentYear = date('Y');


        $name = "KM {$lastMonth} {$currentMonth} {$currentYear}";
        if(file_exists(KM_EXCEL . $name . '.xlsx'))
        {
            $cont = 2;
            while(file_exists(KM_EXCEL . $name . '-' . $cont . '.xlsx')) {
                $cont++;
            }
            $name = $name . '-' . $cont;
        }

        $result = array();
        $result['name'] = $name;
        $result['excel'] = $name . ".xlsx";
        $result['pdf'] = $name . ".pdf";

        return $result;
    }

    public function getMonth($month)
    {
        $months = [1 => 'ENERO', 2 => 'FEBRERO', 3 => 'MARZO', 4 => 'ABRIL', 5 => 'MAYO', 6 => 'JUNIO', 7 => 'JULIO', 8 => 'AGOSTO', 9 => 'SEPTIEMBRE', 10 => 'OCTUBRE', 11 => 'NOVIEMBRE', 12 =>'DICIEMBRE'];

        return isset($months[$month]) ? $months[$month] : '';
    }

    public function exportToPdf($html, $filename)
    {
       try {
			$dompdf = new Dompdf();
			$dompdf->loadHtml($html);

			$dompdf->render();

            $output = $dompdf->output();

            $filePath = self::PDF_PATH . $filename . '.pdf';

			file_put_contents($filePath, $output);

            return true;
        } catch (Exception $e) {
            die('Error al exportar a PDF: ' . $e->getMessage());
        }
    }

    public function remove($id)
    {
        if($file = $this->getById($id)){
            if($this->remove($id))
            {
                if (file_exists($file['excel_path'])) {
                    unlink($file['excel_path']);
                    if (file_exists($file['pdf_path'])) {
                        unlink($file['pdf_path']);
                        return true;
                    }
                }
            }
        }
        return false;
    }

    public function getById($id)
    {
        return parent::getById($id);
    }

    public function __get($atributo) {
        if (property_exists($this, $atributo)) {
            return $this->$atributo;
        } else {
            return null;
        }
    }
}

?>
