<?php
$c = new PDO('mysql:host=localhost;dbname=traceflow_ot', 'root', '');
$res = $c->query('SELECT fecha_creacion_ot, fecha_liberacion_ot FROM ordenes_trabajo WHERE ot_numero = "10022017"')->fetch(PDO::FETCH_ASSOC);
print_r($res);
