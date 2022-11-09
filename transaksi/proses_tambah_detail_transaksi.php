<?php
if($_POST) {
    $id_transaksi = $_POST['id_transaksi'];
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];


    if(empty($id_transaksi)) {
        echo "<script>alert('id transaksi tidak boleh kosong');location.href='tambah_detail_transaksi.php';</script>";
    } elseif(empty($id_barang)) {
        echo "<script>alert('id paket tidak boleh kosong');location.href='tambah_detail_transaksi.php';</script>";
    } elseif(empty($qty)) {
        echo "<script>alert('qty tidak boleh kosong');location.href='tambah_detail_transaksi.php';</script>";
    } else {
        
        include "../koneksi.php";

        $abc= mysqli_query($conn, "insert into detail_transaksi (id_transaksi,id_barang,qty) value ('". $id_transaksi."','".$id_barang."','".$qty."')");

        if($abc) {  
            echo "<script>alert('Sukses menambahkan data detail transaksi');location.href='tambah_detail_transaksi.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan data detail transaksi');location.href='tambah_detail_transaksi.php';</script>";
        }
    }
}
?>