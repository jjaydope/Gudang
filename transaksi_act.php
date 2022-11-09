<?php
include 'koneksi.php';
session_start();
include "authcheck.php";

//menghilangkan Rp pada nominal
$bayar = preg_replace('/\D/', '', $_POST['bayar']);
// print_r(preg_replace('/\D/', '', $_POST['total']));

// print_r($_SESSION['cart']) ;

$tanggal_waktu = date('Y-m-d H:i:s');
$nomor = rand(111111,999999);
$nip = 	$_POST['member'];
 // session login petugas
$petugas = $_SESSION['id_petugas'];


//insert ke tabel transaksi
mysqli_query($conn, "INSERT INTO transaksi (id_petugas,NIP,tgl) VALUES ('$petugas','$nip','$tanggal_waktu')");

//mendapatkan id transaksi baru
$id_transaksi = mysqli_insert_id($conn);

//insert ke detail transaksi
foreach ($_SESSION['cart'] as $key => $value) {

	$id_barang = $value['id'];
	$qty = $value['qty'];
	$tanggal = date('Y-m-d H:i:s');

	mysqli_query($conn,"INSERT INTO detail_transaksi (id_transaksi,id_barang,qty,tgl) VALUES ('$id_transaksi','$id_barang','$qty','$tanggal')");

	// $sum += $value['harga']*$value['qty'];
}

$_SESSION['cart'] = [];
//redirect ke halaman transaksi selesai
header("location:transaksi_selesai.php?id_transaksi=".$id_transaksi);



?>