<?php include '../header.php';?>
<?php include '../../../mongo/db-init.php';?>
<?php include '../../../mongo/functions.php';?>
<div data-role="page" data-theme="b">
<body>

<div data-role="header" data-theme="b" id="navtop">
    <h1>Admin Panel</h1>
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

<h1>User Management</h1>
<?php
echo "<p>I Am Now A Mobile Developer!!</p>";

$kayttajat = findAll($collection);

echo "<table border=1><tr>";
echo "<td>Email</td>";
echo "<td>ID</td>";
//echo "<td>Password</td>";
echo "<td>Delete User</td>";
echo "</tr>";
foreach ($kayttajat as $document) {
  echo "<tr>";
  $email = $document['email'];
  echo "<td><a href=''>$email</a></td>";
  $id = $document['_id'];
  echo "<td>$id</td>";
  $password = $document['password'];
  //echo "<td>$password</td>";
  echo "<td><a href='deleteUser.php?email=$email'><button>&#9785;</button></a></td>";  
  echo "</tr>";
}
echo "</table>";

?>
</div>
</div>
</body>