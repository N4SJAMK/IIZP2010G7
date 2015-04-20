<?php include '../header.php';?>
<?php include '../../../mongo/db-init.php';?>
<?php include '../../../mongo/functions.php';?>
<?php include '../../../mongo/mongoundumper.php';?>

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
<h3>Pick exported zip file to import</h3>

<?php
if(isset($_POST['backupped'])) {
  echo $_POST['teksti'];
  echo $_FILES['filetto'];
  if (isset($_FILES['filetto']['name'])) {
    $newfilename = "backup.zip";
    $datapath   = "/tmp/";
  
    $newfile = $datapath . $newfilename;
    echo $newfile;
  
    $uploadedfile = $_FILES['filetto']['name'];
    echo $uploadedfile . "Jee";
  
  
    if (move_uploaded_file($_FILES['filetto']['tmp_name'], $newfile)) {
        
      } else {
        print "Tiedoston kopioiminen epäonnistui, Muuta informaatiota:\n";
        print_r($_FILES);
      }
  
    $undumper = new MongoDumper($newfilename);
    //$undumper->run(true); // Switch to true for debug info
  } else {
    echo "variable files not set!";
  }
}
?>
  
  <form enctype="multipart/form-data" action="<?php echo ($_SERVER['PHP_SELF'])?>" method="POST">
    <input name="filetto" type="file"><br>
    <input type="text" name="teksti"><br>
    <input type="submit" value="Submit" name="backupped">
  </form>
  
</div>
</div>
</body>