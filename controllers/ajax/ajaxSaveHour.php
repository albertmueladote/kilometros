<?php
require '../../conf/conf.php';
if (!$cookie->exists()) {
    die();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $hours = $_POST['hours'];

    if($id = $hour->save($hours, $date))
    {
        echo json_encode(['result' => true, 'id' => $id]);
    } else {
        echo json_encode(['result' => false, 'err' => 'Error al guardar los datos']);
    } 
} else {
    echo json_encode(['result' => false, 'err' => 'Datos no envíados']);
}
?>