<?php 


class Product extends Dbh{

	public function getProducts(){
		$sql = "SELECT * FROM barang ORDER BY id DESC";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute();

	    while($result = $stmt->fetchAll()) {
	      return $result;
	    };
	}

    public function getProductsPage($start, $page){
        $sql = "SELECT * FROM barang ORDER BY id DESC LIMIT ? , ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$start, $page]);

        while($result = $stmt->fetchAll()) {
          return $result;
        };
    }

	public function addProduct($brand_barang, $nama_barang, $warna_barang, $ram_barang, $memori_barang, $baterai_barang, $kamera_depan_barang, $kamera_belakang_barang, $stok_barang, $harga_barang, $deskripsi_barang, $gambar, $tgl_input) {
    $sql = "INSERT INTO barang(brand_barang, nama_barang, warna_barang, ram_barang, memori_barang, baterai_barang, kamera_depan_barang, kamera_belakang_barang, stok_barang, harga_barang, deskripsi_barang, gambar_barang, createdAt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute([$brand_barang, $nama_barang, $warna_barang, $ram_barang, $memori_barang, $baterai_barang, $kamera_depan_barang, $kamera_belakang_barang, $stok_barang, $harga_barang, $deskripsi_barang, $gambar, $tgl_input]);

  	}

	public function editProduct($id){
	    $sql = "SELECT * FROM barang where id = ?";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$id]);
	    $result = $stmt->fetch();

	    return $result;
	}

	public function updateProduct($brand_barang, $nama_barang, $warna_barang, $ram_barang, $memori_barang, $baterai_barang, $kamera_depan_barang, $kamera_belakang_barang, $stok_barang, $harga_barang, $deskripsi_barang, $gambar, $id) {
	    $sql = "UPDATE barang SET brand_barang = ?, nama_barang = ?, warna_barang = ?, ram_barang = ?, memori_barang = ?, baterai_barang = ?, kamera_depan_barang = ?, kamera_belakang_barang = ?, stok_barang = ?, harga_barang = ?, deskripsi_barang = ?, gambar_barang = ? where id = ?";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$brand_barang, $nama_barang, $warna_barang, $ram_barang, $memori_barang, $baterai_barang, $kamera_depan_barang, $kamera_belakang_barang, $stok_barang, $harga_barang, $deskripsi_barang, $gambar, $id]);

	}

	  public function deleteProduct($id){
	    $sql = "DELETE FROM barang where id = ?";
	    $stmt = $this->connect()->prepare($sql);
	    $stmt->execute([$id]);
	  }

      public function searchProduct($input, $category){
        $sql = "SELECT * FROM barang where " . $category ." LIKE ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute(['%' . $input . '%']);

        while($result = $stmt->fetchAll()) {
          return $result;
        };
      }

      public function searchProductIndex($input){
        $sql = "SELECT * FROM barang where nama_barang LIKE concat('%', :input, '%') ORDER BY id DESC";
                
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([':input' => $input ]);

        while($result = $stmt->fetchAll()) {
          return $result;
        };
      }

      public function buyProduct($quantitas, $id_barang){
        $sql = "UPDATE barang SET stok_barang = stok_barang - ? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$quantitas, $id_barang]);
      }



	  public function upload(){

    	$nama_file = $_FILES['gambar_barang']['name'];
    	$ukuran_file = $_FILES['gambar_barang']['size'];
    	$error = $_FILES['gambar_barang']['error'];
    	$tmpName = $_FILES['gambar_barang']['tmp_name'];


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