<?php
include('../conf/conf.php');
if (!$cookie->exists()) {
    header("Location: /login");
}
include(VIEWS . 'viewForm.php');
?>