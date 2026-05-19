<?php
require_once 'vendor/autoload.php';
require_once 'config/database.php';
require_once 'app/models/TraceabilityModel.php';

try {
    ini_set('memory_limit', '-1');
    
    echo "--- Database Clean and Import CLI ---\n";
    
    $db = (new Database())->getConnection();
    if(!$db) {
        throw new Exception("No DB connection.");
    }
    
    $model = new TraceabilityModel($db);
    
    // Clear data from database
    $conn = $db;
    
    echo "Clearing old tables...\n";
    $conn->exec("SET FOREIGN_KEY_CHECKS = 0");
    $conn->exec("TRUNCATE TABLE materiales");
    $conn->exec("TRUNCATE TABLE ordenes_compra");
    $conn->exec("TRUNCATE TABLE solicitudes_pedido");
    $conn->exec("TRUNCATE TABLE ordenes_trabajo");
    $conn->exec("SET FOREIGN_KEY_CHECKS = 1");
    echo "Tables cleared successfully.\n";
    
    // Load Excel file
    $file = 'uploads/Ots_Carbon_PMY_H4.xlsx';
    echo "Loading Excel file: $file...\n";
    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file);
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($file);
    
    $worksheet = $spreadsheet->getSheetByName('Carbon2');
    if (!$worksheet) {
        $worksheet = $spreadsheet->getSheetByName('Carbón');
    }
    if (!$worksheet) {
        $worksheet = $spreadsheet->getActiveSheet();
    }
    
    echo "Using sheet: " . $worksheet->getTitle() . "\n";
    $highestRow = $worksheet->getHighestDataRow();
    $highestColumn = 'X';
    
    $firstCell = $worksheet->getCell('A1')->getCalculatedValue();
    $startRow = is_numeric($firstCell) ? 1 : 2;
    
    echo "Importing rows...\n";
    
    $model->beginTransaction();
    $imported_count = 0;
    
    for ($row = $startRow; $row <= $highestRow; $row++) {
        $otVal = $worksheet->getCell('A' . $row)->getCalculatedValue();
        if (empty($otVal)) {
            continue;
        }
        
        $rowData = [];
        foreach(range('A', $highestColumn) as $col) {
            $cell = $worksheet->getCell($col . $row);
            $rowData[$col] = $cell->getCalculatedValue();
        }
        
        $model->procesarFilaExcel($rowData);
        $imported_count++;
    }
    
    $model->commit();
    
    echo "Successfully imported $imported_count rows!\n";
    
    // Let's print the actual DB counts
    $kpis = $model->getDashboardKPIs();
    echo "\n--- Database KPIs ---\n";
    echo "Total Materials: " . $kpis['total_materiales'] . "\n";
    echo "Disponible: " . $kpis['disponibles'] . "\n";
    echo "En Tránsito: " . $kpis['en_transito'] . "\n";
    echo "Sin OC: " . $kpis['sin_oc'] . "\n";
    echo "Total OTs: " . $kpis['total_ots'] . "\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    if (isset($model)) {
        $model->rollBack();
    }
}
