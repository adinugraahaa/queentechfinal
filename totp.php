<?php 
session_start();
require_once('./templates/header.php');

require 'vendor/otphp/otphp.php';

if (isset($_SESSION['class'])) {
	

	if (isset($_POST['submit'])) {
		$otp = $_POST['otp'];
		$totp2 = $_SESSION['class'];
		if ($totp2->verify($otp)) {
			echo 'berhasil';
		}else{
			echo 'gagal';
		}
		unset($_SESSION['class']);
	}
}else
{
	$totp = new \OTPHP\TOTP("base32secret3232");
	$secret = $totp->now();
	$_SESSION['class'] = $totp;
}
var_dump($_SESSION);
?>

<main class="main">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-5">
				<form action="" method="POST">
					<label for=""><?= $secret; ?></label>

					<input type="text" name="otp">

					<button class="btn btn-primary" type="submit" name="submit">Submit</button>
				</form>
			</div>
		</div>
	</div>
</main>

<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js
"></script>
    <script>
    	$(function(){
    	
    	})
    </script>
    
  </body>
</html>



