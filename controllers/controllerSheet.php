<?php
	require '../conf/conf.php';
	if(isset($_GET['id']))
	{
		$file = $ddbb->getById($_GET['id']);
		$data = $excel->read($file['excel_path']);
		$from_month = $excel->getMonth(date('n', $file['from_date']));
		$from_day = date('j', $file['from_date']);
		$to_month = $excel->getMonth(date('n', $file['to_date']));
		$to_day = date('j', $file['to_date']);
		$year = date('Y', $file['to_date']);
		include('../views/viewSheet.php');
	} else {
		echo "Error al cargar el pdf";
	}
?>