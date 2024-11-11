<?php
include('../conf/conf.php');
if (!$cookie->exists()) {
    header("Location: /login");
}
$list = $excel->getAll();
include('../views/viewList.php')
?>