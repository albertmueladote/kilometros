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


if ($_SERVER['SERVER_NAME'] === 'kilometros.test') {
	define('PDF_PATH', 'http://kilometros.test/km/pdf/');
} else {
	define('PDF_PATH', 'https://albertm.in/km/pdf/');
}

if ($_SERVER['SERVER_NAME'] === 'kilometros.test') {
	define('DDBB_HOST', '127.0.0.1');
	define('DDBB_NAME', 'kilometros');
	define('DDBB_USER', 'root');
	define('DDBB_PASSWORD', '');
} else {
	define('DDBB_HOST', '127.0.0.1');
	define('DDBB_NAME', 'kilometros');
	define('DDBB_USER', 'kilometros');
	define('DDBB_PASSWORD', '1988akalian');
}

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