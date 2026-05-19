<?php
// Verificar que getTimelineData retorna materiales Sin OC
require_once 'config/database.php';
require_once 'app/models/TraceabilityModel.php';

$dbObj = new Database();
$conn = $dbObj->getConnection();
$model = new TraceabilityModel($conn);

$timeline = $model->getTimelineData();

$totalMat = 0;
$sinOcMat = 0;
$conOcMat = 0;

foreach($timeline as $ot => $data) {
    foreach($data['materiales'] as $m) {
        $totalMat++;
        if(empty($m['oc_numero'])) {
            $sinOcMat++;
            if($sinOcMat <= 5) {
                echo "Sin OC: OT={$data['ot_numero']} | mat={$m['codigo_material']} | estado={$m['estado_abastecimiento']}\n";
            }
        } else {
            $conOcMat++;
        }
    }
}

echo "\n=== RESUMEN ===\n";
echo "Total materiales en timeline: $totalMat\n";
echo "Con OC: $conOcMat\n";
echo "Sin OC (oc_numero vacío): $sinOcMat\n";
echo "Total OTs: " . count($timeline) . "\n";
