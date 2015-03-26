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

<h1>User Management</h1>
<form>
    <input id="filterTable-input" data-type="search">
</form>
<?php
//echo "<p>I Am Now A Mobile Developer!!</p>";

$kayttajat = findAll($users);
$taulut = findAll($boards);

?>
<table data-role="table" id="movie-table" data-filter="true" data-input="#filterTable-input" class="ui-responsive">
<thead>
	<tr>
		<th data-priority="1">Email</th>
		<th data-priority="2">ID</th>
		<th data-priority="3">Boards</th>
		<th data-priority="4">Delete User</th>
	</tr>
</thead>
<tbody>
<?php
foreach ($kayttajat as $document) {
  echo "<tr>";
	$email = $document['email'];
		echo "<td><a href=''>$email</a></td>";
	$id = $document['_id'];
		echo "<td>$id</td>";
	$password = $document['password'];
	//echo "<td>$password</td>";
		
	
	echo "<td>";
		$laskuri = 0;
		foreach ($taulut as $document) {
			if ($id == $document['createdBy']) {
			$laskuri++; 
			}
		}
		echo "$laskuri";
	echo "</td>";
  echo "<td><a href='deleteUser.php?email=$email'><button data-icon='delete' data-iconpos='notext' style='margin-left:30px;'></button></a></td>";
 
  echo "</tr>";
}
echo "</tbody>";
echo "</table>";

?>
</div>
</div>
</body>