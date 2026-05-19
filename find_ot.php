<?php
$c = new PDO('mysql:host=localhost;dbname=traceflow_ot', 'root', '');
$res = $c->query('SELECT * FROM ordenes_trabajo WHERE ot_numero = "20038405"')->fetch(PDO::FETCH_ASSOC);
if($res) {
    print_r($res);
} else {
    echo "OT not found.\n";
}
