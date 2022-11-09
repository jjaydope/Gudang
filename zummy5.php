<?php
include "koneksi.php";
$kode_barcode = addslashes(trim($_POST['input_scanner']));
$nama_barang = addslashes(trim($_POST['nama_barang']));
$stok = addslashes(trim($_POST['stok']));
$input = mysqli_query($conn,"insert into barang(kode_barang,nama_barang,stok) values('$kode_barcode','$nama_barang','$stok')");
if($input){
   echo "Data berhasil disimpan";
}else{
   echo "Data gagal disimpan";
}
