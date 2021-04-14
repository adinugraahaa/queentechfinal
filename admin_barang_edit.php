<?php

$active_page = "admins"; 
include('./includes/class-autoload.inc.php');
require_once('./templates/header.php');
require_once('navbar.php');
require_once('admin_sidebar.php');


if (isset($_GET['id'])) {
  $id_barang = $_GET['id'];

  $products = new Product();

  $product = $products->editProduct($id_barang);
}else{
  die;
}
 ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                      <div class="massage text-center"></div>
                        <form class="formRegister p-3 mx-auto mt-4 rounded shadow" id="form-submit"  action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="gambar_lama" value="<?= $product['gambar_barang'] ?>">
                                    <input type="hidden" name="id_barang" value="<?= $product['id'] ?>" >
                                    <div class="form-row">
                                      <div class="mb-3 col-md-6 form-group">
                                        <label class="small mb-1" for="brand_barang">Brand</label>
                                          <input type="text" class="form-control form-control-sm" id="brand_barang" name="brand_barang" value="<?= $product['brand_barang']; ?>">
                                      </div>
                                      <div class="col-md-6 mb-3 form-group">
                                        <label class="small mb-1" for="nama_barang">Nama</label>
                                          <input type="text" class="form-control form-control-sm" id="nama_barang" name="nama_barang" value="<?= $product['nama_barang']; ?>">
                                      </div>
                                    </div>
                                    <div class="form-row">
                                      <div class="mb-3 col-md-6 form-group">
                                        <label class="small mb-1" for="nama_barang">Warna</label>
                                          <input type="text" class="form-control form-control-sm" id="warna_barang" name="warna_barang" value="<?= $product['warna_barang']; ?>">
                                      </div>
                                      <div class="col-md-6 mb-3 form-group">
                                        <label class="small mb-1" for="nama_barang">RAM</label>
                                          <input type="text" class="form-control form-control-sm" id="ram_barang" name="ram_barang" value="<?= $product['ram_barang']; ?>">
                                      </div>
                                    </div>
                                    <div class="form-row">
                                      <div class="mb-3 col-md-6 form-group">
                                        <label class="small mb-1" for="nama_barang">Memori</label>
                                          <input type="text" class="form-control form-control-sm" id="memori_barang" name="memori_barang" value="<?= $product['memori_barang']; ?>">
                                      </div>
                                      <div class="col-md-6 mb-3 form-group">
                                        <label class="small mb-1" for="nama_barang">Baterai</label>
                                          <input type="text" class="form-control form-control-sm" id="baterai_barang" name="baterai_barang" value="<?= $product['baterai_barang']; ?>">
                                      </div>
                                    </div>
                                    <div class="form-row">
                                      <div class="mb-3 col-md-6 form-group">
                                        <label class="small mb-1" for="nama_barang">Kamera Depan</label>
                                          <input type="text" class="form-control form-control-sm" id="kamera_depan_barang" name="kamera_depan_barang" value="<?= $product['kamera_depan_barang']; ?>">
                                      </div>
                                      <div class="col-md-6 mb-3 form-group">
                                        <label class="small mb-1" for="nama_barang">Kamera Belakang</label>
                                          <input type="text" class="form-control form-control-sm" id="kamera_belakang_barang" name="kamera_belakang_barang" value="<?= $product['kamera_belakang_barang']; ?>">
                                      </div>
                                    </div>
                                    <div class="form-row">
                                      <div class="mb-3 col-md-6 form-group">
                                        <label class="small mb-1" for="nama_barang">Stok</label>
                                          <input type="text" class="form-control form-control-sm" id="stok_barang" name="stok_barang" value="<?= $product['stok_barang']; ?>">
                                      </div>
                                      <div class="col-md-6 mb-3 form-group">
                                        <label class="small mb-1" for="nama_barang">Harga</label>
                                          <input type="text" class="form-control form-control-sm" id="harga_barang" name="harga_barang" value="<?= $product['harga_barang']; ?>">
                                      </div>
                                    </div>

                                    <div class="form-row">
                                      <div class="form-group col-md-6 mb-3">
                                        <img src="img/<?= $product['gambar_barang']?>" alt="" style="width: 110px; height: 110px; margin: 0 5px">
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_gambar" name="gambar_barang">
                                      <label class="custom-file-label" for="file_gambar">Pilih File Gambar</label>
                                      </div>
                                    </div>
                                    <div class="mb-3 col-md-6 form-group">
                                        <label class="small mb-1" for="nama_barang">Deskripsi</label>
                                          <textarea name="deskripsi_barang" id=" form-control-smdeskripsi_barang" cols="30" rows="4" class="form-control"><?= $product['deskripsi_barang']; ?></textarea>
                                      </div>
                                  </div>
                                    <div class="mb-3 row">
                                        <button type="button" class="btn btn-secondary ml-auto" id="btn-cancel">Cancel</button>
                                        <button class="btn btn-primary mx-2" id="btn-submit" type="submit" name="submit">Perbarui</button>
                                    </div>
                                </form>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
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
          
          $('#btn-submit').click(function(e){
            e.preventDefault();
            var fm = document.getElementById('form-submit');
            var fd = new FormData(fm);
           var files = $('#file_gambar')[0].files; 
                fd.append('file', files[0]); 
       
                $.ajax({ 
                    url: 'admin_update_product.process.php', 
                    type: 'post', 
                    data: fd,
                    dataType: 'json', 
                    contentType: false, 
                    processData: false, 
                    success: function(response){ 
                        if (response.status) {
                          toastr.info(response.message);
                          setTimeout(function(){
                            window.location.href = 'admin_barang.php';
                          }, 3000);
                        }else{
                          toastr.info(response.message);
                          // fd.reset();
                        }
                    }
                });
          });

          $('#btn-cancel').click(function(e){
            e.preventDefault();

            window.location.href = "admin_barang.php";
          })
      })
    </script>
    
  </body>
</html> 