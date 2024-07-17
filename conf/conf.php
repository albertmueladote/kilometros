<?php
date_default_timezone_set('Europe/Madrid');

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('_CLASS', $_SERVER['DOCUMENT_ROOT'] . '/class/');
define('CONTROLLERS', $_SERVER['DOCUMENT_ROOT'] . '/controllers/');
define('CSS', $_SERVER['DOCUMENT_ROOT'] . '/css/');
define('IMAGES', $_SERVER['DOCUMENT_ROOT'] . '/images/');
define('JS', $_SERVER['DOCUMENT_ROOT'] . '/js/');
define('KM', $_SERVER['DOCUMENT_ROOT'] . '/km/');
define('KM_EXCEL', $_SERVER['DOCUMENT_ROOT'] . '/km/excel/');
define('KM_PDF', $_SERVER['DOCUMENT_ROOT'] . '/km/pdf/');
define('VENDOR', $_SERVER['DOCUMENT_ROOT'] . '/vendor/');
define('VIEWS', $_SERVER['DOCUMENT_ROOT'] . '/views/');

define('PDF_PATH', 'http://kilometros.test/km/pdf/');

define('DDBB_HOST', '127.0.0.1');
define('DDBB_NAME', 'kilometros');
define('DDBB_USER', 'root');
define('DDBB_PASSWORD', '');

define('COOKIE', 'kilometroshqyx5Z8VD1NGNmmbgRie7T3xwfz0hi');

define('USERNAME', 'dolores');
define('PASSWORD', 'dolores');

require VENDOR . 'autoload.php';

require _CLASS . 'classDDBB.php';
require _CLASS . 'classExcel.php';
require _CLASS . 'classCookie.php';

$ddbb = new DDBB();
$excel = new Excel();
$cookie = new Cookie();

if ($_SERVER['REQUEST_URI'] == '/login') {
    if ($cookie->exists()) {
        header("Location: /");
    }
}else {
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
		if ($_SERVER['REQUEST_URI'] !== '/login' && empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
		    if (!$cookie->exists()) {
		        header("Location: /login");
		    }
		}
	} else {
		if ($_SERVER['REQUEST_URI'] !== '/login') {
		    if (!$cookie->exists()) {
		        header("Location: /login");
		    }
		}
	}
}