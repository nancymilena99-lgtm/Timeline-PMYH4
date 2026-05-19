<?php
try {
    $c = new PDO('mysql:host=localhost;dbname=traceflow_ot', 'root', '');
    $stmt = $c->query("SELECT DISTINCT proceso FROM ordenes_trabajo");
    while($row = $stmt->fetch()) {
        echo "'" . $row['proceso'] . "'\n";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
