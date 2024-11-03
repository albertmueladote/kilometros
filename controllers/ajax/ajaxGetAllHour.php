<?php
require '../../conf/conf.php';
if (!$cookie->exists()) {
    die();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($hours = $hour->getAll())
    {
        echo json_encode(['result' => true, 'hours' => $hours]);
    } else {
        echo json_encode(['result' => false, 'err' => 'Error al extraer las horas']);
    } 
} else {
    echo json_encode(['result' => false, 'err' => 'Datos no envíados']);
}
?>