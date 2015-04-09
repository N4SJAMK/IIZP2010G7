<?php include '../header.php';?>
<?php include '../../../mongo/db-init.php';?>
<?php include '../../../mongo/functions.php';?>
<div data-role="page" data-theme="b">
<body>

<div data-role="header" data-theme="b" id="navtop">
    <h1>Admin Panel</h1>
  <a href="logout.php" class="ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-action">Logout</a>
	 <a href="options.php" class="ui-btn-right ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-gear">Options</a>
	 <div data-role="navbar" data-grid="c" data-theme="b">
    <ul>
        <li><a href="status.php" >Status</a></li>
        <li><a href="userManagement.php" >User Management</a></li>
        <li><a href="databaseManagement.php">Database Management</a></li>
        <li><a href="adminSettings.php" class="ui-btn-active">Admin Settings</a></li>
    </ul>
</div><!-- /navbar -->
</div>

<div id="container" data-role="main" class="ui-content">

<h1>Admin Settings</h1>
<?php
if (isset($_POST['emailNEW']) && isset($_POST['passwordNEW']) && isset($_POST['passwordNEW2'])) {
  if ($_POST['passwordNEW'] == $_POST['passwordNEW2']) {
    insert($admins,$_POST['emailNEW'],$_POST['passwordNEW']);
    echo "User added!";
  } else {
    echo "<h2>Passwords did not match!</h2>";
    echo "<form method='POST' action='adminSettings.php'>";
    echo "Email: <input type='text' name='emailNEW'>";
    echo "Password: <input type='password' name='passwordNEW'>";
    echo "Retype password: <input type='password' name='passwordNEW2'>";
    echo "<input type='submit' value='Create'>";
    echo "</form>";
  }
} else {
  echo "<h2>Create new account</h2>";
  echo "<form method='POST' action='adminSettings.php'>";
  echo "Email: <input type='text' name='emailNEW'>";
  echo "Password: <input type='password' name='passwordNEW'>";
  echo "Retype password: <input type='password' name='passwordNEW2'>";
  echo "<input type='submit' value='Create'>";
  echo "</form>";
}

if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['emailOLD'])) {
  update($admins,$_POST['emailOLD'],$_POST['email'],$_POST['password']);
  echo "User updaed!";
} else {
  echo "<h2>Change accounts</h2>";
  foreach (findAll($admins) as $adminit) {
    echo "<form method='POST' action=''>";
    $email = $adminit['email'];
    echo "Email: <input type='text' name='email' value='$email'>";
    echo "Password: <input type='password' name='password'>";
    echo "<input type='hidden' name='emailOLD' value='$email'>";
    echo "<input type='submit' value='Change'>";
    echo "</form>";
  } 
}



 echo "";
?>
</div>
</div>
</body>