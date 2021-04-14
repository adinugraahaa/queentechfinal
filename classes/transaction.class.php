<?php 


class Transaction extends Dbh{

	public function getTransaction(){
		$sql = "SELECT p.id, m.nama, b.nama_barang, ps.harga * ps.quantitas as total , ps.quantitas,  p.status, t.tgl_pembayaran FROM transaksi t INNER JOIN pemesanan p ON t.id_pemesanan = p.id INNER JOIN pemesanan_satuan ps ON p.id = ps.id_pemesanan INNER JOIN barang b ON ps.id_barang = b.id INNER JOIN member m ON t.id_member = m.id ORDER BY t.id DESC";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute();

	    while($result = $stmt->fetchAll()) {
	      return $result;
	    };
	}

	public function getTransactionHistory($id_member){
		$sql = "SELECT b.gambar_barang, b.nama_barang, ps.harga * ps.quantitas as total , ps.quantitas,t.tgl_pembayaran FROM transaksi t INNER JOIN pemesanan p ON t.id_pemesanan = p.id INNER JOIN pemesanan_satuan ps ON p.id = ps.id_pemesanan INNER JOIN barang b ON ps.id_barang = b.id INNER JOIN member m ON t.id_member = m.id WHERE t.id_member = ?";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$id_member]);

	    while($result = $stmt->fetchAll()) {
	      return $result;
	    };
	}

	public function getOrderHistory($id_member){
		$sql = "SELECT p.id, b.gambar_barang, b.nama_barang, ps.harga * ps.quantitas as total , ps.quantitas, p.createdAt as tgl_pembayaran FROM pemesanan_satuan ps INNER JOIN pemesanan p ON ps.id_pemesanan = p.id INNER JOIN barang b ON ps.id_barang = b.id INNER JOIN member m ON p.id_member = m.id WHERE p.status = 'Waiting' AND p.id_member = ?";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$id_member]);
		while($result = $stmt->fetchAll()) {
	      return $result;
	    };
	}

	public function addTransaction($id_member, $id_pesanan, $tgl_pembayaran, $gambar_bukti) {
    $sql = "INSERT INTO transaksi(id_member, id_pemesanan, tgl_pembayaran, bukti_pembayaran) VALUES (?, ?, ?,?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$id_member, $id_pesanan, $tgl_pembayaran, $gambar_bukti]);
  	}

  	public function getId($tgl_pembayaran){
	    $sql = "SELECT id FROM transaksi where tgl_pembayaran = ?";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$tgl_pembayaran]);
	    $result = $stmt->fetch();

	    return $result;
	}

	public function getTransactionItem($id_transaksi){
	    $sql = "SELECT * FROM transaksi where id_transaksi = ?";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$id_transaksi]);
	    $result = $stmt->fetch();

	    return $result;
	}

	public function addOrderImage($id_transaksi, $gambar_bukti) {
	    $sql = "UPDATE transaksi SET bukti_pembayaran = ? where id_transaksi = ?";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$gambar_bukti, $id_transaksi]);

	}

	public function search($start_date, $end_date){
		$sql = "SELECT p.id, m.nama, b.nama_barang, ps.harga * ps.quantitas as total , ps.quantitas,  p.status, t.tgl_pembayaran FROM transaksi t INNER JOIN pemesanan p ON t.id_pemesanan = p.id INNER JOIN pemesanan_satuan ps ON p.id = ps.id_pemesanan INNER JOIN barang b ON ps.id_barang = b.id INNER JOIN member m ON t.id_member = m.id where t.tgl_pembayaran >=? AND t.tgl_pembayaran <= ? ORDER BY t.tgl_pembayaran DESC";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$start_date, $end_date]);

	     while($result = $stmt->fetchAll()) {
	      return $result;
	    };
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
    		// echo "<scipt>
    		// 	alert('Yang di upload bukan gambar')
    		// </script>";
            // echo 'Yang di upload bukan gambar';
            $data['status'] = false;
            $data['message'] = "Yang di upload bukan gambar";
            echo json_encode($data);
            return false;
    	}

    	if ($ukuran_file > 1000000) {
            $data['status'] = false;
    		$data['message'] = 'Ukuran gambar terlalu besar';
            echo json_encode($data);
            return false;

    	}

    	$namaFileBaru = uniqid();
    	$namaFileBaru .= '.';
    	$namaFileBaru .= $ekstensiGambar;

    	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    	return $namaFileBaru;
    }



}