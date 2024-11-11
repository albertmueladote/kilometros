<?php
require '../../conf/conf.php';
if (!$cookie->exists()) {
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($id = $excel->delete($_POST['id']))
    {
        echo json_encode(['result' => true, 'id' => $id]);
    } else { 
        echo json_encode(['result' => false, 'err' => 'Error al eliminar fichero']);
    }
} else {
    echo json_encode(['result' => false, 'err' => 'Datos no envíados']);
}
?>