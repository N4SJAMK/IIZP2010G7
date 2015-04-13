<?php include '../header.php';?>
<?php include '../../../mongo/db-init.php';?>
<?php include '../../../mongo/functions.php';?>
<?php include '../../../mongo/mongodumper.php';?>
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
        <li><a href="databaseManagement.php" class="ui-btn-active">Database Management</a></li>
        <li><a href="adminSettings.php">Admin Settings</a></li>
    </ul>
</div><!-- /navbar -->
</div>

<div id="container" data-role="main" class="ui-content">

<h1>Database Management</h1>
<?php
if (isset($_POST['do'])) {
  $dumpfolder = "/tmp";
  $dumper = new MongoDumper("$dumpfolder");
  
  $dumper->run("teamboard-dev", false);
  // Switch to true for debug info
  
  echo "<h2>Dumped to $dumpfolder !</h2>";
}

//echo "<p>I Am Now A Mobile Developer!!</p>";

  //$dir = dirname($_SERVER['SCRIPT_FILENAME'])."/";
  $dir = "/tmp/";
  
  $fiilut = array();

  $handle = opendir($dir);

  while($file = readdir($handle)) {
      if (is_file($dir.$file)) {
			$fiilut[] = $file;
            //echo "$file";
		}	
	}

rsort($fiilut);

  foreach($fiilut as $filu) {
	echo "<div style='padding: 5px'>";
	echo "<a href='/mongo/tmp/$filu'>$filu</a>";
	echo "</div>";

}

?>
  
  <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
    <input type="hidden" name="do">
    <input type="submit" value="Backup to /tmp">
  </form>
  
</div>
</div>
</body>