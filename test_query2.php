<?php
try {
    $c = new PDO('mysql:host=localhost;dbname=traceflow_ot', 'root', '');
    $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT m.codigo_material, m.descripcion_material, ot.ot_numero, ot.proceso, 
                         ot.fecha_creacion as ot_creacion, ot.fecha_liberacion_ot,
                         sp.sp_numero, sp.fecha_creacion_sp, sp.fecha_liberacion_sp,
                         oc.oc_numero, oc.fecha_creacion_oc, oc.fecha_liberacion_oc, oc.fecha_entrega_material,
                         m.estado_abastecimiento
                  FROM materiales m
                  JOIN ordenes_trabajo ot ON m.ot_id = ot.id
                  LEFT JOIN solicitudes_pedido sp ON m.sp_id = sp.id
                  LEFT JOIN ordenes_compra oc ON m.oc_id = oc.id";

    $stmt = $c->query($query);
    $data = $stmt->fetchAll();
    echo count($data);
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
