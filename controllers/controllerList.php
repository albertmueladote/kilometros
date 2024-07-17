<?php
include('../conf/conf.php');
if (!$cookie->exists()) {
    header("Location: /login");
}
$list = $ddbb->getAll();
include('../views/viewList.php')
?>