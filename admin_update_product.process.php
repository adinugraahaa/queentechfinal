<?php 


    include('./includes/class-autoload.inc.php');

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
    	$gambar_lama = $_POST['gambar_lama'];
        $id_barang = $_POST['id_barang'];

        $product = new Product();

    	if ($_FILES['gambar_barang']['error'] === 4) {
    		$gambar = $gambar_lama;
    	}
    	else{
    		$gambar = $product->upload();
    	}

    	if (!$gambar == false) {
    		$product->updateProduct($brand_barang, $nama_barang, $warna_barang, $ram_barang, $memori_barang, $baterai_barang, $kamera_depan_barang, $kamera_belakang_barang, $stok_barang, $harga_barang, $deskripsi_barang, $gambar, $id_barang );
    	// header("location: admin_barang.php");
            // echo = "<h4>Data Successfully Update</h4>";
            $data['status'] = true;
            $data['message'] = 'Update Data Successfully !';
            
        }else{
            $data['status'] = false;
            $data['message'] = 'Update Data Failed !';
        }

        echo json_encode($data);


