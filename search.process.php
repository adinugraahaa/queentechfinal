<?php 

    include('./includes/class-autoload.inc.php');


$search = $_POST['search'];
$category = $_POST['category'];
$products = new Product();


$data = "";
if ($category == "pilih") {
	$data .= '<div class="col-md-12 text-center" style="margin-top: 200px">
					<h2>Pilih kategori terlebih dahulu</h2>
					</div>';

}else {
$search_product = $products->searchProduct($search, $category);
	if ($search_product) {
		foreach ($search_product as $product) {
			$data .= '<div class="col-lg-3 hover">
						<a href="detail_barang.php?id='. $product["id"] . '">
						  <div class="p-2 bd-highlight mx-2">
								  <div class="card p-2 mb-2">
								  <img src="img/'. $product["gambar_barang"] . '" class="card-img-top" alt="..." height="250">
								  <div class="card-body">
								  <h6 class="card-title font-14">'. $product["nama_barang"] . '</h6>
								    <p class="card-text text-danger">Rp '. number_format(intval($product["harga_barang"])) . '</p>
								  </div>
								</div>
						  </div>
						</a>
						</div>';
		}
	}
	else{
		$data .= ' <div class="col-md-12 text-center" style="margin-top: 200px">
					<h2>Product not exist</h2>
					</div>';
	}
}

echo $data;
// echo var_dump($category);
