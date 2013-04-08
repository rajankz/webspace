<html>
<head><title>XML to CSV</title></head>
<body>
<p>Convert XML files to php.</p>
<form action="xml2php.php">
<p>Enter XML folder path
<input type="text" value="../data/2012" name="path" />
</p>
<input type="submit" value="show me" />
</form>


<?php if(isset($_POST){ 
//path to directory to scan
$directory = $_POST['path'];
 
//get all xml files
$allXML = glob($directory . "*.xml");
 
//print each file name
foreach($allXML as $oneXML)
{
echo $oneXML;
}


}
?>


</body>
</html>