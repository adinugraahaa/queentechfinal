<?php 


    include('./includes/class-autoload.inc.php');
    $transactions  = new Transaction();

    if (isset($_POST['data']) && isset($_POST['data']) == "transaksi") {
    	
    	$transaksi_data = $transactions->getTransaction();
    	$data = '';

    	foreach ($transaksi_data as $transaksi) {
    		$data .= '<tr>
                        <td>' . $transaksi['nama'] . '</td>
                        <td>' . $transaksi['nama_barang'] . '</td>
                        <td>' . $transaksi['quantitas'] . '</td>
                        <td>Rp&nbsp;' . number_format(intval($transaksi['total'])) . '</td>
                        <td>' . $transaksi['status'] . '</td>
                        <td>' . $transaksi['tgl_pembayaran'] . '</td>
                    </tr>';
    	}

    	echo $data;
    }

    if (isset($_POST['date'])) {

    	$dates = $_POST['date'];
    	$date = explode(" - ", $dates);
    	$start_date = $date[0];
    	$end_date = $date[1];
    	$data = '';
    	$search_data = $transactions->search($start_date, $end_date);

    	if ($search_data) {
	    	foreach ($search_data as $transaksi) {
	    		$data .= '<tr>
	                        <td>' . $transaksi['nama'] . '</td>
	                        <td>' . $transaksi['nama_barang'] . '</td>
	                        <td>' . $transaksi['quantitas'] . '</td>
	                        <td>' . number_format(intval($transaksi['total'])) . '</td>
	                        <td>' . $transaksi['status'] . '</td>
	                        <td>' . $transaksi['tgl_pembayaran'] . '</td>
	                    </tr>';
	    	}
    	}else{
    		$data .= '<tr>
	                        <td colspan="6"> Data not found </td>
	                  </tr';
    	}

    	echo $data;
    }