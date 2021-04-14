<?php 


class Detail_Transaction extends Dbh{

		public function addDetailTransaction($id_transaksi, $id_barang, $total, $status = "wait"){
			$sql = "INSERT INTO detail_transaksi(id_transaksi, id_barang, total, status) VALUES (?, ?, ?, ?)";
			$stmt = $this->connect()->prepare($sql);
			$stmt->execute([$id_transaksi, $id_barang, $total, $status]);	
	}

		public function getDetailTransactionId($id_transaksi){
		    $sql = "SELECT id_detail_transaksi FROM detail_transaksi where id_transaksi = ?";
		    $stmt = $this->connect()->prepare($sql);
		    $stmt->execute([$id_transaksi]);
		    $result = $stmt->fetch();

	    return $result;
	}

		public function getDetailTransaction($id_transaksi){
			$sql = "SELECT * FROM detail_transaksi where id_transaksi = ?";
		    $stmt = $this->connect()->prepare($sql);
		    $stmt->execute([$id_transaksi]);
		    $result = $stmt->fetch();

	    return $result;
		}

		public function addStatus($id_transaksi) {
		    $sql = "UPDATE detail_transaksi SET status = 'success' where id_transaksi = ?";
		    $stmt = $this->connect()->prepare($sql);
		    $stmt->execute([$id_transaksi]);
		}



		public function upload(){

    	$nama_file = $_FILES['gambar_bukti']['name'];
    	$ukuran_file = $_FILES['gambar_bukti']['size'];
    	$error = $_FILES['gambar_bukti']['error'];
    	$tmpName = $_FILES['gambar_bukti']['tmp_name'];


    	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    	$ekstensiGambar = explode('.', $nama_file);
    	$ekstensiGambar = strtolower(end($ekstensiGambar));
    	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {

    		$_SESSION['showAlert'] = '<script>
    			alert("Yang di upload bukan gambar")
    		</script>';	
    		return false;
    	}

    	if ($ukuran_file > 1000000) {
    		$_SESSION['showAlert'] = "<scipt>
    			alert('Ukuran gambar terlalu besar')
    		</script>";	
    		return false;

    	}

    	$namaFileBaru = uniqid();
    	$namaFileBaru = substr($namaFileBaru, 0,5);
    	$namaFileBaru .= '.';
    	$namaFileBaru .= $ekstensiGambar;

    	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    	return $namaFileBaru;
    }





}