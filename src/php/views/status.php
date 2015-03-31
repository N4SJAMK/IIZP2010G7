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
//echo "<p>I Am Now A Mobile Developer!!</p>";

$kayttajat = findAll($users);

echo "<div id='statusUsers'> <img src='../../profile-icon.png' height='100' width='100'/>";
	echo "<h3>Registered users: </h3>";
	$usersLaskuri = 0;
	foreach ($kayttajat as $document) {
	$usersLaskuri++;
	}
	echo "$usersLaskuri<br>\n";
echo "</div>";
$kayttajat = NULL;

echo "<div id='statusUsers'> <img src='../../board.png' height='100' width='100'/>";
	echo "<h3>Created boards: </h3>";
	$taulut = findAll($boards);
	$boardsLaskuri = 0;
	foreach ($taulut as $document) {
	$boardsLaskuri++;
	}
	echo "$boardsLaskuri<br>\n";
echo "</div>";
$taulut = NULL;

echo "<div id='statusUsers'> <img src='../../profile-icon.png' height='100' width='100'/><img src='../../board.png' height='100' width='100'/>";
	echo "<h3>Average boards / user: </h3>";
	$avg = $boardsLaskuri / $usersLaskuri;
	$avground = round($avg,2);
	echo "$avground<br>\n";
echo "</div>";

echo "<div id='statusUsers'> <img src='../../board.png' height='100' width='100'/>";
    echo "<h3>Created tickets: </h3>";
    $tiketit = findAll($tickets);
    $ticketsLaskuri = 0;
    foreach ($tiketit as $document) {
    $ticketsLaskuri++;
    }
    echo "$ticketsLaskuri<br>\n";
echo "</div>";
$tiketit = NULL;

echo "<div id='statusUsers'> <img src='../../board.png' height='100' width='100'/><img src='../../board.png' height='100' width='100'/>";
	echo "<h3>Average tickets / board: </h3>";
	$avg2 = $ticketsLaskuri / $boardsLaskuri;
	$avground2 = round($avg2,2);
	echo "$avground2<br>\n";
echo "</div>";

?>
</div>
</div>
</body>
