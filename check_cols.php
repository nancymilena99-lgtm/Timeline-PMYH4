<?php
try {
    $c = new PDO('mysql:host=localhost;dbname=traceflow_ot', 'root', '');
    echo "--- ordenes_trabajo ---\n";
    $stmt = $c->query("DESC ordenes_trabajo");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['Field'] . "\n";
    }
    echo "\n--- materiales ---\n";
    $stmt = $c->query("DESC materiales");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo $row['Field'] . "\n";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
