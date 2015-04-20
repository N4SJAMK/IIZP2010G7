<?php
$asd = <<<ASD
<!DOCTYPE html>
<head>
  <title>Tallenna tiedosto Webiin</title>
</head>
<body>
  <h2>Tallenna tiedosto Webiin</h2>
</body>
</html>
ASD;
echo $asd;
// upskripti-v2.php

// Kohdehakemistojen määrittelyt
$serverpath = dirname($_SERVER['SCRIPT_FILENAME']);
$urlpath    = dirname($_SERVER['SCRIPT_NAME']);
$datapath   = "/data/";
$datadir    = "$serverpath" . "$datapath";
$urldir     =  "$urlpath" . "$datapath";

// Demonstraationa näkyviin:
echo "serverpath: $serverpath <br>";
echo "urlpath: $urlpath <br>";
echo "datapath: $datapath <br>";
echo "datadir: $datadir <br>";
echo "urldir: $urldir <br>";

// Pääohjelma
if (isset($_FILES['filetto']['tmp_name'])) {
   tallenna($datadir, $urldir);
} else {
   lomake();
}

// Tiedoston lähetyslomake
function lomake()
{
   ?>
   <form enctype="multipart/form-data" action="<?php echo ($_SERVER['PHP_SELF'])?>" method="post">
   Tallennettava tiedosto:<br>
   <input name="filetto" type="file"><br>
   <input type="submit" value="Tallenna">
   </form>
   <?php
}

// Funktio tiedoston tallentamiseen
function tallenna($datadir, $webdir)
{ 
  $uploadfile = $datadir . $_FILES['filetto']['name'];
  print "<pre>";
  if (move_uploaded_file($_FILES['filetto']['tmp_name'], $uploadfile)) {
    echo "Kopioitiin tiedosto: {$_FILES['filetto']['name']}\n";
    echo "nimelle: $uploadfile\n\n";
    echo "Tiedosto näkyy Web-hakemistossa: ";
    echo "<a href=\"$webdir\">$webdir</a><br>\n";
    print "Muuta informaatiota:\n";
  } else {
    print "Tiedoston kopioiminen epäonnistui, Muuta informaatiota:\n";
  }
  print_r($_FILES);
  print "</pre>";
}

?>