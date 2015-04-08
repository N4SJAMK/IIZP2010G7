<head>
<link rel="stylesheet" type="text/css" href="../../css/mystyle.css">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>

<?php
session_start();

if (!isset($_SESSION['loggedIn']) || ($_SESSION['loggedIn'] == false)) {
  header ('Location: login.php');
}

?>