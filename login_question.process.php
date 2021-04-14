<?php 

session_start();
    include('./includes/class-autoload.inc.php');
    include('encrypt.php');

    $service = new BlowfishService();
    $members = new Member();

    // if (isset($_POST['submit'])) {
    	$id_member = $_SESSION['id_member'];
    	$answear1 = $_POST['inputAnswear1'];
    	$answear2 = $_POST['inputAnswear2'];
        $member = $members->getProfile($id_member);

    	$questions = new Questions();

    	$question = $questions->getQuestionLogin($id_member);

        $hashQuestion1 = $question[0]['deskripsi_jawaban'];
        $hashQuestion2 = $question[1]['deskripsi_jawaban'];


            if ($service->check($answear1, $hashQuestion1) && $service->check($answear2, $hashQuestion2)) {
                    $_SESSION['Login_Verified'] = true;
                // $_SESSION['timestamp'] = time(); //set new timestamp
        		// if ($_SESSION['admin'] == true) {
          //           header("location: admin_dashboard.php");
          //           }else{
        			// header("location: index.php");
                    if ($member['admin'] == "1") {
                        $data['status'] = "admin";
                        $data['message'] = 'Login admin Successfully !';
                        
                    }else{

                        $data['status'] = true;
                        $data['message'] = 'Login Question Successfully !';
                    }
                }
    	else{
            $data['status'] = false;
            $data['message'] = 'Your answear not right !';

    	}
        echo json_encode($data);
