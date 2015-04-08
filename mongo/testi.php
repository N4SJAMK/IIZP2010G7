<?php
//DB connect etc.etc.
include("db-init.php");
//Functions
include("functions.php");



$result = findAll($users);
//echo "Function returned!<br>Result:<br>";
foreach ($result as $document) {
  echo $document["_id"] . "\n <br>";
  echo $document["email"] . "\n <br>";
  echo $document["password"] . "\n <br>";
  echo $document["__v"] . "\n <br>";
  echo $document["token"] . "\n <br><br><br>";
}
echo "<br><br><br>";


//insert($collection,"Tapsa@testaaja","eihashattusalasana");

//insert($admins,"Admin@admin2.com","sala");
//update($users,"ali_aldool@yahoo.com","ali_aldool@yahoo.com",'ali123456')

?>