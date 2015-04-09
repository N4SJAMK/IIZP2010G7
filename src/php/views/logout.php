<?php
session_start();

	if (isset($_SESSION['loggedIn'])) {
		$_SESSION['loggedIn'] = false;
	
		header('Location: login.php');
		
		unset($_SESSION['loggedIn']);
		unset($_SESSION['email']);
		
	} 
	else {
		header('Location: login.php');
	}
    
?>