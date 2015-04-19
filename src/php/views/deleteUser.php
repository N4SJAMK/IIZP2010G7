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
        <li><a href="status.php">Status</a></li>
        <li><a href="userManagement.php" class="ui-btn-active">User Management</a></li>
        <li><a href="databaseManagement.php">Database Management</a></li>
        <li><a href="adminSettings.php">Admin Settings</a></li>
    </ul>
</div><!-- /navbar -->
</div>

<div id="container" data-role="main" class="ui-content">

<!-- <h1>User Management</h1> -->
<?php
//echo "<p>I Am Now A Mobile Developer!!</p>";

if(isset($_POST['email'])) {
  deleteUser($users,$_POST['email'],$boards,$tickets);
  header ('Location: userManagement.php');
}

$email = $_GET['email'];

echo "<h2 style='text-align: center;'>Are you sure you want to delete user $email ?</h2>\n";
//echo "<a href=''><button>Yes</button></a>";
echo "<form method='POST' action='deleteUser.php'>";
echo "<input type=submit value='Yes'>";
echo "<input type=hidden name='email' value='$email'> </form>";
//echo "<button onclick='deleteUser($users,$email);'>\nYes</button>\n";
echo "<a href='userManagement.php' style='text-decoration: none;'><button>No</button></a>";
//
?>
</div>
</div>
</body>