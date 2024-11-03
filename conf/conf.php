<?php
date_default_timezone_set('Europe/Madrid');

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('_CLASS', $_SERVER['DOCUMENT_ROOT'] . '/models/');
define('CONTROLLERS', $_SERVER['DOCUMENT_ROOT'] . '/controllers/');
define('CSS', $_SERVER['DOCUMENT_ROOT'] . '/public/css/');
define('IMAGES', $_SERVER['DOCUMENT_ROOT'] . '/public/images/');
define('JS', $_SERVER['DOCUMENT_ROOT'] . '/public/js/');
define('KM', $_SERVER['DOCUMENT_ROOT'] . '/public/km/');
define('KM_EXCEL', $_SERVER['DOCUMENT_ROOT'] . '/public/km/excel/');
define('KM_PDF', $_SERVER['DOCUMENT_ROOT'] . '/public/km/pdf/');
define('VENDOR', $_SERVER['DOCUMENT_ROOT'] . '/vendor/');
define('VIEWS', $_SERVER['DOCUMENT_ROOT'] . '/views/');
define('PARTIALS', $_SERVER['DOCUMENT_ROOT'] . '/views/partials/');


if ($_SERVER['SERVER_NAME'] === 'kilometros.test') {
	define('PDF_PATH', 'http://kilometros.test/public/km/pdf/');
} else {
	define('PDF_PATH', 'https://albertm.in/public/km/pdf/');
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
require _CLASS . 'classHour.php';

$ddbb = new DDBB();
$excel = new Excel();
$cookie = new Cookie();
$hour = new Hour();