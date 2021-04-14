<?php 

class Member extends Dbh{

	public function addMember($nama, $email, $username, $password, $tgl_register) {
	    $sql = "INSERT INTO member(nama, email, username, password, registerAt) VALUES (?, ?, ?, ?, ?)";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$nama, $email, $username, $password, $tgl_register]);
	}

	public function getId($username){
		$sql = "SELECT id FROM member where username = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$username]);
		$result = $stmt->fetch();

		return $result;		
	}

	public function getMemberLogin($email){
		$sql = "SELECT * FROM member where email = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$email]);
		$result = $stmt->fetch();

		return $result;	
	}

	public function checkUsername($username){
		$sql = "SELECT * FROM member where username = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$username]);
		$result = $stmt->fetch();
 
		return $result;
	}

	public function getProfile($id_member){
		$sql = "SELECT * FROM member where id = ? ORDER BY id DESC";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id_member]);
		$result = $stmt->fetch();

		return $result;		
	}

	public function updateMember($nama_member, $alamat_member, $email, $telp_member, $id_member) {
	    $sql = "UPDATE member SET nama = ?, alamat = ?, email = ?, telp = ? where id = ?";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$nama_member, $alamat_member, $email, $telp_member, $id_member]);

	}

	public function getMemberDashboard(){
		$sql = "SELECT * FROM member WHERE admin = '0' ORDER BY id DESC";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute();
		while($result = $stmt->fetchAll()) {
	      return $result;
	    };
	}

}