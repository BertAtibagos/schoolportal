<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

try {
    if(isset($_POST["file_content"])){
        $temporary_html_file = 'tmp_html/' . time() . '.html';

        file_put_contents($temporary_html_file, $_POST["file_content"]);

        $reader = IOFactory::createReader('Html');

        $spreadsheet = $reader->load($temporary_html_file);

        // Get the active sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Freeze the first 2 rows
        $sheet->freezePane('A3');

        // Add styling to the columns (adjust as needed)
        $HeaderStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => '000000'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '8DB4E2'], // Light gray fill color
            ],
        ];

        $CenterBodyStyle = [
            'font' => [
                'color' => ['rgb' => '000000'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $BorderBodyStyle = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];
        
        // Get the number of rows
        $highestRow = $sheet->getHighestRow();

        // Define the range for the styling and formatting (from column E to Z, starting from row 3)
        $stylingRange = 'E3:Z' . $highestRow;

        // Apply styling to columns A to Z (adjust as needed)
        $sheet->getStyle('A1:I2')->applyFromArray($HeaderStyle);
        $sheet->getStyle('C3:I' . $highestRow)->applyFromArray($CenterBodyStyle);
        $sheet->getStyle('A3:I' . $highestRow)->applyFromArray($BorderBodyStyle);
        
        // Set the number format to percentage for the specified range (row 1)
        $sheet->getStyle('F3:F' . $highestRow)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);
        $sheet->getStyle('I3:I' . $highestRow)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE);

        // Save the modified spreadsheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'CAREER_INTEREST_SURVEY_REPORT(' . date("m-d-Y") . ').xlsx';
        $writer->save($filename);

        // Set headers for file download
        header('Content-Type: application/x-www-form-urlencoded');
        header('Content-Transfer-Encoding: Binary');
        header("Content-disposition: attachment; filename=\"".$filename."\"");

        // Output the file
        readfile($filename);

        // Delete temporary files
        unlink($temporary_html_file);
        unlink($filename);

        exit;
    } else {
        echo 'FILE_CONTENT POST NOT SET.';
    }
} catch (Exception $e) {
    echo 'Caught exception: ', $e->getMessage(), "\n";
}
?>
