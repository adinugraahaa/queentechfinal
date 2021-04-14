<?php 

class Login_Question extends Dbh{

	public function addQuestionLogin($id_member, $tgl_input){
		$sql = "INSERT INTO pertanyaan_login(id_member, createdAt) VALUES(?,?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id_member, $tgl_input]);
	}

	public function getQuestionLoginId($id_member){
		$sql = "SELECT id FROM pertanyaan_login WHERE id_member = ?";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id_member]);
		$result = $stmt->fetch();

	    return $result;
	}

	public function addQuestionItem ($id_pertanyaan1, $id_jawaban1, $id_pertanyaan2, $id_jawaban2, $id_pertanyaan_login, $tgl_input){
		$sql = "INSERT INTO pertanyaan_satuan( id_pertanyaan, id_jawaban, id_pertanyaan_login, createdAt) VALUES (?, ?, ?, ?), (?, ?, ?, ?)";
		$stmt = $this->connect()->prepare($sql);
		$stmt->execute([$id_pertanyaan1, $id_jawaban1, $id_pertanyaan_login, $tgl_input, $id_pertanyaan2, $id_jawaban2, $id_pertanyaan_login, $tgl_input]);
	}
}