<?php
$dbHostname = 'localhost';
$dbname   = 'gened';
$dbUser = 'root';
$dbPassword = '';

mysql_connect($dbHostname, $dbUser, $dbPassword) or DIE('Unable to connect to database. Please try again later.');
mysql_select_db($dbname) or DIE('Database name is not available!');

?>