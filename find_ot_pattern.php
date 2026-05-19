<?php
$c = new PDO('mysql:host=localhost;dbname=traceflow_ot', 'root', '');
$res = $c->query('SELECT ot_numero FROM ordenes_trabajo WHERE ot_numero LIKE "%20038405%"')->fetchAll(PDO::FETCH_ASSOC);
print_r($res);
