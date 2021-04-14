<?php 
	session_start();
    include('./includes/class-autoload.inc.php');
    include('encrypt.php');
    $member = new Member();

    	$username = $_POST['username'];
    	$password = $_POST['password'];
    	$detail_member = $member->checkUsername($username);
      if ($detail_member) {

          		$password_hash = $detail_member['password'];
          		
      			   $service = new BlowfishService();

      			   if ($service->check($password, $password_hash)) {
                      $_SESSION['Login_Password'] = true;
      				    $_SESSION['id_member'] = $detail_member['id'];
          			
                      // if (isset($_POST['admin'])) {
                      //     $_SESSION['admin'] = true;
                      // }
                      $data['status'] = true;
                      $data['message'] = 'Login Successfully !';      				
      				 }
      			    else{
      			      $data['status'] = false;
                  $data['message'] = 'Username and Password are false !';
      			         }
			}else{
        $data['status'] = false;
        $data['message'] = 'Username not exist !';
        // $data['message'] = var_dump($detail_member);
      }

      echo json_encode($data);

    	