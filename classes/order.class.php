<?php 

class Order extends Dbh{

	public function NewOrder($id_member, $grand_total, $nama, $alamat, $tgl_input){
		$sql = "INSERT INTO pemesanan(id_member, grand_total, nama, alamat, createdAt) VALUES(?,?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id_member, $grand_total, $nama, $alamat, $tgl_input]);
	}

	public function getOrders($tgl_input){
		$sql = "SELECT * FROM pemesanan WHERE createdAt = ?";
		$stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$tgl_input]);
	    $result = $stmt->fetch();

		return $result;
	}

	public function getOrderTransaction($id_order){
		$sql = "SELECT * FROM pemesanan WHERE id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id_order]);
		$result = $stmt->fetch();

		return $result;
	}

	public function addOrder($id_barang, $id_pemesanan, $harga, $quantitas, $tgl_input){
		$sql = "INSERT INTO pemesanan_satuan(id_barang, id_pemesanan, harga, quantitas, createdAt) VALUES (?,?,?,?,?)";

		$stmt = $this->connect()->prepare($sql);

		$stmt->execute([$id_barang, $id_pemesanan, $harga, $quantitas, $tgl_input]);
	}

	public function setStatus($id_order, $status){
		$sql = "UPDATE pemesanan SET status = ? WHERE id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$status, $id_order]);
	}

	// public function getOrderHistory($id_member){
	// 	$sql = "SELECT p.id  FROM pemesanan_satuan ps INNER JOIN pemesanan p ON ps.id_pemesanan = p.id WHERE id_member = ?"
	// }

	public function getIdBarang($id_order){
		$sql = "SELECT id_barang, quantitas FROM pemesanan_satuan ps INNER JOIN pemesanan p ON ps.id_pemesanan = p.id WHERE p.id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id_order]);
		while($result = $stmt->fetchAll()) {
          return $result;
        };

	}



}