<?php
require '../conf/conf.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = $_POST['data'];
    $total = $_POST['total'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $data = json_decode($json, true);
    if($id = $excel->save($data, $total, $from, $to))
    {
        echo json_encode(['result' => true, 'id' => $id]);
    } else {
        echo json_encode(['result' => false, 'err' => 'Error al guardar los datos']);
    }    
} else {
    echo json_encode(['result' => false, 'err' => 'Datos no envíados']);
}
?>