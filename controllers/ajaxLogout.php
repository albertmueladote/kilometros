<?php
require '../conf/conf.php';
if (!$cookie->exists()) {
    die();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($cookie->delete()) {
        echo json_encode(['result' => true]);
    } else {
        echo json_encode(['result' => false, 'err' => 'Error al eliminar la cookie']);
    }
} else {
    echo json_encode(['result' => false, 'err' => 'Datos no recibidos']);
}
?>