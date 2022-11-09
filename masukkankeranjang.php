<?php
session_start();
if($_POST){
include "koneksi.php";
$qry_get_barang=mysqli_query($conn,"select * from barang where
id_barang = '".$_GET['id_barang']."'");
$dt_barang=mysqli_fetch_array($qry_get_barang);
$_SESSION['cart'][]=array(
'id_barang'=>$dt_barang['id_barang'],
'nama_barang'=>$dt_barang['nama_barang'],
'qty'=>$_POST['jumlah_minta']
);
}
header('location: keranjang.php');
?>