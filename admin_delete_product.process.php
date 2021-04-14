<?php 


    include('./includes/class-autoload.inc.php');

    if ($_GET['send'] == "del") {
    	
    	$id_barang = $_GET['id'];

    	$product = new Product();

    	$product->deleteProduct($id_barang);

    	// var_dump($id_barang);
    	// die;
    	header("location: {$_SERVER['HTTP_REFERER']}");

    }