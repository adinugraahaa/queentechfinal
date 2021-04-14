<?php 
	session_start();
    include('./includes/class-autoload.inc.php');
	date_default_timezone_set('Asia/Jakarta');
    $tanggal = date("Y-m-d H:i:s");
	$id_member = $_SESSION['id_member'];
	$cart = new Cart();

    if (isset($_GET["count_cart"])) {
    	$getCart = $cart->getCartMember($id_member);
    	if ($getCart) {
    		echo count($getCart);
    	}else{
    		echo '';
    	}

    }

    if (isset($_POST['action']) && isset($_POST['action']) == 'cart') {
    	$data = '';
    	$id_barang = $_POST['id_barang'];
    	$quantitas = $_POST['quantity'];
    	$harga = $_POST['harga_barang'];
    	$cart_member = $cart->getCarts($id_member);
    	$id_cart_member = $cart_member['id'];
    	$checkCart = $cart->checkCartMember($id_barang, $id_cart_member);
    	if ($checkCart) {
    		$quantitas_cart_member = $checkCart['quantitas'];
    		$quantitas_baru = intval($quantitas) +  intval($quantitas_cart_member);
    		$id_cart_item_member = $checkCart['id'];
    		$cart->updateCartMember($quantitas_baru, $id_cart_item_member);
    		echo "Product telah update di keranjang";
    	}else{
    		$cart->addCart($id_barang, $id_cart_member, $harga, $quantitas, $tanggal);
    	echo "Produk telah di tambahkan ke keranjang";
		}
    }

    if (isset($_POST['mode']) && isset($_POST['mode']) == 'update') {
    	$id_cart = $_POST['id_cart'];
    	$quantitas = $_POST['qty'];
    	$cart->updateCartMember($quantitas, $id_cart);
    	echo 'Update quantity successfully !';
    }

    if (isset($_POST['method']) && isset($_POST['method']) == 'submit') {
    	$id_cart_item = $_POST['keranjang'];
    	$grand_total = $_POST['grand_total'];

    	$data = array("keranjang_id" => $id_cart_item, "grand_total" => $grand_total);
    	$_SESSION['checkout'] = $data;

    	echo "ok";
    }

    if (isset($_POST['metode']) && isset($_POST['metode']) == 'checkout') {
    	$orders = new Order();
    	$members = new Member();
    	$db = new Dbh();
    	$tanggal = date("Y-m-d H:i:s");
    	$id_keranjang = $_POST['keranjang'];
    	$id_barang = $_POST['barang'];
    	$harga_item = $_POST['harga'];
    	$quantitas_item = $_POST['quantitas'];
    	$grand_total = $_POST['grand_total'];
    	$alamat = $_POST['alamat'];
    	$count = count($id_keranjang);
    	$count_prev = $count;
    	$member = $members->getProfile($id_member);
    	$nama = $member['nama'];
    	$orders->NewOrder($id_member, $grand_total, $nama, $alamat, $tanggal);
    	$order_member = $orders->getOrders($tanggal);
    	$id_order_member = $order_member['id'];



// 
    	for ($i=0; $i < $count; $i++) { 
    		$orders->addOrder($id_barang[$i], $id_order_member, $harga_item[$i], $quantitas_item[$i], $tanggal);
    		$cart->deleteCart($id_keranjang[$i]);	
    	}
    	echo $id_order_member;
    	// echo var_dump($_POST);

    }



