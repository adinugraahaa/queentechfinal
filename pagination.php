<?php  

    include('./includes/class-autoload.inc.php');
 $productss = new Product();
 $record_per_page = 8;  
 $page = '';  
 $data = '';  
 if(isset($_POST["page"]))  
 {  
      $page = $_POST["page"];  
 }  
 else  
 {  
      $page = 1;  
 }  
 $start_from = ( $page - 1) * $record_per_page;  
 $products = $productss->getProductsPage($start_from, $record_per_page);
 foreach ($products as $product) {
 $data .= '
          <div class="col-lg-3 hover section-index">
          <a href="detail_barang.php?id='. $product["id"] . '">
            <div class="p-2 bd-highlight mx-2">
                <div class="card p-2 mb-2">
                <img src="img/'. $product["gambar_barang"] . '" class="card-img-top" alt="..." height="250">
                <div class="card-body">
                <h6 class="card-title font-14 name">'. $product["nama_barang"] . '</h6>
                  <p class="card-text text-danger">Rp '. number_format(intval($product["harga_barang"])) . '</p>
                </div>
              </div>
            </div>
          </a>
          </div>
 ';
 }

 $data .= '<div class="col-lg-12"><nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">';
 $product_all = $productss->getProducts();
 $total_records = count($product_all); 
 $total_pages = ceil($total_records/$record_per_page);  
 for($i=1; $i<=$total_pages; $i++)  
 {    
      $data .= "<li class='page-item'><span class='pagination_link page-link' id='".$i."'>".$i."</span></li>";
      // $data .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
 }  
 $data .= '</ul>
</nav></div>';
 echo $data;  
 ?>  
