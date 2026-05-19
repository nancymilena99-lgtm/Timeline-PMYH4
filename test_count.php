<?php
try {
    $c = new PDO('mysql:host=localhost;dbname=traceflow_ot', 'root', '');
    $res = $c->query("SELECT COUNT(*) FROM materiales")->fetchColumn();
    echo "Materiales: " . $res . "\n";
    $res2 = $c->query("SELECT COUNT(*) FROM ordenes_trabajo")->fetchColumn();
    echo "OTs: " . $res2 . "\n";
} catch (Exception $e) {
    echo $e->getMessage();
}
