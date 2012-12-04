<head>
	<title>iSeries Website</title>
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/style.css" rel="stylesheet" media="screen">   
	<script src="js/jquery-1.8.3.min.js"></script>
	<script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/functions.js"></script>
</head>
<body>
	<?php include('config.inc'); ?>
	<div class="container-fluid">
	<div class="row-fluid">
		<div class="span2">
			<!--Sidebar content-->
			<?php include('navmenu.php'); ?>
		</div>
		<div class="span8">
		<!--Body content-->
		<?php
		if($_SESSION['msg']){
			$msgClass = $_SESSION['msg_type'];
			echo "<div class=".$msgClass.">";
			echo $_SESSION['msg'];
			echo "</div>";
			unset($_SESSION['msg']);			
		}
		
		?>