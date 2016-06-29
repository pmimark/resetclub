<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'dbo630488467');
define('DB_PASSWORD', '8message'); 
define('DB_DATABASE', 'db630488467');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die(mysql_error());
$database = mysql_select_db(DB_DATABASE) or die(mysql_error());
?>
