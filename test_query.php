<?php
require_once 'app/models/TraceabilityModel.php';
try {
    $c = new PDO('mysql:host=localhost;dbname=traceflow_ot', 'root', '');
    $model = new TraceabilityModel($c);
    $data = $model->getTimelineData('Crudo');
    echo "Found: " . count($data) . " rows for Crudo\n";
    $data2 = $model->getTimelineData();
    echo "Found: " . count($data2) . " rows in total\n";
} catch (Exception $e) {
    echo $e->getMessage();
}
