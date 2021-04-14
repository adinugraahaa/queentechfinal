<?php 

session_start();
	include('./includes/class-autoload.inc.php');
	$members = new Member();
	$email = $_POST['email'];
	$data = '';

	
	if ($members->getMemberLogin($email)) {
		$data .= 'OTP code has been send';
	}else{
		$data .= 'Email not exist';
	}

	echo $data;


