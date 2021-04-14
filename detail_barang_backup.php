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

 ?>
                <main class="main">
                    <div class="container">
					<section id="product" class="py-3">
			                <div class="container">
			                    <div class="row">
			                        <div class="col-sm-6">
			                            <img src="img/<?= $product['gambar_barang']?>" alt="product" class="img-fluid">
			                            
			                        </div>
			                        <div class="col-sm-6 py-5">
			                            <h5 class="font-baloo font-size-20"><?= $product['nama_barang']?></h5>
			                            
			                            <hr class="m-0">

			                            <!---    product price       -->
			                                <table class="my-3">
			                                    
			                                    <tr class="font-rale font-size-14">
			                                        <td style="width: 100px">Harga</td>
			                                        <td class="font-size-20 text-danger">Rp <span><?= $product['harga_barang']?></span></td>
			                                    </tr>
			                                    <tr class="font-rale font-size-14">
			                                        <td style="width: 100px">Stok</td>
			                                        <td class="font-size-20 text-danger"><span><?= $product['stok_barang']?></span></td>
			                                    </tr>
			                                    
			                                </table>
			                            <!---    !product price       -->

			                             
			                                <hr>

			                            <!-- order-details -->
			                                <!-- <div id="order-details" class="font-rale d-flex flex-column text-dark">
			                                    <small>Delivery by : Mar 29  - Apr 1</small>
			                                    <small>Sold by <a href="#">Daily Electronics </a>(4.5 out of 5 | 18,198 ratings)</small>
			                                    <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to Customer - 424201</small>
			                                </div> -->
			                             <!-- !order-details -->

			                             <div class="row" style="min-height: 320px">
			                             	<div class="col-12">
					                            <h6 class="font-rubik">Product Description</h6>
					                            <hr>
					                            <p class="font-rale font-size-14"><?= $product['deskripsi_barang'] ?></p>
					                            <p class="font-rale font-size-14"></p>
					                        </div>
			                             </div>
			                             <form action="detail_barang_beli.process.php" method="POST" id="form-submit">
			                             	<input type="hidden" name="id_barang" value="<?= $id_barang?>">
			                             	<input type="hidden" name="id_member" value="<?= $id_member?>">

			                             <div class="row">
			                                 
			                                 <div class="col-4 offset-8">
			                                   <!-- product qty section   -->
			                                     <div class="qty d-flex">
			                                         <h6 class="font-baloo">Qty</h6>
			                                         <div class="px-4 d-flex font-rale">
			                                             <button class="qty-up border bg-light" data-id="pro1"><i class="fas fa-angle-up"></i></button>
			                                             <input type="text" data-id="pro1" class="qty_input border px-2 w-50 bg-light" readonly value="1" placeholder="1" name="quantity">
			                                             <button data-id="pro1" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
			                                         </div>
			                                     </div>
			                                    <!-- !product qty section  -->

			                                 </div>

			                             </div>

			                             <div class="row">
			                             	<div class="col-12">
			                             		<div class="form-row pt-4 font-size-16 font-baloo">
			                                <div class="col">
			                                    <button class="btn btn-danger form-control" id="btn-cancel">Batal</button>
			                                </div>
			                                <div class="col">
			                                    <button type="submit" name="submit" class="btn btn-warning form-control" id="btn-submit">Beli</button>
			                                </div>
			                            </div>
			                             	</div>
			                             </div>
			                             </form>
			                        </div>

			                        
			                    </div>
			                </div>
			            </section>
            </div>
                    </div>
                </main>


<footer class="py-4 bg-dark mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; E-Commerce 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>

<!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script type="text/javascript" src="jquery-3.5.1.min.js"></script>
    <script type="text/javaScript">
    	$(document).ready(function(){

    		// product qty section
    let $qty_up = $(".qty .qty-up");
    let $qty_down = $(".qty .qty-down");
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

       $('#btn-cancel').click(function(e){
       		e.preventDefault();
       		window.location.href = "index.php";
       })

    	});
    </script>
  </body>
</html>