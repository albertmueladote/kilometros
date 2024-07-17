<?php
require '../conf/conf.php';
if (!$cookie->exists()) {
    die();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'];
    $password = $_POST['password'];
    
    if($user == USERNAME && $password == PASSWORD)
    {
        if($cookie->create()) {
            echo json_encode(['result' => true]);
        } else {
            echo json_encode(['result' => false, 'err' => 'Error al crear la cookie']);
        }
    } else {
        echo json_encode(['result' => false, 'err' => 'Error al hacer login']);
    }
} else {
    echo json_encode(['result' => false, 'err' => 'Datos no recibidos']);
}
?>