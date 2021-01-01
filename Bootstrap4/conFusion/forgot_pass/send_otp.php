<?php
session_start();
$con=mysqli_connect('localhost','root','','kmanagement');


$email=$_POST['email'];
$res=mysqli_query($con,"select * from users where user_mail='$email'");
$count=mysqli_num_rows($res);

if($count>0){
	$otp=rand(11111,99999);
	mysqli_query($con,"update users set otp='$otp' where user_mail='$email'");
	$html="We have recived a request to reset password for your account. \n Your Otp is ".$otp;
	$_SESSION['EMAIL']=$email;
	smtp_mailer($email,'Reset Password',$html);
	echo "yes";
}else{
	echo "not_exist";
}

function smtp_mailer($to,$subject, $msg){
	require_once("smtp/class.phpmailer.php");
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPDebug = 1; 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'TLS'; 
	$mail->Host = "smtp.sendgrid.net";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->Username = "rahul.yd149@gmail.com";
	$mail->Password = "Rahulyadav@12345";
	$mail->SetFrom("rahul.yd149@gmail.com");
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	if(!$mail->s
	end()){
		return 0;
	}else{
		return 1;
	}
}
?>