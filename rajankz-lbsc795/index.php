<?php
	session_start();
	// Check, if user is already login, then jump to secured page
	if (isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['authenticated']=="true")
	{
		header('Location: updates.php');
	}
?>
<html>
<head>
<title>Campus Connection</title>
<link rel="stylesheet" href="style.css" />
<link rel="stylesheet" href="css/custom-theme/jquery-ui-1.8.16.custom.css" />
<script src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="favicon.ico" />
</head>
<body>
	<div id="content">
		<div><?php include('index-header.php') ?></div><br />
		<div id="body"><?php include('index-body.php') ?></div>
		<div><?php include('footer.php') ?></div>
	</div>
</body>
</html>