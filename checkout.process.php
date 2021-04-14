<?php 
    session_start();
    include('./includes/class-autoload.inc.php');

    $data = "";

    if (isset($_POST['submit'])) {
    	
    	$id_transaction = $_POST['id_transaksi'];
    	$detail_transaction = new Detail_Transaction();
    	
    	$transactions = new Transaction();
        // var_dump($_FILES); die;

    	$gambar_bukti = $detail_transaction->upload();
    	// var_dump($gambar_bukti, $id_transaction); die;
    	if (!$gambar_bukti == false) {
    		$transactions->addOrderImage(intval($id_transaction), $gambar_bukti);

		$detail_transaction->addStatus(intval($id_transaction));
        // echo '<div class="alert alert-warning" role="alert">
        //               Pesanan Berhasil !
        //             </div>';
        // echo $data;
        $_SESSION['showAlert'] = '<div class="alert alert-warning" role="alert">
                      Pesanan Berhasil !
                    </div>';
    	header("location: {$_SERVER['HTTP_REFERER']}");

    	}
        header("location: {$_SERVER['HTTP_REFERER']}");
        
    }else{
    		// echo '<div class="alert alert-warning" role="alert">
      //                 Pesanan Gagal !
      //               </div>';
            // echo $data;
    	}
