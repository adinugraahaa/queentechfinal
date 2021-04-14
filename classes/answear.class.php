<?php 

class Answear extends Dbh{

	public function addAnswear($deskripsi_jawaban1, $deskripsi_jawaban2, $tgl_input){
		$sql = "INSERT INTO jawaban(deskripsi_jawaban, createdAt) VALUES (?, ?), (?, ?)";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$deskripsi_jawaban1, $tgl_input, $deskripsi_jawaban2, $tgl_input]);
	}

	public function getId($tgl_input){
		$sql = "SELECT id FROM jawaban where createdAt = ?";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$tgl_input]);
	    while($result = $stmt->fetchAll()) {
	      return $result;
	    };
	}

}