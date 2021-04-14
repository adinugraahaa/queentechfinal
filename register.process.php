<?php 

    include('./includes/class-autoload.inc.php');
    include('encrypt.php');
date_default_timezone_set('Asia/Jakarta');

    $member = new Member();
    $login_question = new Login_Question();
    $answear = new Answear();
    $cart = new Cart();
    
    $service = new BlowfishService();
    // $data = "";

    if(isset($_POST['nama'])){
    	$username = $_POST['username'];
    	$password = $_POST['password'];
    	$nama = $_POST['nama'];
    	$email = $_POST['email'];
    	$question1 = $_POST['question1'];
    	$question2 = $_POST['question2'];
    	$questionInput1 = $_POST['questionInput1'];
    	$questionInput2 = $_POST['questionInput2'];
        $checkUsername = $member->checkUsername($username);
        $checkEmail = $member->getMemberLogin($email);
        $tanggal = date("Y-m-d H:i:s");
        // $tanggal = '2020-12-29 13:22:26';
        if (!$username || !$email || !$questionInput1 || !$questionInput2) {
            $data['status'] = false;
            $data['message'] = 'Please fill all data';
        }
        elseif ($checkUsername) {
            $data['status'] = false;
            $data['message'] = 'Username already exist !';
        }elseif ($checkEmail) {
            $data['status'] = false;
            $data['message'] = 'Email already exist !';
        }else{

    	// $hashed_password = HASH_PWD($password);
        $hashed_password = $service->hash($password);

        $hashed_answear1 = $service->hash($questionInput1);

        $hashed_answear2 = $service->hash($questionInput2);

    	$member->addMember($nama, $alamat, $email, $telp, $username, $hashed_password);
        $member->addMember($nama, $email, $username, $hashed_password, $tanggal);

    	$id_member = $member->getId($username);
    	
    	$answear->addAnswear($hashed_answear1, $hashed_answear2, $tanggal);  

    	$id_answear = $answear->getId($tanggal);

    	$answear1 = $id_answear[0]['id'];
    	$answear2 = $id_answear[1]['id'];

        $login_question->addQuestionLogin($id_member['id'], $tanggal);

        $id_login_question = $login_question->getQuestionLoginId($id_member['id']);

    	$login_question->addQuestionItem( $question1, $answear1, $question2 , $answear2, $id_login_question['id'], $tanggal);

        $cart_member = $cart->InitializeCart($id_member['id'], $nama, $tanggal);

            $data['status'] = true;
        $data['message'] = 'Register Successfully !';

    }

    echo json_encode($data);

}