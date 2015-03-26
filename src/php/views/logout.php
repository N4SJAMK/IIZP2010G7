<?php
session_start();

if (isset($_SESSION['loggedIn'])) {
  $_SESSION['loggedIn'] = false;
  unset($_SESSION['loggedIn']);
  
  header('Location: login.php');
} else {
  header('Location: login.php');
}
    
?>