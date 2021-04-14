<?php 


    include('./includes/class-autoload.inc.php');
    date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d H:i:s");


    // if (isset($_POST['submit'])) {
    	$brand_barang = $_POST['brand_barang'];
    	$nama_barang = $_POST['nama_barang'];
        $warna_barang = $_POST['warna_barang'];
        $ram_barang = $_POST['ram_barang'];
        $memori_barang = $_POST['memori_barang'];
        $baterai_barang = $_POST['baterai_barang'];
        $kamera_depan_barang = $_POST['kamera_depan_barang'];
        $kamera_belakang_barang = $_POST['kamera_belakang_barang'];
    	$stok_barang = $_POST['stok_barang'];
    	$harga_barang = $_POST['harga_barang'];
    	$deskripsi_barang = $_POST['deskripsi_barang'];
        $data = '';
    	$product = new Product();

    	$gambar = $product->upload();

    	if (!$gambar == false) {
    		$product->addProduct($brand_barang, $nama_barang, $warna_barang, $ram_barang, $memori_barang, $baterai_barang, $kamera_depan_barang, $kamera_belakang_barang, $stok_barang, $harga_barang, $deskripsi_barang, $gambar, $tanggal);
    	// header("location: {$_SERVER['HTTP_REFERER']}");
            $data = 'Add data successfuly !';

    	}else{
    		$data = "Something Error";

    	}

        echo $data;


    // }
