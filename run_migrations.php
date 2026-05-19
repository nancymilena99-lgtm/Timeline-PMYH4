<?php
try {
    $c = new PDO('mysql:host=localhost;dbname=traceflow_ot', 'root', '');
    $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Añadiendo columnas...\n";
    
    try {
        $c->exec("ALTER TABLE ordenes_trabajo ADD COLUMN fecha_creacion_ot DATE AFTER fecha_liberacion_ot");
        echo "Columna fecha_creacion_ot añadida.\n";
    } catch(Exception $e) { echo "fecha_creacion_ot ya existe o error: " . $e->getMessage() . "\n"; }

    try {
        $c->exec("ALTER TABLE materiales ADD COLUMN cantidad_requerida DECIMAL(10,2) DEFAULT 0 AFTER fecha_entrega_material");
        echo "Columna cantidad_requerida añadida.\n";
    } catch(Exception $e) { echo "cantidad_requerida ya existe o error: " . $e->getMessage() . "\n"; }

    try {
        $c->exec("ALTER TABLE materiales ADD COLUMN stock_almacen DECIMAL(10,2) DEFAULT 0 AFTER cantidad_requerida");
        echo "Columna stock_almacen añadida.\n";
    } catch(Exception $e) { echo "stock_almacen ya existe o error: " . $e->getMessage() . "\n"; }

    echo "Migración finalizada.\n";

} catch (Exception $e) {
    echo "Error general: " . $e->getMessage();
}
