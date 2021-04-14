<?php 

class Cart extends Dbh{

	public function InitializeCart($id_member, $nama_member, $tgl_input){
		$sql = "INSERT INTO keranjang(id_member, nama, createdAt) VALUES(?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id_member, $nama_member, $tgl_input]);
	}

	public function getCarts($id_member){
		$sql = "SELECT * FROM keranjang WHERE id_member = ?";
		$stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$id_member]);
	    $result = $stmt->fetch();

		return $result;
	}


	public function getCartMember($id_member){
		$sql = "SELECT ks.id, ks.id_barang, ks.id_keranjang, ks.harga, ks.quantitas, ks.createdAt FROM keranjang_satuan ks INNER JOIN keranjang k ON ks.id_keranjang = k.id WHERE k.id_member = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id_member]);

		while ($result = $stmt->fetchAll()) {
			return $result;
		}
	}

	public function checkoutCart($id_keranjang_satuan){
		$sql = "SELECT * FROM keranjang_satuan WHERE id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id_keranjang_satuan]);

		$result = $stmt->fetch();
		return $result;
	}

	public function checkCartMember($id_barang, $id_keranjang){
		$sql = "SELECT * FROM keranjang_satuan WHERE id_barang = ? AND id_keranjang = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id_barang, $id_keranjang]);

		$result = $stmt->fetch();
		return $result;
	}

	public function updateCartMember($quantitas, $id){
		$sql = "UPDATE keranjang_satuan SET quantitas = ? WHERE id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$quantitas, $id]);
	}

	public function addCart( $id_barang, $id_keranjang, $harga, $quantitas, $tgl_input){
		$sql = "INSERT INTO keranjang_satuan(id_barang, id_keranjang, harga, quantitas , createdAt) VALUES(?,?,?,?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id_barang, $id_keranjang, $harga, $quantitas, $tgl_input]);
	}

	public function deleteCart($id){
		$sql = "DELETE FROM keranjang_satuan WHERE id = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id]);
	}


}