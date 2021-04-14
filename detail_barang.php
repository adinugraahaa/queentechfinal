<?php
session_start(); 
include('./includes/class-autoload.inc.php');
require_once('./templates/header.php');
require_once('navbar.php');

if (isset($_GET['id'])){
  $id_barang = $_GET['id'];
  $products = new Product();
  $product = $products->editProduct($id_barang);
}else{
    	header("location: 404.php");
}
if (isset($_SESSION['id_member']  )) {
	$id_member = $_SESSION['id_member'];
}

$members = new Member();
	$member = $members->getProfile($id_member);
	$alamat_member = $member['alamat_member'];

 ?>
                <main class="main">
                    <div class="container mt-5 rounded-0">
						<div class="position-relative" style="bottom: 25px">
							<a href="index.php"><i class="fas fa-arrow-left fa-lg"></i></a>
						</div>
					<section id="product">
			                <div class="container py-3" style="background-color: #fff">
			                    <div class="row">
			                        <div class="col-lg-5">
			                            <img src="img/<?= $product['gambar_barang']?>" alt="product" class="img-fluid mx-auto img-detail">
			                        </div>
			                        <div class="col-sm-7">
			                            <h5 class=""><?= $product['nama_barang']?></h5>
			                            
			                            <hr class="m-0">

			                            <!---    product price       -->
			                            <div class="d-flex bd-highlight py-2 mt-3">
			                            	<div class="bd-hightlight font-14" style="width: 100px">
			                            		<p>Harga</p>
			                            	</div>
			                            	<div class="bd-hightlight font-14 font-weight-bold text-warning" style="width: 100px">
			                            		Rp<span class="text-warning font-weight-bold"><?= number_format(intval($product['harga_barang']))?></span>
			                            	</div>
			                            </div>
			                            <div class="d-flex bd-highlight py-2">
				                            <div class="bd-hightlight font-14" style="width: 100px">
				                            		<p>Stok</p>
				                            	</div>
			                            	<div class="bd-hightlight font-14 text-warning" style="width: 100px">
			                            		<span><?= $product['stok_barang']?></span>
			                            	</div>
			                            </div>
			                                <hr class="m-0">
			                            <div class="d-flex bd-highlight py-2">
			                            	<div class="bd-hightlight font-14" style="width: 100px">
				                            		<p>Warna</p>
				                            	</div>
			                            	<div class="bd-hightlight font-14 text-warning" style="width: 100px">
			                            		<span><?= $product['warna_barang']?></span>
			                            	</div>
			                            	<div class="bd-hightlight font-16" style="width: 100px">
			                            	</div>
			                            </div>
			                            <img src="img/<?= $product['gambar_barang']; ?>" alt="" class="img-thumbnail" style="width: 70px; height: 70px">
			                             
			                             <form action="" id="form-submit">
			                             	<input type="hidden" name="id_barang" value="<?= $id_barang?>">
			                             	<input type="hidden" name="id_member" value="<?= $id_member?>">
			                             	<input type="hidden" name="harga_barang" value="<?= $product['harga_barang']; ?>">

			                             <div class="d-flex mt-4" id="section-quantity">
			                                             <button class="qty-up border bg-light" data-id="pro1"><i class="fas fa-angle-up"></i></button>
			                                             <input type="text" data-id="pro1" class="qty_input border px-2 bg-light" readonly value="1" placeholder="" name="quantity">
			                                             <button data-id="pro1" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
			                                         </div>
			                             	<div class="form-row mt-4 icons" id="section-btn">
			                             		<div class="col-4">
			                                    <button class="btn form-control py-1 font-14" id="btn-cart"><i class="fas fa-cart-plus"></i>  &nbsp;Masukkan Keranjang</button>
			                                </div>
			                                <div class="col-4">
			                                    <a href="keranjang.php?id_barang=<?= $id_barang; ?>"><button type="submit" name="submit" class="btn btn-warning form-control font-14" id="btn-submit">Beli</button></a>
			                             	</div>
			                            
			                             </div>
			                             </form>
			                             </div>
			                        <!-- <div class="col-sm-3">
			                        	<div class="card p-2 rounded-0 shadow-lg">
			                        		<div class="cord-body">
			                        			<div class="card-title border-bottom">
			                        				<h5 class="font-16">Alamat pengiriman</h5>
			                        			</div>
			                        			<div class="card-text bg-light" style="height: 50px">
			                        				<p class="font-14"><?= $alamat_member; ?></p>
			                        			</div>
			                        		</div>
			                        	</div>
			                        </div> -->
			                        </div>

			                        
			                    </div>
			                    <div class="row mt-5 mb-3 " style="min-height: 320px; background-color: #fff">
			                             	<div class="col-12 col-md-12 px-0">
			                             		<ul class="nav nav-pills" id="nav-detail" role="tablist">
												  <li class="nav-item" role="presentation">
												    <a class="nav-link active" id="pills-deskripsi-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-selected="true">Deskripsi</a>
												  </li>
												  <li class="nav-item" role="presentation">
												    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Spesifikasi</a>
												  </li>
												</ul>
												<hr class="m-0">
												<div class="tab-content px-4 mt-3" id="pills-tabContent">
												  <div class="tab-pane fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-deskripsi-tab">
												 <h6 class="font-20 font-weight-bold">Product Description</h6>
					                            <hr>
					                            <p class="font-14"><?= $product['deskripsi_barang'] ?></p></div>
												 <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
												 <h6 class="font-20 font-weight-bold">Spesifikasi</h6>
					                            <hr>
											  	 	<div class="d-flex bd-highlight">
						                            <div class="bd-hightlight font-16" style="width: 200px;">
						                            		<p style="color: rgba(0,0,0,0.38);">Brand</p>
						                            	</div>
					                            	<div class="bd-hightlight font-16 text-warning" style="width: 100px">
					                            		<span><?= $product['brand_barang']?></span>
					                            	</div>
					                            </div>
						                          <hr>
						                          <div class="d-flex bd-highlight">
							                            <div class="bd-hightlight font-16" style="width: 200px;">
							                            		<p style="color: rgba(0,0,0,0.38);">RAM</p>
							                            	</div>
						                            	<div class="bd-hightlight font-16 text-warning" style="width: 100px">
						                            		<span><?= $product['ram_barang']?></span>
						                            	</div>
												  </div>
												  <hr>
												  <div class="d-flex bd-highlight">
							                            <div class="bd-hightlight font-16" style="width: 200px;">
							                            		<p style="color: rgba(0,0,0,0.38);">Memori</p>
							                            	</div>
						                            	<div class="bd-hightlight font-16 text-warning" style="width: 100px">
						                            		<span><?= $product['memori_barang']?></span>
						                            	</div>
													</div>
													<hr>
												  <div class="d-flex bd-highlight">
							                            <div class="bd-hightlight font-16" style="width: 200px;">
							                            		<p style="color: rgba(0,0,0,0.38);">Kamera Depan</p>
							                            	</div>
						                            	<div class="bd-hightlight font-16 text-warning" style="width: 100px">
						                            		<span><?= $product['kamera_depan_barang']?></span>
						                            	</div>
													</div>
													<hr>
												  <div class="d-flex bd-highlight">
							                            <div class="bd-hightlight font-16" style="width: 200px;">
							                            		<p style="color: rgba(0,0,0,0.38);">Kamera Belakang</p>
							                            	</div>
						                            	<div class="bd-hightlight font-16 text-warning" style="width: 100px">
						                            		<span><?= $product['kamera_belakang_barang']?></span>
						                            	</div>
													</div>
													<hr>
												  <div class="d-flex bd-highlight">
							                            <div class="bd-hightlight font-16" style="width: 200px;">
							                            		<p style="color: rgba(0,0,0,0.38);">Baterai</p>
							                            	</div>
						                            	<div class="bd-hightlight font-16 text-warning" style="width: 100px">
						                            		<span><?= $product['baterai_barang']?></span>
						                            	</div>
												 </div>
					                        </div>
			                             </div>
			               			 </div>
			            	</section>
            			</div>
                    </div>
                </main>

<footer class="py-4 bg-dark mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-center small">
                            <div class="text-muted">Copyright &copy; QueenTech 2020</div>
                            
                        </div>
                    </div>
                </footer>

    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js
    "></script>
    <script type="text/javaScript">
    	$(document).ready(function(){
    // get count cart
    function getCart(){
    	$.get("cart.process.php", {count_cart : "count_cart"})
    	.done(function(data){
    		$('#cart-count').html(data);
    	})
    }

    getCart();

    $('#btn-cart').click(function(e){
    	e.preventDefault();
    	var fd = $('form').serialize();
    	var mbr = $('input[name=id_member]').val();

    	if (!mbr) {
    		toastr.info("Please Login to continue purchase");
    	}else{


    	$.post("cart.process.php", fd + "&action=cart")
    	.done(function(data){
    		toastr.success(data);
    		getCart();

    	});
    	}

    });

    $('#btn-submit').click(function(e){
    	e.preventDefault();
    	var fd = $('form').serialize();
    	var mbr = $('input[name=id_member]').val();

    	if (!mbr) {
    		toastr.info("Please Login to continue purchase");
    	}else{

    	$.post("cart.process.php", fd + "&action=cart")
    	.done(function(data){
    		var id_barang = $('input[name=id_barang]').val();
    			window.location.href = "keranjang.php?id_barang=" + id_barang;
    	});
    	}
    })

    		// product qty section
    let $qty_up = $(".qty-up");
    let $qty_down = $(".qty-down");
    // let $input = $(".qty .qty_input");

    // click on qty up button
    $qty_up.click(function(e){
    	e.preventDefault();
        let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
        if($input.val() >= 1 && $input.val() <= 9){
            $input.val(function(i, oldval){
                return ++oldval;
            });
        }
    });

       // click on qty down button
       $qty_down.click(function(e){
    	e.preventDefault();
        let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
        if($input.val() > 1 && $input.val() <= 10){
            $input.val(function(i, oldval){
                return --oldval;
            });
        }
    });


       toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": false,
                  "positionClass": "toast-top-center",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "3000",
                  "hideDuration": "1000",
                  "timeOut": "4000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut",
                }

    	});
    </script>
  </body>
</html>