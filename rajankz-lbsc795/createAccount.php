<?php
	include('config.inc');
	
	//if post from this page, then create account and redirect to updates page
	if(isset($_POST['emailId']) && isset($_POST['username']) && isset($_POST['password']))
	{
		$username = $_POST['username'];
		$fName=$_POST['firstName'];
		$lName=$_POST['lastName'];
		$emailId=$_POST['emailId'];
		$univEmailExt=$_POST['univEmailExt'];
		$password_md5=md5($_POST['password']);
		$createUserAccountSql = "insert into users(username, fName, lName, password_md5) values('$username', '$fName', '$lName', '$password_md5')";
		$createUnivAccountSql = "insert into univUser(username, univEmailExt, userEmail) values('$username', '$univEmailExt', '$emailId')";
		$setUserActiveSql = "update registration set status='a' where emailId='$emailId'";
		
		//echo $createUserAccountSql;
		//echo "<br />";
		//echo $createUnivAccountSql;
		$result1 = mysql_query($createUserAccountSql) or die(mysql_error());
		$result2 = mysql_query($createUnivAccountSql) or die(mysql_error());
		$result3 = mysql_query($setUserActiveSql) or die(mysql_error());
		
		if(!$result1 || !$result2 || !$result3)
		{
			$message = "Unable to create an account at this time! Please try later.";
			die($message);
			header('Location:http://localhost/~aast/lbsc795/index.php');
		}	
		
		header('Location:http://localhost/~aast/lbsc795/updates.php');
	}
	
$emailId = $_GET['emailId'];
$confirmCode=$_GET['confirmCode'];

 $findEmailSql = "select emailId, confirm_code, univEmailExt, status from registration where emailId='".$emailId."' and confirm_code='".$confirmCode."'";
 $result=mysql_query($findEmailSql) or die(mysql_error());
 
 if(mysql_num_rows($result) == 0){
 	$message = 'Invalid Email-Id or Confirm Code';
 	die($message);
 	exit;
 }
 
 $row = mysql_fetch_assoc($result);
 $status=$row['status'];
 $univEmailExt=$row['univEmailExt'];
 
  if($status == 'a'){
 	$_SESSION['status']="error";
 	$_SESSION['message']="This email-id is already activated. Click here if you need assistance with account recovery.";
 	header('Location: http://localhost/~aast/lbsc795');
 }
 
 if($status == 'p'){
 	$_SESSION['status']="success";
 	?>
 	<form action="createAccount.php" name="createAcount" method="post">
		<table>
			<tr>
				<tr><td class="right-align">Email: </td><td><?=$emailId?></td></tr>
				<tr><td class="right-align">First Name: </td><td><input class="bigText" name="firstName" type="text" value="" /></td></tr>
				<tr><td class="right-align">Last Name: </td><td><input class="bigText" name="lastName" type="text" value="" /></td></tr>
				<tr><td class="right-align">Username: </td><td><input class="bigText" name="username" type="text" value="" /></td></tr>
				<tr><td class="right-align">Password: </td><td><input class="bigText" name="password" type="password" value="" /></td></tr>
				<tr><td class="right-align">Retype Password: </td><td><input class="bigText" name="retype-password" type="password" value="" /></td></tr>
			</tr>
		</table>
		<input type="hidden" name="univEmailExt" value=<?=$univEmailExt ?> /> 
		<input type="hidden" name="emailId" value=<?=$emailId?> /> 
		<input type="submit" value="Create Account" name="submit" /> 
	</form>
<?php	
 }
?>