<?php 


   include('./includes/class-autoload.inc.php');

    if ($_GET['send'] == "del") {
      
      $id_keranjang_satuan = $_GET['id'];

      $cart = new cart();

      $cart->deleteCart($id_keranjang_satuan);

      header("location: {$_SERVER['HTTP_REFERER']}");

    }