<?php
session_start();
include('config.inc');

//user is trying to register
if ($_POST['process'] == 'signUp') {
	if($_POST['email'] == ''){
		//TODO:
		//create error message
		//redirect to index page
	}else{
		$_SESSION['email'] = $_POST['email'];
	}
		
	//check if email belongs to correct university
	if($_POST['university']!="null"){
		$_SESSION['university'] = $_POST['university'];
		$subject = $_POST['email'];
		$pattern = '/'.$_POST['university'].'$/';
		//echo $subject; echo $pattern;
		if(!preg_match($pattern, $subject, $matches)){
		//echo "2";
			//fail
			$_SESSION['status']="error";
			$_SESSION['message']="The email id does not match the university selected, the email should end in ".$_POST['university'];
			header('Location: http://localhost/~aast/lbsc795');
			exit();
		}
	}
	//echo "3";
	//exit;
	
	//check if exists
	$checkSql = "select 1 from registration where emailId = '".$_POST['email']."'";
	$result = mysql_query($checkSql) or die(mysql_error());
	if($result){
		$_SESSION['status']="error";
		$_SESSION['message']="The email-id is already registered.";
		header('Location: http://localhost/~aast/lbsc795');
	}

		
	$confirmCode =  md5(uniqid(rand()));
	$registerSql = "INSERT INTO registration(`emailId`,`confirm_code`,`status`) values('".$_POST['email']."','". $confirmCode ."','p')";
	
	//insert the record
	$insert=mysql_query($registerSql) or die(mysql_error());
	
	//if inserted, send email
	if($insert)	{
		require("lib-external/PHPMailer-Lite_v5.1/class.phpmailer-lite.php");
		
		$mail = new PHPMailerLite();
		//$mail->IsSMTP();
		$mail->Host = 'ssl://smtp.gmail.com:465';
		$mail->SMTPAuth = true;
		$mail->Username = "connection.campus@gmail.com";
		$mail->Password="Windows8";
		$mail->SetLanguage("en","phpmailer/language");
		
		$mail->From="connection.campus@gmail.com";
		$mail->FromName="Do Not Reply";
		$mail->AddAddress($_POST['email']);
		$mail->AddBcc("connection.campus@gmail.com");
		$mail->AddReplyTo("connection.campus@gmail.com", "Campus Connection Admin");
		$mail->Subject="Campus Connecton Confirmation Link";
		$mail->Body="Please click on the following link to activate your account.\r\n";
		$mail->Body .= "http://localhost/~aast/lbsc795/register.php?emailId=".$_POST['email']."&confirmCode=". $confirmCode;
		
		//send mail
		if(!$mail->Send()){
			echo "Unable to send the email";
			echo "Error : " . $mail->ErrorInfo;
			exit;
		}
		//echo "Message has been sent";
		
		$_SESSION['status']="success";
		$_SESSION['message']="An email has been sent to the id with activation link.";
		//header('Location: http://localhost/~aast/lbsc795');
		
	}

 } 
 // user is trying to activate
 else{
	$emailId=$_GET['emailId'];
	$confirmCode=$_GET['confirmCode'];
	header('Location: http://localhost/~aast/lbsc795/createAccount.php?emailId='.$emailId."&confirmCode=".$confirmCode);
}

?>