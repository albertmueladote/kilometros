<?php

function env($param)
{
	if (file_exists('../.env')) {
		$envPath = '../.env';
	} else {
		if (file_exists('../../.env')) {
			$envPath = '../../.env';
		} else {
			throw new Exception(".env file not found.");
		}
	}

	$env = [];
	$lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach ($lines as $line) {
	    if (strpos(trim($line), '#') === 0) {
	        continue;
	    }
	    list($key, $value) = explode('=', $line, 2);
	    if($param == trim($key)) {
	    	return trim($value);
	    }
	}
	return false;
}

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
	define('DDBB_HOST', env('local_db_host'));
	define('DDBB_NAME', env('local_db_name'));
	define('DDBB_USER', env('local_db_username'));
	define('DDBB_PASSWORD', env('local_db_password'));
} else {
	define('DDBB_HOST', env('server_db_host'));
	define('DDBB_NAME', env('server_db_name'));
	define('DDBB_USER', env('server_db_username'));
	define('DDBB_PASSWORD', env('server_db_password'));
}

define('COOKIE', env('cookie'));

define('USERNAME', env('username'));
define('PASSWORD', env('password'));

require VENDOR . 'autoload.php';

require _CLASS . 'classDDBB.php';
require _CLASS . 'classExcel.php';
require _CLASS . 'classCookie.php';
require _CLASS . 'classHour.php';

$ddbb = new DDBB();
$excel = new Excel();
$cookie = new Cookie();
$hour = new Hour();
