<?php 


    include('./includes/class-autoload.inc.php');

    $products = new Product();

    $productss = $products->getProducts();

    $data = '';
    if ($productss) {
        
    foreach ($productss as $product) {
    	$data .= '<tr>
                    <td>'. $product['nama_barang'] .'</td>
                    <td><img style="widtd: 50px; height: 50px" src="img/'. $product['gambar_barang'] .'" alt=""></td>
                    <td style="widtd: 130px">Rp '. number_format(intval($product['harga_barang'])) .'</td>
                    <td>' . $product['stok_barang'] .'</td>
                    <td><a href="admin_barang_edit.php?id=' . $product['id_barang'] .'"><button class="btn btn-warning text-white    ">Edit</button></a></td>
                    <td><a href="admin_delete_product.process.php?id=' . $product['gambar_barang'] .'&send=del"><button class="btn btn-danger">Delete</button></a></td>
                </tr>';
    }
    }else{
        $data .= '<tr>
                    <td>Post is empty</td>
                </tr>';
    }

    echo $data;