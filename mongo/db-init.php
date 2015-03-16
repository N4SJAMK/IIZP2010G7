<?php

//Connecting to _LOCAL_ database
$connection = new Mongo();
//echo "Connection success!<br>";

//Selecting database
$dbname = $connection->selectDB('teamboard-dev');
//echo "DB select success!<br>";

//Selecting collection
$collection = $dbname->selectCollection('users');
//echo "Collection select success!<br>";

?>