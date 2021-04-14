<?php 

class Questions extends Dbh{

	public function getQuestion(){
		$sql = "SELECT * FROM pertanyaan";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute();

	    while($result = $stmt->fetchAll()) {
	      return $result;
	    };
	}

	public function getQuestionLogin($id){
		$sql = "SELECT p.`deskripsi_pertanyaan`, j.`deskripsi_jawaban` FROM `pertanyaan_satuan` ps INNER JOIN `pertanyaan_login` pl ON ps.`id_pertanyaan_login` = pl.`id` INNER JOIN `jawaban` j ON ps.`id_jawaban` = j.`id` INNER JOIN `pertanyaan` p ON ps.`id_pertanyaan` = p.`id` WHERE pl.`id_member` = ?";

	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$id]);

	    while($result = $stmt->fetchAll()) {
	      return $result;
	    };
	}

}