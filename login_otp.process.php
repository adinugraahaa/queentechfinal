<?php 
session_start();
include('./includes/class-autoload.inc.php');
require './vendor/autoload.php';
require_once('mail.php');

if (isset($_POST{'sendOTP'})) {
	
	$ga = new PHPGangsta_GoogleAuthenticator();
	$secret = $ga->createSecret();
	$oneCode = $ga->getCode($secret);
	$members = new Member();
	$id_member = $_SESSION['id_member'];
	$member = $members->getProfile($id_member);
	$email_member = $member['email'];
	sendEmail($email_member, $oneCode);
	$_SESSION['timestamp'] = time();

	echo $oneCode;
}

if (isset($_POST['otp1'])) {
	
$inputCode = '';

for ($i=1; $i < 7; $i++) { 
	$inputCode .= $_POST['digit-' . $i];
}

$secretCode = $_POST['otp1'];

if (time() - $_SESSION['timestamp'] > 300) {
	$inputCode = uniqid();
}

if ($inputCode == $secretCode) {
    $_SESSION['Login_Verified'] = true;
	$data["status"] = true;
	$data["message"] = 'OTP login successfully !';
}
else{

	$data["status"] = false;
	$data["message"] = 'Login OTP failed';
}
echo json_encode($data);
}