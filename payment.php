<?php 

session_start();
include('./includes/class-autoload.inc.php');
require_once('./templates/header.php');
require_once('navbar.php');

if (isset($_GET['id'])) {
	$id_order = $_GET['id'];
}
else{
    	header("location: {$_SERVER['HTTP_REFERER']}");
}
$orders = new Order();

$order = $orders->getOrderTransaction($id_order);
 ?>
<main class="main">
	<div class="container">
		<div class="row justify-content-center main">
			<div class="col-md-10" id="section-cart">
                    <button class="btn bg--primary text-white position-relative" id="btn-back" style="top: 10px;"><i class="fas fa-arrow-left fa-lg"></i></button>
				<div class="row justify-content-center mt-5">
					<div class="col-md-5">
						<div class="border text-center mt-2 pb-3 shadow" id="section-cart">
                                        <h6 class="font-size-12 font-rale text-secondary py-3"><i class="fas fa-file-invoice-dollar"></i> Pembayaran</h6>
                                        <div class="border-top p-2">
                                           <div class="d-flex justify-content-between mx-2">
                                            <h5 class="font-16 font-weight-bold">Total</h5>
                                            <h5 class="font-16 font-weight-bold"><span class="text-danger" id="grand_total">Rp&nbsp;<?= number_format(intval($order['grand_total'])); ?></span> </h5>
                                           </div>
                                           <hr class="w-100">
                                           <h5 class="font-16">No Rekening:</h5>
                                           <h5 class="font-20 ">1200&nbsp;8067&nbsp;0068&nbsp;7812</h5>
                                           <form action="" id="form-submit">
                                           	<input type="hidden" name="id_order" value="<?= $id_order; ?>">
	                                           <div class="custom-file my-3">
			                                      <input type="file" class="custom-file-input" id="file_gambar" name="gambar_bukti">
			                                      <label class="custom-file-label" for="file_gambar">Masukkan Bukti Pembayaran</label>
			                                    </div>
	                                           <div id="section-btn">
	                                            <button id="btn-cart" class="btn w-75 mt-3">Pembayaran</button>
                                           </form>
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

        $('#btn-back').click(function(){
            window.history.back();
        })
    	
    	$('#btn-cart').click(function(e){
    			e.preventDefault();
    			var fm = document.getElementById('form-submit');
    			var fd = new FormData(fm);
    			 var files = $('#file_gambar')[0].files; 
                fd.append('file', files[0]); 
       
                $.ajax({ 
                    url: 'payment.process.php', 
                    type: 'post', 
                    data: fd, 
                    contentType: false, 
                    processData: false, 
                    success: function(response){ 
                        toastr.success(response);
                        setTimeout(function(){
                        	window.location.href = "index.php";
                        },3000);
                    }
                });
    		});

        
    	})
    </script>
    
  </body>
</html>