<?php
try {
    $c = new PDO('mysql:host=localhost;dbname=traceflow_ot', 'root', '');
    
    echo "--- OT Data ---\n";
    $stmt = $c->query("SELECT ot_numero, fecha_creacion_ot FROM ordenes_trabajo LIMIT 5");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "OT: {$row['ot_numero']} | Creada: " . ($row['fecha_creacion_ot'] ?? 'NULL') . "\n";
    }

    echo "\n--- Material Data ---\n";
    $stmt = $c->query("SELECT codigo_material, cantidad_requerida, stock_almacen FROM materiales LIMIT 5");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Mat: {$row['codigo_material']} | Req: {$row['cantidad_requerida']} | Stock: {$row['stock_almacen']}\n";
    }

    echo "\n--- Totals ---\n";
    echo "Total OTs with date: " . $c->query("SELECT COUNT(*) FROM ordenes_trabajo WHERE fecha_creacion_ot IS NOT NULL")->fetchColumn() . "\n";
    echo "Total Materials with stock: " . $c->query("SELECT COUNT(*) FROM materiales WHERE stock_almacen > 0")->fetchColumn() . "\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
