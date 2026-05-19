<?php
try {
    $c = new PDO('mysql:host=localhost;dbname=traceflow_ot', 'root', '');
    $query = "SELECT COUNT(*) FROM materiales m
              JOIN ordenes_trabajo ot ON m.ot_id = ot.id";
    $res = $c->query($query)->fetchColumn();
    echo "Join 1: " . $res . "\n";
} catch (Exception $e) {
    echo $e->getMessage();
}
