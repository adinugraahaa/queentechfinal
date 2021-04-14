<?php 
session_start(); 
include('./includes/class-autoload.inc.php');
require_once('./templates/header.php');
require_once('navbar.php');

$id_member = $_SESSION['id_member'];
if (isset($_GET['id_barang'])) {
  $id_beli = $_GET['id_barang'];
}

$cart = new Cart();
$products_all = new Product();
$cart_member = $cart->getCartMember($id_member);
?>

 <main class="main">
 	<div class="container">
 		<div class="row">
 				<div class="col-sm-8" id="cart-data">
 					<div class="row mt-4 py-1 rounded-0 shadow" id="section-cart">
 											<div class="col-sm-2 p">
 												<div class="form-check">
					                          <input class="form-check-input ids_all position-static" type="checkbox" value="all" aria-label="..." style="width: 20px; height: 20px;" name="all" >
                                    <input type="hidden" id="id_beli" value="<?= $id_beli; ?>">
					                        </div>
 											</div>
                                            <div class="col-sm-8 px-4 mt-1">
                                                <h5 class="font-16">Produk</h5>
                                            </div>

                                            <div class="col-sm-2 mt-1 text-center">
                                                <div class="font-16 text-danger ">
                                                    <span class="">Harga</span>
                                                </div>
                                            </div>
                                      </div>
 					<?php if($cart_member) : ?>
            <?php foreach ($cart_member as $cart) : ?>
              <?php $product = $products_all->editProduct($cart['id_barang']); ?>
                                    <!-- cart item -->
                                    <div class="row border-top py-3 mt-3 shadow" id="section-cart">
                                            <div class="col-sm-2">
                                              <div class="d-flex bd-highlight">
                                              <div class="form-check">
                          <input class="form-check-input ids position-static" type="checkbox" value="<?= $cart['id'] ?>" aria-label="..." style="width: 20px; height: 20px; margin-top: 50px; margin-right: 10px;" name="keranjang[]" data-harga="<?= $cart['harga']; ?>" data-quantitas="<?= $cart['quantitas']; ?>" data-barang="<?= $product['id']; ?>">
                        </div>
                        <input type="hidden" name="grand_total" id="grand_total" value="">
                                                <img src="img/<?= $product['gambar_barang']; ?>" style="height: 120px;" alt="cart1" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 pl-4">
                                                <h5 class="font-16 name"><?= $product['nama_barang']; ?></h5>
                                                <small>by <?= $product['brand_barang']; ?></small>

                                                <!-- product qty -->
                                                    <div class="qty d-flex pt-2">
                                                        <div class="d-flex" id="section-quantity">
                                                            <button class="qty-up border bg-light" data-id="<?= $product['id']; ?>"><i class="fas fa-angle-up"></i></button>
                                                            <input type="text" id="<?= $product['id']; ?>" class="qty_input border px-2 bg-light" readonly value="<?= $cart['quantitas']; ?>" data-cart="<?= $cart['id']; ?>">
                                                            <button class="qty-down border bg-light" data-id="<?= $product['id']; ?>"><i class="fas fa-angle-down"></i></button>
                                                        </div>
                                                        <a href="keranjang_delete.php?id=<?= $cart['id']; ?>&send=del" class="text-danger px-3 mt-2"><i class="fas fa-trash-alt fa-lg"></i></a>
                                                    </div>
                                                <!-- !product qty -->

                                            </div>

                                            <div class="col-sm-2 text-center px-0 ">
                                                <div class="font-16 text-warning ">
                                                    Rp&nbsp;<span class=" text-warning"><?= number_format(intval($cart['harga'])); ?></span>
                                                    <input type="hidden" name="total[]" value="<?= $cart['harga']; ?>">
                                                </div>
                                            </div>
                                      </div>
                                    <!-- !cart item -->
                         <?php endforeach; ?>
                       <?php else : ?>
                                        <div class="row border-top py-3 mt-3">
                                          <div class="col-sm-12">
                                            <h5 class="text-center font-16">Keranjang Kosong</h5>
                                          </div>
                                </div>
                        <?php endif; ?>
                                    
                                </div>
                                <!-- subtotal section-->
                                <div class="col-sm-4 mt-4">
                                    <div class="sub-total border text-center mt-2 shadow" id="section-cart">
                                        <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Your order is eligible for FREE Delivery.</h6>
                                        <div class="border-top py-4">
                                           <div class="d-flex justify-content-between mx-2">
                                           	 <h5 class="font-size-20">Subtotal (<span id="subtotal"></span> item):&nbsp;</h5>
                                            <h5 class="font-16"><span class="text-danger">Rp&nbsp;<span class="text-danger" id="deal-price">0</span></span> </h5>
                                           </div>
                                           <div id="section-btn">
                                            <button id="btn-submit" class="btn mt-3">Checkout</button>
                                           </div>
                                        </div>
                                    </div>
                                </div>
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
     <script>
     	$(function(){

			  $('#subtotal').html("0");

        function checkBeli(){
          var check = $('#id_beli').val();
          $('.ids').each(function(){
            var ids_val = $(this).data("barang");
            if (check == ids_val) {
              $(this).prop("checked", true);
            }
        });
        }
        checkBeli();

			  function total_harga(){
			  	var total = 0;
			  	var sum;
          var n = 0;
			  	$('.ids:checked').each(function(){
			  		var ids_val = $(this).data("barang");
			  		var quantitas = $('#'+ids_val).val();
			  		sum = parseInt($(this).data("harga")) * parseInt(quantitas);
			  		total = total + sum;
            n = n + 1;
				})
        $('#subtotal').html(n);
			  	$('#deal-price').text(new Intl.NumberFormat().format(total));
			  $('#grand_total').val(total);
			  }
			  total_harga();
     		$('input[type=checkbox]').on("click", function(){
     			if ($(this).val() == 'all' && $(this).prop("checked")) {
     				$('.ids').prop("checked", true);
     			}else if($(this).val() == 'all'){
     				$('.ids').prop("checked", false);
     			}
     			var n = $( "input:checked" ).length;
			  $('#subtotal').html(n);
				total_harga();
     		});

     		$('#btn-submit').click(function(){

     			var ids = $('.ids:checked').serialize();
     			var total = $('#grand_total').val();
          if (total != 0) {
       			$.post("cart.process.php", ids + "&grand_total=" + total + "&method=submit")
       			.done(function(data){
       				// toastr.info(data);
       				// console.log(data);
       				window.location.href = "checkout.php";
       			});
          }else{
            toastr.info("Please select product");
          }
     			


     		});

     		$('.qty-up').click(function(){
     			var data = $(this).data("id");
     			let $input = $("#"+data);
     			if($input.val() >= 1){
     			$input.val(function(i,value){
     				return ++value;
	     			})
	     		}
	     		var id_cart = $input.data("cart");
     			var qty = $input.val();

     			$.post("cart.process.php", {id_cart: id_cart, qty: qty, mode: "update"}, 
     				function(data){
					toastr.success(data);;
				});

     		})


     		$('.qty-down').click(function(){
     			var data = $(this).data("id");
     			let $input = $("#"+data);
     			if($input.val() > 1){
     			$input.val(function(i,value){
     				return --value;
	     			})
	     		}
	     		var id_cart = $input.data("cart");
     			var qty = $input.val();

     			$.post("cart.process.php", {id_cart: id_cart, qty: qty, mode: "update"}, 
     				function(data){
					toastr.success(data);
				});
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
			  
     	
     	})
     </script>
     
   </body>
 </html>