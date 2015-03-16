<?php
//DB connect etc.etc.
include("db-init.php");
//Functions
include("functions.php");



$result = findAll($collection);
//echo "Function returned!<br>Result:<br>";
foreach ($result as $document) {
  echo $document["_id"] . "\n <br>";
  echo $document["email"] . "\n <br>";
  echo $document["password"] . "\n <br>";
  echo $document["token"] . "\n <br><br><br>";
}
echo "<br><br><br>";




$se = "Testi@testi.fi";
$result = find($collection, $se);
//echo "Function returned!<br>";
foreach ($result as $document) {
  echo $document["email"] . "\n <br>";
}
//echo "after<br>";

$se = "Testi2@testi.fi";
$result = find($collection, $se);
//echo "Function returned!<br>";
foreach ($result as $document) {
  echo $document["email"] . "\n <br>";
}
//echo "after";




$email = "eemai1212adli@testi.fi";
$password = "asddsdsaasd";

insert($collection,$email,$password);

$email2 = "asdasd@dsadsa.fi";
$password2 = "salaslalslals";

update($collection,$email,password,$email2,password2);

?>