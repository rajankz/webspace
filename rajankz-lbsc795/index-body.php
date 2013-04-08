<?php
if (isset($_SESSION['ip_address']) && $_SERVER['REMOTE_ADDR']!=$_SESSION['ip_address']) {
    // Check failed: we'll start a brand new session
    session_regenerate_id(FALSE);
    session_unset();
    session_start();
}
// First time here
if( !isset($_SESSION['ip_address']) ){
    $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['start_date'] = new DateTime;
}
include('config.inc');
$email = $_SESSION['email']==''?"\"\"":$_SESSION['email'];
?>
<div id="index-body">
	<form name="signUp" action="register.php" method="post">
		<table id="sign-up">
			<tr><td class="right-align">First Name: </td><td><input class="bigText" name="first-name" type="text" value="" /></td></tr>
			<tr><td class="right-align">Last Name: </td><td><input class="bigText" name="last-name" type="text" value="" /></td></tr>
			<tr><td class="right-align">University: </td><td>
			<select name='university' class="bigText">
				<?php
					$selectAllUnivsSql = "select univName, univEmailExt from universities where deleted='n' order by univId";
					$result = mysql_query($selectAllUnivsSql);
					if(!$result){
						$message = 'Database Not Ready. Error Details: Invalid Query: '.$selectAllUnivsSql;
						die($message);
					}
					while($row = mysql_fetch_assoc($result)){
						?>
						<option value=<?=$row['univEmailExt']?> 
						<?php
							if($_SESSION['university'] == $row['univEmailExt'])
							{
								echo "selected = 'true'";
							}
						?>
						><?=$row['univName']?></option>
						<?php
					}
					mysql_free_result($result);
				?>
			</select></td></tr>
			<tr><td class="right-align">Email: </td><td><input class="bigText" name="email" type="text" value=<?=$email?> /></td></tr>
			<tr><td></td><td><input class="bigButton" type="submit" value="Sign Up" name="signup" id="signup" /></td></tr>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
			<tr><td></td><td>
			<?php
				if($_SESSION['status']=='error' || $_SESSION['status']=='success'){
					echo '<div id="statusMessage">';
					echo $_SESSION['message'];
					echo '</div>';
				}
				unset($_SESSION['status']);
			?>
			</div></td></tr>
		</table>
		<input type="hidden" name="process" value="signUp" />
	</form>
</div>