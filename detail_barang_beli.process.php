<?php 
session_start();
    include('./includes/class-autoload.inc.php');
date_default_timezone_set('Asia/Jakarta');

	if ($_SESSION['Login_Verified'] && isset($_SESSION['id_member']) ) {
		
	    if (isset($_POST['submit'])) {
	    	$quantity = $_POST['quantity'];
	    	$id_barang = $_POST['id_barang'];
	    	$id_member = $_POST['id_member'];
			$tgl_pembayaran = date("Y-m-d H:i:s");
	    	$Transaction = new Transaction();
	    	$getBarang = new Product();
	    	$Detail_transaction = new Detail_Transaction();


	    	$Transaction->addTransaction($id_member, $quantity, $tgl_pembayaran);

	    	$barang = $getBarang->editProduct($id_barang);
	    	$stokBarang = $barang['stok_barang'];
	    	$hargaBarang = $barang['harga_barang'];
	    	$total_harga = $hargaBarang * $quantity;

	    	$id_transaksi = $Transaction->getId($tgl_pembayaran);
	    	// var_dump($total_harga, $id_transaksi['id_transaksi'] , $id_barang); die;
	    	$Detail_transaction->addDetailTransaction(intval($id_transaksi['id_transaksi']), intval($id_barang), $total_harga);

	    	$ID_detail_transaction = $Detail_transaction->getDetailTransactionId(intval($id_transaksi['id_transaksi']));
	    	// var_dump($ID_detail_transaction); die;

	    	header("location: checkout.php?id_transaksi=" . $id_transaksi['id_transaksi']);

	    }

	}else{

    	header("location: {$_SERVER['HTTP_REFERER']}");
	}
