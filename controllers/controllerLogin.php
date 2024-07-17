<?php
include('../conf/conf.php');
if ($cookie->exists()) {
    header("Location: /");
}
include('../views/viewLogin.php')
?>