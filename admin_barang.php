<?php 

session_start();
include('./includes/class-autoload.inc.php');
$active_page = "admins";
require_once('./templates/header.php');
require_once('navbar.php');

if ($_SESSION['Login_Verified'] == false) {
      header('location: admin');
}
$product_all = new Product(); 
$members = new Member();
$id_member = $_SESSION['id_member'];
$checkadmin = $members->getProfile($id_member);    
    
    if ($checkadmin['admin'] == "0") {
      header('location: index.php');
    }
require_once('admin_sidebar.php');
    if (isset($_POST['search'])) {
      $products = $product_all->searchProduct($_POST['input_search']);
    }else{
    $products = $product_all->getProducts();
    }

    // if(time() - $_SESSION['timestamp'] > 900) { //subtract new timestamp from the old one
    // echo"<script>alert('15 Minutes over!');</script>";
    // unset($_SESSION['Login_OTP'], $_SESSION['Login_Password'], $_SESSION['Login_Verified'], $_SESSION['timestamp']);
    // header("Location:  index.php"); //redirect to index.php
    // exit;
    // } else {
    //     $_SESSION['timestamp'] = time(); //set new timestamp
    // }
 ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-12 my-3">
                                <div class="d-flex bd-highlight justify-content-between">
                                    <div class="bd-highlight">
                                        <button type="button" class="btn btn--primary" data-toggle="modal" data-target="#addProductModal" style="background-color: #1C4857">Tambah Barang</button>
                                    </div>
                                    <div class="bd-highlight">
                                        <form action="" method="POST" id="form-search">
                                            <div class="input-group">
                                                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name="input_search" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit" name="search" id="btn-search"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="text-center font-14">
                                            <th>Nama</th>
                                            <th>Gambar</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="product-list">
                                        <?php if($products) : ?>
                                        <?php foreach ($products as $product) : ?>
                                            <tr>
                                            <td><?= $product['nama_barang']?></td>
                                            <td><img style="widtd: 50px; height: 50px" src="img/<?= $product['gambar_barang']?>" alt=""></td>
                                            <td style="widtd: 130px">Rp <?= number_format(intval($product['harga_barang']))?></td>
                                            <td><?= $product['stok_barang']?></td>
                                            <td><a href="admin_barang_edit.php?id=<?= $product['id']?>"><button class="btn btn-warning text-white    ">Ubah</button></a></td>
                                            <td><a href="admin_delete_product.process.php?id=<?= $product['id']?>&send=del"><button class="btn btn-danger">Hapus</button></a></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                            <p class="mx-auto mt-5">post is empty</p >
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal Add Product-->
                            <div class="modal fade" id="addProductModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Produk</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form class="formRegister mx-auto" action="" method="POST" enctype="multipart/form-data" id="form-submit">
                                    <div class="form-row">
                                     	<div class="mb-3 col-md-6 form-group">
                                     		<label class="small mb-1" for="brand_barang">Brand</label>
                                          <input type="text" class="form-control form-control-sm" id="brand_barang" name="brand_barang" placeholder="Masukkan brand">
                                    	</div>
                                    	<div class="col-md-6 mb-3 form-group">
                                    		<label class="small mb-1" for="nama_barang">Nama</label>
                                          <input type="text" class="form-control form-control-sm" id="nama_barang" name="nama_barang" placeholder="Masukkan nama">
                                    	</div>
                                    </div>
                                    <div class="form-row">
                                     	<div class="mb-3 col-md-6 form-group">
                                     		<label class="small mb-1" for="nama_barang">Warna</label>
                                          <input type="text" class="form-control form-control-sm" id="warna_barang" name="warna_barang" placeholder="Masukkan warna">
                                    	</div>
                                    	<div class="col-md-6 mb-3 form-group">
                                    		<label class="small mb-1" for="nama_barang">Ram</label>
                                          <input type="text" class="form-control form-control-sm" id="ram_barang" name="ram_barang" placeholder="Masukkan ram">
                                    	</div>
                                    </div>
                                    <div class="form-row">
                                     	<div class="mb-3 col-md-6 form-group">
                                     		<label class="small mb-1" for="nama_barang">Memori</label>
                                          <input type="text" class="form-control form-control-sm" id="memori_barang" name="memori_barang" placeholder="Masukkan memori">
                                    	</div>
                                    	<div class="col-md-6 mb-3 form-group">
                                    		<label class="small mb-1" for="nama_barang">Baterai</label>
                                          <input type="text" class="form-control form-control-sm" id="baterai_barang" name="baterai_barang" placeholder="Masukkan baterai">
                                    	</div>
                                    </div>
                                    <div class="form-row">
                                     	<div class="mb-3 col-md-6 form-group">
                                     		<label class="small mb-1" for="nama_barang">Kamera Depan</label>
                                          <input type="text" class="form-control form-control-sm" id="kamera_depan_barang" name="kamera_depan_barang" placeholder="Masukkan kamera depn">
                                    	</div>
                                    	<div class="col-md-6 mb-3 form-group">
                                    		<label class="small mb-1" for="nama_barang">Kamera Belakang</label>
                                          <input type="text" class="form-control form-control-sm" id="kamera_belakang_barang" name="kamera_belakang_barang" placeholder="Masukkan kamera belakang">
                                    	</div>
                                    </div>
                                    <div class="form-row">
                                     	<div class="mb-3 col-md-6 form-group">
                                     		<label class="small mb-1" for="nama_barang">Stok</label>
                                          <input type="text" class="form-control form-control-sm" id="stok_barang" name="stok_barang" placeholder="Masukkan stok">
                                    	</div>
                                    	<div class="col-md-6 mb-3 form-group">
                                    		<label class="small mb-1" for="nama_barang">Harga</label>
                                          <input type="text" class="form-control form-control-sm" id="harga_barang" name="harga_barang" placeholder="Masukkan harga">
                                    	</div>
                                    </div>
                                    <div class="form-row">
                                     	<div class="mb-3 col-md-6 form-group">
                                     		<label class="small mb-1" for="nama_barang">Deskripsi</label>
                                          <textarea name="deskripsi_barang" id=" form-control-smdeskripsi_barang" cols="30" rows="3" class="form-control"></textarea>
                                    	</div>
                                    	<div class="col-md-6 mb-3 mt-4">
                                          <div class="custom-file mb-3">
		                                      <input type="file" class="custom-file-input" id="file_gambar" name="gambar_barang">
		                                      <label class="custom-file-label" for="file_gambar">Pilih File Gambar</label>
		                                    </div>
                                    	</div>
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <button type="button" class="btn btn--secondary ml-auto" data-dismiss="modal" id="btn-close">Batal</button>
                                        <button class="btn btn--primary mx-2" id="btn-submit" type="submit" name="submit">Tambah</button>
                                    </div>
                                </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- End Modal Add Product-->
                        </div>
                    </div>
                </main>
            </div>
</div>

    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js
"></script>
    <script>
    	$(function(){

    		function getData(){
    			$.get('admin_barang_data.php', function(data){
    				$('#product-list').html(data);
    			})
    		}

    		$('#form-submit').attr("required", 'required');

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

    		$('#btn-submit').click(function(e){
    			e.preventDefault();
    			var fm = document.getElementById('form-submit');
    			var fd = new FormData(fm);
    			 var files = $('#file_gambar')[0].files; 
                fd.append('file', files[0]); 
       
                $.ajax({ 
                    url: 'admin_add_product.process.php', 
                    type: 'post', 
                    data: fd, 
                    contentType: false, 
                    processData: false, 
                    success: function(response){ 
                        toastr.info(response);
                        getData();
                        $('#form-submit').trigger("reset");
                        $('#btn-close').trigger("click");
                    }
                });
    		});

        $('#btn-search').click(function(e){
          e.preventDefault();

          var fd = $('input[name=input_search]').val();

          $.post("admin_search_product.process.php", {search: fd})
          .done(function(data){
            $('#product-list').html(data);
          })
        })
    	})
    </script>
    
  </body>
</html>