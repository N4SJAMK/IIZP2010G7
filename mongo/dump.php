<?php
include("mongodumper.php");

//$dumper = new MongoDumper("/var/www/html/mongo");

$dumper = new MongoDumper("/tmp");
$dumper->run("teamboard-dev", true); // 'true' shows debug info
?>