<?php 

session_start();
    include('./includes/class-autoload.inc.php');
// var_dump($_POST['email']); die;

    if (isset($_POST['submit'])) {
    	
    	$nama_member = $_POST['nama'];
    	$alamat_member = $_POST['alamat'];
    	$email_member = $_POST['email'];
    	$telp_member = $_POST['telp'];

    	$id_member = $_SESSION['id_member'];

    	$member = new Member();

    	$member->updateMember($nama_member, $alamat_member, $email_member, $telp_member, $id_member);
    			header("location: profile.php");
    }else{
    	echo "FAILED";
    }

  ?>