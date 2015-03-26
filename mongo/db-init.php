<?php

//Connecting to _LOCAL_ database
$connection = new Mongo();
//echo "Connection success!<br>";

//Selecting database
$dbname = $connection->selectDB('teamboard-dev');
//echo "DB select success!<br>";

//Selecting collection
$users = $dbname->selectCollection('users');
//echo "Collection select success!<br>";

//Selecting collection
$boards = $dbname->selectCollection('boards');
//echo "Collection select success!<br>";


//Selecting collection
$admins = $dbname->selectCollection('admins');
//echo "Collection select success!<br>";

//Selecting collection
$tickets = $dbname->selectCollection('tickets');
//echo "Collection select success!<br>";

?>