<?php
try {
    $c = new PDO('mysql:host=localhost', 'root', '');
    echo 'Conexión exitosa';
} catch (Exception $e) {
    echo $e->getMessage();
}
