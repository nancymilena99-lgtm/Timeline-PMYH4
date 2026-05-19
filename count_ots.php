<?php
$c = new PDO('mysql:host=localhost;dbname=traceflow_ot', 'root', '');
$res = $c->query('SELECT ot_numero FROM ordenes_trabajo')->fetchAll(PDO::FETCH_COLUMN);
echo "Total OTs in DB: " . count($res) . "\n";
echo "OTs: " . implode(", ", $res) . "\n";
