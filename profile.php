<?php 
session_start();
include('./includes/class-autoload.inc.php');
require_once('./templates/header.php');
require_once('navbar.php');

if (isset($_SESSION['id_member'])) {
	$id_member = $_SESSION['id_member'];
}else{
	header("location : 404.php");
}
 
 $members = new Member();
 $transactions = new Transaction();
 $member = $members->getProfile($id_member);
 $transaction = $transactions->getTransactionHistory($id_member);
 $order = $transactions->getOrderHistory($id_member);
 ?>

<main class="main">
	<div class="container-fluid mt-4">
		<div class="row">
			<!-- PHOTO SESSION -->
			<div class="col-sm-12 col-md-7 mt-5">
        <ul class="nav nav-pills mb-3" id="nav-detail" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="pills-selesai-tab" data-toggle="pill" href="#pills-selesai" role="tab" aria-controls="pills-selesai" aria-selected="true">Selesai</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-belum-selesai-tab" data-toggle="pill" href="#pills-belum-selesai" role="tab" aria-controls="pills-belum-selesai" aria-selected="false">Belum Selesai</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-selesai" role="tabpanel" aria-labelledby="pills-selesai-tab">
    <table class="table tabel-hover bg-white text-center">
          <thead>
            <th></th>
            <th>Nama Barang</th>
            <th>total</th>
            <th>Tanggal Pemesanan</th>
          </thead>
          <tbody>
            <?php if($transaction) : ?>
              <?php foreach ($transaction as $history) : ?>
                <tr id="section-cart" class="shadow-lg">
              <td><img src="img/<?= $history['gambar_barang']; ?>" style="height: 90px;" alt="cart1" class="img-fluid"></td>
              <td width="300px"><?= $history['nama_barang'] . " x" . $history['quantitas']; ?></td>
              <td>Rp&nbsp;<?= number_format(intval($history['total'])) ?></td>
              <td><?= $history['tgl_pembayaran'] ?></td>
            </tr>
            <?php endforeach; ?>
            <?php else : ?>
             <p class="mx-auto mt-5">post is empty</p >
          <?php endif; ?>
          </tbody>
        </table>
  </div>
  <div class="tab-pane fade" id="pills-belum-selesai" role="tabpanel" aria-labelledby="pills-belum-selesai-tab">
            <?php if($order) : ?>
    <table class="table tabel-hover bg-white text-center">
          <thead>
            <th></th>
            <th>Nama Barang</th>
            <th>total</th>
            <th>Tanggal Pemesanan</th>
          </thead>
          <tbody>
              <?php foreach ($order as $history) : ?>
               </a>
                <tr id="section-cart" class="shadow-lg">
              <td><img src="img/<?= $history['gambar_barang']; ?>" style="height: 90px;" alt="cart1" class="img-fluid"></td>
              <td width="300px"> <a href="payment.php?id=<?= $history['id']; ?>"><?= $history['nama_barang'] . " x" . $history['quantitas']; ?></a></td>
              <td>Rp&nbsp;<?= number_format(intval($history['total'])) ?></td>
              <td><?= $history['tgl_pembayaran'] ?></td>
            </tr>
            <?php endforeach; ?>
            
          </tbody>
        </table>
        <?php else : ?>
             <p class="mx-auto mt-5 text-center">History is empty</p >
          <?php endif; ?>
  </div>
</div>
				
			</div>
			<!-- END PHOTO SESSION -->
			<div class="col-sm-12 col-md-4 ml-5">
				<div class="row justify-content-center">
                            <div class="col-sm-12 col-md-12">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Biodata Diri</h3></div>
                                    <div class="card-body">
                                        <form action="profile.process.php" method="post">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label small mb-1" for="inputNama">Nama</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control py-1" id="inputNama" type="text" name="nama" placeholder="" value="<?php echo $member['nama'] ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label small mb-1" for="inputAlamat">Alamat</label>
                                                <div class="col-sm-8">
                                                	<textarea class="form-control py-1" id="inputAlamat" type="text" name="alamat" placeholder=""><?= $member['alamat'] ?> </textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label small mb-1" for="inputEmail">Email</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control py-1" id="inputEmail" type="email" name="email" placeholder="" value="<?= $member['email'] ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label small mb-1" for="inputTelp">Telp</label>
                                                <div class="col-sm-8">
                                                	<input class="form-control py-1" id="inputTelp " type="text" name="telp" placeholder="" value="<?=$member['telp'] ?>"/>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group d-flex align-items-center justify-content-end mt-4 mb-0">
                                                <a class="small d-none" href="password.html">Forgot Password?</a>
                                                <button type="submit" name="submit" class="btn btn-primary" style="width: 100px">Ubah</button>
                                            </div>
                                        </form>
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
       function getCart(){
          $.get("cart.process.php", {count_cart : "count_cart"})
          .done(function(data){
            $('#cart-count').html(data);
          })
        }

        getCart();
      })
    </script>
    
  </body>
</html>