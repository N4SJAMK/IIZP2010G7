<?php 
	$filename = $_GET['file'];
	unlink($filename); 
	header('location: db_export.php');
?>