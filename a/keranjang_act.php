<?php
include '../koneksi.php';


if (isset($_POST['kode_barang'])) {
    $kode_barang = $_POST['kode_barang'];
    $qty = 1;
}
    //menampilkan data barang
    $data = mysqli_query($conn, "SELECT * FROM dummy WHERE kode_barang='$kode_barang'");
    $b = mysqli_fetch_assoc($data);

        $barang = [
            'id' => $b['id_dummy'],
            'nama' => $b['nama'],
            'qty' => $qty,

        
        //merubah urutan tampil pada keranjang
        // krsort($_SESSION['cart']);
        ]

