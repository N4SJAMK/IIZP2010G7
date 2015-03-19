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
        <li><a href="status.php" class="ui-btn-active">Status</a></li>
        <li><a href="userManagement.php">User Management</a></li>
        <li><a href="databaseManagement.php">Database Management</a></li>
        <li><a href="adminSettings.php">Admin Settings</a></li>
    </ul>
</div><!-- /navbar -->
</div>

<div id="container" data-role="main" class="ui-content">

<h1>Status</h1>
<?php
echo "<p>I Am Now A Mobile Developer!!</p>";

$kayttajat = findAll($collection);

foreach ($kayttajat as $document) {
  $email = $document['email'];
  echo "Email: $email<br>";
  $id = $document['_id'];
  echo "ID: $id<br>";
  $password = $document['password'];
  echo "Hashed password: $password<br><br>";
}

?>
</div>
</div>
</body>