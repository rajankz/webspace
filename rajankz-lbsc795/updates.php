<?php
	session_start();
	// Check, if user is already login, then jump to secured page
	if (isset($_SESSION['username']))// && isset($_SESSION['password']) && $_SESSION['authenticated']=="true")
	{
		//ok
	}
	else
	{
		header('Location: index.php');
	}
?>
<html>
<head>
<title>Campus Connection</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="js/common.js" ></script>
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/custom-theme/jquery-ui-1.8.16.custom.css" />
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="favicon.ico" />

<script>
	$(function() {
		$( "#postsFilter" ).buttonset();
		
	});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
		var newHeight = $('#mainContent').css('height');
		$('#groupsAndFriends').css('height', newHeight);
   	});
	</script>

</head>
<body>
	<div id="content">
		<?php include('header.php') ?>
		<?php include('updates-body.php') ?>
		<?php include('footer.php') ?>
		<div class="clearfix"></div>
	</div>
</body>
</html>