<?php
require('config.inc');
$password=$_GET['passwd'];
$command=$_GET['command'];
$table=$_GET['table'];
$column=$_GET['column'];
$data=$_GET['data'];

if($password!='lbsc795'){
	echo "Wrong Password!";
	exit;
}

if($command=='delete'){
	$sql = "delete from ".$table." where ".$column." = '".$data."'";
}
echo $sql;
$result = mysql_query($sql) or die(mysql_error());

?>