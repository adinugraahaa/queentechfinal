<?php 
session_start();
include('./includes/class-autoload.inc.php');
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d H:i:s");
    $transactions = new Transaction();
    $orders = new Order();
    $products = new Product();
    $id_member = $_SESSION['id_member'];
    $id_order = $_POST['id_order'];

	$gambar = $transactions->upload();

	if (!$gambar == false) {
		$transactions->addTransaction($id_member, $id_order, $tanggal, $gambar);
		$orders->setStatus($id_order, "Terbayar");
        $order_barang = $orders->getIdBarang($id_order);
        foreach ($order_barang as $barang) {
            $products->buyProduct($barang['quantitas'], $barang['id_barang']);
        }

        $data = 'Transaksi anda telah berhasil!';

	}else{
		$data = "Bukti pembayaran gagal";

	}

    echo $data;
