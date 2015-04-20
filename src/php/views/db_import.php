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
<form action="db_import.php" method="post" enctype="multipart/form-data">
  <input type="file" name="backuppi">
  <input type="submit" value="Submit" name="backupped">
</form>
<?php
if(isset($_POST['backupped'])) {
  $newfilename = "backup.zip";
  $datapath   = "/tmp/";
  
  $newfile = $datapath . $newfilename;
  echo $newfile;
  
  $uploadedfile = $_FILES['backuppi']['name'];
  echo $uploadedfile . "Jee";
  
  
  if (move_uploaded_file($_FILES['backuppi']['tmp_name'], $newfile)) {
      
    } else {
      print "Tiedoston kopioiminen epäonnistui, Muuta informaatiota:\n";
      print_r($_FILES);
    }
  
  $undumper = new MongoDumper($newfilename);
  //$undumper->run(true); // Switch to true for debug info
}
?>
 
</div>
</div>
</body>

<?php /*
if ($_FILES['filetto']['name'] != "") {  
    $n2 = $n + 1;
    $filu = fopen("n.txt", "w") or die("Unable to open file!");
    fwrite($filu, $n2);
    fclose($filu);
    //echo $n2;
  
    $uploadedfile = $_FILES['filetto']['name'];
    
    $ext = pathinfo($uploadedfile, PATHINFO_EXTENSION);
    
    $newfile = $datadir . $n . "." . $ext;
    
    print "<pre>";
    if (move_uploaded_file($_FILES['filetto']['tmp_name'], $newfile)) {
      
      echo "Kopioitiin tiedosto: {$_FILES['filetto']['name']}\n";
      echo "nimelle: $uploadfile\n\n";
      echo "Tiedosto näkyy Web-hakemistossa: ";
      echo "<a href=\"$urldir\">$urldir</a><br>\n";
      print "Muuta informaatiota:\n";
      
      
    } else {
      print "Tiedoston kopioiminen epäonnistui, Muuta informaatiota:\n";
      print_r($_FILES);
    }
    print "</pre>";
    
    $sqlpath = $urlpath . $datapath . $n. "." . $ext;
  } else {
    $sqlpath = "";
  }
  
    // Kohdehakemistojen määrittelyt
  $serverpath = dirname($_SERVER['SCRIPT_FILENAME']);
  $urlpath    = dirname($_SERVER['SCRIPT_NAME']);
  $datapath   = "/kuvat/";
  $datadir    = "$serverpath" . "$datapath";
  $urldir     =  "$urlpath" . "$datapath";

  /*
  // Demonstraationa näkyviin:
  echo "serverpath: $serverpath <br>";
  echo "urlpath: $urlpath <br>";
  echo "datapath: $datapath <br>";
  echo "datadir: $datadir <br>";
  echo "urldir: $urldir <br>";
  
  
  $header = $_POST['header'];
  $content = $_POST['content'];
  $uid = $_SESSION['uid'];
  
  $n = file("n.txt")[0];
  //echo $n;
  
  if ($_FILES['filetto']['name'] != "") {  
    $n2 = $n + 1;
    $filu = fopen("n.txt", "w") or die("Unable to open file!");
    fwrite($filu, $n2);
    fclose($filu);
    //echo $n2;
  
    $uploadedfile = $_FILES['filetto']['name'];
    
    $ext = pathinfo($uploadedfile, PATHINFO_EXTENSION);
    
    $newfile = $datadir . $n . "." . $ext;
    
      */ ?>