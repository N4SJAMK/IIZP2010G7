<?php include '../../../mongo/db-init.php';?>
<?php include '../../../mongo/functions.php';?>
<head>
<link rel="stylesheet" type="text/css" href="../../css/mystyle.css">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>  
</head>




<div data-role="page" data-theme="b">
<body>

<div data-role="header" data-theme="b" id="navtop">
    <h1>Admin Panel</h1>
</div>

<div id="container" data-role="main" class="ui-content">
<h1 style="text-align: center;">Login</h1>

  <form method='POST' action='login.php'>
    <div class ="loginform" style="text-align: center; max-width: 400px; margin-left: auto; margin-right: auto;">
      <input name="email" id="textinput-fc" type="text" value="" placeholder="Email" required>
      <input name="password" id="textinput-fc" type="password" value="" placeholder="Password" required>
      <input type="submit" value="Ok" name="submit">
    </div>
  </form>

<?php
session_start();

if (isset($_POST['submit'])) {
  $admins = findAll($admins);
  foreach ($admins as $admin) {
    if ($_POST['email'] == $admin['email'] && $_POST['password'] == $admin['password']) {
        $_SESSION['loggedIn'] = true;
		$_SESSION['email'] = $admin['email'];
        header('Location: status.php');
    }
	else {
		  echo "<p style='color: #B22222;font-size: 20px;border-bottom: 1px solid #FFF;padding-bottom: 8px;'>Invalid username or password!</p>";
		  header("Refresh: 5; url=userManagement.php");
	  }
  }
  
}
?>
</div>
</div>
</body>

