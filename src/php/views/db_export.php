<?php include '../header.php';?>
<?php include '../../../mongo/db-init.php';?>
<?php include '../../../mongo/functions.php';?>
<?php include '../../../mongo/mongodumper.php';?>

<div data-role="page">
<body>

<div data-role="header" id="navtop">
    <h1>Admin Panel</h1>
  <a href="logout.php" class="ui-btn ui-btn-inline ui-mini ui-corner-all ui-btn-icon-right ui-icon-action">Logout</a>
    <b><label data-inline="true" style="position: absolute;
  top: .24em; right: .28em;" >Choose theme: 
    <a href="#" data-role="button" data-inline="true" data-theme="a" onclick="$.mobile.changeGlobalTheme('a');">Theme a</a>
    <a href="#" data-role="button" data-inline="true" data-theme="b" onclick="$.mobile.changeGlobalTheme('b');">Theme b</a>
    <label></b>
	 <div data-role="navbar" data-grid="c">
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
<h3>Data Export Details</h3>
<?php
    //
    // If you are using windows, change $windows to TRUE.
    // In mac and linux, keep FALSE;
    //

    $windows = TRUE;

	date_default_timezone_set('Europe/Riga');
	$crtdate = date('d.m.Y H:i:s');
	
    if ($windows == TRUE) {
      $dir = "/var/www/html/db-backups/"; //Windows
      $dumpfolder = "/var/www/html/db-backups"; //Windows
      $dumpspace = "";
    } else {
      $dir = "/tmp/"; //Linux / Mac
      $dumpfolder = "/tmp"; //Linux / Mac
      $dumpspace = "/";
    }
	
echo"
        <ul data-role='listview' id='activitiy-fields' data-inset='true'  style='width: 400px;'>
          <li>Mongo database: <b>$dbname</b></li>
          <li>Export file destination: <b>$dumpfolder</b></li>
		  <li>File Type: <b>.Zip</b></li>
		  <li>Date&Time: <b>$crtdate</b></li>
		  <li>Last Backup:";if (file_exists($dir)){ echo date("<b> d.m.Y H:i:s</b>", filectime($dir));} else {echo "<b> Never</b>";}echo"</li>
        </ul>
		<form method='POST' action=''>
		<input value='Export' type='submit' name='Export'  data-inline='true' >
		<a href='databaseManagement.php'  data-inline='true' data-role='button'>Cancel</a>
		</form>";
		
echo "<div class='aside'>";	
if (isset($_POST['Export'])) {
  $dumper = new MongoDumper("$dumpfolder");
  $dumper->run("teamboard-dev", false); // Switch to true for debug info
	if ($dumper==true){
		echo "<p style='color: #228B22;font-size: 16px;padding-bottom: 8px;'>Exported successfully</p>";
		header('refresh: 5; url=db_export.php');
  }
  else {
	  echo "<p style='color: #B22222;font-size: 16px;padding-bottom: 8px;'>Export did not complete..</p>";
  }
  Header('Refresh:5; url=db_export.php');
}
echo "</div>";
  $fiilut = array();

  $handle = opendir($dir);

  while($file = readdir($handle)) {
      if (is_file($dir.$file)) {
			$fiilut[] = $file;
		}
	}
if ($fiilut == true){
	echo"
	 <table data-role='table' id='table' data-filter='true' data-input='#filterTable-input' class='ui-responsive'>
	<thead>
	<tr>
		<th data-priority='1'>ID</th>
		<th data-priority='2'>Filename</th>
		<th data-priority='3'>Download</th>
		<th data-priority='3'>Delete</th>
	</tr>
</thead>
<hr>";
  
}
if ($windows == TRUE) {
  define( 'SCRIPT_ROOT', 'http://localhost:9003/db-backups/'); //Windows
} else {
  define( 'SCRIPT_ROOT', $dumpfolder); //Mac / Linux
}

$i=0;
  foreach($fiilut as $filu) {
	  $i++;
	  echo"
	 
<tbody>
<td>$i</td>
<td>$filu</td>
<td><a href='".SCRIPT_ROOT.$dumpspace.$filu."' target='download_frame'>Download File</a>
			<iframe id='download_frame'style='display:none;'></iframe></td> 
<td><a href='deletebkup.php?file=$dumpfolder/$filu'><button data-icon='delete' data-iconpos='notext' style='margin-left:15px; bottom:10px;'>Delete</button></a></td>
</tbody>";

  }
?>
 
</div>
</div>

<script>
$.mobile.changeGlobalTheme = function(theme)
{
    // These themes will be cleared, add more
    // swatch letters as needed.
    var themes = " a b";

    // Updates the theme for all elements that match the
    // CSS selector with the specified theme class.
    function setTheme(cssSelector, themeClass, theme)
    {
        $(cssSelector)
            .removeClass(themes.split(" ").join(" " + themeClass + "-"))
            .addClass(themeClass + "-" + theme)
            .attr("data-theme", theme);
    }

    // Add more selectors/theme classes as needed.
    setTheme(".ui-mobile-viewport", "ui-overlay", theme);
    setTheme("[data-role='page']", "ui-body", theme);
    setTheme("[data-role='main']", "ui-body", theme);
    setTheme("[data-role='header']", "ui-bar", theme);
    setTheme("[data-role='listview'] > li", "ui-bar", theme);
    setTheme(".ui-btn", "ui-btn-up", theme);
    setTheme(".ui-btn", "ui-btn-hover", theme);
};
</script>
</body>