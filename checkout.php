<?php 
session_start();
include('./includes/class-autoload.inc.php');
require_once('./templates/header.php');
require_once('navbar.php'); 

if (isset($_SESSION['checkout'])) {
    $id_cart_checkout = $_SESSION['checkout']['keranjang_id'];
    $grand_total = $_SESSION['checkout']['grand_total'];
}else{
    header("location : 404.php");
}
$carts = new Cart();
$products = new Product();
?>

<main class="main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                <div class="col-md-7">
                          <button class="btn bg--primary text-white position-absolute" id="btn-back" style="left: -50px; top: 30px"><i class="fas fa-arrow-left fa-lg"></i></button>
                    <div class="row mt-4 py-1 shadow" id="section-cart">
                                            <div class="col-sm-12 mt-1 pb-2">
                                                    <span class="font-14 text-secondary">Alamat pengiriman</span><br>
                                                    <textarea class="form-control mt-2" name="alamat" id="alamat" rows="3"></textarea>
                                            </div>
                                      </div>
            <?php foreach ($id_cart_checkout as $checkout) : ?>
              <?php $cart_item = $carts->checkoutCart($checkout);  ?>
              <?php $product = $products->editProduct($cart_item['id_barang']); ?>
                                    <!-- cart item -->
                                    <div class="row border-top py-3 mt-4 shadow" id="section-cart">
                                            <div class="col-sm-2 pr-0">
                                                <img src="img/<?= $product['gambar_barang']; ?>" style="height: 90px;" alt="cart1" class="img-fluid">
                                                </div>
                                            <div class="col-sm-10">
                                                <h5 class="font-16 name"><?= $product['nama_barang']; ?></h5>
                                                <small>Rp&nbsp;<?= number_format(intval($cart_item['harga'])); ?> /produk</small> <br>
                                                <small id="">Total:&nbsp;<?= $cart_item['quantitas']; ?></small>
                                            </div>
                                      </div>
                                      <input type="hidden" class="id_keranjang" name="keranjang[]" value="<?= $checkout; ?>">
                                      <input type="hidden" class="id_barang" name="barang[]" value="<?= $cart_item['id_barang']; ?>">
                                      <input type="hidden" class="harga" name="harga[]" value="<?= $cart_item['harga']; ?>">
                                      <input type="hidden" class="quantitas" name="quantitas[]" value="<?= $cart_item['quantitas']; ?>">
                                      <input type="hidden" id="grand_total_val" name="grand_total" value="<?= $grand_total; ?>">
                                    <!-- !cart item -->
                         <?php endforeach; ?>
                                </div>
                                <!-- subtotal section-->
                                <div class="col-md-5 mt-4">
                                    <div class="sub-total border text-center mt-2 shadow" id="section-cart">
                                        <h6 class="font-size-12 font-rale text-secondary py-3"><i class="fas fa-file-invoice-dollar"></i> Detail Pesanan</h6>
                                        <div class="border-top p-2">
                                           <div class="d-flex justify-content-between mx-2">
                                            <h5 class="font-16 font-weight-bold">Total</h5>
                                            <h5 class="font-16 font-weight-bold"><span class="text-danger" id="grand_total">Rp&nbsp;<?= number_format(intval($grand_total)); ?></span> </h5>
                                           </div>
                                           <div id="section-btn">
                                            <button id="btn-cart" class="btn w-75 mt-3">Buat Pesanan</button>
                                           </div>
                                        </div>
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

            $('#btn-back').click(function(){
            window.history.back();
        })
            
            $('#btn-cart').click(function(){
                    var alamat = $('#alamat').val();
                    var id_keranjang = $('.id_keranjang').serialize();
                    var id_barang = $('.id_barang').serialize();
                    var harga = $('.harga').serialize();
                    var quantitas = $('.quantitas').serialize();
                    var grand_total = $('#grand_total_val').val();

                    $.post("cart.process.php", id_keranjang + "&" + id_barang + "&" + harga + "&" + quantitas + "&grand_total=" + grand_total + "&alamat=" + alamat + "&metode=checkout")
                    .done(function(data){
                        // toastr.info(data);
                        setTimeout(function(){
                            window.location.href = "payment.php?id=" + data;
                        });
                    });

                    
                });
        })
    </script>
    
  </body>
</html>