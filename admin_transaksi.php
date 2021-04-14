<?php 
session_start();
include('./includes/class-autoload.inc.php');
$active_page = "admins";
require_once('./templates/header.php');
require_once('navbar.php');
if ($_SESSION['Login_Verified'] == false) {
      header('location: admin');
}

$members = new Member();
$id_member = $_SESSION['id_member'];
$checkadmin = $members->getProfile($id_member);    
    
    if ($checkadmin['admin'] == "0") {
      header('location: index.php');
    }
require_once('admin_sidebar.php');

// if(time() - $_SESSION['timestamp'] > 60) { //subtract new timestamp from the old one
//     echo"<script>alert('15 Minutes over!');</script>";
//     unset($_SESSION['Login_OTP'], $_SESSION['Login_Password'], $_SESSION['Login_Verified'], $_SESSION['timestamp']);
//     header("Location:  index.php"); //redirect to index.php
//     exit;
//     } else {
//         $_SESSION['timestamp'] = time(); //set new timestamp
//     }
 ?>
<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-12 my-3">
                                <div class="d-flex bd-highlight justify-content-end d-none">
                                    <div class="bd-highlight">
                                        <form action="" method="POST">
                                            <div class="input-group">
                                                <input class="form-control" type="text" placeholder="Select Date" aria-label="Search" aria-describedby="basic-addon2" name="datefilter" style="width: 220px" />
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" name="search" id="btn-search"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row my-3">
                            <?php $transactions = new Transaction(); ?>
                            <div class="col-sm-12 col-md-12">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="font-14">
                                            <th>Nama Member</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Tanggal Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody id="transaksi-list">
                                        <!-- <?php foreach ($transactions->getTransaction() as $transaction) : ?>
                                            <tr>
                                            <td><?= $transaction['nama']?></td>
                                            <td><?= $transaction['nama_barang']?></td>
                                            <td><?= $transaction['quantitas']?></td>
                                            <td><?= $transaction['total']?></td>
                                            <td><?= $transaction['status']?></td>
                                            <td><?= $transaction['tgl_pembayaran']?></td>
                                        </tr>
                                        <?php endforeach; ?>  -->
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </main>
                <!-- <footer class="py-4 bg-light mt-auto">
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
                </footer> -->
            </div>


</div>

<?php 
// require_once('./templates/footer.php');
 ?>

 <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
 <script type="text/javascript" src="js/bootstrap.min.js"></script>
 <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
 
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js
 "></script>
     <script>
         $(function(){

            function getData(){
                $.post("admin_transaksi_data.php", {data: "transaksi"})
                .done(function(data){
                    $('#transaksi-list').html(data);
                })
            }
            getData();
         
         $('input[name="datefilter"]').daterangepicker({
              autoUpdateInput: false,
              locale: {
                  cancelLabel: 'Clear'
              }
          });

          $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
              $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
          });

          $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
              $(this).val('');
          });

          $('#btn-search').click(function(e){
            e.preventDefault();

            var dt = $('input[name="datefilter"]').val();

            if (dt != '') {
              $.post("admin_transaksi_data.php", { date: dt})
              .done(function(data){
                      $('#transaksi-list').html(data);
                      // toastr.info(data);
              });
            }else{
              getData();
            }

          });
         });
     </script>
     
   </body>
 </html>