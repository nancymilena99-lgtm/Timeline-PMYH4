<?php
$c = new PDO('mysql:host=localhost;dbname=traceflow_ot', 'root', '');
$res = $c->query('SELECT ot_numero, fecha_creacion_ot, fecha_creacion FROM ordenes_trabajo LIMIT 10')->fetchAll(PDO::FETCH_ASSOC);
foreach($res as $row) {
    echo "OT: {$row['ot_numero']} | OT_Creada_Col: " . ($row['fecha_creacion_ot'] ?? 'NULL') . " | System_Creacion: {$row['fecha_creacion']}\n";
}
