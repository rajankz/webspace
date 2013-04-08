<?php
$dbHostname = 'localhost';        // Your MySQL hostname. Usualy named as 'localhost', so you're NOT necessary to change this even this script has already online on the internet.
$dbname   = 'campuscon'; // Your database name.
$dbUser = 'root';             // Your database username.
$dbPassword = '';                 // Your database password. If your database has no password, leave it empty.

// Let's connect to host
 mysql_connect($dbHostname, $dbUser, $dbPassword) or DIE('Connection to host is failed, perhaps the service is down!');
 // Select the database
 mysql_select_db($dbname) or DIE('Database name is not available!');

?>