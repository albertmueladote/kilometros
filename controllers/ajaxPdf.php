<?php
require '../conf/conf.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $html = $_POST['html'];
    $id = $_POST['id'];
    $file = $ddbb->getById($id);
    if($result = $excel->exportToPdf($html, $file["name"]))
    {
        echo json_encode(['result' => true, 'path' => PDF_PATH . $file['name'] . '.pdf']);
    } else {
        echo json_encode(['result' => false, 'err' => 'Error al generar el pdf']);
    }
} else {
    echo json_encode(['result' => false, 'err' => 'Datos no recibidos']);
}
?>